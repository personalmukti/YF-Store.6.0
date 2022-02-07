<?php echo $this->session->flashdata('upload'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800 mb-4">Halaman</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<a
				href="<?= base_url(); ?>administrator/page/add"
				class="btn btn-primary"
				>Tambah</a
			>
		</div>
		<div class="card-body">
            <?php echo $this->session->flashdata('failed'); ?> 
            <?php if($pages->num_rows() > 0){ ?>
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
							<th>Judul</th>
                            <th>Aksi</th>
						</tr>
					</thead>
					<tfoot></tfoot>
					<tbody class="data-content">
                        <?php $no = 1 ?>
						<?php foreach($pages->result_array() as $data): ?>
						<tr>
                            <td><?= $no ?></td>
                            <td><?= $data['title']; ?></td>
                            <td style="width: 100px">
                                <a href="<?= base_url() ;?>administrator/page/<?= $data['id']; ?>/edit" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a>
                                <a href="<?= base_url() ;?>administrator/delete_page/<?= $data['id']; ?>" onclick="return confirm('Yakin ingin menghapus halaman?');" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php $no++ ?>
                        <?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php }else{ ?>
			<div class="alert alert-warning" role="alert">
				Opss, halaman masih kosong, yuk tambah sekarang.
			</div>
            <?php } ?>
		</div>
	</div>
</div>
<!-- /.container-fluid -->