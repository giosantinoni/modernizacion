<?php

include_once 'conex.php';

function consultar($dni, $nombre, $apellido){
	try {
        $conn = conex::con();
		if($dni != ''){
			$sql = $conn->prepare('SELECT *, sum(puntaje) as total FROM cargo WHERE DNI = :dni GROUP BY ID');
			$sql->execute(array('dni' => $dni));
			return $sql->fetchAll();
		}
		else if($nombre != '' && $apellido != ''){
			$sql = $conn->prepare('SELECT *, sum(puntaje) as total FROM cargo WHERE APELLIDO = :ape AND NOMBRE = :nom GROUP BY DNI');
			$sql->execute(array('ape' => $apellido, 'nom' => $nombre));
			return $sql->fetchAll();
		}
		else if($apellido != ''){
			$sql = $conn->prepare('SELECT *, sum(puntaje) as total FROM cargo WHERE APELLIDO LIKE :ape GROUP BY ID');
			$sql->execute(array('ape' => '%'.$apellido.'%'));
			return $sql->fetchAll();
		}
		return array();
    } catch (PDOException $e){
        echo "ERROR: " . $e->getMessage();
    }
}

?>