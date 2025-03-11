<div class="block">
    <div class="container">
        <ul class="breadcrumbs">
            <li><a href="index.html"><i class="icon icon-home"></i></a></li>
            <li>/<span>Pendaftaran Akun Baru</span></li>
        </ul>
    </div>
</div>
<div class="block">
    <div class="container">
        <div class="form-card">
            <h3>Pendaftaran Akun</h3>

            <form method="post" id="form-data" class="account-create">
                <label>Nama Lengkap<span class="required">*</span></label>
                <input class="form-control" type="text" name="nama" id="nama" placeholder="Nama lengkap" required>
                <label>Email<span class="required">*</span></label>
                <input class="form-control" type="email" name="email" id="email"
                    placeholder="Email ( Cth : example@email.com )" required>
                <label>Username<span class="required">*</span></label>
                <input class="form-control" type="text" name="username" id="username" placeholder="Username" required>
                <label>No Telp<span class="required">*</span></label>
                <input class="form-control" type="text" name="no_telp" id="no_telp" placeholder="Nomor Telepon"
                    required>
                <label>Alamat<span class="required">*</span></label>
                <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat" required></textarea>
                <div class="alert alert-danger bg-danger" style='display:none;' id="msg-pass">
                    <span></span>
                </div>
                <label>Katasandi<span class="required">*</span></label>
                <input class="form-control" type="password" name="password" id="passwordRegis" placeholder="Katasandi"
                    required onkeyup="checkPass();">
                <label>Konfirmasi Katasandi<span class="required">*</span></label>
                <input class="form-control" type="password" name="confirm" id="confirmRegis"
                    placeholder="Konfirmasi Katasandi" required onkeyup="checkPass();">
                <div>

                    <button type="button" class="btn disbled btn-lg" id="btnSimpan">Buat Akun</button><span
                        class="required-text">* Wajib Diisi</span>
                </div>
                <div class="back">atau <a href="<?= base_url('/') ?>">Kembali ke Halaman Utama <i class="icon icon-undo"></i></a>
                </div>
            </form>
        </div>
    </div>
</div>