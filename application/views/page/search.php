<div class="wrapper">
    <div class="title-head" style="background-color: <?= $this->Settings_model->general()["navbar_color"]; ?> !important">
            <h2 class="title">Hasil Pencarian: <?= $q ?> <?= $titleHead ?></h2>
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
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>&ob=latest">Terbaru</a>
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>&ob=az">A-Z</a>
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>&ob=za">Z-A</a>
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>&ob=pmin">Harga Terendah</a>
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>&ob=pmax">Harga Tertinggi</a>
                    <hr>
                    <p class="title">
                        Penawaran
                    </p>
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>&promo=true">Promo</a>
                    <hr>
                    <p class="title">
                        Kondisi
                    </p>
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>&condition=1">Baru</a>
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>&condition=2">Bekas</a>
                    <hr>
                    <a href="<?= base_url(); ?>search?q=<?= $q; ?>" class="btn btn-danger text-light btn-sm">Reset Filter</a>
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
                <div style="align-self: flex-start" class="alert alert-warning">Upss. Tidak ada produk yang dapat ditampilkan</div>
            <?php } ?>
        </div>
    </div>
</div>