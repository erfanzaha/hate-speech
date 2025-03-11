<script>
function checkPass() {
        var newPass = $('#r_password').val();
        var confirmPass = $('#confirm').val();
        if (newPass == confirmPass && newPass != "" && confirmPass != "" && newPass.length >= 8) {
            $('#btnSimpan').attr('type', 'submit');
            $('#btnSimpan').attr('class', 'btn btn-primary');
            $('#msg-pass').attr('style', 'display:block;');
            $('#msg-pass').attr('class', 'alert alert-success bg-success');
            $('#msg-pass span').html('Password sesuai');
        } else {
            $('#msg-pass').attr('style', 'display:block;');
            $('#msg-pass').attr('class', 'alert alert-danger bg-danger');
            if (newPass != confirmPass) {
                $('#msg-pass span').html('Password tidak sama');
            } else if (newPass.length < 8) {
                $('#msg-pass span').html('Panjang password kurang dari 8');
            }
            $('#btnSimpan').attr('type', 'button');
            $('#btnSimpan').attr('class', 'btn disbled');
        }
}

var ins = $('#form-data').on('submit', function(e){
      
      e.preventDefault();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      $.ajax({
        url: "<?php echo base_url('proses-reset-password'); ?>",
        method: 'post',
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        success: function(r){
          if(r.icon == 'success'){
              swal({
                  title: "Success",
                  icon: r.icon,
                  text: r.msg,
                  dangerMode: false,
                  buttons: {                        
                      confirm: "Lanjut login",
                  }
              }).then((ok) => {
                window.location.href = "<?= base_url('customer') ?>";
              });
            }else{
              swal({
                  title: r.icon,
                  text: r.msg,
                  icon: r.icon
              });
            }
        }
      }); 
    
  });
</script>