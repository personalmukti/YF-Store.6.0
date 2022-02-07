<?php echo $this->session->flashdata('upload'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800 mb-4"><?= $email['email']; ?></h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
            <a href="<?= base_url(); ?>administrator/email" class="btn btn-sm btn-primary"><i class="fa fa-chevron-left"></i> Kembali</a>
		</div>
		<div class="card-body">
			<?php echo $this->session->flashdata('failed'); ?>
			<div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $email['subject']; ?></h5>
                    <p class="card-text"><?= $email['message']; ?></p>
                </div>
            </div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
