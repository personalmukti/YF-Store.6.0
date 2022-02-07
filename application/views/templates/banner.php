<?php $banner = $this->Settings_model->getBanner(); ?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
  <?php
    foreach ($banner->result_array() as $key => $value) {
        $active = ($key == 0) ? 'active' : '';
        echo '<li data-target="#carouselExampleIndicators" data-slide-to="' . $key . '" class="' . $active . '"></li>';
    }
    ?>
  </ol>
  <div class="carousel-inner">
  <?php
    foreach ($banner->result_array() as $key => $value) {
        $active = ($key == 0) ? 'active' : '';
        echo '<div class="carousel-item ' . $active . '">
            <a href="'.$value['url'].'"><img src="' . base_url() . 'assets/images/banner/' . $value['img'] . '"></a>
        </div>';
    }
    ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>