$(function () {
  $('#form').on('submit', function (e) {
    var archivo = $('#archivo').val();
    var extensiones = archivo.substring(archivo.lastIndexOf('.'));

    if (extensiones != '.txt') {
      if (extensiones != '') {
        alert('El archivo de tipo ' + extensiones + ' no es válido');
      } else if (extensiones == '') {
        alert('No ha seleccionado ningun archivo');
      }
      e.preventDefault();
    }
  });
});
