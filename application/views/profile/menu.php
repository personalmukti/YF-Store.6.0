<?php
$order = $this->db->get_where('invoice', ['user' => $this->session->userdata('id'), 'status !=' => 4]);
?>

<div class="list-group">
  <a href="<?= base_url(); ?>profile" class="list-group-item list-group-item-action">Dashboard</a>
  <?php if($order->num_rows() > 0){ ?>
  <a href="<?= base_url(); ?>profile/transaction" class="list-group-item list-group-item-action">Transaksi <span class="badge badge-info"><?= $order->num_rows(); ?></span></a>
  <?php }else{ ?>
    <a href="<?= base_url(); ?>profile/transaction" class="list-group-item list-group-item-action">Transaksi</a>
  <?php } ?>
  <a href="<?= base_url(); ?>profile/histories" class="list-group-item list-group-item-action">Riwayat Transaksi</a>
  <a href="<?= base_url(); ?>profile/edit-profile" class="list-group-item list-group-item-action">Edit Profil</a>
  <a href="<?= base_url(); ?>profile/change-password" class="list-group-item list-group-item-action">Ganti Kata Sandi</a>
  </div>