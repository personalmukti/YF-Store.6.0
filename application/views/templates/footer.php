
<?php
$categoriesLimit = $this->Categories_model->getCategoriesLimit();
$setting = $this->Settings_model->getSetting();
$sosmed = $this->Settings_model->getSosmed();
$footerhelp = $this->Settings_model->getFooterHelp();
$footerinfo = $this->Settings_model->getFooterInfo();
$rekening = $this->db->get('rekening');
 ?>
 <?php echo $this->session->flashdata('subscriber'); ?>
    <footer>
        <div class="subscribe"  style="background-color: <?= $this->Settings_model->general()["navbar_color"]; ?> !important">
            <div class="main">
            <div class="text">
                <h2>BERLANGGANAN</h2>
                <p>
                Jika Anda ingin mendapatkan email dari kami setiap kali kami memiliki
                penawaran atau produk baru, silakan subcribe kami!
                </p>
            </div>
            <div class="form">
                <form action="<?= base_url(); ?>subscribe-email" method="post">
                <i class="fa fa-envelope"></i>
                <input type="text" placeholder="Masukan email kamu" autocomplete="off" name="email" /><!--
                            --><button type="submit">Subscribe</button>
                </form>
            </div>
            </div>
        </div>
        <div class="about-for-mobile">
                <h2 class="brand-footer"><?= $this->Settings_model->general()["app_name"]; ?></h2>
                <p>
                <?= $setting['short_desc']; ?>
                </p>
                <div class="sosmed">
                <h3>TEMUKAN KAMI</h3>
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
                <h3 class="title">HALAMAN</h3>
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
        <div class="information information-for-mobile">
            <div class="main">
                <div class="item">
                    <h3 class="title">KATEGORI</h3>
                    <?php foreach($categoriesLimit->result_array() as $c): ?>
                        <a href="<?= base_url(); ?>c/<?= $c['slug']; ?>"><?= $c['name']; ?></a>
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
            <p class="mb-0">Copyright &copy;<span id="footer-cr-years"></span> <?= $this->Settings_model->general()["app_name"]; ?> by Yakha Fashion.</p>
        </div>
        </footer>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="<?= base_url(); ?>assets/js/jquery.countdown.min.js"></script>
    <!-- Bootstrap Star Rating JS -->
    <script src='<?= base_url() ?>assets/vendor/bootstrap-star-rating/js/star-rating.min.js' type='text/javascript'></script>
    <script>

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

    </script>

    <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6200f2e79bd1f31184db4f02/1fr9r9n1i';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</html>
