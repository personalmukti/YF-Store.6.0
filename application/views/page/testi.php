<div class="wrapper">
    <div class="title-head" style="background-color: <?= $this->Settings_model->general()["navbar_color"]; ?> !important">
        <h2 class="title">Testimoni</h2>
    </div>
    <?php if($testi->num_rows() > 0){ ?>
        <div class="testi mt-4">
            <div class="row">
            <?php foreach($testi->result_array() as $data){ ?>
                <div class="col-lg-4 mb-4">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $data['name']; ?></h5>
                        <p class="card-text"><?= $data['content']; ?></p>
                    </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    <?php }else{ ?>
        <div class="alert alert-warning mt-4">Upss.. Belum ada testimoni</div>
    <?php } ?>
</div>