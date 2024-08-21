$(function () {
  $('#form').on('submit', function (e) {
    var archivo = $('#archivo').val();
    var extensiones = archivo.substring(archivo.lastIndexOf('.'));

    if (extensiones != '.pdf' && extensiones != '.doc') {
      if (extensiones != '') {
        alert('El archivo de tipo ' + extensiones + ' no es válido');
      } else if (extensiones == '') {
        alert('No ha seleccionado ningun archivo');
      }
      e.preventDefault();
    }

    if ($('#archivo')[0].files[0] != undefined) {
      if ($('#archivo')[0].files[0].size / 1024 > 2048) {
        alert('El archivo excede el tamaño máximo permitido');
        e.preventDefault();
      }
    }
  });
});
