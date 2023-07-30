<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/ClienteDAO.class.php');

	$clienteDAO = new ClienteDAO();
	$cliente = $clienteDAO->getCountClientesOrder();

	$valoresY = array(); //pais
	$valoresX = array(); //fecha

	while($ver = mysqli_fetch_row($cliente)){
		$valoresY[] = $ver[0];
		$valoresX[] = $ver[1];
	}

	$datosX = json_encode($valoresX);
	$datosY = json_encode($valoresY);
 ?>

<div id="graficaLineal"></div>

<script type="text/javascript">

	function crearCadenaLineal(json){
		var parsed = JSON.parse(json);
		var arr = [];
		for(var x in parsed){
			arr.push(parsed[x]);
		}
		return arr;
	}
</script>


<script type="text/javascript">

	datosX = crearCadenaLineal('<?php echo $datosX ?>');
	datosy = crearCadenaLineal('<?php echo $datosY ?>');

	var trace1 = {
		x: datosX,
		y: datosy,
		type: 'scatter'
	};

	//
	// var trace2 = {
	// 	x: [1, 2, 3, 4],
	// 	y: [16, 5, 11, 9],
	// 	type: 'scatter'
	// };

	var data = [trace1];

	Plotly.newPlot('graficaLineal', data);
</script>
