<?php


//include_once 'conex.php';
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

if (isset($_POST["fUsuario"]) and isset($_POST["fClave"])) {
    $usuario = $_POST["fUsuario"];
    $clave = $_POST["fClave"];         
  
    try {
        $conn = conex::con();
        $sql= $conn->prepare('SELECT * FROM usuario WHERE user_name = :user AND user_pass = :pass AND active = true');
        $sql->execute(array('user' => $usuario, 'pass' => $clave));
        $resultado = $sql->fetchAll();
       
        foreach ($resultado as $fila) {            
            session_start();
            $_SESSION["s_usuario_id"] = $fila["id"];
            $_SESSION["s_usuario"] = $fila["user_name"];
            $_SESSION["s_nombreusuario"] = $fila["name"];
            $_SESSION["s_apellidousuario"] = $fila["surname"];           
            $_SESSION["autentificado"] = "SI";
            $_SESSION["ultimoAcceso"] = date("Y-n-j H:i:s");            
            header("Location: ../vistas/inicio.php");
        }
        $mje = base64_encode("Por favor, introduzca un usuario y contraseña válido.");
        header("Location: ../form_login.php?mje=$mje");
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}
?>