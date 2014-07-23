<?php
include_once 'menu.php';
if (!isset($action)){
?>
<h1>Ingrese datos del Cliente</h1>
<form role="form" method="post" action="altaCliente.php">
  				<div class="form-group">
    				<label for="label_nombre">Nombre</label>
    				<input type="nombre" name="nombre" class="form-control" id="label_nombre" placeholder="Nombre Cliente">
  				</div>
  				<div class="form-group">
    				<label for="label_apellido">Apellido</label>
    				<input type="apellido" name="apellido" class="form-control" id="label_apellido" placeholder="Apellido Cliente">
  				</div>
  				<div class="form-group">
    				<label for="label_localidad">Localidad</label>
    				<input type="localidad" name="localidad" class="form-control" id="label_localidad" placeholder="Localidad Cliente">
  				</div>
  				<div class="form-group">
    				<label for="label_telefono">Telefono</label>
    				<input type="telefono" name="telefono" class="form-control" id="label_telefono" placeholder="Telefono">
  				</div>
  				<button type="submit" class="btn btn-default" name="Enviar" value="Enviar" id="enviar">Enviar</button>
  				<button type="reset" class="btn btn-default">Reset</button>
</form>	
<?php
}
	$accion= strtoupper($_POST['accion']);
	$formName = strtoupper($_POST['nombre']);
	$formLast = strtoupper($_POST['apellido']);
	$formPleace = strtoupper($_POST['localidad']);
	$formPhone = strtoupper($_POST['telefono']);
	if ($_POST["Enviar"] == "Enviar") {
		if(empty($formName)|| empty($formLast)|| empty($formPleace)){
			echo "<div class='alert alert-danger'>Error! Por favor intente nuevamente</div>";
		}else {
			include_once 'conection.php';
			$link = conection::openConnection();
			$res = $link->query('CALL insertarCliente("'.$formName.'","'.$formLast.'","'.$formPhone.'","'.$formPleace.'")');
			if($res){
				echo "<div class='alert alert-success'>Felicitaciones! El cliente se encuentra registrado</div>";
			}
			else {
				echo "<div class='alert alert-danger'>Error! Por favor intente nuevamente</div>";
			}
			mysqli_close($link);
			
		}
  }

?>