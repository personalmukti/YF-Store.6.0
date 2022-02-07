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
                    <h2 class="lead text-dark mb-0">Deskripsi Singkat</h2>
                </div>
                <div class="card-body">
                    <p class="text-muted">Deskripsi singkat ini ditampilkan pada footer</p>
                    <form action="<?= base_url(); ?>administrator/edit_description_setting" method="post">
                        <div class="form-group">
                            <textarea name="desc" id="desc" class="form-control" rows="5"><?= $desc['short_desc']; ?></textarea>
                        </div>
                        <button class="btn btn-sm btn-info">Edit Deskripsi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
