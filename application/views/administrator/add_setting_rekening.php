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
                    <h2 class="lead text-dark mb-0">Tambah Rekening</h2>
                </div>
                <div class="card-body">
                    <form action="<?= base_url(); ?>administrator/setting/rekening/add" method="post">
                        <div class="form-group">
                            <label for="rekening">Nama Bank</label>
                            <input type="text" class="form-control" id="rekening" name="rekening" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="name">Atas Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="number">Nomor Rekening</label>
                            <input type="text" class="form-control" id="number" name="number" required autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
