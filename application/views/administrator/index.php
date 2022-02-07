<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">

  <?php $data = $this->db->get('user')->num_rows(); ?>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pengguna</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php $data = $this->db->get_where('invoice', ['status' => 0])->num_rows(); ?>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pesanan Masuk</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php $data = $this->db->get('subscriber')->num_rows(); ?>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Subscriber</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data - 1 ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php $data = $this->db->get('email_send')->num_rows(); ?>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Email Terkirim</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php $data = $this->db->get('categories')->num_rows(); ?>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kategori</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php $data = $this->db->get('products')->num_rows(); ?>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Produk</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php $data = $this->db->get_where('products', ['promo_price !=' => 0])->num_rows(); ?>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Promo</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php $data = $this->db->get('testimonial')->num_rows(); ?>
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Testimoni</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data; ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<?php $this->db->limit(2); $data = $this->db->get_where('invoice', ['status' => 0]); ?>
<!-- 
<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card shadow">
            <div class="card-header">
                Pesanan Masuk
            </div>
            <div class="card-body">
                <?php if($data->num_rows() > 0){ ?>
                <table class="table table-bordered">
                    <tr>
                        <th>Invoice</th>
                        <th>Nama</th>
                        <th>Total</th>
                    </tr>
                    <?php foreach($data->result_array() as $d): ?>
                        <tr>
                            <td><?= $d['invoice_code'] ?></td>
                            <td><?= $d['name'] ?></td>
                            <td><?= number_format($d['total_all'],0,",",".") ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <?php }else{ ?>
                    <div class="alert alert-warning">Belum ada pesanan masuk</div>
                <?php } ?>
            </div>
        </div>
    </div>  
    -->  
    <?php $desc = $this->db->get('settings')->row_array(); ?>
    <div class="col-md-12 mb-3">
        <div class="card shadow">
            <div class="card-header">
                Tentang <?= $this->Settings_model->general()["app_name"]; ?>
            </div>
            <div class="card-body">
                <?= $desc['short_desc']; ?>
                <hr>
                <?= $desc['address']; ?>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <div class="card shadow">
            <div class="card-header">
                Mutasi Transaksi <?= $this->Settings_model->general()["app_name"]; ?>
            </div>
            <div class="card-body">
                  
                      
            </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->