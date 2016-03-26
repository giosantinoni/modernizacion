<?php

include_once '../utilidades/fields.php';
include_once 'conex.php';
@$ac = $_POST["ac"];
switch ($ac) {
    case "agregar":
        $con = conex::con();

        if (!isset($_POST["apellido"]) && !isset($_POST["nombre"]) &&
                !isset($_POST["usuario"]) &&
                !isset($_POST["clave"])) {
            echo "<script language='javascript'>";
            echo "alert('Deben completarse todos los campos requeridos');";
            echo "window.location='../vistas/usuarios.php'";
            echo "</script>";
        }

        /*$apellido = mysql_real_escape_string($_POST["apellido"]);
        $nombre = mysql_real_escape_string($_POST["nombre"]);
        $dni = mysql_real_escape_string($_POST["dni"]);
        $usuario = mysql_real_escape_string($_POST["usuario"]);
        $clave = mysql_real_escape_string($_POST["clave"]);*/

        $apellido = $_POST["apellido"];
        $nombre = $_POST["nombre"];       
        $usuario = $_POST["usuario"];
        $clave = $_POST["clave"];        
        

        $sql = "INSERT INTO usuario(active, surname, name, user_name, user_pass)" .
                "values (1, :ape, :nom, :name, :pass)";

        try {
            $campos_req = array($apellido, $nombre, $usuario, $clave);
            verificar_campos_vacios($campos_req);            
            
            $stmp = $con->prepare($sql);
            $execute = $stmp->execute(array('ape' => $apellido, 'nom' => $nombre,
                'name' => $usuario,
                'pass' => $clave));

            echo "<script language='javascript'>";
            echo "alert('El usuario fue creado correctamente.');";
            echo "window.location='../vistas/usuarios.php'";
            echo "</script>";
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
            echo "<script language='javascript'>";
            echo "alert('Error al crear: ".$e->getMessage()."');";
            echo "window.location='../vistas/usuarios.php'";
            echo "</script>";
        }
        break;

    case "modificar":
        $con = conex::con();
        
        /*$idUsuario = mysql_real_escape_string($_POST["idmod"]);
        $nombre = mysql_real_escape_string($_POST["nombremod"]);
        $apellido = mysql_real_escape_string($_POST["apellidomod"]);
        $dni = mysql_real_escape_string($_POST["dnimod"]);
        $usuario = mysql_real_escape_string($_POST["usuariomod"]);
        $clave = mysql_real_escape_string($_POST["clavemod"]);*/

	$idUsuario = $_POST["idmod"];
	$apellido = $_POST["apellidomod"];
        $nombre = $_POST["nombremod"];      
        $usuario = $_POST["usuariomod"];
       
        $sql = "UPDATE usuario set user_name = :name, name = :nom, surname = :ape WHERE id = :id";

        try {
            $campos_req = array($apellido, $nombre, $usuario, $idUsuario);
            verificar_campos_vacios($campos_req);     
            
            $stmp = $con->prepare($sql);            
            $execute = $stmp->execute(array('ape' => $apellido, 'nom' => $nombre,
                'name' => $usuario,
                'id' => $idUsuario));                        

            echo "<script language='javascript'>";
            echo "alert('Datos modificados correctamente.');";
            echo "window.location='../vistas/usuarios.php'";
            echo "</script>";
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
            echo "<script language='javascript'>";
            echo "alert('Error al modificar: ".$e->getMessage()."');";
            echo "window.location='../vistas/usuarios.php'";
            echo "</script>";
        }
        break;

    case "activar":
        $con = conex::con();
        $idUsuario = $_POST["id"];
        $sql = "UPDATE usuario set active = 1 WHERE id =:id";
        try {
            $stmp = $con->prepare($sql);
            $execute = $stmp->execute(array('id' => $idUsuario));

            echo "<script language='javascript'>";
            echo "alert('Usuario Activado.');";
            echo "window.location='../vistas/usuarios.php'";
            echo "</script>";
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            echo "<script language='javascript'>";
            echo "alert('Error al activar.');";
            echo "window.location='../vistas/usuarios.php'";
            echo "</script>";
        }
        break;

    case "inactivar":
        $con = conex::con();
        $idUsuario = $_POST["id"];
        $sql = "UPDATE usuario set active = 0 WHERE id =:id";
        try {
            $stmp = $con->prepare($sql);
            $execute = $stmp->execute(array('id' => $idUsuario));

            echo "<script language='javascript'>";
            echo "alert('Usuario Inactivado.');";
            echo "window.location='../vistas/usuarios.php'";
            echo "</script>";
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            echo "<script language='javascript'>";
            echo "alert('Error al inactivar.');";
            echo "window.location='../vistas/usuarios.php'";
            echo "</script>";
        }
        break;

    case "eliminar":
//        $con = conex::con();
//        $idUsuario = mysql_real_escape_string($_POST["id"]);
//        $q = "delete from usuarios where Id_Usuario = " . addslashes($idUsuario);
//        $rpta = mysql_query($q, $con);
//        mysql_close($con);
//        if ($rpta == 1) {
//            echo "<script language='javascript'>";
//            echo "alert('El usuario fue eliminado correctamente.');";
//            echo "window.location='../gestionusuarios.php'";
//            echo "</script>";
//        } else {
//            echo "<script language='javascript'>";
//            echo "alert('Error al eliminar.');";
//            echo "window.location='../gestionusuarios.php'";
//            echo "</script>";
//        }
//        break;

    default:
        break;
}

function consultarusuarios() {
    try {
        $conn = conex::con();
        $sql = $conn->prepare('SELECT * FROM usuario');
        $sql->execute();
        return $sql->fetchAll();
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}

function consultarnombreusuarios() {
    $con = conex::con();
    $q = "select Usuario from usuario";

    $rpta = mysql_query($q, $con);
    mysql_close($con);
    if ($rpta) {
        //$fila = mysql_fetch_array($rpta);
        return $rpta;
    } else {
        return "";
    }
}

function consultarusuarioxid($idUsuario) {
    $idUsuario = mysql_real_escape_string($idUsuario);
    $con = conex::con();
    $q = "select * from usuarios where Id_Usuario = " . addslashes($idUsuario);

    $rpta = mysql_query($q, $con);
    mysql_close($con);
    if ($rpta) {
        //$fila = mysql_fetch_array($rpta);
        return $rpta;
    } else {
        return "";
    }
}

?>