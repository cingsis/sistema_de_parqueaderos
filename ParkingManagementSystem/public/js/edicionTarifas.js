function habilitarEdicion()
{
  $("#ValorHora").removeAttr('readonly');
  $("#ValorAdicional").removeAttr('readonly');
  $("#ValorHora2").removeAttr('readonly');
  $("#ValorDia").removeAttr('readonly');
  $("#ValorMensualidad").removeAttr('readonly');

  $("#btnGuardarValores").removeAttr('disabled');
  $("#btnEditarValores").attr('disabled', true);
}
