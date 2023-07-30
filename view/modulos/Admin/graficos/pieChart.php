<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/ClienteDAO.class.php');

	$clienteDAO = new ClienteDAO();
	$cliente = $clienteDAO->getCountClientesOrder();

	$value = array();
	$label = array();

	while($ver = mysqli_fetch_row($cliente)){
		$value[] = $ver[0];
		$label[] = $ver[1];
	}

	$datosA = json_encode($value);
	$datosB = json_encode($label);
 ?>


<div id="graficaPie"></div>


<script type="text/javascript">


var data = [{
  values: <?php echo $datosA?>,
  labels: <?php echo $datosB?>,
  type: 'pie'
}];

var layout = {
  height: 400,
  width: 500
};

Plotly.newPlot('graficaPie', data, layout);
</script>
