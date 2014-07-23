<?php
include_once 'menu.php';
?>
<h1>Caja Diaria</h1>
<div class="datagrid">
	<table>
		<thead>
			<tr>
				<th>Nro </th>
				<th>Fecha</th>
				<th>Servicio</th>
				<th>Total</th>
			</tr>
		</thead>
	<tbody ondblclick="saludo()">
<?php
include_once 'conection.php';
		$link = conection::openConnection();
		$date = date("Y-m-d");
		$query = $link->query('CALL cajaDiariaFicha("'.$date.'")');
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
				echo "</tr>";
				$par++;
				$total+=$row['precio'];
			}
			unset($link);
			unset($query);
			$link = conection::openConnection();
			$date = date("Y-m-d");
			$query = $link->query('CALL cajaDiariaCorte("'.$date.'")');
			while($row = mysqli_fetch_assoc($query)){
				if(($par%2) == 0){
					echo "<tr class='alt'>";	
				}
				else {
					echo "<tr>";
				}
				echo "<td>".$row['id_cortes']."</td>";
				echo "<td>".$row['fecha']."</td>";
				echo "<td>Corte</td>";
				echo "<td>".$row['importe']."</td>";
				echo "</tr>";
				$par++;
				$total+=$row['importe'];
			}
			
		}
	
		else {
			echo " <div class='alert alert-danger'>Cliente sin informacion</div>";
		}
?>
</tbody>
</table>
<p></p>
<fieldset disabled>
    <div class="form-group">
      <label for="disabledTextInput">Total</label>
      <input type="text" id="campoDeshabilitado" class="form-control" placeholder="Campo deshabilitado" value="$<?php echo $total;?>">
    </div>