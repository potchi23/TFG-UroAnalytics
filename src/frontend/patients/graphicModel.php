<?php
	class Graphic_Model{
		private $conexion;
		function __construct()
		{
            require_once("../config/config.php");
			$this->conexion = new conexion();
			$this->conexion->conectar();
        }


		function getData(){
			$sql = "Select * from edad"; //edad es una vista que devuelve tres columnas con rangos de edad	
			$arreglo = array();
			if ($consulta = $this->conexion->conexion->query($sql)) {

				while ($consulta_VU = mysqli_fetch_array($consulta)) {
					$arreglo[] = $consulta_VU;
				}
				return $arreglo;
				$this->conexion->cerrar();	
			}
		}
	}
?>