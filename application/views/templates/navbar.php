<!-- <div class="navbartop">
  <a href="" class="confirm">Konfirmasi Pembayaran</a>
  <a href="">Daftar</a>
  <a href="">Masuk</a>
</div> -->
<?php if($this->session->userdata('login')){ ?>
  <?php
  $user = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
  $cart = $this->db->get_where('cart', ['user' => $this->session->userdata('id')]);
  $order = $this->db->get_where('invoice', ['user' => $this->session->userdata('id'), 'status !=' => 4]);
  ?>
<?php } ?>
<?php
$menu = $this->db->get('menu');
$settingss = $this->db->get('settings')->row_array();
?>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark" style="background-color: <?= $this->Settings_model->general()["navbar_color"]; ?> !important">
  <div class="container">
  <a class="navbar-brand mr-5" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>assets/images/logo/<?= $settingss['logo']; ?>" alt="logo" width="100"></a>

    <div class="collapse navbar-collapse ml-3" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
      <?php foreach($menu->result_array() as $m): ?>
      <?php
      if(substr($m['link'],0,4) == "http" || substr($m['link'],0,3) == "www"){
          $newlink1 = $m['link'];
      }else{
          $newlink1 = base_url() . $m['link'];
      }
      ?>
      <?php if($this->Settings_model->getSubMenu($m['id'])->num_rows() > 0){ ?>
        <li class="nav-item dropdown">
          <a class="nav-link text-light dropdown-toggle" href="#" id="navbarDropdownCategories<?= $m['id'] ?>" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= $m['title']; ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownCategories<?= $m['id'] ?>">
            <?php foreach($this->Settings_model->getSubMenu($m['id'])->result_array() as $cat): ?>
              <?php
              if(substr($cat['link'],0,4) == "http" || substr($cat['link'],0,3) == "www"){
                  $newlink = $cat['link'];
              }else{
                  $newlink = base_url() . $cat['link'];
              }
              ?>
              <a class="dropdown-item" href="<?= $newlink; ?>"><?= $cat['name']; ?></a>
            <?php endforeach; ?>
          </div>
        </li>
      <?php }else{ ?>
        <li class="nav-item active">
          <a class="nav-link" href="<?= $newlink1; ?>"><?= $m['title']; ?></a>
        </li>
      <?php } ?>
      <?php endforeach; ?>
      </ul>
      <br>
      <div>
      </div>
      <?php if($this->session->userdata('login')){ ?>
        <a href="<?= base_url(); ?>cart" class="text-light navbar-cart-inform">
          <i class="fa fa-shopping-cart"></i>
          <?php if($cart->num_rows() > 0){ ?>
            Cart(<?= $cart->num_rows(); ?>)
          <?php }else{ ?>
            Cart
          <?php } ?>
        </a>
        <br>
        <br>
        <br>
      <?php } ?>
    </div>

    <?php if(!$this->session->userdata('login')){ ?>
      <div class="for-hidden">
      <i class="fa text-light mr-3 icon-search-navbar fa-search"></i>
        <a href="<?= base_url(); ?>login" class="btn btn-sm btn-outline-light ml-2"><i class="fa fa-sign-in-alt"></i> Masuk</a>
      </div>
    <?php }else{ ?>
      <div>
      <i class="fa search-icon-desktop text-light ml-3 icon-search-navbar fa-search"></i>
      <img src="<?= base_url(); ?>assets/images/profile/<?= $user['photo_profile']; ?>" class="photo-profile-mobile" alt="Photo Profile <?= $user['name']; ?>" class="photo" data-toggle="dropdown" id="dropdownPhotoProfileNavbarMobile" aria-haspopup="true" aria-expanded="false">
      <div class="dropdown-menu dropdownPhotoProfileNavbarMobile" aria-labelledby="dropdownPhotoProfileNavbarMobile">
        <a class="dropdown-item" href="<?= base_url(); ?>profile">Dashboard</a>
        <a class="dropdown-item" href="<?= base_url(); ?>cart">
        <?php if($cart->num_rows() > 0){ ?>
            Keranjang(<?= $cart->num_rows(); ?>)
          <?php }else{ ?>
            Keranjang
          <?php } ?>
        </a>
        <?php if($order->num_rows() > 0){ ?>
          <a class="dropdown-item" href="<?= base_url(); ?>profile/transaction">Transaksi <small class="badge badge-sm badge-info"><?= $order->num_rows(); ?></small></a>
        <?php }else{ ?>
          <a class="dropdown-item" href="<?= base_url(); ?>profile/transaction">Transaksi</a>
        <?php } ?>
        <a class="dropdown-item" href="<?= base_url(); ?>profile/histories">Riwayat Transaksi</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?= base_url(); ?>profile/edit-profile">Edit Profil</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?= base_url(); ?>logout">Keluar</a>
      </div>
    </div>
    <?php } ?>

    <div>
      <i class="fa search-mobile text-light mr-3 icon-search-navbar fa-search"></i>
      <i class="fa fa-bars btn-for-dropdown"></i>
    </div>

  </div>
</nav>
<div class="dropdown-mobile-menu" style="background-color: <?= $this->Settings_model->general()["navbar_color"]; ?> !important">
  <?php foreach($menu->result_array() as $m): ?>
    <?php if($this->Settings_model->getSubMenu($m['id'])->num_rows() > 0){ ?>
      <div class="dropdown">
        <a class="dropdown-toggle text-light" id="dropdownMenuButton<?= $m['id'] ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= $m['title']; ?></a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?= $m['id'] ?>">
          <?php foreach($this->Settings_model->getSubMenu($m['id'])->result_array() as $cat): ?>
            <?php
            if(substr($cat['link'],0,4) == "http" || substr($cat['link'],0,3) == "www"){
                $newlink = $cat['link'];
            }else{
                $newlink = base_url() . $cat['link'];
            }
            ?>
            <a class="dropdown-item" href="<?= $newlink; ?>"><?= $cat['name']; ?></a>
          <?php endforeach; ?>
        </div>
      </div>
    <?php }else{ ?>
      <?php
        if(substr($m['link'],0,4) == "http" || substr($m['link'],0,3) == "www"){
            $newlink1 = $m['link'];
        }else{
            $newlink1 = base_url() . $m['link'];
        }
      ?>
    <a href="<?= $newlink1 ?>" class="text-light"><?= $m['title']; ?></a>
    <?php } ?>
  <?php endforeach; ?>
  <div class="mt-3"></div>
  <?php if($this->session->userdata('login')){ ?>
    <a href="<?= base_url(); ?>profile" class="text-light"><i class="fa fa-user"></i> <?= $user['name']; ?></a>
    <a href="" class="text-light">
      <i class="fa fa-shopping-cart"></i>
    <?php if($cart->num_rows() > 0){ ?>
      Keranjang(<?= $cart->num_rows(); ?>)
    <?php }else{ ?>
      Keranjang
    <?php } ?>
    </a>
    <?php if($order->num_rows() > 0){ ?>
          <a class="text-light" href="<?= base_url(); ?>profile/transaction">Transaksi <small class="badge badge-sm badge-info"><?= $order->num_rows(); ?></small></a>
        <?php }else{ ?>
          <a class="text-light" href="<?= base_url(); ?>profile/transaction">Transaksi</a>
        <?php } ?>
        <a class="text-light" href="<?= base_url(); ?>logout">Keluar</a>
  <?php }else{ ?>
    <a href="<?= base_url(); ?>login" class="text-light"><i class="fa fa-sign-in-alt"></i> Masuk</a>
    <a href="<?= base_url(); ?>register" class="text-light"><i class="fa fa-user"></i> Daftar</a>
  <?php } ?>
</div>
<div class="search-form">
  <i class="fa fa-times"></i>
  <form action="<?= base_url(); ?>search" method="get">
    <input type="text" placeholder="Cari produk" autocomplete="off" name="q"><!--
    --><button type="submit">Cari</i></button>
  </form>
</div>
<div class="top-nav"></div>
