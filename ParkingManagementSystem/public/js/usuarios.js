function cambiarestado(id){
  swal({
    title: "¿Realmente desea cambiar el estado del usuario?",
    type: "warning",
    confirmButton: "#3CB371",
    confirmButtonText: "btn-danger",
    cancelButtonText: "Cancelar",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Aceptar",
    closeOnConfirm: false,

  },
  // function(isConfirm){
  //     if (isConfirm) {
  //       swal({
  //         title: "Estado del usuario cambiado correctamente!!",
  //         type: "success",
  //         confirmButton: "#3CB371",
  //         confirmButtonText: "Aceptar",
  //         // confirmButtonText: "Cancelar",
  //         closeOnConfirm: false,
  //         closeOnCancel: false
  //       },
        function(isConfirm){
          $.ajax({
            type:"POST",
            url:url+"admin/cambiarEstado",
            data:{
            'id':id,
          },
          }).done(function(respuesta){
            if(respuesta == 1){
              swal({
                      title: "Estado del usuario cambiado correctamente!!",
                      type: "success",
                      confirmButton: "#3CB371",
                      confirmButtonText: "Aceptar",
                      closeOnConfirm: false,
                      closeOnCancel: false
                    },
                    function(isConfirm)
                    {
                      if(isConfirm)
                      {
                        window.location = url + "admin/reporteUsuarios";
                      }
                    }
                  );
            }
            else
            {
              sweetAlert("Error al cambiar el estado");
            }
          }).fail(function(){

          })

        });
      }
      // });
// }

function validarPassRepeat()
{
  var pass = $("#Pass").val();
  var pass2 = $("#RepeatPass").val();

  if (pass != pass2)
  {
    $("#igualpass").show('slow');
  }

  else
  {
    $("#igualpass").hide('slow');
  }
}
