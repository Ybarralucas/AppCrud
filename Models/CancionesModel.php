<?php 

	class CancionesModel extends Mysql
	{
		public $intIdrol;
		public $strRol;
        public $strGen;
		public $strDescripcion;
		public $intStatus;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectCanciones()
		{
			//EXTRAE ROLES
			$sql = "SELECT * FROM CANCIONES";
			$request = $this->select_all($sql);
			return $request;
		}

        public function selectGeneros(){
            $sql = "SELECT * FROM GENEROS";
			$request = $this->select_all($sql);
			return $request;
        }

		public function selectCancion(int $idrol)
		{
			//BUSCAR ROLE
			$this->intIdrol = $idrol;
			$sql = "SELECT * FROM CANCIONES WHERE idCancion = $this->intIdrol";
			$request = $this->select($sql);
			return $request;
		}

		public function insertCancion(string $rol,int $idgenero){

			$return = "";
			$this->strRol = $rol;
			$this->strGen = $idgenero;

			$sql = "SELECT * FROM CANCIONES WHERE nombreCancion = '{$this->strRol}' ";
			$request = $this->select_all($sql);

            

            //var_dump($request);

			if(empty($request))
			{
                $query_insert  = "INSERT INTO CANCIONES(nombreCancion,idGenero) VALUES(?,?)";
	        	$arrData = array($this->strRol,$this->strGen);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = true;
		
			}else{
				
                $return = false;
               
			}
			return $return;
		}	

		public function updateCancion(int $idrol, string $rol,int $idgenero){
			$this->intIdrol = $idrol;
			$this->strRol = $rol;
			$this->strGen = $idgenero;

			$sql = "SELECT * FROM CANCIONES WHERE nombreCancion = '$this->strRol' AND idCancion != $this->intIdrol";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE CANCIONES SET nombreCancion = ?, idGenero=? WHERE idCancion = $this->intIdrol ";
				$arrData = array($this->strRol,$this->strGen);
				$request = $this->update($sql,$arrData);
                $res=true;
			}else{
				$res= false;
			}
		    return $res;			
		}

		public function deleteCancion(int $idrol)
		{
			$this->intIdrol = $idrol;
			$sql = "DELETE FROM CANCIONES WHERE idCancion = $this->intIdrol";
			$request = $this->delete($sql);
			if(!empty($request))
			{
				
			    $request = 'ok';	
				
			}else{
				$request = 'exist';
			}
			return $request;
		}
	}
 ?>