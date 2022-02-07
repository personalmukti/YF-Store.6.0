<?php echo $this->session->flashdata('upload'); ?>
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h4 mb-2 text-gray-800 mb-4"><?= $product['title']; ?></h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <p class="lead mb-0 pb-0">Gambar Pendukung</p>
                </div>
                <div class="card-body">
                    <?php if($img->num_rows() > 0){ ?>
                    <div class="row">
                        <?php foreach($img->result_array() as $d): ?>
                            <div class="col-md-6 mb-3">
                                <img src="<?= base_url(); ?>assets/images/product/<?= $d['img'] ?>" width="100%">
                                <a href="<?= base_url(); ?>administrator/delete_img_other_product/<?= $d['id']; ?>/<?= $product['productId'] ?>" class="btn btn-block btn-sm btn-danger mt-1" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php }else{ ?>
                        <div class="alert alert-warning">Belum ada gambar pendukung untuk produk <?= $product['title']; ?></div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <p class="lead mb-0 pb-0">Upload Gambar Pendukung</p>
                </div>
                <div class="card-body">
                    <?php echo $this->session->flashdata('failed'); ?>
                    <form action="<?= base_url(); ?>administrator/product/add-img/<?= $product['productId']; ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="file" name="img" id="img" class="form-control" required>
                        </div>
                        <input type="hidden" name="help" value="1">
                        <button class="btn btn-sm btn-info" type="submit">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>