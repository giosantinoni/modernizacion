<?php
include_once '../script/session.inc.php';
include_once '../controlador/tipodocumentosDAO.php';
include_once '../controlador/conex.php';

@$usuario = $_SESSION["s_usuario"]; //base64_decode($_GET['usuario']);
@$usuarionombre = $_SESSION["s_nombreusuario"];
@$usuarioapellido = $_SESSION["s_apellidousuario"];

@$idTipodocumentoMod = $_POST["id"];

if ($idTipodocumentoMod != "") {    
    $nombreMod = $_POST["nombre"];
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

                <div class="panel-group" style="width:50%" id="accordion">
                    <?php if ($idTipodocumentoMod == "") { ?>
                        <div class="panel panel-default">
                            <div style="background:#FFF" class="panel-heading">
                                <h4 style="text-align:left" class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">                                        
                                        <strong>Nuevo Tipo Documento</strong>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne"  class="panel-collapse collapse" >
                                <div style="text-align:left" class="panel-body">
                                    <form id="agregar" name="agregar" method="post" action="../controlador/tipodocumentosDAO.php" Enctype = "multipart/form-data" >
                                        <table align="center" width="99%">                                                                                      
                                            <tr>
                                                <td style="width:25%">
                                                    Descripcion
                                                </td>
                                                <td style="width:70%">
                                                    <input class="form-control" type="text" name="nombre" id="nombre" />
                                                </td>
                                                <td width="4%"></td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%"></td>
                                                <td style="width:70%">
                                                    <span id="alert_nombre" aria-hidden="true" style="color:red;display:none;">Debe completar este campo</span>
                                                </td>
                                                <td width="4%"></td>
                                            </tr>
                                            <tr><td>&nbsp;</td><td></td><td></td></tr>
                                            <tr>
                                                <td>
                                                </td>                                                
                                                <td style="float:right;">                                                                                                        
                                                    <button type="button" class="btn btn-default" onclick="cancelar();" style="background:#efefee; padding-right:10px">Cancelar</button> 
                                                    <button type="submit" class="btn btn-default" style="background:#efefee; padding-right:10px" onclick="return comprobaragregar();" >Agregar</button>
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
                    <?php if ($idTipodocumentoMod != "") { ?>
                        <div class="panel panel-default">
                            <div style="background:#FFF" class="panel-heading">
                                <h4 style="text-align:left" class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        <strong>Modificar Tipo Documento</strong>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne"  class="panel-collapse " >
                                <div style="text-align:left" class="panel-body">
                                    <form id="agregar" name="agregar" method="post" action="../controlador/tipodocumentosDAO.php" Enctype = "multipart/form-data" >
                                        <input type="hidden" id="idmod" name="idmod" value="<?php echo $idTipodocumentoMod; ?>"/>
                                        <table align="center" width="99%">                                           
                                            <tr>
                                                <td style="width:25%">
                                                    Descripcion
                                                </td>
                                                <td style="width:70%">
                                                    <input class="form-control" type="text" name="nombremod" id="nombremod" value="<?php echo $nombreMod; ?>"/>
                                                </td>
                                                <td width="4%"></td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%"></td>
                                                <td style="width:70%">
                                                    <span id="alert_nombremod" aria-hidden="true" style="color:red;display:none;">Debe completar este campo</span>
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


                <div style="width:50%">
                    <?php
                    $registros = consultartipodocumentos();
                    echo '<table class="table table-hover">';
                    echo '<tr><th>Descripcion</th><th>Estado</th><th style="text-align:right;width:20%;"></th></tr>';
                    foreach ($registros as $reg) {
                        $id = $reg['ID'];                        
                        $nombre = $reg['DESCRIPCION'];                        
                        $estado = $reg['ACTIVO'];
                        echo '<tr>';                        
                        echo '<td>';
                        echo $nombre;
                        echo '</td>';                        
                        echo '<td>';
                        if ($estado) {
                            echo 'ACTIVO';
                        } else {
                            echo 'INACTIVO';
                        }
                        echo '</td>';

                        echo '<td>';
                        echo '<form style="float:right" name="Activar" method="post" action="../controlador/tipodocumentosDAO.php">
								<input id="id" name="id" type="hidden" value="' . $id . '" />
								<acronym title="Activar">
								<button type="submit" class="btn btn-default" >
								<span class="glyphicon glyphicon-arrow-up" aria-hidden="true">
								</button>
								</acronym>
								<input type="hidden" name="ac" id="ac" value="activar">
								</form>';
                        echo '<form style="float:right" name="Inactivar" method="post" action="../controlador/tipodocumentosDAO.php">
								<input id="id" name="id" type="hidden" value="' . $id . '" />
								<acronym title="Inactivar">
								<button type="submit" class="btn btn-default" >
								<span class="glyphicon glyphicon-arrow-down" aria-hidden="true">
								</button>
								</acronym>
								<input type="hidden" name="ac" id="ac" value="inactivar">
								</form>';
                        echo '<form style="float:right" name="edicion" method="post" action="tipodocumentos.php">
								<input name="id" id="id" type="hidden" value="' . $id . '" />								
								<input id="nombre" name="nombre" type="hidden" value="' . $nombre . '" />								
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
                <center>Hotel Boutique | Año 2016 ©</center>
                <br>
                    </footer>
                    </body>   
                    </html>
                    <script >

                        function comprobaragregar() {
                            var alerta_nom = document.getElementById("alert_nombre");                            
                            var nombre = document.getElementById("nombre").value;                            
                            var condicion = 0;
                            if (nombre == '') {
                                alerta_nom.style.display = "block";
                                condicion = 1;
                            } else {
                                alerta_nom.style.display = "none";
                            }							
                            if (condicion == 1) {
                                return false;
                            } else {
                                return true;
                            }
                        }

                        function comprobarmodificar() {                           
                            var alerta_nom = document.getElementById("alert_nombremod");                                                        
                            var nombre = document.getElementById("nombremod").value;
                            
                            var condicion = 0;
                            if (nombre == '') {
                                alerta_nom.style.display = "block";
                                condicion = 1;
                            } else {
                                alerta_nom.style.display = "none";
                            }                            
                            if (condicion == 1) {
                                return false;
                            } else {
                                return true;
                            }
                        }

                        function cancelar() {
                            window.location = 'tipodocumentos.php';
                        }

                        function confirmar() {
                            return confirm("¿Esta seguro que desea eliminar esta Tipodocumento?");
                        }
                    </script>

