<?php echo $this->session->flashdata('success'); ?>
<div class="wrapper">
    <?php include 'menu.php'; ?>
    <div class="core">
        <h2 class="title">Ganti Kata Sandi</h2>
        <hr>
        <?php echo $this->session->flashdata('failed'); ?>
        <form action="<?= base_url(); ?>profile/change-password" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="oldpassword">Password Lama</label>
                <input type="password" name="oldpassword" class="form-control" id="oldpassword" required autocomplete="off">
                <small class="form-text text-danger pl-1"><?php echo form_error('oldpassword'); ?></small>
            </div>
            <div class="form-group">
                <label for="newpassword">Password Baru</label>
                <input type="password" name="newpassword" class="form-control" id="newpassword" required autocomplete="off">
                <small class="form-text text-danger pl-1"><?php echo form_error('newpassword'); ?></small>
            </div>
            <div class="form-group">
                <label for="confirmpassword">Konfirmasi Password Baru</label>
                <input type="password" name="confirmpassword" class="form-control" id="confirmpassword" required autocomplete="off">
                <small class="form-text text-danger pl-1"><?php echo form_error('confirmpassword'); ?></small>
            </div>
            <button class="btn btn-dark">Update</button>
        </form>
    </div>
</div>