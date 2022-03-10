<div class="wrapper">
    <?php include 'menu.php'; ?>
    <div class="core">
        <h2 class="title">Berikan Testimoni</h2>
        <hr>

        <!-- Post List -->
        <?php 
        foreach($posts as $post){
            $id = $post['id'];
            $img = $post['img'];
            $product_name = $post['product_name'];
            $price = $post['price'];
            $rating = $post['rating']; // User rating on a post
            $averagerating = $post['averagerating']; // Average rating

            ?>

        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="<?= base_url(); ?>assets/images/product/<?= $img; ?>" alt="Card image cap">
          <div class="card-body">
            <h4 class="card-title"><?= $product_name; ?></h4>
            <p class="card-text">Rp. <?= $price ?></p>
            <div class="post-action">

                    <!-- Rating Bar -->
                    <input id="post_<?= $id ?>" value='<?= $rating ?>' class="rating-loading ratingbar" data-min="0" data-max="5" data-step="1">
                    <!-- <img src="<?= base_url(); ?>assets/images/icon/rating.png" width="240px" height="80px">
                     Average Rating -->
                    <div >Rating trata-rata: <span id='averagerating_<?= $id ?>'><?= $averagerating ?></span></div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Tulis pendapat anda!</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea><hr>
                        <a class="btn btn-primary btn-md">Kirim</a>
                      </div>

                </div>
          </div>
        </div>
            <?php
        }
        ?>
    </div>
</div>