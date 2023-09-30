$(document).ready(function () {
    $('#tablex').DataTable({
      responsive: true,
      scrollX: true
    });
});

$("form").submit(function(){
  $('#submit').hide();
  $('#loading').removeClass('hidden');
});

$(".sweetalert-confirm").click(function(){
  let link = $(this).attr('href');
    Swal.fire({
    title: 'Yakin mau dihapus?',
    text: "Anda tidak akan dapat mengembalikan ini!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#006AB',
    cancelButtonColor: '#6E0717',
    confirmButtonText: 'Hapus'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = link
    }
  })
  return false;
});