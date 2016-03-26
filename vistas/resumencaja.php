<?php
include_once '../script/session.inc.php';
include_once '../controlador/cajaDAO.php';
include_once '../controlador/conex.php';

@$usuario = $_SESSION["s_usuario"]; //base64_decode($_GET['usuario']);
@$usuarionombre = $_SESSION["s_nombreusuario"];
@$usuarioapellido = $_SESSION["s_apellidousuario"];

function getIDPorUserName($user_name) {
    try {
        $conn = conex::con();
        $sql = $conn->prepare('SELECT * FROM usuario WHERE USER_NAME = :user');
        $sql->execute(array('user' => $user_name));
        $resul = $sql->fetchAll();
		foreach($resul as $reg){			
			return $reg['ID'];
		}
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}

$id_usuario = '';
if($usuario == 'admin'){
	$id_usuario = getIDPorUserName($usuario);	
}

if (isset($_POST['cbusuario'])) {
    $id_usuario = $_POST['cbusuario'];
}

if (isset($_GET['usuario'])) {
    $id_usuario = $_GET['usuario'];
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

function consultarusuarioPorID($id) {
    try {
        $conn = conex::con();
        $sql = $conn->prepare('SELECT * FROM usuario WHERE ID = '.$id);
        $sql->execute();
        $resul = $sql->fetchAll();
		foreach($resul as $reg){
			return $reg['USER_NOMBRE'].' '.$reg['USER_APELLIDO'];
		}
    } catch (PDOException $e) {
        echo "ERROR: " . $e->getMessage();
    }
}

?>	


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Administrador</title>


        <link href="css/bootstrap.min.css" rel="stylesheet" />          
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-select.min.js"></script>        
    </head>

    <body style="background:#efefee"><!--#96D161 verde manzana-->
        <header>
            <?php include("header.php"); ?>
        </header>
        <section>
            <center>
			
			 <div class="panel panel-default">                                        
                    <div style="text-align:left" class="panel-body">
                        <form id="ver_resumen" name="resumen" method="post" action="resumencaja.php" Enctype = "multipart/form-data" >
                            <table align="center" width="20%">
                                <tr>
                                    <td style="width:25%"> Usuario </td>
                                    <td style="width:70%">
                                        <select name="cbusuario" id="cbusuario" class="form-control">
                                            <option value="0">Seleccione...</option>
                                            <?php
                                            foreach (consultarusuarios() as $reg) {
                                                $id = $reg['ID'];
                                                $usuario_combo = $reg['USER_NAME'];
                                                ?>
                                                <option value="<?php echo $id; ?>"><?php echo $usuario_combo; ?></option>						
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td width="4%"></td>
                                    <td style="float:right;">                                                                                                                                                    
                                        <button type="submit" class="btn btn-default" style="background:#efefee; padding-right:10px" >Ver Estado de Caja</button>
                                    </td>
                                </tr>

                            </table>                                                                                   

                            <input type="hidden" name="ac" value="agregar">
                        </form>
                    </div>

                </div>           	
				
				  <div style="width:60%">
                    <?php
					$registros = array();
					if($usuario != 'admin'){
						$id_usuario = getIDPorUserName($usuario);
						$registros = estadoCaja($id_usuario);	
					}
					else{
						$registros = estadoCaja($id_usuario);					
					}
					if($id_usuario != ''){
						$cajero = consultarusuarioPorID($id_usuario);
					} 
					echo '<dir style="text-align: center">ESTADO DE CAJA DEL CAJERO:'.$cajero.'</dir>';
                    echo '<table class="table table-hover">';
                    echo '<tr><th>Fecha y Hora Inicio</th><th>Total Ingresado</th><th>Total de Retiros</th><th>Estado Actual</th><th>Fecha y Hora Cierre</th><th>Total Cierre</th><th style="text-align:right;width:20%;"></th></tr>';
                    foreach ($registros as $reg) {
                        $id = $reg['ID'];                        
                        $fecha_inicio = $reg['FECHAHORA_INICIO'];                        
						$fecha_cierre = $reg['FECHAHORA_CIERRE'];                        
                        $habilitada = $reg['HABILITADA'];
						$monto_cierre = $reg['MONTO_CIERRE'];
						$monto_ingreso = $reg['MONTO_INGRESO'];
						$monto_egreso = $reg['MONTO_EGRESO'];						
						if($habilitada){
							$habilitada = "HABILITADA";
						}else{
							$habilitada = "CERRADA";
						}							
                        echo '<tr>';                        
							echo '<td>';
							$date = new DateTime($fecha_inicio);
							echo $date->format('d-M-Y H:i:s');									
							echo '</td>';
							echo '<td>';
							echo $monto_ingreso;
							echo '</td>';	
							echo '<td>';
							echo $monto_egreso;	
							echo '</td>';
							echo '<td>';
							echo $habilitada;	
							echo '</td>';						
							echo '<td>'; 
							$date = new DateTime($fecha_cierre);
							echo $date->format('d-M-Y H:i:s');								
							echo '</td>';
							echo '<td>'; 							
							echo $monto_cierre;	
							echo '</td>';
							
							echo '<td>';
                              echo '<form style="float:right" name="detalle" method="post" action="detalle_de_caja.php">
								<input id="id" name="id" type="hidden" value="' . $id . '" />
								<input id="id_usuario" name="id_usuario" type="hidden" value="' . $id_usuario . '" />
								<input id="fecha_inicio" name="fecha_inicio" type="hidden" value="' . $fecha_inicio . '" />
								<input id="fecha_cierre" name="fecha_cierre" type="hidden" value="' . $fecha_cierre . '" />
								<input id="habilitada" name="habilitada" type="hidden" value="' . $habilitada . '" />
								<acronym title="Ver Detalle">
								<button type="submit" class="btn btn-default" >
								<span class="glyphicon glyphicon-th-list" aria-hidden="true">
								</button>
								</acronym>								
								</form>';
							echo '</td>';								
                        echo '</tr>';
                    }
                    echo '</table>';
                    ?> 
                </div>

              
            </center>         
        </section>
        <footer style="background:#333333; clear:both; color:white;">
            <br>
                <center>Turismo Catamarca | Año 2015 ©</center>
                <br>
                    </footer>
                    </body>   
                    </html>
                    <script >

                       
                    </script>

