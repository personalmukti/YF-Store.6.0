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
                    <h2 class="lead text-dark mb-0">Biaya Antar</h2>
                </div>
                <div class="card-body">
                   <a href="<?= base_url(); ?>administrator/setting/delivery/add" class="btn btn-sm btn-info">Tambah</a>
                   <hr>
                   <?php if($delivery->num_rows() > 0){ ?>
                   <table class="table table-bordered">
                        <tr>
                            <th>#</th>
                            <th>Tujuan</th>
                            <th>Biaya</th>
                            <th>Aksi</th>
                        </tr>
                        <?php $no=1; foreach($delivery->result_array() as $d): ?>
                        <?php
                            $curl = curl_init();
                            curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=".$d['destination'],
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 30,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_HTTPHEADER => array(
                                "key: ". $this->Settings_model->general()["api_rajaongkir"]
                            ),
                            ));
                    
                            $response = curl_exec($curl);
                            $err = curl_error($curl);
                    
                            curl_close($curl);
                    
                            if ($err) {
                                echo "cURL Error #:" . $err;
                            } else {
                                $response =  json_decode($response, true);
                                $dest = $response['rajaongkir']['results'];
                            }
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $dest['type'] . ' ' . $dest['city_name']; ?></td>
                                <td>Rp<?= number_format($d['price'],0,",","."); ?></td>
                                <td style="width: 100px">
                                    <a href="<?= base_url() ;?>administrator/setting/delivery/<?= $d['id']; ?>" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a>
                                    <a href="<?= base_url() ;?>administrator/delete_delivery/<?= $d['id']; ?>" onclick="return confirm('Yakin ingin menghapus biaya antar ini?')" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php $no++; endforeach; ?>
                   </table>
                    <?php }else{ ?>
                        <div class="alert alert-warning">Belum ada kota tujuan yang diantar.</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
