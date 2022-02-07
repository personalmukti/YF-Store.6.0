<?php echo $this->session->flashdata('success'); ?>
<div class="wrapper">
    <?php include 'menu.php'; ?>
    <div class="core">
        <h2 class="title">Edit Profil</h2>
        <hr>
        <?php echo $this->session->flashdata('failed'); ?>
        <form action="<?= base_url(); ?>profile/edit-profile" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" name="name" value="<?= $user['name']; ?>" class="form-control" id="name" required autocomplete="off">
                <small class="form-text text-danger pl-1"><?php echo form_error('name'); ?></small>
            </div>
            <div class="form-group">
                <label for="photo">Foto Profil</label><br>
                <img src="<?= base_url(); ?>assets/images/profile/<?= $user['photo_profile']; ?>" alt="Foto profil <?= $user['name']; ?>" class="photo-profile">
                <input type="file" name="newphoto" class="form-control mt-2" id="photo">
            </div>
            <button class="btn btn-dark">Update</button>
        </form>
    </div>
</div>