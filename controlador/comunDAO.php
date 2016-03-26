<?php
include_once 'conex.php';

function verificarPermiso($pantalla, $operacion, $id_usuario){
	
	$con = conex::con();
	
	$sql_permiso = "SELECT * FROM usuario_permiso, usuario, permiso, pantalla, operacion  
		WHERE usuario_permiso.USUARIO_ID = usuario.ID 
		AND usuario_permiso.PERMISO_ID = permiso.ID 
		AND permiso.PANTALLA_ID = pantalla.ID
		AND permiso.OPERACION_ID = operacion.ID 	
		AND pantalla.NOMBRE = :pant 
		AND operacion.NOMBRE = :ope 
		AND usuario.ID = :usu";
		$stmp = $con->prepare($sql_permiso);
        $execute = $stmp->execute(array('pant' => $pantalla, 'ope' => $operacion, 'usu' => $id_usuario));
		$resul = $stmp->fetchAll();	
		
		if(count($resul) == 0){	
			if($operacion == 'ver'){
				throw new Exception('No tiene permisos para visualizar los registros de '. $pantalla);
			}
			throw new Exception('No tiene permisos para ejecutar esta accion.');
		}			
}

function verificarRegistroDuplicados($valor, $comparator_field, $tabla){
	$con = conex::con();
	
	$sql = "SELECT * FROM ".$tabla. " WHERE ". $comparator_field. " = :valor";
	$stmp = $con->prepare($sql);
	$execute = $stmp->execute(array('valor' => $valor));
    $resul = $stmp->fetchAll();	
		
	if(count($resul) > 0){		    
		throw new Exception('Ya existe '. $tabla);
	}				
}

function verificarRegistroDuplicadosAlModificar($valor, $id, $comparator_field, $tabla){
	$con = conex::con();
	
	$sql = "SELECT * FROM ".$tabla. " WHERE ". $comparator_field. " = :valor AND id <> :id";
	$stmp = $con->prepare($sql);
	$execute = $stmp->execute(array('valor' => $valor, 'id' => $id));
    $resul = $stmp->fetchAll();	
		
	if(count($resul) > 0){		    
		throw new Exception('Ya existe '. $tabla);
	}				
}

function consultarClientePorID($id){
        $conn = conex::con();               
        $sql = $conn->prepare('SELECT cliente.ID, cliente.DNI, cliente.NOMBRE, cliente.APELLIDO,
                              cliente.TIPODOCUMENTO_ID, cliente.LOCALIDAD_ID, cliente.TELEFONO,
                              cliente.ACTIVO, cliente.SEXO, tipodocumento.DESCRIPCION as TIPODOC 
                              FROM cliente, tipodocumento 
                              WHERE cliente.TIPODOCUMENTO_ID = tipodocumento.ID							  
							  AND cliente.ID =:id');        
        $sql->execute(array('id' => $id));
        $resultado = $sql->fetchAll();
        if(count($resultado) > 0){
            return $resultado;
        }
        else{
            throw new Exception("ERROR: No existe Cliente o esta Inactivo");            
        }    
}

?>