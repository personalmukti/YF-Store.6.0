<?php echo $this->session->flashdata('verification'); ?>
<div class="wrapper">
    <a href="<?= base_url(); ?>"><h2 class="brand-name"><?= $this->Settings_model->general()["app_name"]; ?></h2></a>
    <p class="subtitle">Silakan buat password baru</p>
    <?php echo $this->session->flashdata('failed'); ?>
    <form action="<?= base_url(); ?>new-password" method="post">
        <div class="form-group">
            <input type="password" placeholder="Password Baru"  name="password" class="form-control"  autocomplete="off">
            <small class="form-text text-danger pl-1"><?php echo form_error('password'); ?></small>
        </div>
        <div class="form-group">
            <input type="password" placeholder="Ketik Ulang Password"  name="password1" class="form-control"  autocomplete="off">
            <small class="form-text text-danger pl-1"><?php echo form_error('password1'); ?></small>
        </div>
        <button type="submit" class="btn btn-block btn-dark mt-3 mb-1">Ubah Password</button>
    </form>
</div>