<?php

include_once '../script/session.inc.php';
include_once '../utilidades/fields.php';
include_once 'comunDAO.php';
include_once 'conex.php';
@$ac = $_POST["ac"];
@$id_usuario = $_SESSION["s_usuario_id"];

switch ($ac) {
    case "agregar":
        $con = conex::con();			
	
		try {
		
        if (!isset($_POST["nombre"])) {
            echo "<script language='javascript'>";
            echo "alert('Deben completarse todos los campos requeridos');";
            echo "window.location='../vistas/tipodocumentos.php'";
            echo "</script>";
        }
			
		verificarPermiso('tipodocumentos', 'crear', $id_usuario);	
        
        $descripcion = mysql_real_escape_string($_POST["nombre"]);   

		verificarRegistroDuplicados($descripcion, 'DESCRIPCION', 'tipodocumento');		

        $sql = "INSERT INTO tipodocumento(ACTIVO, DESCRIPCION)" .
                "values (1, :nom)";

        
            $campos_req = array($descripcion);
            verificar_campos_vacios($campos_req);            
            
            $stmp = $con->prepare($sql);
            $execute = $stmp->execute(array('nom' => $descripcion));

            echo "<script language='javascript'>";
            echo "alert('La tipodocumento fue creado correctamente.');";
            echo "window.location='../vistas/tipodocumentos.php'";
            echo "</script>"; 
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
            echo "<script language='javascript'>";
            echo "alert('Error al crear: ".$e->getMessage()."');";
            echo "window.location='../vistas/tipodocumentos.php'";
            echo "</script>";
        }
        break;

    case "modificar":
        $con = conex::con();
		
		try {
			
		verificarPermiso('tipodocumentos', 'modificar', $id_usuario);	
		
        $Idtipodocumento = mysql_real_escape_string($_POST["idmod"]);
        $descripcion = mysql_real_escape_string($_POST["nombremod"]); 
	
		verificarRegistroDuplicadosAlModificar($descripcion, $Idtipodocumento, 'DESCRIPCION', 'tipodocumento');	
		
        $sql = "UPDATE tipodocumento set DESCRIPCION = :nom WHERE ID = :id";

        
            $campos_req = array($descripcion, $Idtipodocumento);
            verificar_campos_vacios($campos_req);     
            
            $stmp = $con->prepare($sql);            
            $execute = $stmp->execute(array('nom' => $descripcion,                
                'id' => $Idtipodocumento));                        

            echo "<script language='javascript'>";
            echo "alert('Datos modificados correctamente.');";
            echo "window.location='../vistas/tipodocumentos.php'";
            echo "</script>";
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
            echo "<script language='javascript'>";
            echo "alert('Error al modificar: ".$e->getMessage()."');";
            echo "window.location='../vistas/tipodocumentos.php'";
            echo "</script>";
        }
        break;

    case "activar":
        $con = conex::con();
		
		try {
			
		verificarPermiso('tipodocumentos', 'activar', $id_usuario);	
		
        $Idtipodocumento = mysql_real_escape_string($_POST["id"]);
        $sql = "UPDATE tipodocumento set ACTIVO = 1 WHERE ID =:id";
        
            $stmp = $con->prepare($sql);
            $execute = $stmp->execute(array('id' => $Idtipodocumento));

            echo "<script language='javascript'>";
            echo "alert('tipodocumento Activada.');";
            echo "window.location='../vistas/tipodocumentos.php'";
            echo "</script>";
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
            echo "<script language='javascript'>";
            echo "alert('Error al activar: ".$e->getMessage()."');";
            echo "window.location='../vistas/tipodocumentos.php'";
            echo "</script>";
        }
        break;

    case "inactivar":
        $con = conex::con();
		
		try {
			
		verificarPermiso('tipodocumentos', 'inactivar', $id_usuario);	
		
        $Idtipodocumento = mysql_real_escape_string($_POST["id"]);
        $sql = "UPDATE tipodocumento set ACTIVO = 0 WHERE ID =:id";
       
            $stmp = $con->prepare($sql);
            $execute = $stmp->execute(array('id' => $Idtipodocumento));

            echo "<script language='javascript'>";
            echo "alert('tipodocumento Inactivada.');";
            echo "window.location='../vistas/tipodocumentos.php'";
            echo "</script>";
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
            echo "<script language='javascript'>";
            echo "alert('Error al inactivar: ".$e->getMessage()."');";
            echo "window.location='../vistas/tipodocumentos.php'";
            echo "</script>";
        }
        break;

    default:
        break;
}

function consultartipodocumentos() {
    try {
        $conn = conex::con();
        $sql = $conn->prepare('SELECT * FROM tipodocumento');
        $sql->execute();
        return $sql->fetchAll();
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}

function consultartipodocumentosActivas() {
    try {
        $conn = conex::con();
        $sql = $conn->prepare('SELECT * FROM tipodocumento WHERE ACTIVO = true');
        $sql->execute();
        return $sql->fetchAll();
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}

?>
