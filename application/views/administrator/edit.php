<?php echo $this->session->flashdata('upload'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-body">
      <h3 class="lead">Edit Username</h3>
      <hr />
      <form action="<?= base_url(); ?>administrator/edit_username" method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input
            type="text"
            class="form-control"
            id="username"
            value="<?= $admin['username']; ?>"
            name="username"
            autocomplete="off"
          />
          <small class="form-text text-danger msgErrorUsername" style="display: none;"></small>
        </div>
        <button type="submit" class="btn btn-edit-username btn-primary">
          Ubah Username
        </button>
      </form>
    </div>
  </div>
  <div class="card shadow mb-4">
    <div class="card-body">
      <h3 class="lead">Edit Password</h3>
      <hr />
      <div class="alert alert-danger" style="display: none;" role="alert"></div>
      <form action="<?= base_url(); ?>administrator/edit_pass" method="post">
        <div class="form-group">
          <label for="oldPassword">Password Lama</label>
          <input
              type="password"
              name="oldPassword"
              id="oldPassword"
              required
              class="form-control"
              data-toggle="password"
            />
        </div>
        <div class="form-group">
          <label for="newPassword">Password Baru</label>
          <input
              type="password"
              name="newPassword"
              id="newPassword"
              required
              class="form-control"
              data-toggle="password"
            />
        </div>
        <div class="form-group">
          <label for="confirmPassword">Konfirmasi Password Baru</label>
          <input
              type="password"
              name="confirmPassword"
              id="confirmPassword"
              required
              class="form-control"
              data-toggle="password"
            />
        </div>
        <button type="submit" class="btn btn-edit-password btn-primary">Ubah Password</button>
      </form>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
