<?php
include_once 'menu.php';
if (!isset($action)){
?>
<form role="form" method="post" action="historicos.php">
  				
  				<div class="radio">
 					<label>
 						<input type="radio" name="consulta" id="opciones_2" value="dia">Por dia
 					</label>
  					
				 			<input type="date" name="fecha" step="1" min="2012-01-01" max="2099-12-31" value="<?php echo $time;?>">
				</div>
  				
	
  				
  				<div class="radio">
 					<label>
 						<input type="radio" name="consulta" id="opciones_2" value="periodo">Por Periodo
 					</label>
  					
				 			<input type="date" name="desde" step="1" min="2012-01-01" max="2099-12-31" value="<?php echo $time;?>">
				 			<input type="date" name="hasta" step="1" min="2012-01-01" max="2099-12-31" value="<?php echo $time;?>">
				</div>
  				<button type="submit" class="btn btn-default" name="Enviar" value="Enviar" id="enviar">Enviar</button>
  				<button type="reset" class="btn btn-default">Reset</button>
	</form>	
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
	}
	$accion= strtoupper($_POST['accion']);
	$consulta = $_POST['consulta'];
	$dia = $_POST['fecha'];
	$desde = $_POST['desde'];
	$hasta = $_POST['hasta'];
	if ($_POST["Enviar"] == "Enviar") {
		if($consulta=="dia"){?>
			
<?php
include_once 'conection.php';
		$link = conection::openConnection();
		$date = date("Y-m-d");
		$query = $link->query('CALL cajaDiariaFicha("'.$dia.'")');
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
			$query = $link->query('CALL cajaDiariaCorte("'.$dia.'")');
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
	
		}
		else{ //////////////////////////////////////////// ELSE
		include_once 'conection.php';
		$link = conection::openConnection();
		$date = date("Y-m-d");
		$query = $link->query('CALL porPeriodoFicha("'.$desde.'","'.$hasta.'")');
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
			$query = $link->query('CALL porPeriodoCorte("'.$desde.'","'.$hasta.'")');
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
	
		}
	}
?>