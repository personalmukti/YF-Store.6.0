<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-7">
            <h3 class="title">Terima Kasih Telah Berbelanja di <?= $this->Settings_model->general()["app_name"]; ?></h3>
            <hr>
            <?php if($metod == 'cod'){ ?>
                <p>Anda menggunakan metode COD/Cash of Delivery, silakan hubungi kami melalui Whatsapp dengan mengklik tombol dibawah ini</p>
                <a href="https://wa.me/<?= $this->Settings_model->general()["whatsappv2"]; ?>?text=Halo kak, saya membeli produk di <?= $this->Settings_model->general()["app_name"]; ?> menggunakan metode COD/Cash of Delivery dengan Order ID <?= $invoice_id['invoice']; ?>" class="btn btn-sm btn-success" target="_blank"> Hubungi Whatsapp</a>
            <?php }else{ ?>
            <h4>Kode Pesanan Anda adalah <?= $invoice_id['invoice']; ?></h4>
            <p>Kami telah mengirimkan email kepada Anda yang berisi tagihan pesanan. Cek folder Inbox atau Spam untuk melihat email yang kami kirim.</p>
            <hr>
            <strong>Mohon untuk melakukan pembayaran sebesar <h5 class="text-primary">Rp <?= number_format($invoice_id['total'],0,",","."); ?></h5> ke rekening dibawah ini (pilih salah satu): </strong>
            <?php foreach($rekening->result_array() as $r): ?>
                <p><strong><?= $r['rekening']; ?></strong><br/>
                Atas Nama : <?= $r['name']; ?><br/>
                No Rekening : <?= $r['number']; ?></p>
            <?php endforeach; ?>
            <p>Jika sudah melakukan pembayaran, silakan melakukan konfirmasi pembayaran <a href="<?=base_url();?>payment/confirmation" class="btn btn-info btn-sm">dengan klik disini</a> atau bisa melalui Whatsapp <?= $this->Settings_model->general()["whatsapp"] ?> atau <a href="https://wa.me/<?= $this->Settings_model->general()["whatsappv2"] ?>" target="_blank">klik disini</a> dengan format sebagai berikut:</p> 
            <table>
                <tr>
                    <td>1. Kode Pesanan : <strong><?= $invoice_id['invoice']; ?></strong></td>
                </tr>
                <tr>
                    <td>2. Transfer Dari Bank : </td>
                </tr>
                <tr>
                    <td>3. Transfer Ke Bank : </td>
                </tr>
                <tr>
                    <td>*Sertakan juga bukti transfer</td>
                </tr>
            </table></p>
            <?php } ?>
        </div>
    </div>

</div>