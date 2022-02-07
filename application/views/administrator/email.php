<?php echo $this->session->flashdata('upload'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800 mb-4">Manajemen Email</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<a
				href="<?= base_url(); ?>administrator/email/send"
				class="btn btn-info"
				>Kirim Email</a
			>
		</div>
		<div class="card-body">
            <?php echo $this->session->flashdata('failed'); ?> 
            <?php if($email->num_rows() > 0){ ?>
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
							<th>Tujuan</th>
                            <th>Subjek</th>
                            <th>Aksi</th>
						</tr>
					</thead>
					<tfoot></tfoot>
					<tbody class="data-content">
                        <?php $no = 1 ?>
						<?php foreach($email->result_array() as $data): ?>
						<tr>
							<td><?= $no ?></td>
							<?php if($data['mail_to'] == 0){ ?>
								<td>Semua Email</td>
							<?php }else{ ?>
								<td><?= $data['email']; ?></td>
							<?php } ?>
                            <td><?= $data['subject']; ?></td>
                            <td style="width: 100px">
                                <a href="<?= base_url() ;?>administrator/email/<?= $data['sendId']; ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url() ;?>administrator/detele_email/<?= $data['sendId']; ?>" onclick="return confirm('Yakin ingin menghapus email ini?')" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php $no++ ?>
                        <?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php }else{ ?>
			<div class="alert alert-warning" role="alert">
				Opss, email masih kosong.
			</div>
            <?php } ?>
		</div>
	</div>
</div>
<!-- /.container-fluid -->