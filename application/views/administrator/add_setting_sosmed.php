<?php echo $this->session->flashdata('upload'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800 mb-4">Pengaturan</h1>

	<div class="row">
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                <?php include('menu-setting.php'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="lead text-dark mb-0">Tambah Sosmed</h2>
                </div>
                <div class="card-body">
                    <form action="<?= base_url(); ?>administrator/setting/sosmed/add" method="post">
                        <div class="form-group">
                            <label for="name">Jenis Sosmed</label>
                            <input type="text" class="form-control" id="name" name="name" required autocomplete="off">
														<small class="text-muted">Contoh: Facebook, Twitter</small>
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon Sosmed</label>
                            <input type="text" class="form-control" id="icon" name="icon" required autocomplete="off">
														<small class="text-muted">Buka link ini <a href="https://fontawesome.com/icons" target="_blank">fontawesome</a> lalu cari nama sosmed. Misal icon untuk Facebook adalah facebook-f</small>
                        </div>
                        <div class="form-group">
                            <label for="link">Link atau URL</label>
                            <input type="text" class="form-control" id="link" name="link" required autocomplete="off" value="https://">
														<small class="text-muted">Misal: https://facebook.com/namapengguna</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
