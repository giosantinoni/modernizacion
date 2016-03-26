<?php
include_once '../script/session.inc.php';
include_once '../controlador/usuariosDAO.php';
include_once '../controlador/conex.php';

@$usuario = $_SESSION["s_usuario"]; 
@$usuarionombre = $_SESSION["s_nombreusuario"];
@$usuarioapellido = $_SESSION["s_apellidousuario"];

@$idUsuarioMod = $_POST["id"];

if ($idUsuarioMod != "") {
    $usuarioMod = $_POST["usuario"];
    $claveMod = '';
    $nombreMod = $_POST["nombre"];
    $apellidoMod = $_POST["apellido"];
    $dniMod = '';
}
?>	


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,300">
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

                <div class="panel-group" style="width:70%; font-family: 'Roboto', sans-serif; font-weight: 400;color:#777" id="accordion">
                    <?php if ($idUsuarioMod == "") { ?>
                        <div class="panel panel-default">
                            <div style="background:#FFF" class="panel-heading" >
                                <h4 style="text-align:left;color:#777" class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">                                        Nuevo Usuario
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne"  class="panel-collapse collapse">
                                <div style="text-align:left; width:70%" class="panel-body">
                                    <form id="agregar" name="agregar" method="post" action="../controlador/usuariosDAO.php" Enctype = "multipart/form-data" align="left">
                                        <table align="left" width="99%">
                                            <tr>
                                                <td style="width:25%">
                                                    Nombre Persona                                                    
                                                </td>
                                                <td style="width:70%">
                                                    <input class="form-control" type="text" name="nombre" id="nombre" />
                                                </td>
                                                <td width="4%"></td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%"></td>
                                                <td style="width:70%">
                                                    <span id="alertn" aria-hidden="true" style="color:red;display:none;">Debe completar este campo</span>
                                                </td>
                                                <td width="4%"></td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%">
                                                    Apellido Persona
                                                </td>
                                                <td style="width:70%">
                                                    <input class="form-control" type="text" name="apellido" id="apellido" />
                                                </td>
                                                <td width="4%"></td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%"></td>
                                                <td style="width:70%">
                                                    <span id="alertap" aria-hidden="true" style="color:red;display:none;">Debe completar este campo</span>
                                                </td>
                                                <td width="4%"></td>
                                            </tr>                                            
                                            <tr>
                                                <td style="width:25%">
                                                    Usuario
                                                </td>
                                                <td style="width:40%">
                                                    <input class="form-control" type="text" name="usuario" id="usuario"/>
                                                </td>
                                                <td width="4%" align="center">
                                                    <acronym title="Nombre de usuario existente"><span id="alertau" class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;display:none;"></span></acronym>                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%"></td>
                                                <td style="width:70%">
                                                    <span id="alertu" aria-hidden="true" style="color:red;display:none;">Debe completar este campo</span>
                                                </td>
                                                <td width="4%"></td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%">
                                                    Contraseña
                                                </td>
                                                <td style="width:40%">
                                                    <input class="form-control" type="password" name="clave" id="clave" />
                                                </td>
                                                <td width="4%"></td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%"></td>
                                                <td style="width:70%">
                                                    <span id="alertc" aria-hidden="true" style="color:red;display:none;">Debe completar este campo</span>
                                                </td>
                                                <td width="4%"></td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%">
                                                    Repetir Contraseña
                                                </td>
                                                <td style="width:70%">
                                                    <input class="form-control" type="password" name="clave2" id="clave2" onblur="comprobarpass();"/>
                                                </td>
                                                <td width="4%" align="center">
                                                    <acronym title="Contraseñas no coinciden"><span id="alerta" class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;display:none;"></span></acronym>
                                                    <acronym title="Contraseñas coinciden"><span id="alerta2" class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green;display:none"></span></acronym>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%"></td>
                                                <td style="width:70%">
                                                    <span id="alertc2" aria-hidden="true" style="color:red;display:none;">Debe completar este campo</span>
                                                </td>
                                                <td width="4%"></td>
                                            </tr>                                                                                      
                                            <tr><td>&nbsp;</td><td></td><td></td></tr>
                                            <tr>
                                                <td>
                                                </td>                                                
                                                <td style="float:right;">                                                                                                        
                                                    <button type="button" class="btn btn-default" onclick="cancelar();" style="background:#efefee; padding-right:10px color:#777">Cancelar</button> 
                                                    <button type="submit" class="btn btn-default" style="background:#efefee; padding-right:10px; color:#777" onclick="return comprobaragregar();" >Agregar</button>
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
                    <?php } ?>
                    <?php if ($idUsuarioMod != "") { ?>
                        <div class="panel panel-default">
                            <div style="background:#FFF" class="panel-heading">
                                <h4 style="text-align:left" class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        <strong>Modificar Usuario</strong>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne"  class="panel-collapse " >
                                <div style="width:70%" class="panel-body">
                                    <form id="agregar" name="agregar" method="post" action="../controlador/usuariosDAO.php" Enctype = "multipart/form-data" align="left">
                                        <input type="hidden" id="idmod" name="idmod" value="<?php echo $idUsuarioMod; ?>"/>
                                        <table align="center" width="99%">
                                            <tr>
                                                <td style="width:25%">
                                                    Nombre Persona
                                                </td>
                                                <td style="width:70%">
                                                    <input class="form-control" type="text" name="nombremod" id="nombremod" value="<?php echo $nombreMod; ?>"  />
                                                </td>
                                                <td width="4%"></td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%"></td>
                                                <td style="width:70%">
                                                    <span id="alertnmod" aria-hidden="true" style="color:red;display:none;">Debe completar este campo</span>
                                                </td>
                                                <td width="4%"></td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%">
                                                    Apellido Persona
                                                </td>
                                                <td style="width:70%">
                                                    <input class="form-control" type="text" name="apellidomod" id="apellidomod"  value="<?php echo $apellidoMod; ?>"/>
                                                </td>
                                                <td width="4%"></td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%"></td>
                                                <td style="width:70%">
                                                    <span id="alertapmod" aria-hidden="true" style="color:red;display:none;">Debe completar este campo</span>
                                                </td>
                                                <td width="4%"></td>
                                            </tr>                                            
                                            <tr>
                                                <td style="width:25%">
                                                    Usuario
                                                </td>
                                                <td style="width:70%">
                                                    <input class="form-control" type="text" name="usuariomod" id="usuariomod" readonly="readonly" value="<?php echo $usuarioMod; ?>"/>
                                                </td>
                                                <td width="4%" align="center">
                                                    <acronym title="Nombre de usuario existente"><span id="alertaumod" class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;display:none;"></span></acronym>                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%"></td>
                                                <td style="width:70%">
                                                    <span id="alertumod" aria-hidden="true" style="color:red;display:none;">Debe completar este campo</span>
                                                </td>
                                                <td width="4%"></td>
                                            </tr>
                                            
                                                                                                                               
                                            <tr><td>&nbsp;</td><td></td><td></td></tr>
                                            <tr>
                                                <td>
                                                </td>
                                                <td style="float:right;">
                                                    <button type="button" class="btn btn-default" onclick="cancelar();" style="background:#efefee; padding-right:10px">Cancelar</button> 
                                                    <button type="submit" class="btn btn-default" style="background:#efefee; padding-right:10px" onclick="return comprobarmodificar();" >Modificar</button>
                                                </td>
                                                <td>
                                                </td>
                                            </tr>
                                        </table>
                                        <input type="hidden" name="ac" value="modificar"></input>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>


                <div style="width:70%; align:left; font-family:'Roboto', sans-serif; font-weight:300">
                    <?php
                    $registros = consultarusuarios();
                    echo '<table class="table table-hover">';
                    echo '<tr><th>Usuario</th><th>Nombre</th><th>Apellido</th><th>Estado</th><th style="text-align:right;width:20%;"></th></tr>';
                    foreach ($registros as $reg) {
                        $id = $reg['id'];
                        $usuario = $reg['user_name'];                                                
                        $nombre = $reg['name'];
                        $apellido = $reg['surname'];
                        $estado = $reg['active'];
                        echo '<tr>';
                        echo '<td>';
                        echo $usuario;
                        echo '</td>';
                        echo '<td>';
                        echo $nombre;
                        echo '</td>';
                        echo '<td>';
                        echo $apellido;
                        echo '</td>';
                        echo '<td>';
                        if ($estado) {
                            echo 'ACTIVO';
                        } else {
                            echo 'INACTIVO';
                        }
                        echo '</td>';

                        echo '<td>';
                        echo '<form style="float:right" name="Activar" method="post" action="../controlador/usuariosDAO.php">
								<input id="id" name="id" type="hidden" value="' . $id . '" />
								<acronym title="Activar">
								<button type="submit" class="btn btn-default" onclick="return confirmar();">
								<span class="glyphicon glyphicon-arrow-up" aria-hidden="true">
								</button>
								</acronym>
								<input type="hidden" name="ac" id="ac" value="activar">
								</form>';
                        echo '<form style="float:right" name="Inactivar" method="post" action="../controlador/usuariosDAO.php">
								<input id="id" name="id" type="hidden" value="' . $id . '" />
								<acronym title="Inactivar">
								<button type="submit" class="btn btn-default" onclick="return confirmar();">
								<span class="glyphicon glyphicon-arrow-down" aria-hidden="true">
								</button>
								</acronym>
								<input type="hidden" name="ac" id="ac" value="inactivar">
								</form>';
                        echo '<form style="float:right" name="edicion" method="post" action="usuarios.php">
								<input name="id" id="id" type="hidden" value="' . $id . '" />
								<input id="usuario" name="usuario" type="hidden" value="' . $usuario . '" />								                                                               						                                                                  							        
								<input id="nombre" name="nombre" type="hidden" value="' . $nombre . '" />
								<input id="apellido" name="apellido" type="hidden" value="' . $apellido . '" />								
								<acronym title="Editar">
								<button type="submit" class="btn btn-default">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true">
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
                <center>Rectorado - Universidad Nacional de Catamarca | Año 2016 ©</center>
                <br>
                    </footer>
                    </body>   
                    </html>
                    <script >

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

