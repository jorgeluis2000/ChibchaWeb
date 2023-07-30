<script>
  var Var_JavaScript = 135; // declaración de la variable 
</script>
<?php
$var_PHP = "<script> document.writeln(Var_JavaScript); </script>"; // igualar el valor de la variable JavaScript a PHP 
echo($var_PHP); // muestra el resultado 
?>
<script src="https://checkout.epayco.co/checkout.js" class="epayco-button" data-epayco-key="491d6a0b6e992cf924edd8d3d088aff1" data-epayco-amount="<?php echo($new); ?>" data-epayco-name="Hosting - plan" data-epayco-description="Hosting - plan" data-epayco-currency="USD" data-epayco-country="CO" data-epayco-test="false" data-epayco-external="false" data-epayco-response="http://localhost:80/ChibchaWeb/view/modulos/Client/ResponseClient.php?  type=1&plan=<?php echo('a'); ?>" data-epayco-confirmation="http://localhost:80/ChibchaWeb/view/modulos/Client/ResponseClient.php?type=1&plan=<?php echo('a'); ?>">
</script>