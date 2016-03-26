<?php
class conex{ 
	public static function con(){                
                $conexion = new PDO('mysql:host=localhost;dbname=docentes_prov', 'root', '');
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
		if(!$conexion){
			return false;	
		}else{
			return $conexion;	
		}
	}	
}
?>