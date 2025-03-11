<div class="block">
    <div class="container">
        <ul class="breadcrumbs">
            <li><a href="index.html"><i class="icon icon-home"></i></a></li>
            <li>/<span>Customer Forgot Password</span></li>
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
                    <h4>Lupa Password</h4>
                    <p>Jika Anda memiliki akun dengan kami, silakan masuk.</p>
                    <form method="post" id="form-data" class="account-create">
                        <label>E-mail<span class="required">*</span></label>
                        <input class="form-control input-lg" type="email" name="email" id="email" placeholder="Email ( Cth : example@email.com )" required>
                        <div>
                            <button class="btn btn-lg" type="submit">Tahap Selanjutnya</button><span class="required-text">*
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