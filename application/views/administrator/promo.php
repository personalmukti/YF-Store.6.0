<?php echo $this->session->flashdata('upload'); ?>
<?php
  $setting = $this->db->get('settings')->row_array();
  $dateNow = date('Y-m-d H:i');
  $dateDB = $setting['promo_time'];
  $dateDBNew = str_replace("T"," ",$dateDB);
  $msg = "";
  if($dateNow >= $dateDBNew){
	$msg = "Sudah Habis";
    $this->db->set('promo', 0);
    $this->db->update('settings');
  }
  ?>
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800 mb-4">Promo Produk</h1>

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3" id="infoForPromo">
			<?php if($setting['promo'] == 1){ ?>
			<div class="row">
				<div class="col-md-3">
					<h3 class="lead">Promo Sedang Aktif</h3>
					<button
					onclick="onPromo('1')"
					class="btn btn-danger btn-sm btn-setting-promo"
					><i class="fa fa-minus-circle"></i> Nonaktifkan</button>
				</div>
				<div class="form-group input-group-sm mb-0 col-md-5">
					<p class="mb-0">Waktu promo</p>
					<form class="form-inline">
						<input type="datetime-local" name="date" id="inputDatePromo" class="form-control col-md-7 mr-1 form-control-sm" required>
						<button class="btn btn-primary btn-sm" id="setPromoTime">Set Waktu</button>
					</form>
					<small class="form-text text-muted">Batas Promo: <?= str_replace("T", " ", $setting['promo_time']); ?></small>
				</div>
			</div>
			<?php }else{ ?>
				<div class="row">
					<div class="col-md-3">
					<h3 class="lead">Promo Tidak Aktif</h3>
					<button
					onclick="onPromo('2')"
					class="btn btn-primary btn-sm btn-setting-promo"
					><i class="fa fa-check-circle"></i> Aktifkan</button>
					</div>
					<div class="form-group input-group-sm mb-0 col-md-5">
						<p class="mb-0">Waktu promo</p>
						<form class="form-inline">
							<input type="datetime-local" name="date" id="inputDatePromo" class="form-control col-md-7 mr-1 form-control-sm">
							<button class="btn btn-primary btn-sm" id="setPromoTime">Set Waktu</button>
						</form>
						<small class="form-text text-muted">Batas Promo: <?= str_replace("T", " ", $setting['promo_time']); ?> &bull; <span class="text-danger"><?= $msg; ?></span></small>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="card-body"> 
			<?php if($promo->num_rows() > 0){ ?>
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
								<th>Judul</th>
								<th>Harga Asli</th>
								<th>Harga Promo</th>
								<th style="width: 130px">Aksi</th>
							</tr>
						</thead>
						<tfoot></tfoot>
						<tbody class="data-content">
							<?php $no = 1 ?>
							<?php foreach($promo->result_array() as $data): ?>
							<tr>
								<td><?= $no ?></td>
								<td><img style="width: 50px" src="<?= base_url(); ?>assets/images/product/<?= $data['img']; ?>"></td>
								<td><?= $data['title']; ?></td>
								<td><?= $data['price']; ?></td>
								<td><?= $data['promo_price']; ?></td>
								<td>
									<a href="<?= base_url(); ?>administrator/delete_promo/<?= $data['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus promo untuk produk ini?')"><i class="fa fa-minus-circle"></i> Hapus</a>
								</td>
							</tr>
							<?php $no++ ?>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			<?php }else{ ?>
				<div class="alert alert-warning">Upss.. Belum ada promo</div>
			<?php } ?>
		</div>
		<hr>
		<div class="card-header">
			Pilih Produk sebagai promo
		</div>
		<div class="card-body">
		<?php if($getProducts->num_rows() > 0){ ?>
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
								<th>Judul</th>
								<th>Harga</th>
								<th>Stok</th>
								<th>Kategori</th>
								<th style="width: 150px">Tanggal Input</th>
								<th>Status</th>
								<th style="width: 130px">Aksi</th>
							</tr>
						</thead>
						<tfoot></tfoot>
						<tbody class="data-content">
							<?php $no = $this->uri->segment(3) + 1; ?>
							<?php foreach($getProducts->result_array() as $data): ?>
							<tr>
								<td><?= $no ?></td>
								<td><img style="width: 50px" src="<?= base_url(); ?>assets/images/product/<?= $data['productsImg']; ?>"></td>
								<td><?= $data['productsTitle']; ?></td>
								<td><?= str_replace(",",".",number_format($data['productsPrice'])); ?></td>
								<td><?= $data['productsStock']; ?></td>
								<td><?= $data['categoriesName']; ?></td>
								<td><?= $data['productsDate']; ?></td>
								<?php if($data['productsPublish'] == 1){ ?>
									<td>Publish</td>
								<?php }else{ ?>
									<td>Draft</td>
								<?php } ?>
								<td>
									<a href="" onclick="getProduct('<?= $data['productsId'] ?>')" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addPromo"><i class="fa fa-plus-circle"></i> Tambah</a>
								</td>
							</tr>
							<?php $no++ ?>
							<?php endforeach; ?>
						</tbody>
					</table>
					<?= $this->pagination->create_links(); ?>
				</div>
				<?php }else{ ?>
				<div class="alert alert-warning" role="alert">
					Semua produk sudah dimasukan kedalam promo
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<!-- /.container-fluid -->


<!-- Modal -->
<div class="modal fade" id="addPromo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Promo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  <form action="<?= base_url(); ?>administrator/add_promo" method="post">
      <div class="modal-body" id="showModalBodyAddPromo">
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Tambah</button>
	  </div>
	  </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>

	function getProduct(id){
		$.ajax({
			url: "<?= base_url(); ?>administrator/ajax_get_product_by_id/" + id,
			type: "get",
			dataType: "json",
			success: function(data){
				$("#showModalBodyAddPromo").html(`
					<p>${data.title}</p>
					<p>Harga Awal: ${data.price}</p>
					<div class="form-group">
						<label for="price">Harga Promo</label>
						<input type="number" class="form-control" id="price" required name="price">
						<small id="priceHelp" class="form-text text-muted">Isikan tanpa tanda pemisah. Contoh pengisian 300000</small>
						<input type="hidden" name="product" value="${data.productId}" >
					</div>
				`);
			}
		})
	}

	$("#setPromoTime").click(function(e){
		e.preventDefault();
		const pdate = $("#inputDatePromo").val();
		$.ajax({
			url: "<?= base_url(); ?>administrator/set_time_promo",
			type: "post",
			data: {
				pdate: pdate
			},
			success: function(){
				swal({
					text: 'Waktu Promo berhasil diubah',
					icon: 'success'
				});
			}
		})
	})

	function onPromo(type){
		$.ajax({
			url: '<?= base_url(); ?>administrator/off_promo_setting/' + type,
			type: 'get',
			success: function(){
				location.reload(true);
			}
		})
	}

</script>