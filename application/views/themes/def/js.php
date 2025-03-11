<?php
$uri  = $this->uri->segment(1);
if($uri == ""){
    $uri = "dashboard";
}else{
    $uri = $uri;
}
$this->load->view($uri.'/js/js-'.$uri);
?>

<script>
$(document).on('click', '#btn-logout', function(e) {

    e.preventDefault();
    swal({
        dangerMode: true,
        title: "Peringatan",
        text: "Anda yakin ingin logout?",
        icon: "warning",
        buttons: {
            cancel: "Batal",
            confirm: "Lanjutkan"
        },
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then((ok) => {
        if (ok) {
            $.ajax({
                url: '<?= base_url('logout') ?>',
                method: 'post',
                success: function(res) {
                    swal({
                        title: "Sukses",
                        text: "Anda berhasil logout",
                        icon: "success",
                        closeOnClickOutside: false,
                        closeOnEsc: false
                    }).then((ok) => {
                        if (ok) {
                            window.location.href = "<?= base_url('/') ?>";
                        }
                    });
                }
            });
        } else {
            swal({
                title: "Dibatalkan",
                text: "Anda membatalkan logout",
                icon: "error"
            });
        }
    });
});
</script>