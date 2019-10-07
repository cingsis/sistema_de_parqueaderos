
  function busquedaPorFiltro()
  {  
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
        $("#resultado").append(resp.html);
      }
    });
  }

  function buscarTodos()
  {
    var formData = new FormData($("#formSalida")[0]);

    $.ajax({
      url: url + 'home/buscarTodos',
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
        $("#resultado").append(resp.html);
      }
    });
  }
