<div class="wrapper">
    <div class="title-head" style="background: linear-gradient(to right, <?= $this->Settings_model->general()["navbar_color"]; ?>, #ffffff)  !important">
        <?php if($titleHead == ""){ ?>
            <h2 class="title">Semua Produk</h2>
        <?php }else{ ?>
            <h2 class="title">Semua Produk > <?= $titleHead ?></h2>
        <?php } ?>
    </div>
    <div class="dropdown filter-for-mobile">
        <a class="btn btn-secondary btn-sm mt-2 dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Filter
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        
        <a href="<?= base_url(); ?>products?ob=latest" class="dropdown-item">Terbaru</a>
        <a href="<?= base_url(); ?>products?ob=az" class="dropdown-item">A-Z</a>
        <a href="<?= base_url(); ?>products?ob=za" class="dropdown-item">Z-A</a>
        <a href="<?= base_url(); ?>products?ob=pmin" class="dropdown-item">Harga Terendah</a>
        <a href="<?= base_url(); ?>products?ob=pmax" class="dropdown-item">Harga Tertinggi</a>
        <a href="<?= base_url(); ?>products?promo=true" class="dropdown-item">Promo</a>
        <a href="<?= base_url(); ?>products?condition=1" class="dropdown-item">Baru</a>
        <a href="<?= base_url(); ?>products?condition=2" class="dropdown-item">Bekas</a>
        <a href="<?= base_url(); ?>products" class="btn dropdown-item btn-danger text-danger">Reset Filter</a>
        </div>
    </div>
    <div class="core">
        <div class="filter">
            <div class="filter-main">
                <div class="top" style="background-color: <?= $this->Settings_model->general()["navbar_color"]; ?> !important">
                    <p>Filter</p>
                </div>
                <div class="bodf">
                    <p class="title">
                        Urutkan
                    </p>
                    <a href="<?= base_url(); ?>products?ob=latest">Terbaru</a>
                    <a href="<?= base_url(); ?>products?ob=az">A-Z</a>
                    <a href="<?= base_url(); ?>products?ob=za">Z-A</a>
                    <a href="<?= base_url(); ?>products?ob=pmin">Harga Terendah</a>
                    <a href="<?= base_url(); ?>products?ob=pmax">Harga Tertinggi</a>
                    <hr>
                    <p class="title">
                        Harga
                    </p>
                    <small class="text-muted">Tulis tanpa tanda pemisah, cth: 34000</small>
                    <form action="<?= base_url(); ?>products" method="get">
                        <input type="number" placeholder="Harga Minimum" name="minprice" class="form-control">
                        <input type="number" placeholder="Harga Maksimum" name="maxprice" class="form-control mt-2">
                        <button type="submit" class="btn btn-secondary btn-block btn-sm mt-2">Terapkan</button>
                    </form>
                    <hr>
                    <p class="title">
                        Penawaran
                    </p>
                    <a href="<?= base_url(); ?>products?promo=true">Promo</a>
                    <hr>
                    <p class="title">
                        Kondisi
                    </p>
                    <a href="<?= base_url(); ?>products?condition=1">Baru</a>
                    <a href="<?= base_url(); ?>products?condition=2">Bekas</a>
                    <hr>
                    <a href="<?= base_url(); ?>products" class="btn btn-danger text-light btn-sm">Reset Filter</a>
                </div>
            </div>
        </div>
        <?php $setting = $this->db->get('settings')->row_array(); ?>
        <div class="main-product">
            <?php if($products->num_rows() > 0){ ?>
            <?php foreach($products->result_array() as $p): ?>
                <a href="<?= base_url(); ?>p/<?= $p['slug']; ?>">
                <div class="card">
                    <img src="<?= base_url(); ?>assets/images/product/<?= $p['img']; ?>" class="card-img-top" >
                    <div class="card-body">
                    <p class="card-text mb-0"><?= $p['title']; ?></p>
                    <?php if($setting['promo'] == 1){ ?>
                    <?php if($p['promo_price'] == 0){ ?>
                        <p class="newPrice">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                    <?php }else{ ?>
                        <p class="oldPrice mb-0">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                        <p class="newPrice">Rp <?= str_replace(",",".",number_format($p['promo_price'])); ?></p>
                    <?php } ?>
                    <?php }else{ ?>
                        <p class="newPrice">Rp <?= str_replace(",",".",number_format($p['price'])); ?></p>
                    <?php } ?>
                    </div>
                </div>
                </a>
            <?php endforeach; ?>
            <div class="clearfix"></div>
            <?php }else{ ?>
                <div class="alert alert-warning">Upss. Tidak ada produk yang dapat ditampilkan</div>
            <?php } ?>
        </div>
    </div>
</div>