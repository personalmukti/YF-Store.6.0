<?php echo $this->session->flashdata('upload'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800 mb-4">Pengguna</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
            <?php echo $this->session->flashdata('failed'); ?> 
            <?php if($users->num_rows() > 0){ ?>
			<div class="table-responsive">
				<table
					class="table table-bordered"
					id="dataTable"
					width="100%"
					cellspacing="0"
				>
					<thead>
						<tr>
							<th>#</th>
							<th>Foto</th>
							<th>Nama</th>
							<th>Username</th>
                            <th>Email</th>
                            <th>Tanggal Daftar</th>
                            <th>Aktif</th>
						</tr>
					</thead>
					<tfoot></tfoot>
					<tbody class="data-content">
                        <?php $no = $this->uri->segment(3) + 1; ?>
						<?php foreach($users->result_array() as $data): ?>
						<tr>
							<td><?= $no; ?></td>
                            <td><img style="width: 50px; height: 50px; object-fit: cover;" src="<?= base_url(); ?>assets/images/profile/<?= $data['photo_profile']; ?>" alt="foto <?= $data['name']; ?>"></td>
                            <td><?= $data['name']; ?></td>
                            <td><?= $data['username']; ?></td>
                            <td><?= $data['email']; ?></td>
                            <td><?= $data['date_register']; ?></td>
                            <?php if($data['is_activate'] == 0){ ?>
                                <td>Belum aktif <a href="<?= base_url(); ?>administrator/active_user/<?= $data['id']; ?>">aktifkan</a></td>
                            <?php }else{ ?>
                                <td>Aktif <a href="<?= base_url(); ?>administrator/nonactive_user/<?= $data['id']; ?>">nonaktifkan</a></td>
                            <?php } ?>
                        </tr>
						<?php $no++; ?>
                        <?php endforeach; ?>
					</tbody>
				</table>
                <?= $this->pagination->create_links(); ?>
			</div>
			<?php }else{ ?>
			<div class="alert alert-warning mb-0" role="alert">
				Opss, belum ada pengguna.
			</div>
            <?php } ?>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
