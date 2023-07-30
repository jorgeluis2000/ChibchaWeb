<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
  function getQueryParam(param) {
    location.search.substr(1)
    .split("&")
        .some(function(item) { // returns first occurence and stops
          return item.split("=")[0] == param && (param = item.split("=")[1])
        })
        return param
      }
      $(document).ready(function() {
      //llave publica del comercio
      //Referencia de payco que viene por url
      var ref_payco = getQueryParam('ref_payco');
      //Url Rest Metodo get, se pasa la llave y la ref_payco como paremetro
      var urlapp = "https://secure.epayco.co/validation/v1/reference/" + ref_payco;
      $.get(urlapp, function(response) {
        if (response.success) {
          if (response.data.x_cod_response == 1) {
            //Codigo personalizado
            alert("Transaccion Aprobada");
            console.log('transacción aceptada');
          }
          //Transaccion Rechazada
          if (response.data.x_cod_response == 2) {
            console.log('transacción rechazada');
          }
          //Transaccion Pendiente
          if (response.data.x_cod_response == 3) {
            console.log('transacción pendiente');
          }
          //Transaccion Fallida
          if (response.data.x_cod_response == 4) {
            console.log('transacción fallida');
          }
          $('#1').val(response.data.x_id_invoice);
          $('#2').val(response.data.x_transaction_date);
          $('#3').val(response.data.x_response);
          $('#4').val(response.data.x_response_reason_text);
          $('#5').val(response.data.x_bank_name);
          $('#6').val(response.data.x_cardnumber);
          $('#7').val(response.data.x_quotas);
          $('#8').val(response.data.x_transaction_id);
          $('#9').val(response.data.x_amount + ' ' + response.data.x_currency_code);
        } else {
          alert("Error consultando la información");
        }
      });
    });
  </script>