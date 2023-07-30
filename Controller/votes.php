<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Controller/database.class.php');

$valor = $_GET['valor'];

$db = new Database();
$db->connect();

$count1 = "SELECT * FROM CALIFICACION ORDER BY cod_calificacion DESC";
$db->doQuery($count1, SELECT_QUERY);
$num = $db->results[0];
$codigo = $num['cod_calificacion'];

$query = "INSERT INTO CALIFICACION values ($codigo+1, $valor)";
$db->doQuery($query, INSERT_QUERY);

header("location: ../view/principal/Home");
?>