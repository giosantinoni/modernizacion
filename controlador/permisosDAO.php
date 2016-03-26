<?php

include_once '../utilidades/fields.php';
include_once 'conex.php';
@$ac = $_POST["ac"];

switch ($ac) {
    case "activar":
        $con = conex::con();
        $id_per = $_POST["id_permiso"];
        $id_usuario = $_POST["id_usuario"];
        $sql = "INSERT usuario_permiso (USUARIO_ID, PERMISO_ID) values(:id_usu, :id_per)";
        try {
            $stmp = $con->prepare($sql);
            $execute = $stmp->execute(array(':id_per' => $id_per, ':id_usu' => $id_usuario));
            echo "<script language='javascript'>";
            echo "window.location='../vistas/asignar_permisos.php?usuario=" . $id_usuario . "'";
            echo "</script>";
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            echo "<script language='javascript'>";
            echo "alert('Error al activar.');";
            echo "window.location='../vistas/asignar_permisos.php?usuario=" . $id_usuario . "'";
            echo "</script>";
        }
        break;

    case "desactivar":
        $con = conex::con();
        $id_per = $_POST["id_permiso"];
        $id_usuario = $_POST["id_usuario"];
        try {
            $sql = "DELETE FROM usuario_permiso WHERE USUARIO_ID =:usu AND PERMISO_ID =:per";
            $stmp = $con->prepare($sql);
            $execute = $stmp->execute(array(':per' => $id_per, ':usu' => $id_usuario));            
            echo "<script language='javascript'>";
            echo "window.location='../vistas/asignar_permisos.php?usuario=" . $id_usuario . "'";
            echo "</script>";
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
            echo "<script language='javascript'>";
            echo "alert('Error al activar.');";
            echo "window.location='../vistas/asignar_permisos.php?usuario=" . $id_usuario . "'";
            echo "</script>";
        }
        break;
}

function getTodosPermisos() {
    try {
        $conn = conex::con();
        $sql = $conn->prepare('SELECT permiso.ID as id_per, operacion.NOMBRE as ope, pantalla.NOMBRE as pan FROM operacion, pantalla, permiso '
                . 'WHERE pantalla.ID = permiso.PANTALLA_ID AND operacion.ID = permiso.OPERACION_ID ORDER BY pantalla.ID');
        $sql->execute();
        return $sql->fetchAll();
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}

function getTodosPermisosPorUsuario($id) {
    try {
        $conn = conex::con();
        $sql = $conn->prepare('SELECT permiso.ID as id_per, operacion.NOMBRE as ope, pantalla.NOMBRE as pan FROM operacion, pantalla, permiso, usuario, usuario_permiso '
                . 'WHERE pantalla.ID = permiso.PANTALLA_ID AND operacion.ID = permiso.OPERACION_ID '
                . 'AND permiso.ID = usuario_permiso.PERMISO_ID '
                . 'AND usuario.ID = usuario_permiso.USUARIO_ID AND usuario.ID = :id_usu '
                . 'ORDER BY pantalla.ID');
        $sql->execute(array(':id_usu' => $id));
        return $sql->fetchAll();
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}

?>