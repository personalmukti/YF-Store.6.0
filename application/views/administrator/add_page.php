<?php echo $this->session->flashdata('upload'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800 mb-4">Tambah Halaman</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<a
				href="<?= base_url(); ?>administrator/pages"
				class="btn btn-danger"
				><i class="fa fa-times-circle"></i> Batal</a
			>
		</div>
		<div class="card-body">
			<?php echo $this->session->flashdata('failed'); ?>
			<form
				action="<?= base_url(); ?>administrator/page/add"
				method="post"
				enctype="multipart/form-data"
			>
				<div class="form-group">
					<label for="title">Judul Halaman</label>
					<input
						type="text"
						class="form-control"
						id="title"
						name="title"
						required
						autocomplete="off"
					/>
				</div>
				<div class="form-group">
					<label for="slug">Slug Halaman</label>
					<input
						type="text"
						class="form-control"
						id="slug"
						name="slug"
						required
						autocomplete="off"
					/>
					<small class="text-muted">Gunakan tanda - jika lebih dari 1 kata. Contoh: about-us</small>
				</div>
				<div class="form-group">
					<label for="description">Isi</label>
					<textarea name="description" id="description" cols="30" rows="10"></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Tambah Halaman</button>
			</form>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
