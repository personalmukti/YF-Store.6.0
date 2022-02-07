<?php echo $this->session->flashdata('upload'); ?>
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h4 mb-2 text-gray-800 mb-4"><?= $product['title']; ?></h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <p class="lead mb-0 pb-0">Harga Satuan: Rp<?= number_format($product['price'],0,",","."); ?></p>
                    <hr>
                    <p class="lead mb-0 pb-0">Harga Grosir</p>
                </div>
                <div class="card-body">
                <?php if($grosir->num_rows() > 0){ ?>
                   <div class="table-responsive">
                        <table
                            class="table table-bordered"
                            id="dataTable"
                            width="100%"
                            cellspacing="0">
                            <tr>
                                <th>#</th>
                                <th>Jumlah min.</th>
                                <th>Harga Grosir</th>
                                <th>Aksi</th>
                            </tr>
                            <?php $no = 1; foreach($grosir->result_array() as $g): ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $g['min'] ?></td>
                                <td><?= number_format($g['price'],0,",",".") ?></td>
                                <td style="width:50px;"><a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php $no++; endforeach; ?>
                        </table>
                    </div>
                <?php }else{ ?>
                    <div class="alert alert-warning">Belum ada harga grosir</div>
                <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <p class="lead mb-0 pb-0">Tambah Harga Grosir</p>
                </div>
                <div class="card-body">
                    <?php echo $this->session->flashdata('failed'); ?>
                    <form action="<?= base_url(); ?>administrator/product/grosir/<?= $product['productId']; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <?php if($grosir->num_rows() < 1){ ?>
                            <label for="min">Jumlah min. (minimal 2)</label>
                        <?php }else{ ?>
                            <label for="min">Jumlah min. (minimal <?= $grosir->row_array()['min'] + 1 ?>)</label>
                        <?php } ?>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">≥</span>
                            </div>
                            <input type="number" name="min" required id="min" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga Grosir</label>
                        <input type="number" name="price" id="price" class="form-control" required>
                        <small id="priceHelp" class="form-text text-muted">Isikan tanpa tanda pemisah. Contoh pengisian 300000</small>
                    </div>
                    <button class="btn btn-sm btn-info" type="submit">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>