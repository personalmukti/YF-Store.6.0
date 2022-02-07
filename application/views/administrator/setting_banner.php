<?php echo $this->session->flashdata('upload'); ?>

<!-- Begin Page Content -->
<div class="container-fluid mb-5">
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
                    <h2 class="lead text-dark mb-0">Banner Slider</h2>
                </div>
                <div class="card-body">
                   <a href="<?= base_url(); ?>administrator/setting/banner/add" class="btn btn-sm btn-info">Tambah Banner</a>
                   <hr>
                   <?php if($banner->num_rows() > 0){ ?>
                   <table class="table table-bordered">
                        <tr>
                            <th>Gambar</th>
                            <th>URL</th>
                            <th>Aksi</th>
                        </tr>
                        <?php foreach($banner->result_array() as $d): ?>
                            <tr>
                                <td><img style="width: 80%" src="<?= base_url(); ?>assets/images/banner/<?= $d['img']; ?>" alt=""></td>
                                <td><?= $d['url']; ?></td>
                                <td>
                                    <a href="<?= base_url() ;?>administrator/delete_banner/<?= $d['id']; ?>" onclick="return confirm('Yakin ingin menghapus banner ini?')" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                   </table>
                    <?php }else{ ?>
                        <div class="alert alert-warning">Belum ada banner</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
