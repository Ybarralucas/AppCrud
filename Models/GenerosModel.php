<?php 

	class GenerosModel extends Mysql
	{
		public $intIdrol;
		public $strRol;
		public $strDescripcion;
		public $intStatus;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectGeneros()
		{
			//EXTRAE ROLES
			$sql = "SELECT * FROM GENEROS";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectGenero(int $idrol)
		{
			//BUSCAR ROLE
			$this->intIdrol = $idrol;
			$sql = "SELECT * FROM GENEROS WHERE idGenero = $this->intIdrol";
			$request = $this->select($sql);
			return $request;
		}

		public function insertGenero(string $rol){

			$return = "";
			$this->strRol = $rol;
			

			$sql = "SELECT * FROM GENEROS WHERE nombreGenero = '{$this->strRol}' ";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$query_insert  = "INSERT INTO GENEROS(nombreGenero) VALUES(?)";
	        	$arrData = array($this->strRol);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = true;
				
			}else{
				$return = false;
			}
			return $return;
		}	

		public function updateGenero(int $idrol, string $rol){
			$this->intIdrol = $idrol;
			$this->strRol = $rol;
			

			$sql = "SELECT * FROM GENEROS WHERE nombreGenero = '$this->strRol' AND idGenero != $this->intIdrol";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "UPDATE GENEROS SET nombreGenero = ?  WHERE idGenero = $this->intIdrol ";
				$arrData = array($this->strRol);
				$request = $this->update($sql,$arrData);
				$res=true;
			}else{
				$res=false;
			}
		    return $res;			
		}

		public function deleteGenero(int $idrol)
		{
			$this->intIdrol = $idrol;

			$sql = "SELECT nombreCancion FROM CANCIONES WHERE idGenero = $this->intIdrol";
			$request = $this->select_all($sql);

			if(empty($request))
			{
				$sql = "DELETE FROM GENEROS WHERE idGenero = $this->intIdrol";
				$request = $this->delete($sql);
				$res=true;
			}else{
				$res=false;
			}


			return $res;
		}
	}
 ?>