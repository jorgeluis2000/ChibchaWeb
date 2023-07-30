<?php 
session_start();
require ($_SERVER['DOCUMENT_ROOT']. '/ChibchaWeb/Controller/DAO/implementation/UsuarioDAO.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/ChibchaWeb/Controller/database.class.php');

$userDAO = new UsuarioDAO();
$usuario = $userDAO->getUsuario($_SESSION["loggedIn"]);
$codigo = $usuario->getCodigoUsuario();

$str = file_get_contents('php://input');
$fileName = md5(time()).'.jpg';

$user = $_GET['us'];
$path;
$image;

if ($user == 1) {
	$path = '../Data/Profiles/'.$fileName;
	$image = "Data/Profiles/$fileName";
} else {
	$path = '../Data/Distributor/'.$fileName;
	$image = "Data/Distributor/$fileName";
}

file_put_contents($path, $str);

$db = new Database();
$db->connect();

$img = "UPDATE USUARIO set img_usuario = '$image' WHERE cod_usuario = $codigo";
$db->doQuery($img, UPDATE_QUERY);

$db->disconnect();
?>