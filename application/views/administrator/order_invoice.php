<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Pesanan <?= $invoice['name']; ?> - <?= $invoice['invoice_code'] ?></title>

    <!-- Custom fonts for this template-->
    <link
      href="<?= base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />

    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/logo/favicon.png" type="image/x-icon">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet" />

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/select2-4.0.6-rc.1/dist/css/select2.min.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>

    <link rel="stylesheet" media="screen" type="text/css" href="<?= base_url(); ?>assets/css/colorpicker.css" />

    <style>

      /* Chrome, Safari, Edge, Opera */
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }

      /* Firefox */
      input[type=number] {
        -moz-appearance: textfield;
      }

      .ck-editor__editable_inline {
          min-height: 300px;
      }

      .description-product-detail {
        color: #666;
      }

      .description-product-detail h2 {
        font-size: 22px;
      }

      .description-product-detail h3 {
        font-size: 19px;
      }

      .description-product-detail h4 {
        font-size: 17px;
      }

      .description-product-detail p {
        font-size: 14.5px;
      }

      .description-product-detail img {
        width: 50%;
      }

    </style>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </head>

  <body id="page-top">

<?php echo $this->session->flashdata('upload'); ?>
<?php
$id = $invoice['province'];
$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=$id",
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
    $province = $response['rajaongkir']['results']['province'];
}

$id = $invoice['regency'];
$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=$id",
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
    $regency = $response['rajaongkir']['results']['type'] . ' ' . $response['rajaongkir']['results']['city_name'];
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <h1>
    <?= $this->Settings_model->general()["app_name"]; ?>
    </h1>
    <h4>Order ID <?= $invoice['invoice_code']; ?></h4>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
            <h3 class="lead">Data Alamat</h3>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td>Label Alamat</td>
                            <td><?= $invoice['label']; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Penerima</td>
                            <td><?= $invoice['name']; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?= $invoice['email']; ?></td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td><?= $invoice['telp']; ?></td>
                        </tr>
                        <tr>
                            <td>Provinsi</td>
                            <td><?= $province; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td>Kabupaten/Kota</td>
                            <td><?= $regency; ?></td>
                        </tr>
                        <tr>
                            <td>Kecamatan</td>
                            <td><?= $invoice['district']; ?></td>
                        </tr>
                        <tr>
                            <td>Desa/Kelurahan</td>
                            <td><?= $invoice['village']; ?></td>
                        </tr>
                        <tr>
                            <td>Kode Post</td>
                            <td><?= $invoice['zipcode']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td style="width: 65%"><?= $invoice['address']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr><hr>
            <h3 class="lead">Metode Pengiriman</h3>
            <hr>
            <div class="row">
                <div class="col-md-10">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td>Ekspedisi</td>
                            <?php if($invoice['courier'] == "jne"){ ?>
                                <td>Jalur Nugraha Ekakurir (JNE)</td>
                            <?php }else if($invoice['courier'] == "pos"){ ?>
                                <td>POS Indonesia (POS)</td>
                            <?php }else if($invoice['courier'] == "tiki"){ ?>
                                <td>Citra Van Titipan Kilat (TIKI)</td>
                            <?php }else if($invoice['courier'] == "antar"){ ?>
                                <td>Diantar oleh penjual</td>
                            <?php }else{ ?>
                                <td>Jasa kurir tidak dikenal, silakan hubungi pembeli.</td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Layanan</td>
                             <?php if($invoice['courier'] == "antar"){ ?>
                                <td>-</td>
                            <?php }else{ ?>
                                <td><?= $invoice['courier_service']; ?></td>
                            <?php } ?>
                        </tr>
                    </table>
                </div>
            </div>
		</div>
	</div>
    <div class="card shadow mb-5">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Ket</th>
                    <th>Harga</th>
                    <th>Total</th>
                <?php $no=1; foreach($orders->result_array() as $data): ?>
                </tr>
                    <td><?= $no; ?></td>
                    <td><?= $data['product_name']; ?></td>
                    <td class="text-center"><?= $data['qty']; ?></td>
                    <?php if($data['ket'] == ""){ ?>
                        <td>-</td>
                    <?php }else{ ?>
                        <td><?= $data['ket']; ?></td>
                    <?php } ?>
                    <td>Rp <?= number_format($data['price'],0,",","."); ?></td>
                    <?php $total = $data['price'] * $data['qty']; ?>
                    <td>Rp <?= number_format($total,0,",","."); ?></td>
                <tr>
                <?php $no++; endforeach; ?>
                </tr>
            </table>
            <div class="col-md-6">
                <table class="table table-borderless table-sm">
                    <tr>
                        <th>Total Harga</th>
                        <th>Rp <?= number_format($invoice['total_price'],0,",","."); ?></th>
                    </tr>
                    <tr>
                    <?php if($invoice['courier'] == "antar"){ ?>
                        <th>Biaya Ongkir (Diantar oleh penjual)</th>
                    <?php }else{ ?>
                        <th>Biaya Ongkir (<?= strtoupper($invoice['courier']); ?> <?= $invoice['courier_service']; ?>)</th>
                    <?php } ?>
                        <th>Rp <?= number_format($invoice['ongkir'],0,",","."); ?></th>
                    </tr>
                    <tr>
                        <th>Total Keseluruhan</th>
                        <th>Rp <?= number_format($invoice['total_all'],0,",","."); ?></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->


<script>
  window.print();
</script>

</body>

</html>
