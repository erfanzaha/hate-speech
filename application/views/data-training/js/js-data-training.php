<script>
$("#form-data input").on("change invalid", function() {
    var data = $(this).get(0);
    data.setCustomValidity("");

    if (!data.validity.valid) {
        data.setCustomValidity("Opss.. harus diisi !");
    }
});

$(document).on('submit', '#form-data', function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: "<?= base_url('data-training-proses') ?>",
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

$(function() {
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: '<?= base_url() ?>assets/emojilib/img/',
          popupButtonClasses: 'fa fa-smile-o'
        });
        window.emojiPicker.discover();
    });
</script>