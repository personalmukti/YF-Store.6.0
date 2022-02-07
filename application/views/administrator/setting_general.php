<?php echo $this->session->flashdata('upload'); ?>

<!-- Begin Page Content -->
<div class="container-fluid mb-4">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800 mb-4">Pengaturan</h1>

	<div class="row">
        <div class="col-lg-3">
            <div class="card shadow">
                <div class="card-body">
                <?php include('menu-setting.php'); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card shadow">
                <div class="card-body">
                    <?php echo $this->session->flashdata('failed'); ?>
                    <p class="lead">Logo</p>
                    <img src="<?= base_url(); ?>assets/images/logo/<?= $setting['logo'] ?>" alt="logo" width="40%">
                    <form action="<?= base_url(); ?>administrator/setting_change_logo" method="post" enctype="multipart/form-data">
                        <div class="form-group mt-2">
                            <input type="file" name="logo" id="logo" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success">Ganti Logo</button>    
                    </form>
                    <hr>
                    <?php echo $this->session->flashdata('failed'); ?>
                    <p class="lead">Favicon</p>
                    <img src="<?= base_url(); ?>assets/images/logo/<?= $setting['favicon'] ?>" alt="favicon" width="70px">
                    <form action="<?= base_url(); ?>administrator/setting_change_favicon" method="post" enctype="multipart/form-data">
                        <div class="form-group mt-2">
                            <input type="file" name="logo" id="logo" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-sm btn-success">Ganti Favicon</button>    
                    </form>
                    <div class="col-md-9">
                </div>
            </div>
        </div>
        <div class="card shadow mt-3">
            <div class="card-header">
                <h2 class="lead text-dark mb-0">Umum</h2>
            </div>
                <div class="card-body">
                    <form action="<?= base_url(); ?>administrator/setting/general" method="post">
                        <div class="form-group">
                            <label for="title">Nama Website</label>
                            <input type="text" autocomplete="off" name="title" id="title" class="form-control" required value="<?= $general['app_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="slogan">Slogan Website</label>
                            <input type="text" autocomplete="off" name="slogan" id="slogan" class="form-control" required value="<?= $general['slogan']; ?>">
                            <small class="text-muted">Akan muncul pada title home</small>
                        </div>
                        <div class="form-group">
                            <label for="color">Warna Navigasi</label>
                            <input type="text" autocomplete="off" name="color" id="color" class="form-control" required value="<?= $general['navbar_color']; ?>">
                            <small class="text-muted">Gunakan kode heksa. Contoh: #12283F</small>
                        </div>
                        <div class="form-group">
                            <label for="rajaongkir">API Rajaongkir</label>
                            <input type="text" autocomplete="off" name="rajaongkir" id="rajaongkir" class="form-control" required value="<?= $general['api_rajaongkir']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="smtp_host">SMTP Host</label>
                            <input type="text" autocomplete="off" name="smtp_host" id="smtp_host" class="form-control" required value="<?= $general['host_mail']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="smtp_port">SMTP Port</label>
                            <input type="text" autocomplete="off" name="smtp_port" id="smtp_port" class="form-control" required value="<?= $general['port_mail']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="crypto_smtp">Crypto Mail</label>
                            <input type="text" autocomplete="off" name="crypto_smtp" id="crypto_smtp" class="form-control" value="<?= $general['crypto_smtp']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="account_gmail">Akun Mail</label>
                            <input type="email" autocomplete="off" name="account_gmail" id="account_gmail" class="form-control" required value="<?= $general['account_gmail']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="pass_gmail">Password Mail</label>
                            <input type="password" autocomplete="off" name="pass_gmail" id="pass_gmail" class="form-control" required value="<?= $general['pass_gmail']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="whatsapp">WhatsApp</label>
                            <input type="number" autocomplete="off" name="whatsapp" id="whatsapp" class="form-control" required value="<?= $general['whatsapp']; ?>">
                            <small class="text-muted">Format angka 08xx. Contoh: 081234567890</small>
                        </div>
                        <div class="form-group">
                            <label for="whatsappv2">WhatsApp V2</label>
                            <input type="number" autocomplete="off" name="whatsappv2" id="whatsappv2" class="form-control" required value="<?= $general['whatsappv2']; ?>">
                            <small class="text-muted">Format angka 628xx. Contoh: 6281234567890</small>
                        </div>
                        <div class="form-group">
                            <label for="email_contact">Email Kontak</label>
                            <input type="text" autocomplete="off" name="email_contact" id="email_contact" class="form-control" required value="<?= $general['email_contact']; ?>">
                            <small class="text-muted">Muncul pada footer. Setiap orderan masuk akan dikirim ke email tersebut</small>
                        </div>
                        <div class="form-group">
                            <label for="client_api_midtrans">Client Key Midtrans</label>
                            <input type="text" autocomplete="off" name="client_api_midtrans" id="client_api_midtrans" class="form-control" required value="<?= $general['client_api_midtrans']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="server_api_midtrans">Server Key Midtrans</label>
                            <input type="text" autocomplete="off" name="server_api_midtrans" id="server_api_midtrans" class="form-control" required value="<?= $general['server_api_midtrans']; ?>">
                        </div>
                        <button type="submit" class="btn btn-sm btn-success">Update</button>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
