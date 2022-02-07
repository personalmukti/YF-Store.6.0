<?php echo $this->session->flashdata('upload'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800 mb-4">Edit Kategori</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<a
				href="<?= base_url(); ?>administrator/categories"
				class="btn btn-danger"
				><i class="fa fa-times-circle"></i> Batal</a
			>
		</div>
		<div class="card-body">
			<?php echo $this->session->flashdata('failed'); ?>
			<form
				action="<?= base_url(); ?>administrator/category/<?= $category['id']; ?>"
				method="post"
				enctype="multipart/form-data"
			>
				<div class="form-group">
					<label for="name">Nama Kategori</label>
					<input
						type="text"
						class="form-control"
						id="name"
						name="name"
						required
						autocomplete="off"
						value="<?= $category['name']; ?>"
					/>
				</div>
				<div class="form-group">
					<label>Icon Lama</label><br />
					<input
						type="hidden"
						name="oldIcon"
						value="<?= $category['icon']; ?>"
					/>
					<img
						src="<?= base_url(); ?>assets/images/icon/<?= $category['icon']; ?>"
						style="width: 70px;"
					/>
				</div>
				<div class="form-group">
					<label for="icon">Icon Baru</label>
					<input type="file" name="icon" id="icon" class="form-control" />
				</div>
				<button type="submit" class="btn btn-primary">Edit Kategori</button>
			</form>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
