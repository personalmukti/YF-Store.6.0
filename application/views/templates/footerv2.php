
<?php
$categoriesLimit = $this->Categories_model->getCategoriesLimit();
$setting = $this->Settings_model->getSetting();
$sosmed = $this->Settings_model->getSosmed();
$footerhelp = $this->Settings_model->getFooterHelp();
$footerinfo = $this->Settings_model->getFooterInfo();
$rekening = $this->db->get('rekening');
 ?>
    <footer class="bg-light">
    <div class="about-for-mobile">
                <h2 class="brand-footer"><?= $this->Settings_model->general()["app_name"]; ?></h2>
                <p>
                <?= $setting['short_desc']; ?>
                </p>
                <div class="sosmed">
                <h3>Temukan kami di</h3>
                <?php foreach($sosmed->result_array() as $s): ?>
                  <a href="<?= $s['link']; ?>" target="_blank" title="<?= $s['name']; ?>">
                      <i class="fab fa-<?= $s['icon']; ?>"></i>
                  </a>
                <?php endforeach; ?>
                </div>
            </div>
        <div class="information">
            <div class="main">
            <div class="about about-hide">
                <h2 class="brand-footer"><?= $this->Settings_model->general()["app_name"]; ?></h2>
                <p>
                <?= $setting['short_desc']; ?>
                </p>
                <div class="sosmed">
                <h3>Temukan kami di</h3>
                <?php foreach($sosmed->result_array() as $s): ?>
                  <a href="<?= $s['link']; ?>" target="_blank" title="<?= $s['name']; ?>">
                      <i class="fab fa-<?= $s['icon']; ?>"></i>
                  </a>
                <?php endforeach; ?>
                </div>
            </div>
            <div class="item item-hide">
                <h3 class="title">KATEGORI</h3>
                <?php foreach($categoriesLimit->result_array() as $c): ?>
                    <a href="<?= base_url(); ?>c/<?= $c['slug']; ?>"><?= $c['name']; ?></a>
                <?php endforeach; ?>
            </div>
            <div class="item">
                <h3 class="title">INFO <?= strtoupper($this->Settings_model->general()["app_name"]); ?></h3>
                <?php foreach($footerinfo->result_array() as $f): ?>
                  <a href="<?= base_url(); ?><?= $f['slug']; ?>"><?= $f['title']; ?></a>
                <?php endforeach; ?>
            </div>
            <div class="item">
                <h3 class="title">BANTUAN</h3>
                <?php foreach($footerhelp->result_array() as $f): ?>
                  <a href="<?= base_url(); ?><?= $f['slug']; ?>"><?= $f['title']; ?></a>
                <?php endforeach; ?>
            </div>
            </div>
        </div>
        <div class="contact">
            <div class="main">
                <div class="item">
                    <i class="fa fa-map-marker-alt"></i>
                    <p><?= nl2br($setting['address']); ?></p>
                </div>
                <div class="item">
                    <i class="fa fa-phone"></i>
                    <p><?= $this->Settings_model->general()["whatsapp"]; ?></p>
                </div>
                <div class="item">
                    <i class="fa fa-envelope"></i>
                    <p><?= $this->Settings_model->general()["email_contact"]; ?></p>
                </div>
            </div>
        </div>
        <div class="copyright" style="background-color: <?= $this->Settings_model->general()["navbar_color"]; ?> !important">
            <p class="mb-0">Copyright &copy; <span id="footer-cr-years"></span> <?= $this->Settings_model->general()["app_name"]; ?>. All Right Reserved.</p>
        </div>
        </footer>

        <?php
        if($this->session->userdata('login')){
            $cart = $this->db->get_where('cart', ['user' => $this->session->userdata('id')]);
            $totalall = 0;
            foreach($cart->result_array() as $c){
                $totalall += intval($c['price']) * intval($c['qty']);
            }
        }
        ?>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.countdown.min.js"></script>
    <script src="<?= base_url(); ?>assets/lightbox2-2.11.1/dist/js/lightbox.js"></script>
    <script src="<?= base_url(); ?>assets/select2-4.0.6-rc.1/dist/js/select2.min.js"></script>
    <script>
        $('.recent-product').slick({
            infinite: false,
            slidesToShow: 6,
            slidesToScroll: 1
        });

        $("i.icon-search-navbar").on('click', function(){
            $("div.search-form").slideDown('fast');
            $("div.search-form input").focus();
        })

        $("div.search-form i").on('click', function(){
            $("div.search-form").slideUp('fast');
        })

        $("i.fa-bars").on('click', function(){
            $("div.dropdown-mobile-menu").slideToggle('fast');
        })

        $("div.product-wrapper div.main-product button.slick-prev").html("<i class='fa fa-chevron-left'></i>")
        $("div.product-wrapper div.main-product button.slick-next").html("<i class='fa fa-chevron-right'></i>")

        const years = new Date().getFullYear();
        $("#footer-cr-years").text(years);

        $("#countdownPromo").countdown({
            date: "<?= $setting['promo_time']; ?>",
            render: function (data) {
                var el = $(this.el);
                el.empty()
                .append(
                    this.leadingZeros(data.days, 2) + " : "
                )
                .append(
                    this.leadingZeros(data.hours, 2) + " : "
                )
                .append(
                    this.leadingZeros(data.min, 2) + " : "
                )
                .append(
                    this.leadingZeros(data.sec, 2)
                );
            },
        });

        //loading screen
        $(window).ready(function(){
            $(".loading-animation-screen").fadeOut("slow");
        })


        // detail
        $("#detailBtnPlusJml").click(function(){
            var val = parseInt($(this).prev('input').val());
            $(this).prev('input').val(val + 1).change();
            return false;
        })

        $("#detailBtnMinusJml").click(function(){
            var val = parseInt($(this).next('input').val());
            if (val !== 1) {
                $(this).next('input').val(val - 1).change();
            }
            return false;
        })

        $("#paymentSelectProvinces").select2({
            placeholder: 'Pilih Provinsi',
            language: 'id'
        })

        $("#paymentSelectRegencies").select2({
            placeholder: 'Pilih Kabupaten/Kota',
            language: 'id'
        })

        $("#paymentSelectKurir").select2({
            placeholder: 'Pilih Salah Satu',
            language: 'id'
        })

        $("#paymentSelectService").select2({
            placeholder: 'Pilih Service',
            language: 'id'
        })

        $("#paymentSelectProvinces").change(function(){
            $("#paymentSelectRegencies").select2({
                placeholder: 'Loading..',
                language: 'id'
            })
            const id = $(this).val();
            $.ajax({
                url: "<?= base_url(); ?>payment/getLocation",
                type: "post",
                dataType: "json",
                async: true,
                data: {
                    id: id
                },
                success: function(data){
                    $("#paymentSelectRegencies").select2({
                        placeholder: 'Pilih Kabupaten/Kota',
                        language: 'id'
                    })
                    $("#paymentSelectRegencies").html(data);
                    $("#paymentTextErrorAboveSelectKurir").hide();
                }
            });
        })

        $("#paymentSelectProvinces").change(paymentSelectKurir);

        $("#paymentSelectRegencies").change(paymentSelectKurir);

        function paymentSelectKurir(){
            $("#paymentSelectKurir").select2({
                placeholder: 'Loading..',
                language: 'id'
            })
            $("#paymentTotalAll").text("Rp"+'<?= number_format($totalall,0,",","."); ?>');
            $("#paymentSendingPrice").text("Rp0");
            const destination = $("#paymentSelectRegencies").val();
            if(destination === ""){
                $("#paymentTextErrorAboveSelectKurir").show();
            }else{
                $("#paymentTextErrorAboveSelectKurir").hide();
                $.ajax({
                    url: "<?= base_url(); ?>payment/getService",
                    type: "post",
                    dataType: "json",
                    async: true,
                    data: {
                        destination: destination
                    },
                    success: function(data){
                        $("#paymentSelectKurir").select2({
                            placeholder: 'Pilih Salah Satu',
                            language: 'id'
                        })
                        $("#paymentSelectKurir").html(data);
                    }
                });
            }
        }

        $("#paymentSelectKurir").change(paymentSelectService);

        function paymentSelectService(){
            let id = $("#paymentSelectKurir").val();
            id = id.split('-');
            id = id[0];
            if(id === ""){
                id = 0;
            }
            $("#paymentSendingPrice").text("Rp"+number_format(id).split(",").join("."));
            const price = $("#paymentPriceTotalAll").val();
            const total = parseInt(price) + parseInt(id);
            $("#paymentTotalAll").text("Rp"+number_format(total).split(",").join("."));
        }

        function number_format (number, decimals, decPoint, thousandsSep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
            var n = !isFinite(+number) ? 0 : +number
            var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
            var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
            var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
            var s = ''

            var toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec)
            return '' + (Math.round(n * k) / k)
                .toFixed(prec)
            }

            // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.')
            if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
            }
            if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
            }

            return s.join(dec)
        }

    </script>
</html>
