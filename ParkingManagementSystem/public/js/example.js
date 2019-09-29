

function myFunction()
{

  var formData = new FormData($("#id")[0]);

  $.ajax({
    url: url + 'controller/function',
    type: 'POST',
    data: formData,
    dataType: 'json',
    cache: false,
    contentType: false,
    processData: false
  }).done(function(resp)
  {
    console.log("response if true");
  });
}
