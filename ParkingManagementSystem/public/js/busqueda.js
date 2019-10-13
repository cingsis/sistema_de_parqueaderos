
  function busquedaPorFiltro()
  {
    if(document.formsalida.buscar.value == "")
    {
      $('#campovacio').show('slow');
      $('#noexiste').hide('slow');
      document.formsalida.buscar.style.border = "1px solid #f22012";
    }
    else
    {
      $('#campovacio').hide('slow');
      $('#noexiste').hide('slow');
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
        $("#errorvacios").hide('slow');

        if(resp != 2)
        {
          swal({
            title: "Total a pagar: $ " + resp.valor_cobro,
            text: "",
            type: "success",
            confirmButtonColor: "#3CB371",
            cancelButtonText: "No",
            showCancelButton: false,
            confirmButtonText: "Aceptar",
            closeOnConfirm: true,
          });

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

        if(resp == 2)
        {
          $("#carga").hide("slow");
          $("#noexiste").show("slow");

          // $("#resultado").append(
          //   '<tr><td colspan="4"><strong><p class="text-center">' +
          //   'No se encontrarón datos con la ' +
          //   'información proporcionada, por favor ingrese otra placa...!</p></strong>' +
          //   '</td></tr>'
          // );
        }
        }
      });
    }
  }

  function llamarFuncionBusqeda(event)
  {
    const key = event.key; // "A", "1", "Enter", "ArrowRight"...

    if (key === "Enter")
    {
      event.preventDefault();
      busquedaPorFiltro();
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

function guardarSalida()
{
  if(document.registrosalida.numeroplaca.value != "" &&
    document.registrosalida.tipovehiculo.value != "" &&
    document.registrosalida.tipovehiculo.value != "" &&
    document.registrosalida.horasalida.value != "" &&
    document.registrosalida.diastranscurridos.value != "" &&
    document.registrosalida.transcurrido.value != "" &&
    document.registrosalida.valorcobro.value != "" &&
    document.registrosalida.usuarioactual.value != "")
  {
    $("#errorvacios").hide('slow');

    var formData = new FormData($("#RegistroSalida")[0]);
    var id = $("#Id").val();

    $.ajax({
      url: url + 'admin/registrarSalida',
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
        if(resp == 1)
        {
          swal({
                title: "Registro guardado correctamente!",
                text: "¿Desea imprimir el Tiquete de salida?",
                type: "success",
                confirmButtonColor: "#3CB371",
                cancelButtonText: "No",
                showCancelButton: true,
                confirmButtonText: "Sí",
                closeOnConfirm: true,

                },
                function(isConfirm){
                if (isConfirm) {
                  window.location =  url + 'home/comprobanteSalida?id='+ id;
                }
                else
                {
                  window.location = url + "admin/salidaMotos";
                }
            });

        }
      }
    });
  }
  else
  {
    $("#errorvacios").show('slow');
  }
}
