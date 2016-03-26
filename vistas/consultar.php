<?php
include_once '../script/session.inc.php';
include_once '../controlador/consultasDAO.php';
include_once '../controlador/conex.php';

@$usuario = $_SESSION["s_usuario"]; 
@$usuarionombre = $_SESSION["s_nombreusuario"];
@$usuarioapellido = $_SESSION["s_apellidousuario"];

$dni = '';
$apellido = '';
$nombre = '';

if(isset($_POST['dni'])){
   $dni = $_POST['dni'];
}

if(isset($_POST['apellido'])){
   $apellido = $_POST['apellido'];
}

if(isset($_POST['nombre'])){
   $nombre = $_POST['nombre'];
}

?>	


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,300">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Administrador</title>


        <!--<link href="css/bootstrap.min.css" rel="stylesheet" />          
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-select.min.js"></script> -->
		<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet" /> 
        
        <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css">       
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-select.min.js"></script> 

       <script type="text/javascript" language="javascript" src="js/jquery-1.11.3.min.js"></script>
       <script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
       <script type="text/javascript" language="javascript" src="js/dataTables.bootstrap.min.js"></script>
		
    </head>

    <body style="background:#efefee"><!--#96D161 verde manzana-->
        <header>
            <?php include("header.php"); ?>
        </header>
        <section>
            <center>

                <div class="panel-group" style="width:70%; font-family: 'Roboto', sans-serif; font-weight: 400;color:#777" id="accordion">
                    
                        <div class="panel panel-default">
                            <div style="background:#FFF" class="panel-heading">
                                <h4 style="text-align:left; color:#777" class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">                                        
                                     Nueva Consulta
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne"  class="panel-collapse collapse" >
                                <div style="text-align:left; width:70%" class="panel-body">
                                    <form id="agregar" name="agregar" method="post" action="consultar.php" Enctype = "multipart/form-data" >
                                        <table align="center" width="99%">
										    <tr>
                                                <td >
                                                    DNI
                                                </td>
                                                <td >
                                                    <input class="form-control" type="text" name="dni" id="dni"/>
                                                </td>                                                
                                            </tr>
                                            <tr>
                                                <td style="width:25%">
                                                    Nombre                                               
                                                </td>
                                                <td style="width:70%">
                                                    <input class="form-control" type="text" name="nombre" id="nombre" />
                                                </td>
                                                <td width="4%"></td>
                                            </tr>                                           
                                            <tr>
                                                <td style="width:25%">
                                                    Apellido
                                                </td>
                                                <td style="width:70%">
                                                    <input class="form-control" type="text" name="apellido" id="apellido" />
                                                </td>
                                                <td width="4%"></td>
                                            </tr>                                                                                     
                                                                     
                                            <tr><td>&nbsp;</td><td></td><td></td></tr>
                                            <tr>
                                                <td>
                                                </td>                                                
                                                <td style="float:right;">                                                                                                                                                            
                                                    <button type="submit" class="btn btn-default" style="background:#efefee; padding-right:10px" onclick="return comprobaragregar();" >Buscar</button>
                                                </td>                                                                                                                                                
                                                <td>
                                                </td>
                                            </tr>
                                        </table>
                                        <input type="hidden" name="ac" value="agregar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    
                </div>


                <div style="width:80%; font-family:'Roboto', sans-serif; font-weight:300">
                    <?php
                    $registros = consultar($dni, $nombre, $apellido);
                    echo '<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">';
                    echo '<thead><tr><th>Nombre</th><th>Apellido</th><th>DNI</th><th>Organismo</th><th>Cargo</th><th>Puntaje</th><th>Fecha de Alta</th><th>Situacion de Revista</th></tr></thead>';
					//echo '<tfoot><tr><th>Nombre</th><th>Apellido</th><th>DNI</th><th>ORGANISMO</th><th>CARGO</th><th>PUNTAJE</th><th>FECHA ALTA</th><th>SITUACION REVISTA</th></tr></tfoot>';
					echo "<tbody>";
                    foreach ($registros as $reg) {                                                                                        
                        $nombre = $reg['NOMBRE'];
                        $apellido = $reg['APELLIDO'];
                        $cuil = $reg['PRE_CUIL'].'-'.$reg['DNI'].''.$reg['SUF_CUIL'];
						$organismo = $reg['ORGANISMO'];
						$cargo = $reg['CARGO'];
						$puntaje = $reg['PUNTAJE'];
						$revista = $reg['REVISTA'];
						$fecha_alta = $reg['ALTA'];
                        echo '<tr>';
                        echo '<td>';
                        echo $nombre;
                        echo '</td>';
                        echo '<td>';
                        echo $apellido;
                        echo '</td>';
                        echo '<td>';
                        echo $cuil;
                        echo '</td>';
						echo '<td>';
                        echo $organismo;
                        echo '</td>';
						echo '<td>';
                        echo $cargo;
                        echo '</td>';
						echo '<td>';
                        echo $puntaje;
                        echo '</td>';
						echo '<td>';
                        echo $fecha_alta;
                        echo '</td>';
						echo '<td>';
                        echo $revista;
                        echo '</td>';                  
                        echo '</tr>';
                    }
					echo "</tbody>";
                    echo '</table>';
                    ?> 
                </div>
            </center>         
        </section>
        <footer style="background:#333333; clear:both; color:white;">
            <br>
                <<center>Rectorado - Universidad Nacional de Catamarca | Año 2016 ©</center>
                <br>
                    </footer>
                    </body>   
                    </html>
                    <script >
					
						$(document).ready(function() {
                            $('#example').DataTable();
                        } );


                        function comprobarpass() {
                            var c1 = document.getElementById("clave").value;
                            var c2 = document.getElementById("clave2").value;
                            var alerta = document.getElementById("alerta");
                            var alerta2 = document.getElementById("alerta2");
                            if (c1 == c2) {
                                alerta2.style.display = "block";
                                alerta.style.display = "none";
                            } else {
                                alerta.style.display = "block";
                                alerta2.style.display = "none";
                            }
                        }

                        function comprobarpassmod() {
                            var c1 = document.getElementById("clavemod").value;
                            var c2 = document.getElementById("clave2mod").value;
                            var alerta = document.getElementById("alertamod");
                            var alerta2 = document.getElementById("alerta2mod");
                            if (c1 === c2) {
                                alerta2.style.display = "block";
                                alerta.style.display = "none";
                            } else {
                                alerta.style.display = "block";
                                alerta2.style.display = "none";
                            }
                        }

                        function comprobaragregar() {                           
                            var alerta2 = document.getElementById("alerta2");
                            var alertn = document.getElementById("alertn");
                            var alertap = document.getElementById("alertap");
                            var alertdni = document.getElementById("alertdni");
                            var alertu = document.getElementById("alertu");
                            var alertc = document.getElementById("alertc");
                            var alertc2 = document.getElementById("alertc2");
                            var nombre = document.getElementById("nombre").value;
                            var apellido = document.getElementById("apellido").value;
                            var usuario = document.getElementById("usuario").value;
                            var dni = document.getElementById("dni").value;
                            var clave = document.getElementById("clave").value;
                            var clave2 = document.getElementById("clave2").value;
                            var condicion = 0;
                            if (nombre == "") {
                                alertn.style.display = "block";
                                condicion = 1;
                            } else {
                                alertn.style.display = "none";
                            }

                            if (apellido == '') {
                                alertap.style.display = "block";
                                condicion = 1;
                            } else {
                                alertap.style.display = "none";
                            }

                            if (dni == "") {
                                alertdni.style.display = "block";
                                condicion = 1;
                            } else {
                                alertdni.style.display = "none";
                            }

                            if (usuario == "") {
                                alertu.style.display = "block";
                                condicion = 1;
                            } else {
                                alertu.style.display = "none";
                            }

                            if (clave == "") {
                                alertc.style.display = "block";
                                condicion = 1;
                            } else {
                                alertc.style.display = "none";
                            }

                            if (clave2 == "") {
                                alertc2.style.display = "block";
                                condicion = 1;
                            } else {
                                alertc2.style.display = "none";
                            }                            

                            if (alerta2.style.display == "none") {
                                alert("Las contraseñas no coinciden.");
                                condicion = 1;
                            }
                            if (condicion == 1) {
                                return false;
                            } else {
                                return true;
                            }
                        }

                        function comprobarmodificar() {                           
                            var alerta2 = document.getElementById("alerta2mod");
                            var alertn = document.getElementById("alertnmod");
                            var alertap = document.getElementById("alertapmod");
                            var alertdni = document.getElementById("alertdnimod");
                            var alertu = document.getElementById("alertumod");
                            var alertc = document.getElementById("alertcmod");
                            var alertc2 = document.getElementById("alertc2mod");
                            var nombre = document.getElementById("nombremod").value;
                            var apellido = document.getElementById("apellidomod").value;
                            var dni = document.getElementById("dnimod").value;
                            var usuario = document.getElementById("usuariomod").value;
                            var clave = document.getElementById("clavemod").value;
                            var clave2 = document.getElementById("clave2mod").value;
                            var condicion = 0;
                            if (nombre == "") {
                                alertn.style.display = "block";
                                condicion = 1;
                            } else {
                                alertn.style.display = "none";
                            }

                            if (apellido == "") {
                                alertap.style.display = "block";
                                condicion = 1;
                            } else {
                                alertap.style.display = "none";
                            }

                            if (dni == "") {
                                alertap.style.display = "block";
                                condicion = 1;
                            } else {
                                alertdni.style.display = "none";
                            }

                            if (usuario == "") {
                                alertu.style.display = "block";
                                condicion = 1;
                            } else {
                                alertu.style.display = "none";
                            }

                            if (clave == "") {
                                alertc.style.display = "block";
                                condicion = 1;
                            } else {
                                alertc.style.display = "none";
                            }

                            if (clave2 == "") {
                                alertc2.style.display = "block";
                                condicion = 1;
                            } else {
                                alertc2.style.display = "none";
                            }

                            if (alerta2.style.display == "none") {
                                alert("Las contraseñas no coinciden.");
                                condicion = 1;
                            }
                            if (condicion == 1) {
                                return false;
                            } else {
                                return true;
                            }
                        }

                        function cancelar() {
                            window.location = 'usuarios.php';
                        }

                        function confirmar() {
                            return confirm("¿Esta seguro que desea inactivar este usuario?");
                        }
                    </script>

