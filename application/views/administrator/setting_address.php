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
                    <h2 class="lead text-dark mb-0">Alamat</h2>
                </div>
                <div class="card-body">
                    <form action="<?= base_url(); ?>administrator/setting/address" method="post">
                        <div class="form-group">
													<label for="address">Masukan alamat seperti nama jalan, kota, dsb.</label>
														<textarea name="address" value="<?= $address['address']; ?>" required class="form-control" id="address"><?= $address['address']; ?></textarea>
                        </div>
												<div class="form-group">
		                        <label for="settingSelectRegency">Kabupaten atau Kota</label>
		                        <select name="settingSelectRegency" id="settingSelectRegency" class="form-control" required>
		                            <option value="<?= $selectRegency['city_id']; ?>"><?= $selectRegency['type']; ?> <?= $selectRegency['city_name']; ?></option>
		                            <?php foreach($regency as $r): ?>
		                                <option value="<?= $r['city_id']; ?>"><?= $r['type']; ?> <?= $r['city_name']; ?></option>
		                            <?php endforeach; ?>
		                        </select>
		                    </div>
                        <button class="btn btn-info">Ubah Alamat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
