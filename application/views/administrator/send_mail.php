<?php echo $this->session->flashdata('upload'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800 mb-4">Kirim Email</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<a
				href="<?= base_url(); ?>administrator/email"
				class="btn btn-danger"
				><i class="fa fa-times-circle"></i> Batal</a
			>
		</div>
		<div class="card-body">
			<?php echo $this->session->flashdata('failed'); ?>
			<form
				action="<?= base_url(); ?>administrator/email/send"
				method="post"
			>
				<div class="form-group">
					<label for="sendMailTo">Tujuan</label>
					<select name="sendMailTo" id="sendMailTo" class="form-control" required>
						<option></option>
						<?php if($email->num_rows() > 1){ ?>
						<?php foreach($email->result_array() as $e): ?>
							<option value="<?= $e['id']; ?>"><?= $e['email']; ?></option>
						<?php endforeach; ?>
						<?php }else{ ?>
						    <option disabled>Belum ada email</option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="subject">Subjek</label>
					<input type="text" autocomplete="off" id="subject" class="form-control" name="subject" required>
				</div>
				<div class="form-group">
					<label for="description">Isi</label>
					<textarea name="description" id="description" rows="5" class="form-control"></textarea>
				</div>
				<button type="submit" class="btn btn-info">Kirim Email</button>
			</form>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
