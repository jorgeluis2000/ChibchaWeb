<?php
session_start();
if (isset($_SESSION["loggedIn"])) {
    if ($_SESSION["loggedIn"] == true && $_SESSION["tipo"] == 2) {
        header("location: ../modulos/Client/ProfileClient");
    }elseif ($_SESSION["loggedIn"] == true && $_SESSION["tipo"] == 1) {
        header("location: ../modulos/Admin/AdminHome");
    }elseif ($_SESSION["loggedIn"] == true && $_SESSION["tipo"] == 3) {
        header("location: ../modulos/Distributor/ProfileDistributor");
    }elseif ($_SESSION["loggedIn"] == true && $_SESSION["tipo"] == 4) {
        header("location: ../modulos/Employee/ProfileEmployee");
    }
}
ob_start();
header("refresh: 8; url = Home");
ob_end_flush();

$correo = $_GET['mail'];

if (!isset($correo)) {
    header("location: Home");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ChibchaWeb | Espere ...</title>
    <environment include="Development">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </environment>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Data/css/main.css"/>
    <link href="../../Data/assets/multistepform/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../../Data/css/styles.css"/>}
    <link href="https://fonts.googleapis.com/css?family=Marko+One&display=swap" rel="stylesheet">
</head>
<body>
<style type="text/css">body{font-family: 'Marko One', sans-serif;}</style>
    <div class="container-fluid">
        <div class="row justify-content-between">
            <div class="col-2"></div>
            <div class="col-8 center">
                <span>Chibcha Web</span>
                <div class="row">
                    <div class="col-6 top">
                        <?php if ($correo != 1) { ?>
                        <h3>¡Revisa tu email! ... </h3><h5><b><?php echo($correo); ?></b></h5><br>
                        <h3>En tu bandeja de entrada dejamos un correo para que sigas con el proceso</h3>
                        <?php } else { ?>
                        <h3>¡Ya estas cerca de completar tu registro como distribuidor en ChibchaWeb!</h3><br>
                        <h3>El administrador te enviará un correo cuando tu solicitud de ingreso sea aprobada</h3>
                        <?php } ?>
                    </div>
                    <div class="col-6">
                        <img src="../../Data/imgs/pay.png">
                    </div>
                </div>
                <div class="lase text-center">
                    <hr>
                    <img src="../../Data/imgs/loader05.gif">
                </div>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
</body>
</html>