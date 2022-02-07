<form action="<?= base_url(); ?>payment/succesfully" method="post">
<div class="wrapper">
    <div class="core">
        <?php if($cart->num_rows() > 0){ ?>
        <div class="products">
            <table class="table">
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Ket</th>
                    <th>Harga</th>
                </tr>
                <?php foreach($cart->result_array() as $item): ?>
                <tr>
                    <td># <?= $item['product_name']; ?></td>
                    <td class="text-center"><?= $item['qty']; ?></td>
                    <?php if($item['ket'] == ""){ ?>
                        <td>-</td>
                    <?php }else{ ?>
                        <td><?= $item['ket']; ?></td>
                    <?php } ?>
                    <td>Rp<?= number_format($item['price'] * $item['qty'],0,",","."); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="line"></div>
        <div class="address">
            <h2 class="title">Alamat Pengiriman</h2>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="label">Alamat Sebagai</label>
                        <input type="text" id="label" autocomplete="off" class="form-control" placeholder="Contoh: Rumah, Kantor, Kos, dll" required name="label">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name">Nama Penerima</label>
                        <input type="text" id="name" autocomplete="off" class="form-control" required name="name">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="telp">Nomor Telepon</label>
                        <input type="number" id="telp" autocomplete="off" class="form-control" required name="telp">
                        <small class="text-muted">Contoh: 081234567890</small>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="zipcode">Kode Pos</label>
                        <input type="number" id="zipcode" autocomplete="off" class="form-control" required name="zipcode">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="paymentSelectProvinces">Provinsi</label>
                        <select name="paymentSelectProvinces" id="paymentSelectProvinces" class="form-control" required>
                            <option></option>
                            <?php foreach($provinces as $p): ?>
                                <option value="<?= $p['province_id']; ?>"><?= $p['province']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="paymentSelectRegencies">Kabupaten/Kota</label>
                        <select name="paymentSelectRegencies" id="paymentSelectRegencies" class="form-control" required>
                            <option></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="district">Kecamatan</label>
                        <input type="text" class="form-control" autocomplete="off" id="district" name="district" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="village">Desa/Kelurahan</label>
                        <input type="text" class="form-control" autocomplete="off" id="village" name="village" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="address">Alamat</label>
                    <textarea name="address" id="address" class="form-control" placeholder="Isi dengan nama jalan, nomor rumah, nama gedung, dsb" required></textarea>
                </div>
            </div>
        </div>
        <div class="line mt-4"></div>
        <div class="send">
            <h2 class="title">Metode Pengiriman</h2>
            <small class="text-danger" id="paymentTextNotSupportDelivery" style="display: none;">Metode antar belum tersedia untuk tempat Anda.</small>
            <div class="form-group mt-3" id="groupPaymentSelectKurir">
                <select name="paymentSelectKurir" id="paymentSelectKurir" class="form-control" required>
                    <option></option>
                </select>
            </div>
        </div>
        <?php }else{ ?>
            <div class="alert alert-warning">Upss. Kamu belum memiliki satupun belanjaan. Yuk belanja dulu.</div>
        <?php } ?>
    </div>
    <?php
        $totalall = 0;
        $totalitem = 0;
        foreach($cart->result_array() as $c){
            $totalall += intval($c['price']) * intval($c['qty']);
            $totalitem += intval($c['qty']);
        }
    ?>
    <input type="hidden" id="paymentPriceTotalAll" value="<?= $totalall; ?>">
    <div class="total shadow">
        <h2 class="title">Ringkasan Belanja</h2>
        <hr>
        <div class="list">
            <p>Total Belanja</p>
            <p>Rp<?= number_format($totalall,0,",","."); ?></p>
        </div>
        <div class="list">
            <p>Biaya Pengiriman</p>
            <p id="paymentSendingPrice">Rp0</p>
        </div>
        <hr>
        <div class="list">
            <p>Total Tagihan</p>
            <p id="paymentTotalAll">Rp<?= number_format($totalall,0,",","."); ?></p>
        </div>
        <?php if($cart->num_rows() > 0){ ?>
            <button class="btn btn-dark btn btn-block mt-2" id="btnPaymentNow" type="submit">Bayar Sekarang</button>
        <?php }else{ ?>
            <div class="alert mt-2 alert-warning">Keranjangmu masih kosong.</div>
            <a href="<?= base_url(); ?>">
                <button class="btn btn-dark btn btn-block mt-2">Belanja Dulu</button>
            </a>
        <?php } ?>
    </div>
</div>
</form>