<?php 

	class Canciones extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function Canciones()
		{
            $arrGeneros = $this->model->selectGeneros();
		
			$data['page_tag'] = "Canciones";
			$data['page_name'] = "Canciones";
			$data['page_title'] = "Canciones";
            $data['Can_functions_js'] = "functions_Canciones.js";
            $data['generos'] = $arrGeneros;
			$this->views->getView($this,"canciones",$data);
            $arrPermisoRol['generos'] = $arrGeneros;
			$html = getModal("modalCanciones",$arrPermisoRol);
            
            
		}

		public function getCanciones()
		{
			$arrData = $this->model->selectCanciones();

			$arrVal = array();
			$cont=0;
			for ($i=0; $i < count($arrData); $i++) {
				$cont++;
				$name = array(
						'num' => $cont,
						'cancion'=> $arrData[$i]['nombreCancion'],
						'action'=> '<div class="text-center">
						<button class="btn btn-primary btn-sm btnEditRol" rl="'.$arrData[$i]['idCancion'].'" onclick="fntEditRol(this)" title="Editar"><i class="fas fa-pencil-alt"></i></button>
						<button class="btn btn-danger btn-sm btnDelRol" rl="'.$arrData[$i]['idCancion'].'" onclick="fntDelRol(this)" title="Eliminar"><i class="far fa-trash-alt"></i></button>
						</div>'
					); 

					array_push($arrVal, $name); 

			}
			echo json_encode($arrVal);
			die();
		}

		public function getCancion(int $idrol)
		{
			$intIdrol = intval(strClean($idrol));
			if($intIdrol > 0)
			{
				$arrData = $this->model->selectCancion($intIdrol);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function setCancion(){
			
			$intIdrol = intval($_POST['idCan']);
			$strRol =  strClean($_POST['txtNombre']);
            $strGenero =  intval($_POST['txtidGenero']);
            
			

			if($intIdrol == 0)
			{
				//Crear
				$request_rol = $this->model->insertCancion($strRol,$strGenero);
				$option = 1;
			}else{
				//Actualizar
				$request_rol = $this->model->updateCancion($intIdrol, $strRol,$strGenero);
				$option = 2;
			}

			if($request_rol)
			{
				if($option == 1)
				{
					$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.','opcion'=>'1');
				}else{
					$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.','opcion'=>'2');
				}
			}else if(!$request_rol){
				
				$arrResponse = array('status' => false, 'msg' => '¡Atención! la cancion ya existe.');
			}else{
				$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function delCancion()
		{
			if($_POST){
				$intId = intval($_POST['idCancion']);
				$requestDelete = $this->model->deleteCancion($intId);
				if($requestDelete == 'ok')
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la cancion');
				}else if($requestDelete == 'exist'){
					$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar la cancion.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

	}
 ?>