
	<script src="../../../Data/js/plotly-latest.min.js"></script>
	<script src="../../../Data/js/jquery-3.3.1.min.js"></script>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-primary">
					<div class="panel panel-heading">
					</div>
					<div class="panel panel-body">
						<div class="row">
							<div class="col-sm-12">
								<div id="cargaLineal"></div>
							</div>
							<div class="col-sm-6">
								<h5>Porcentaje de Usuarios por País</h5>
								<div id="cargaPieChart"></div>
							</div>
							<div class="col-sm-6">
								<h5>Total de Usuarios, Empleados y Distribuidores</h5>
								<div id="cargaBarras"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	  $(document).ready(function(){
	    $('#cargaLineal').load('../../modulos/Admin/graficos/lineal.php');
	    $('#cargaPieChart').load('../../modulos/Admin/graficos/pieChart.php');
			$('#cargaBarras').load('../../modulos/Admin/graficos/barras.php');
	  });
	</script>
