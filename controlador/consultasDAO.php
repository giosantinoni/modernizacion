<?php

include_once 'conex.php';

function consultar($dni, $nombre, $apellido){
	try {
        $conn = conex::con();
		if($dni != ''){
			$sql = $conn->prepare('SELECT * FROM cargo WHERE DNI = :dni');
			$sql->execute(array('dni' => $dni));
			return $sql->fetchAll();
		}
		else if($nombre != '' && $apellido != ''){
			$sql = $conn->prepare('SELECT * FROM cargo WHERE APELLIDO = :ape AND NOMBRE = :nom');
			$sql->execute(array('ape' => $apellido, 'nom' => $nombre));
			return $sql->fetchAll();
		}
		else if($apellido != ''){
			$sql = $conn->prepare('SELECT * FROM cargo WHERE APELLIDO LIKE :ape');
			$sql->execute(array('ape' => '%'.$apellido.'%'));
			return $sql->fetchAll();
		}
		return array();
    } catch (PDOException $e){
        echo "ERROR: " . $e->getMessage();
    }
}

?>