<?php echo $this->session->flashdata('upload'); ?>
<?php
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=".$delivery['destination'],
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
<!-- Begin Page Content -->
<div class="container-fluid">
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
                    <h2 class="lead text-dark mb-0">Edit Biaya Antar</h2>
                </div>
                <div class="card-body">
                    <form action="<?= base_url(); ?>administrator/setting/delivery/<?= $delivery['id']; ?>" method="post">
                        <div class="form-group">
                            <label for="settingSelectRegency">Kabupaten atau Kota Tujuan</label>
                            <select name="destination" id="settingSelectRegency" class="form-control" required>
                            <option value="<?= $dest['city_id']; ?>"><?= $dest['type']; ?> <?= $dest['city_name']; ?></option>
                                <?php foreach($regency as $r): ?>
                                    <option value="<?= $r['city_id']; ?>"><?= $r['type']; ?> <?= $r['city_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="price">Biaya</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="price"
                                    name="price"
                                    autocomplete="off"
                                    required
                                    value=<?= $delivery['price']; ?>
                                />
                                <small id="priceHelp" class="form-text text-muted"
                                    >Isikan tanpa tanda pemisah. Contoh pengisian 30000</small
                                >
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
