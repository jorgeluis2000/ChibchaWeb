
<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');

	$usuarioDAO = new UsuarioDAO();
	$user = $usuarioDAO->getCountUsers();

	$valoresY = array();
	$valoresX = array();

	while($ver = mysqli_fetch_row($user)){
		$valoresY[] = $ver[0];
	}

	$datosY = json_encode($valoresY);
 ?>


<div id="graficaBarras"></div>

<script type="text/javascript">

	function crearCadenaBarras(json){
		var parsed = JSON.parse(json);
		var arr = [];
		for(var x in parsed){
			arr.push(parsed[x]);
		}
		return arr;
	}
</script>


<script type="text/javascript">
	datosU = crearCadenaBarras('<?php echo $datosY; ?>');



	var data = [
	{
		x: ['Usuarios', 'Empleados', 'Distribuidores'],
		y: datosU,
		marker:{
	 color: ['rgba(204,204,204,1)', 'rgba(222,45,38,0.8)', 'rgba(204,204,204,1)']
 },
		type: 'bar'
	}
	];

	Plotly.newPlot('graficaBarras', data);
</script>
