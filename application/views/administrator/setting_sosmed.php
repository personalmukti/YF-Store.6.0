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
                    <h2 class="lead text-dark mb-0">Sosial Media</h2>
                </div>
                <div class="card-body">
                   <a href="<?= base_url(); ?>administrator/setting/sosmed/add" class="btn btn-sm btn-info">Tambah Sosmed</a>
                   <hr>
                   <?php if($sosmed->num_rows() > 0){ ?>
                   <table class="table table-bordered">
                        <tr>
                            <th>Jenis Sosmed</th>
                            <th>Icon</th>
                            <th>Link atau URL</th>
                            <th>Aksi</th>
                        </tr>
                        <?php foreach($sosmed->result_array() as $d): ?>
                            <tr>
                                <td><?= $d['name']; ?></td>
                                <td class="text-center"> <i class="fab fa-<?= $d['icon']; ?>"></i> </td>
                                <td><?= $d['link']; ?></td>
                                <td style="width: 100px">
                                    <a href="<?= base_url() ;?>administrator/setting/sosmed/<?= $d['id']; ?>" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a>
                                    <a href="<?= base_url() ;?>administrator/delete_sosmed/<?= $d['id']; ?>" onclick="return confirm('Yakin ingin menghapus sosmed ini?')" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                   </table>
                    <?php }else{ ?>
                        <div class="alert alert-warning">Belum ada akun sosmed.</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
