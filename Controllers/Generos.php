<?php 

	class Generos extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function Generos()
		{
			
			$data['page_tag'] = "Generos";
			$data['page_title'] = "Generos";
			$this->views->getView($this,"generos",$data);
		}

		public function getGeneros()
		{
			$arrData = $this->model->selectGeneros();

			$arrVal = array();
			$cont=0;
			for ($i=0; $i < count($arrData); $i++) {
				$cont++;
				$name = array(
						'num' => $cont,
						'genero'=> $arrData[$i]['nombreGenero'],
						'action'=> '<div class="text-center">
						<button class="btn btn-primary btn-sm btnEditRol" rl="'.$arrData[$i]['idGenero'].'" onclick="fntEditRol(this)" title="Editar"><i class="fas fa-pencil-alt"></i></button>
						<button class="btn btn-danger btn-sm btnDelRol" rl="'.$arrData[$i]['idGenero'].'" onclick="fntDelRol(this)" title="Eliminar"><i class="far fa-trash-alt"></i></button>
						</div>'
					); 

					array_push($arrVal, $name); 

				
			}
			echo json_encode($arrVal);
			die();
		}

		public function getGenero(int $idrol)
		{
			$intIdrol = intval(strClean($idrol));
			if($intIdrol > 0)
			{
				$arrData = $this->model->selectGenero($intIdrol);
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

		public function setGenero(){
			
			$intIdrol = intval($_POST['idG']);
			$strRol =  strClean($_POST['txtNombre']);
			

			if($intIdrol == 0)
			{
				//Crear
				$request_rol = $this->model->insertGenero($strRol);
				$option = 1;
			}else{
				//Actualizar
				$request_rol = $this->model->updateGenero($intIdrol, $strRol);
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
				
				$arrResponse = array('status' => false, 'msg' => '¡Atención! El Genero ya existe.');
			}else{
				$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function delGenero()
		{
			if($_POST){
				$intIdrol = intval($_POST['idg']);
				$requestDelete = $this->model->deleteGenero($intIdrol);
				if($requestDelete)
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado');
				
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Este genero ya esta relacionado.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

	}
 ?>