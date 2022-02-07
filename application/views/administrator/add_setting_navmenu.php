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
                    <h2 class="lead text-dark mb-0">Tambah Menu</h2>
                </div>
                <div class="card-body">
                    <form action="<?= base_url(); ?>administrator/setting/navmenu/add" method="post">
                        <div class="form-group">
                            <label for="title">Judul Menu</label>
                            <input type="text" class="form-control" id="title" name="title" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="submenu">Submenu Dari</label>
                            <select name="submenu" id="submenu" class="form-control">
                            <option value="0">Tidak ada</option>
                            <?php foreach($menu->result_array() as $m): ?>
                                <option value="<?= $m['id']; ?>"><?= $m['title']; ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" id="link" name="link" autocomplete="off">
                            <small class="text-muted">Contoh: product - kosongi jika beranda - gunakan domain (https://domain.com) jika menuju ke eksternal website</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
