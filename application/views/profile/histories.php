<?php echo $this->session->flashdata('success'); ?>
<div class="wrapper">
    <?php include 'menu.php'; ?>
    <div class="core">
        <h2 class="title">Riwayat Transaksi</h2>
        <hr>
        <?php if($finish->num_rows() > 0){ ?>
            <table class="table table-bordered">
                <tr>
                    <th>Order ID</th>
                    <th>Tanggal Pesan</th>
                    <th>Total Pembayaran</th>
                    <th>#</th>
                </tr>
                <?php foreach($finish->result_array() as $d): ?>
                    <tr>
                        <td><?= $d['invoice_code']; ?></td>
                        <td><?= $d['date_input']; ?></td>
                        <td>Rp<?= number_format($d['total_all'],0,",","."); ?></td>
                        <td><small><a href="<?= base_url(); ?>profile/transaction/<?= $d['invoice_code']; ?>" class="btn btn-info btn-sm">Detail</a></small> - <small><a href="<?= base_url(); ?>profile/transaction/<?= $d['invoice_code']; ?>" class="btn btn-warning btn-sm">Berikan Rating</a></small></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php }else{ ?>
            <div class="alert alert-warning">Tidak ada pesanan. Yuk Belanja.</div>
        <?php } ?>
    </div>
</div>