<?php echo $this->session->flashdata('upload'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800 mb-4">Bukti Pembayaran</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-body">
            <?php echo $this->session->flashdata('failed'); ?> 
            <?php if($proof->num_rows() > 0){ ?>
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
							<th>Order ID/Invoice</th>
							<th>File</th>
                            <th>Aksi</th>
						</tr>
					</thead>
					<tfoot></tfoot>
					<tbody class="data-content">
						<?php $no = $this->uri->segment(3) + 1; ?>
						<?php foreach($proof->result_array() as $data): ?>
						<tr>
							<td><?= $no; ?></td>
                            <td><?= $data['invoice']; ?></td>
                            <td><a href="<?= base_url(); ?>assets/images/confirmation/<?= $data['file']; ?>" target="_blank"><?= $data['file']; ?></a></td>
                            <td>
                                <a href="<?= base_url() ;?>administrator/confirm_proof/<?= $data['invoice']; ?>" onclick="return confirm('Yakin sudah menerima pembayaran dan ingin mengonfirmasi pesanan?');" class="btn btn-sm btn-info"><i class="fa fa-check-circle"></i> Selesai</a>
                            </td>
                        </tr>
						<?php $no++; ?>
                        <?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<?php }else{ ?>
			<div class="alert alert-warning mb-0" role="alert">
				Opss, belum ada bukti pembayaran yang masuk.
			</div>
            <?php } ?>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
