<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-7">
            <h3 class="mb-4">Bukti Pembayaran</h3>
            <div class="col-md-6">
            <?php echo $this->session->flashdata('failed'); ?>
            </div>
            <form action="<?=base_url();?>payment/confirmation" method="post" enctype="multipart/form-data">
                <div class="form-group col-md-6">
                    <label for="invoice">Order ID atau Kode Pesanan</label>
                    <input type="text" name="invoice" class="form-control" autocomplete="off">
                    <small class="form-text text-danger pl-1"><?php echo form_error('invoice'); ?></small>
                </div>
                <div class="form-group col-md-6">
                    <label for="invoice">File</label>
                    <input type="file" name="file" class="form-control">
                    <small class="text-muted">File yang didukung berformat JPG, JPEG, PNG, PDF</small>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-block btn-dark">Kirim Bukti</button>
                </div>
            </form>
        </div>
    </div>
</div>