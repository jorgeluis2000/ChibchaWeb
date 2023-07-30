<?php 
session_start();
$_SESSION["loggedIn"] = false;
session_commit();
session_destroy();
header("location: ../view/principal/Home");
?>