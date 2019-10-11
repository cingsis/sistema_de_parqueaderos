
  function busquedaPorFiltro(event)
  {
    const key = event.key; // "A", "1", "Enter", "ArrowRight"...

    if (key === "Enter")
    {
      event.preventDefault();
    }

    if(document.formsalida.buscar.value == "")
    {
      $('#campovacio').show('slow');
      document.formsalida.buscar.style.border = "1px solid #f22012";
    }
    else
    {
      $('#campovacio').hide('slow');
      document.formsalida.buscar.style.border = "1px solid #505762";

      var formData = new FormData($("#formSalida")[0]);

      $.ajax({
        url: url + 'home/buscarPlaca',
        type: 'POST',
        data: formData,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          $("#carga").show("slow");
        },
        success: function(resp)
        {
          $("#carga").hide("slow");
          $("#info").removeClass('ocultar');
          $("#resultado").text("");
          $("#resultado").append(resp.html);
          $("#Transcurrido").val(resp.transcurrido);
          $("#DiasTranscurridos").val(resp.dias_transcurridos);
          $("#FechaSalida").val(resp.fecha_salida);
          $("#HoraSalida").val(resp.hora_salida);
          $("#ValorCobro").val(resp.valor_cobro);
          $("#Id").val(resp.id);
        }
      });
    }
  }

  // function buscarTodos()
  // {
  //   var formData = new FormData($("#formSalida")[0]);
  //
  //   $.ajax({
  //     url: url + 'home/buscarTodos',
  //     type: 'POST',
  //     data: formData,
  //     dataType: 'json',
  //     cache: false,
  //     contentType: false,
  //     processData: false,
  //     beforeSend: function(){
  //       $("#carga").show("slow");
  //     },
  //     success: function(resp)
  //     {
  //       $("#carga").hide("slow");
  //       $("#info").removeClass('ocultar');
  //       $("#resultado").text("");
  //       $("#resultado").append(resp.html);
  //     }
  //   });
  // }

  function actualizarPagina()
  {
    location.reload();
  }

  function asociar(event)
  {
    event.preventDefault();

    var placa = $("#td-placa").text();
    var tipo = $("#td-tipo").text();
    var fecha = $("#td-fecha").text();
    var hora = $("#td-hora").text();

    $("#numeroPlaca").val(placa);
    $("#TipoVeh").val(tipo);
  }
