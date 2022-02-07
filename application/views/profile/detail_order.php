<head>
<script type="text/javascript"
    <?php if($this->config->item('midtrans_production')){ ?>
      src="https://app.midtrans.com/snap/snap.js"
    <?php }else{ ?>
      src="https://app.sandbox.midtrans.com/snap/snap.js"
    <?php } ?>
            data-client-key="<?= $this->Settings_model->general()["client_api_midtrans"]; ?>"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<?php
$id = $ord['province'];
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

$id = $ord['regency'];
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
    $regency = $response['rajaongkir']['results']['city_name'];
}

?>
<?php echo $this->session->flashdata('success'); ?>
<form id="payment-form" method="post" action="<?=base_url()?>snap/finish?invoice=<?= $ord['invoice_code']; ?>">
    <input type="hidden" name="result_type" id="result-type" value=""></div>
    <input type="hidden" name="result_data" id="result-data" value=""></div>
</form>
<div class="wrapper">
    <?php include 'menu.php'; ?>
    <div class="core">
        <?php if($ord['courier'] == "cod"){ ?>
            <?php if($ord['status'] != "4"){ ?>
            <h2 class="title">COD (Cash of Delivery)</h2>
            <p>Pesanan ini menggunakan metode COD (Cash of Delivery). Silakan menghubungi penjual melalui WhatsApp dengan cara <a href="https://wa.me/<?= $this->Settings_model->general()["whatsappv2"]; ?>?text=Halo kak, saya membeli produk di <?= $this->Settings_model->general()["app_name"]; ?> menggunakan metode COD/Cash of Delivery dengan Order ID <?= $ord['invoice_code']; ?>" target="_blank" class="btn btn-success btn-sm">klik disini</a></h2>
            <hr>
            <hr>
            <?php } ?>
        <?php } ?>
        <?php if($ord['status'] == 3){ ?>
            <div class="alert alert-info">Jika pesanan telah sampai tujuan, silakan tekan tombol dibawah</div>
            <a href="<?= base_url(); ?>profile/finish_transaction?invoice=<?= $ord['invoice_code'] ?>&resi=<?= $ord['resi'] ?>" class="btn btn-sm btn-secondary" onclick="return confirm('Yakin sudah sampai?');">Sudah Sampai & Selesai</a>
            <hr>
            <?php if($ord['resi'] != '0'){ ?>
                <h3 class=" lead text-info">RESI: <?= $ord['resi']; ?></h3>
            <?php } ?>
            <hr>
        <?php }else if($ord['pay_status'] == ""){ ?>
            <div class="alert alert-info">Kamu belum memilih metode pembayaran. Silakan klik tombol dibawah untuk memilih metode pembayaran yang diinginkan.</div>
            <button id="pay-button" class="btn btn-sm btn-secondary">Pilih Metode Pembayaran</button>
            <hr>
        <?php }else if($ord['pay_status'] == "pending"){ ?>
            <div class="alert alert-info">Kamu belum melakukan pembayaran. Klik tombol dibawah untuk melihat panduan pembayaran. (batas maksimal pembayaran 1x24jam)</div>
            <a href="<?= $ord['link_pay']; ?>" target="_blank" class="btn btn-sm btn-secondary">Panduan Pembayaran</a>
            <hr>
        <?php } ?>
        <h2 class="title">Detail Pesanan</h2>
        <hr>
        <table class="table table-sm table-borderless">
            <tr>
                <td>Order ID</td>
                <td><?= $ord['invoice_code']; ?></td>
            </tr>
            <tr>
                <td>Tanggal Pesan</td>
                <td><?= $ord['date_input']; ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <?php if($ord['courier'] == "cod"){ ?>
                    <td>Cash of Delivery</td>
                <?php }else{ ?>
                <?php if($ord['pay_status'] == 'pending' || $ord['pay_status'] == ''){ ?>
                    <td>Belum dibayar</td>
                <?php }else if($ord['pay_status'] == 'settlement' && $ord['status'] == 0){ ?>
                    <td>Menunggu konfirmasi</td>
                <?php }else if($ord['status'] == 2){ ?>
                    <td>Sedang diproses</td>
                <?php }else if($ord['status'] == 3){ ?>
                    <td>Sedang dikirim</td>
                <?php }else{ ?>
                    <td>Selesai</td>
                <?php } ?>
                <?php } ?>
            </tr>
            <tr>
                <td>Total Pembayaran</td>
                <th class="text-primary">Rp<?= number_format($ord['total_all'],0,",","."); ?></th>
            </tr>
        </table>
        <hr>
        <hr>
        <h2 class="title">Alamat Pengiriman</h2>
        <hr>
        <table class="table table-sm table-borderless">
            <tr>
                <td>Nama Penerima</td>
                <td><?= $ord['name']; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><?= $ord['address']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td><?= $ord['village']; ?> - <?= $ord['district']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td><?= $regency; ?> <?= $province; ?> - <?= $ord['zipcode']; ?></td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td><?= $ord['telp']; ?></td>
            </tr>
        </table>
        <hr>
        <hr>
        <div class="row">
            <div class="col-md-7">
                <h2 class="title mb-3">Produk Pesanan</h2>
                <?php foreach($product_order->result_array() as $p): ?>
                    <div class="item-product">
                        <img src="<?= base_url(); ?>assets/images/product/<?= $p['img']; ?>" alt="produk <?= $p['product_name']; ?>">
                        <a href="<?= base_url(); ?>p/<?= $p['slug']; ?>"><h3 class="product_name mb-0"><?= $p['product_name']; ?></h3></a>
                        <p class="mb-0">Jumlah: <?= $p['qty']; ?></p>
                        <p class="mb-0 price">Rp<?= number_format($p['price'] * $p['qty'],0,",","."); ?></p>
                        <div class="clearfix"></div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-md-5">
                <h2 class="title">Ringkasan Pembayaran</h2>
                <table class="table table-sm table-borderless">
                    <tr>
                        <td>Jumlah Produk</td>
                        <td>: <?= $product_order->num_rows(); ?></td>
                    </tr>
                    <tr>
                        <td>Harga Produk</td>
                        <td>: Rp<?= number_format($ord['total_price'],0,",","."); ?></td>
                    </tr>
                    <tr>
                        <td>Ongkis Kirim</td>
                        <td>: Rp<?= number_format($ord['ongkir'],0,",","."); ?></td>
                    </tr>
                    <tr>
                        <td>Total Belanja</td>
                        <td>: Rp<?= number_format($ord['total_all'],0,",","."); ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <hr>
        <?php if($ord['courier'] != "cod"){ ?>
        <hr>
        <?php
        if($ord['pay_status'] == 'settlement' && $ord['status'] == 0){
            $pay_stat = 100;
            $sedpros = 0;
            $dalpen = 0;
            $satuj = 0;
        }else if($ord['status'] == 2){
            $pay_stat = 100;
            $sedpros = 100;
            $dalpen = 0;
            $satuj = 0;
        }else if($ord['status'] == 3){
            $pay_stat = 100;
            $sedpros = 100;
            $dalpen = 100;
            $satuj = 0;
        }else if($ord['status'] == 4){
            $pay_stat = 100;
            $sedpros = 100;
            $dalpen = 100;
            $satuj = 100;
        }
        ?>
        <h2 class="title mb-3">Status Pesanan</h2>
        <div class="row">
            <div class="col-md-3">
                <p class="text-muted mb-1">Sudah dibayar</p>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="<?= $pay_stat; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $pay_stat; ?>%"></div>
                </div>
            </div>
            <div class="col-md-3">
                <p class="text-muted mb-1">Sedang diproses</p>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="<?= $sedpros; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $sedpros; ?>%"></div>
                </div>
            </div>
            <div class="col-md-3">
                <p class="text-muted mb-1">Dalam pengiriman</p>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="<?= $dalpen; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $dalpen; ?>%"></div>
                </div>
            </div>
            <div class="col-md-3">
                <p class="text-muted mb-1">Sampai Tujuan</p>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="<?= $satuj; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $satuj; ?>%"></div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<script type="text/javascript">

    const type_order = "<?= $ord['pay_status'] ?>";
    if(type_order == ""){

  modalMidtrans();
  $("#pay-button").click(function(){
      modalMidtrans();
    })
    }

    function modalMidtrans(){
      $.ajax({
        url: '<?=base_url()?>snap/token?invoice=<?= $ord['invoice_code']; ?>',
        cache: false,

        success: function(data) {
          //location = data;

          console.log('token = '+data);
          
          var resultType = document.getElementById('result-type');
          var resultData = document.getElementById('result-data');

          function changeResult(type,data){
            $("#result-type").val(type);
            $("#result-data").val(JSON.stringify(data));
            //resultType.innerHTML = type;
            //resultData.innerHTML = JSON.stringify(data);
          }

          snap.pay(data, {
            
            onSuccess: function(result){
              changeResult('success', result);
              console.log(result.status_message);
              console.log(result);
              $("#payment-form").submit();
            },
            onPending: function(result){
              changeResult('pending', result);
              console.log(result.status_message);
              $("#payment-form").submit();
            },
            onError: function(result){
              changeResult('error', result);
              console.log(result.status_message);
              $("#payment-form").submit();
            }
          });
        }
      });
    }

  </script>