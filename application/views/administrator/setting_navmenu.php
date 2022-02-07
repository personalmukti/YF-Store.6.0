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
                    <h2 class="lead text-dark mb-0">Navigasi Menu</h2>
                </div>
                <div class="card-body">
                   <a href="<?= base_url(); ?>administrator/setting/navmenu/add" class="btn btn-sm btn-info">Tambah Menu</a>
                   <hr>
                   <?php if($menu->num_rows() > 0){ ?>
                   <table class="table table-bordered">
                        <tr>
                            <th>Menu</th>
                            <th>Submenu</th>
                            <th>Aksi</th>
                        </tr>
                        <?php foreach($menu->result_array() as $d): ?>
                        <?php
                        if(substr($d['link'],0,4) == "http" || substr($d['link'],0,3) == "www"){
                            $newlink = $d['link'];
                        }else{
                            $newlink = base_url() . $d['link'];
                        }
                        ?>
                            <tr>
                                <?php if($this->Settings_model->getSubmenu($d['id'])->num_rows() > 0){ ?>
                                    <td><?= $d['title']; ?></td>
                                <?php }else{ ?>
                                    <td><a class="text-secondary" target="_blank" href="<?= $newlink; ?>"><?= $d['title']; ?></a></td>
                                <?php } ?>
                                <?php if($this->Settings_model->getSubmenu($d['id'])->num_rows() > 0){ ?>
                                <td>
                                    <?php foreach($this->Settings_model->getSubmenu($d['id'])->result_array() as $d): ?>
                                        <?php
                                        if(substr($d['link'],0,4) == "http" || substr($d['link'],0,3) == "www"){
                                            $newlink = $d['link'];
                                        }else{
                                            $newlink = base_url() . $d['link'];
                                        }
                                        ?>
                                    <a class="text-secondary" target="_blank" href="<?= $newlink; ?>"><?= $d['name']; ?></a> <a href="<?= base_url(); ?>administrator/delete_navsubmenu/<?= $d['id']; ?>" onclick="return confirm('Yakin ingin menghapus submenu ini?')" class="badge badge-danger ml-1 mr-1"><i class="fa fa-trash"></i></a><br>
                                    <?php endforeach; ?>
                                </td>
                                <?php }else{ ?>
                                    <td>-</td>
                                <?php } ?>
                                <td style="width: 100px">
                                    <a href="<?= base_url() ;?>administrator/setting/navmenu/<?= $d['id']; ?>" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a>
                                    <a href="<?= base_url() ;?>administrator/delete_navmenu/<?= $d['id']; ?>" onclick="return confirm('Yakin ingin menghapus menu ini?')" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                   </table>
                    <?php }else{ ?>
                        <div class="alert alert-warning">Belum ada rekening.</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
