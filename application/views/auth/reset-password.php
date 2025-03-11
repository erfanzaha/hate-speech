<div class="block">
    <div class="container">
        <ul class="breadcrumbs">
            <li><a href="index.html"><i class="icon icon-home"></i></a></li>
            <li>/<span>Customer Reset Password</span></li>
        </ul>
    </div>
</div>
<div class="block">
    <div class="container">
        <div class="row row-eq-height">
            <div class="col-sm-6">
                <div class="form-card">
                    <h4>Buat Akun</h4>
                    <p>Dengan membuat akun di toko kami, Anda dapat melanjutkan proses pembayaran
                        lebih cepat, menyimpan beberapa alamat pengiriman, melihat dan melacak pesanan Anda di akun Anda
                        dan banyak lagi.
                    </p>
                    <div><a href="<?= base_url('register') ?>" class="btn btn-lg"><i
                                class="icon icon-user"></i><span>Register</span></a></div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-card">
                    <h4>Reset Password</h4>
                    <p>Isi form di bawah ini untuk membuat kata sandi baru.</p>
                    <div class="alert alert-danger bg-danger" style='display:none;' id="msg-pass">
                        <span></span>
                    </div>
                    <form method="post" id="form-data" class="account-create">
                        <input type="hidden" name="id_reset" id="id" value="<?= $this->session->userdata('id_user') ?>">
                        <label>New Password<span class="required">*</span></label>
                        <input class="form-control input-lg" type="password" name="r_newpass" id="r_password"
                            placeholder="New Password" required onkeyup="checkPass();">
                        <label>Confirm Password<span class="required">*</span></label>
                        <input class="form-control input-lg" type="password" name="confirm" id="confirm"
                            placeholder="Konfirmasi Password" required onkeyup="checkPass();">
                        <div>
                            <button class="btn btn-lg" type="submit">Reset Password</button><span
                                class="required-text">*
                                Required
                                Fields</span>
                        </div>
                        <div class="back"><a href="<?= base_url('customer') ?>">Login</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>