<?php
include_once 'menu.php';
if (!isset($action)){
	
?>
<h1>Cortes</h1>
<form role="form" method="post" name="cortes" action="cortes.php">
  <label for="label_precio">Precio</label>
  <div class="row">
  	<div class="col-xs-3">
    <input type="text"  class="form-control" placeholder="Precio" name="precio" onkeypress="return justNumbers(event);">
 </div>
 </div>
 <br>
 <button type="submit" value="Cargar" name="Cargar" id = "cargar" class="btn btn-danger">Cargar</button>
</form>
<br>
<img src="images/peluqueria.jpg" alt="Peluqeria MyV" class="img-circle" align="right" />
<?php
}
$formPrecio = $_POST['precio'];
$data = date("Y-m-d");
echo $date;
if($_POST['Cargar']=="Cargar"){
	if($formPrecio==0){
		echo "<div class='form-group has-error'>";
		echo "<label class='control-label' for='inputError'>Ingrese un valor mayor a 0</label>";
		echo "</div>";
	}
	else {
		include_once('conection.php');
		$link = conection::openConnection();
		$query = $link->query('CALL insertarCorte("'.$data.'","'.$formPrecio.'")');
		if($query){
			echo " <div class='alert alert-info'>Informacion almacenada conrrectamente</div>";
		}
		else {
			echo " <div class='alert alert-info'>E R R O R</div>";
		}
	}
}

?>