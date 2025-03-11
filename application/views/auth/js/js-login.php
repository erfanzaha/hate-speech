<script>
$(document).on('submit', '#form-tambah', function(e) {
    
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: "<?= base_url('proses-login') ?>",
        method: 'post',
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        success: function(res) {
            if (res.icon == 'success') {
                swal({
                    title: 'Sukses',
                    text: res.msg,
                    icon: "success",
                    closeOnClickOutside: false,
                    closeOnEsc: false
                }).then((ok) => {
                    window.location.href = "<?= base_url('dashboard') ?>";
                });
            } else {
                swal({
                    title: 'Gagal',
                    text: "Data gagal disimpan",
                    icon: "error",
                    closeOnClickOutside: false,
                    closeOnEsc: false
                });
            }
        }
    });
});
</script>