$(document).ready(function () {
    $('#tablex').DataTable({
      responsive: true,
      scrollX: true
    });

    $('.tambah-toko').click(function() {
      $('.modal-label').html('Tambah Toko');

      $('#kode_toko').val('');
      $('#nama').val('');
      $('#induk').val('');
    });

    $('.edit-toko').click(function() {
      $('.modal-label').html('Edit Toko');
      $('.form-modal').attr('action', 'http://192.168.77.10:8080/nextflashtools/store/edit');

      const code = $(this).data('code');

      $.ajax({
        url: 'http://192.168.77.10:8080/nextflashtools/store/getEdit',
        data: {kode_toko : code},
        method: 'POST',
        dataType: 'JSON',
        success: function(data) {
          $('#kode_toko').val(data.toko);
          $('#nama').val(data.nama);
          $('#induk').val(data.induk);
        }
      });
      return false;
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