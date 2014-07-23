<?php
include_once 'menu.php';
$time = date("Y-m-d");
if (!isset($action)){
?>
<div id="cajaUno">
<h1>Ingrese datos del Cliente</h1>
<form role="form" method="post" action="modificar.php" name="formulario">
				<label for="label_nombre">Fecha</label>
				 <input type="date" name="fecha" step="1" min="2012-01-01" max="2099-12-31" value="<?php echo $time;?>">
  				<div class="form-group">
    				<label for="label_nombre">Cliente</label>
    				<select multiple class="form-control" name="cliente">
    				<?php
    				include_once 'conection.php';
					$link = conection::openConnection();
					$query = $link->query('CALL listarClientes()');
					while($res = mysqli_fetch_assoc($query)){
						?>
							<option value = " <?php echo $res['id']; ?> "><?php echo $res['nombre']." ".$res['apellido']?></option>
							<?php	
					}
					unset($link);
					unset($query);
    				?>
    				
  				</select>
  				<label for="label_apellido">Tratamiento</label>
				<select class="form-control" name="tratamiento">
					<option value="Desgaste">Alisado</option>
					<option value="Color">Color</option>
  					<option value="Corte">Corte</option>
					<option value="Shock">Shock</option>
					<option value="Nutricion">Nutricion</option>
					
					<option value="Trenzas">Trenzas</option>
					<option value="Mechas">Mechas</option>
					<option value="Reflejos">Reflejos</option>
					
					<option value="Localizadas">Localizadas</option>
					<option value="Planchita">Planchita</option>
					<option value="Brushing">Brushing</option>
					<option value="Botox">Botox</option>
					<option value="Nutricion">Nutricion</option>
					<option value="Baño de Crema">Baño de crema</option>
					<option value="Lavado">Lavado</option>
					<option value="Lavado Nutritivo">Lavado Nutritivo</option>
				</select>
				<label for="label_apellido">Descricpcion</label>
  				<textarea class="form-control" rows="3" name="descripcion"></textarea>
  				<label for="label_apellido">Precio</label>
  				<div class="row">
  					<div class="col-xs-3">
    				<input type="text"  class="form-control" placeholder="Precio" name="precio" onkeypress="return justNumbers(event);">
 					</div>
 				</div>
  				<button type="submit" class="btn btn-default" name="Enviar" value="Enviar" id="enviar">Enviar</button>
  				
</form>	
<?php
	$accion= strtoupper($_POST['accion']);
	$fecha = strtoupper($_POST['fecha']);
	$id_cliente = strtoupper($_POST['cliente']);
	$tratamiento = strtoupper($_POST['tratamiento']);
	$descripcion = strtoupper($_POST['descripcion']);
	$precio = $_POST['precio'];
	if ($_POST["Enviar"] == "Enviar") {
		include_once 'conection.php';
		$link = conection::openConnection();
		if($tratamiento=="Corte"){
			$query = $link->query('CALL insertarCorte("'.$data.'","'.$formPrecio.'")');
		}
		else {
			$query = $link->query('CALL insertarFicha("'.$tratamiento.'","'.$fecha.'","'.$precio.'","'.$descripcion.'","'.$id_cliente.'")');	
		}
		
		if($query){
			echo"<div class='alert alert-success'>Elemento añadido</div>";
			$cnn = conection::openConnection();
			$querydos = $cnn->query('CALL porCliente("'.$id_cliente.'")');
			?>
			</div>
	</div>
			<div id="cajaDos">
				<h1>Tratamientos</h1>
				<div class="panel panel-default">
  					<div class="panel-heading">Lista de Tratamientos</div>
  					<div class="panel-body">
    					<div class="datagrid">
							<table>
								<thead>
									<tr>		
										<th>Fecha</th>				
										<th>Servicio</th>
										<th>Total</th>
										<th>Descricpion</th>
									</tr>
								</thead>
			<?php
			while($row = mysqli_fetch_assoc($querydos)){
				if(($par%2) == 0){
					echo "<tr class='alt'>";	
				}
				else {
					echo "<tr>";
				}
				
				echo "<td>".$row['fecha']."</td>";
				echo "<td>".$row['servicio']."</td>";
				echo "<td>".$row['precio']."</td>";
				echo "<td>".$row['descricpion']."</td>";
				echo "</tr>";
				$par++;
				$total+=$row['precio'];
			}
		}
		else{
			echo "<div class='alert alert-danger'>Error! Por favor intente nuevamente</div>";
		}
	}
?>



</div>

</div>


				<tbody id="items">
					
				</tbody>
			</table>
  		</div>
	</div>
	 <fieldset disabled>
    <div class="form-group">
      <label for="disabledTextInput">Total</label>
      <input type="text" id="campoDeshabilitado" class="form-control" 
             placeholder="Campo deshabilitado">
    </div>
</div>
<?php

}
?>