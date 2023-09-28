$(document).ready(function () {
    $('#tablex').DataTable();
  });

  $("form").submit(function(){
    $('#submit').hide();
    $('#loading').removeClass('hidden');
  });