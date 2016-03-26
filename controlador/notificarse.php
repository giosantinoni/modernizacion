<style type="text/css">
body {
	background-color: #FFC;
}
</style>
<?php

$notf = $_GET["notf"];

echo "<div align='center'> ";
switch ($notf){
	case 1:
		echo "Todavia no te logueaste!!";
		echo "<a href='form_login.php'>Loguearse</a> ";
		break;
	case 2:
		echo "Debes iniciar sesion nuevamente, tu sesion ah vencido!!!";
		echo "<a href='form_login.php'>Loguearse</a> ";
		break;
	case 3:
		echo "La clave ingresada no coincide con la repetida.";
		echo "<a href='form_login.php'>Volver a intentar</a> ";
		break;
	case 4:
		echo "El usuario ya existe!!!";
		echo "<a href='form_login.php'>Probar con otro usuario</a> ";
		break;
	case 5:
		echo "El codigo de articulo ya existe!!!";
		echo "<a href='formularios/form_transacciones.php?tipo=insert'>Volver a intentar</a> ";
		break;
	case 6:
		echo "Articulo Modificado!!!";
		echo "<a href='formularios/select_transacciones.php'>Realizar otra Transaccion</a> ";
		break;
	case 7:
		echo "Articulo Eliminado!!!";
		echo "<a href='formularios/select_transacciones.php'>Realizar otra Transaccion</a> ";
		break;
	case 8:
		echo "Articulo Insertado!!!";
		echo "<a href='formularios/select_transacciones.php'>Realizar otra Transaccion</a> ";
		break;
	case 9:
		echo "El articulo No Existe!!!";
		echo "<a href='formularios/form_transacciones.php?tipo=update'>Volver a intentar</a> ";
		break;
	case 10:
		echo "El articulo No Existe!!!";
		echo "<a href='formularios/form_transacciones.php?tipo=delete'>Volver a intentar</a> ";
		break;
	case 11:
		echo "El Usuario No Existe o la clave no es correcta!!!";
		echo "<a href='javascript:history.back()'>Volver a intentar</a> ";
		break;
	
}

echo "</div>";
?>
