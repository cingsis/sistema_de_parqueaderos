function validarContrasenia()
{
  var pass = $("#NewPass").val();
  var pass2 = $("#RepetirPass").val();

  if (pass != pass2)
  {
    $("#errorPass").show('slow');
  }

  else
  {
    $("#errorPass").hide('slow');
  }
}
