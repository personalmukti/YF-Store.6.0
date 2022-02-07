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
                    <h2 class="lead text-dark mb-0">Tambah COD</h2>
                </div>
                <div class="card-body">
                    <form action="<?= base_url(); ?>administrator/setting/cod/add" method="post">
                    <div class="form-group">
                        <label for="settingSelectRegency">Kabupaten atau Kota</label>
                        <select name="destination" id="settingSelectRegency" class="form-control" required>
                            <option></option>
                            <?php foreach($regency as $r): ?>
                                <option value="<?= $r['city_id']; ?>"><?= $r['type']; ?> <?= $r['city_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
