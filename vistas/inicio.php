<?php
include_once '../script/session.inc.php';

@$usuario = $_SESSION["s_usuario"]; //base64_decode($_GET['usuario']);
@$usuarionombre = $_SESSION["s_nombreusuario"];
@$usuarioapellido = $_SESSION["s_apellidousuario"];
?>	


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Administrador Hotel Boutique</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" />        
        <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="js/select_dependientes_3_niveles.js"></script>

    </head>

    <body style="background:#efefee"><!--#96D161 verde manzana-->
        <header>
            <?php include("header.php"); ?>
        </header>
        <section>
            <center>
                <div style="width:50%">
                    <div class="panel-group" style="width:80%" id="accordion">                
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

