<?php
include_once 'menu.php';
if (!isset($action)){
	
?>
<form role="form" method="post" action="fichaTecnica.php">
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
    			?>
 			</select>
 			<br>
 			<button type="submit" name="Busqueda" value ="Busqueda" id="busqueda" class="btn btn-primary btn-lg btn-block">Busqueda</button>
 		</div>
 	</form>
<h1>Ficha</h1>
<div class="datagrid">
			<table>
				<thead>
					<tr>
						<th>Nro </th>
						<th>Fecha</th>
						<th>Servicio</th>
						<th>Total</th>
						<th>Descripcion</th>
					</tr>
				</thead>
				<tbody ondblclick="saludo()"> 
 <?php
}

	$accion= strtoupper($_POST['accion']);
	$formId = $_POST['cliente'];
	if($_POST['Busqueda']=="Busqueda"){
		include_once 'conection.php';
		$link = conection::openConnection();
		$query = $link->query('CALL porCliente("'.$formId.'")');
		$par=0;
		$total =0;
		if(mysqli_num_rows($query)!= 0){
			while($row = mysqli_fetch_assoc($query)){
				if(($par%2) == 0){
					echo "<tr class='alt'>";	
				}
				else {
					echo "<tr>";
				}
				echo "<td>".$row['id_ficha']."</td>";
				echo "<td>".$row['fecha']."</td>";
				echo "<td>".$row['servicio']."</td>";
				echo "<td>".$row['precio']."</td>";
				echo "<td>".$row['descricpion']."</td>";
				echo "</tr>";
				$par++;
				$total+=$row['precio'];
			}
		}
		else {
			echo " <div class='alert alert-danger'>Cliente sin informacion</div>";
		}
	}
	
?>
</tbody>
</table>
<fieldset disabled>
    <div class="form-group">
      <label for="disabledTextInput">Total</label>
      <input type="text" id="campoDeshabilitado" class="form-control" placeholder="Campo deshabilitado" value="$<?php echo $total;?>">
    </div>
