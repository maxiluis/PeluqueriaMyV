<?php
include_once 'menu.php';
include_once 'conection.php';
?>
<h1>Clientes</h1>
<div class="datagrid">
			<table>
				<thead>
					<tr>
						<th>Nro </th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Localidad</th>
						<th>Telefono</th>
					</tr>
				</thead>
				<tbody ondblclick="saludo()"> 
<?php
$link = conection::openConnection();
$query = $link->query('CALL listarClientes');
$par = 0;
while($res = mysqli_fetch_assoc($query)){
	if(($par%2) == 0){
		echo "<tr class='alt'>";	
	}
	else {
		echo "<tr>";
	}
	echo "<td>".$res['id']."</td>";
	echo "<td>".$res['nombre']."</td>";
	echo "<td>".$res['apellido']."</td>";
	echo "<td>".$res['localidad']."</td>";
	echo "<td>".$res['telefono']."</td>";
	echo "</tr>";
	$par++;
}
?>
</table>
</div>