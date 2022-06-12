<?php 
$facebook = get_option('university_facebook');
$instagram = get_option('university_instagram');
$telegram = get_option('university_telegram');
?>
			
<footer class="footer-area">
    <div class="footer-top bg-img default-overlay pt-130 pb-80">
        <div class="container" dir="rtl" style="text-align: right;">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget mb-40">
                        <div class="footer-title">
                            <h4>من نحن</h4>
                        </div>
                        <div class="footer-about" style="text-align: justify;">
                            <p>
                    نعمل منذ عام 2012 وحتى وقتنا الحاضر على مزاولة نشاطنا مع كوادرنا الاستشارية التعليمية الخبيرة في
مجال عملها حيث نحرص على توفير المساندة للطلاب الأجانب اللذين يرغبون في مواصلة التعليم في تركيا. من خلال تبني مسؤولية
تقديم كل الاستشارات اللازمة واتمام عملية التسجيل في الجامعات الحكومية والخاصة . وتجهيز الطالب لدخول امتحانات القبول
الجامعي .ومن ناحية اخرى ومثلما هو الحال في جميع انحاء تركيا يحرص مقر شركتنا في انقرة على تطوير نشاطه في هذا المجال من
خلال تعاونه مع وكالات متنوعة في خارج البلاد</p>
                            <div class="f-contact-info">
                                <div class="single-f-contact-info">
                                    <i class="fa fa-home"></i>
                                    <span><?php echo get_option('university_address'); ?></span>
                                </div>
                                <div class="single-f-contact-info">
                                    <i class="fa fa-envelope-square"></i>
                                    <?php $site_email = get_option('university_email'); ?>
                                    <span><a href="<?php echo 'mailto:'.$site_email; ?>"><?php echo $site_email; ?></a></span>
                                </div>
                                <?php 
                                $site_tel = get_option('university_tel');
                                $site_tel1 = get_option('university_tel1');
                                $site_tel2 = get_option('university_tel2');
                                $site_tel3 = get_option('university_tel3');
                                if($site_tel != ''){
                                    ?>
                                    <div class="single-f-contact-info">
                                        <i class="fa fa-phone"></i>
                                        <span><a href="<?php echo 'tel:'.$site_tel; ?>"><?php echo $site_tel; ?></a></span>
                                    </div>
                                    <?php
                                }
                                
                                if($site_tel1 != ''){
                                    ?>
                                    <div class="single-f-contact-info">
                                        <i class="fa fa-phone"></i>
                                        <span><a href="<?php echo 'tel:'.$site_tel1; ?>"><?php echo $site_tel1; ?></a></span>
                                    </div>
                                    <?php
                                }
                                
                                if($site_tel2 != ''){
                                    ?>
                                    <div class="single-f-contact-info">
                                        <i class="fa fa-phone"></i>
                                        <span><a href="<?php echo 'tel:'.$site_tel2; ?>"><?php echo $site_tel2; ?></a></span>
                                    </div>
                                    <?php
                                }
                                
                                if($site_tel3 != ''){
                                    ?>
                                    <div class="single-f-contact-info">
                                        <i class="fa fa-phone"></i>
                                        <span><a href="<?php echo 'tel:'.$site_tel3; ?>"><?php echo $site_tel3; ?></a></span>
                                    </div>
                                    <?php
                                }
                                
                                ?>
                                
                                <!--<div class="single-f-contact-info">-->
                                <!--    <i class="fa fa-phone"></i>-->
                                <!--    <?php $site_tel1 = get_option('university_tel1'); ?>-->
                                <!--    <span><a href="<?php echo 'tel:'.$site_tel1; ?>"><?php echo $site_tel1; ?></a></span>-->
                                <!--</div>-->
                                <!--<div class="single-f-contact-info">-->
                                <!--    <i class="fa fa-phone"></i>-->
                                <!--    <?php $site_tel2 = get_option('university_tel2'); ?>-->
                                <!--    <span><a href="<?php echo 'tel:'.$site_tel2; ?>"><?php echo $site_tel2; ?></a></span>-->
                                <!--</div>-->
                                <!--<div class="single-f-contact-info">-->
                                <!--    <i class="fa fa-phone"></i>-->
                                <!--    <?php $site_tel3 = get_option('university_tel3'); ?>-->
                                <!--    <span><a href="<?php echo 'tel:'.$site_tel3; ?>"><?php echo $site_tel3; ?></a></span>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer-widget mb-40">
                        <div class="footer-title">
                            <h4>روابط سريعة</h4>
                        </div>
                        <div class="footer-list">
                            <ul>
                                <li><a href="<?php echo site_url();?>">الرئيسية</a></li>
                                <!-- <li><a href="<?php echo site_url().'/university/gov';?>"> الجامعات الحكومية</a></li> -->
                                <li><a href="<?php echo site_url().'/university/priv';?>">الجامعات الخاصة</a></li>
                                <li><a href="<?php echo site_url().'/search-branch/';?>">ابحث عن تخصصك</a></li>
                                <!-- <li><a href="<?php echo site_url().'/calendar/app';?>">تقويم المفاضلات</a></li>
                                <li><a href="<?php echo site_url().'/exam/yos';?>">تقويم اليوس</a></li> -->
                                <li><a href="<?php echo site_url().'/blog/';?>">الأخبار</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="footer-widget negative-mrg-30 mb-40">
                        <div class="footer-title">
                            <h4>آخر الأخبار</h4>
                        </div>
                        <div class="footer-list">
                            <?php
                            $the_query = new WP_Query( array(
                                'posts_per_page' => 5
                            )); 
                            ?>
                            <ul>
                            <?php
                            if ( $the_query->have_posts() ) {
                                while ( $the_query->have_posts() ) {
                                    $the_query->the_post();
                            ?>
                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                            <?php }} ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-widget mb-40">
                        <div class="footer-gallery">
                            <img src="<?php echo get_template_directory_uri().'/assets/img/logo.png'?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom pt-15 pb-15">
        <div class="container" dir="rtl" style="text-align: right;">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-12">
                    <div class="copyright">
                        <p>
                            <span style="color: #000">Horizon Group </span>©
                            كل الحقوق محفوظة
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class = "socialfloating"></div>

<!-- JS
============================================ -->




<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<?php wp_footer(); ?>

<script type="text/javascript">
    $.socialfloating({
        buttons: [[{
            icon: "fab fa-facebook",
            enabled: !0,
            link: "<?php echo $facebook; ?>",
            color: "#000"
        }, {
            icon: "fab fa-instagram",
            enabled: !0,
            link: "<?php echo $instagram; ?>",
            color: "#d94848"
        }, {
            icon: "fab fa-telegram",
            enabled: !0,
            link: "<?php echo 'https://t.me/'.$telegram; ?>",
            color: "#00aced"
        }]],
        container:'socialfloating'
    });
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0T3V6CDLPV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0T3V6CDLPV');
  gtag('send', 'pageview', location.pathname);
</script>
</body>

</html>
<!--
<p>
<a href="http://www.gercekescort.com/escort/adana-escort/" target="_blank" title="adana escort" >adana escort</a>
<a href="http://www.gercekescort.com/escort/adiyaman-escort/" target="_blank" title="adıyaman escort" >adıyaman escort</a>
<a href="http://www.gercekescort.com/escort/afyon-escort/" target="_blank" title="afyon escort" >afyon escort</a>
<a href="http://www.gercekescort.com/escort/agri-escort/" target="_blank" title="ağrı escort" >ağrı escort</a>
<a href="http://www.gercekescort.com/escort/aksaray-escort/" target="_blank" title="aksaray escort" >aksaray escort</a>
<a href="http://www.gercekescort.com/escort/amasya-escort/" target="_blank" title="amasya escort" >amasya escort</a>
<a href="http://www.gercekescort.com/escort/ankara-escort/" target="_blank" title="ankara escort" >ankara escort</a>
<a href="http://www.gercekescort.com/escort/antalya-escort/" target="_blank" title="antalya escort" >antalya escort</a>
<a href="http://www.gercekescort.com/escort/ardahan-escort/" target="_blank" title="ardahan escort" >ardahan escort</a>
<a href="http://www.gercekescort.com/escort/artvin-escort/" target="_blank" title="artvin escort" >artvin escort</a>
<a href="http://www.gercekescort.com/escort/aydin-escort/" target="_blank" title="aydın escort" >aydın escort</a>
<a href="http://www.gercekescort.com/escort/balikesir-escort/" target="_blank" title="balıkesir escort" >balıkesir escort</a>
<a href="http://www.gercekescort.com/escort/bartin-escort/" target="_blank" title="bartın escort" >bartın escort</a>
<a href="http://www.gercekescort.com/escort/batman-escort/" target="_blank" title="batman escort" >batman escort</a>
<a href="http://www.gercekescort.com/escort/bayburt-escort/" target="_blank" title="bayburt escort" >bayburt escort</a>
<a href="http://www.gercekescort.com/escort/bilecik-escort/" target="_blank" title="bilecik escort" >bilecik escort</a>
<a href="http://www.gercekescort.com/escort/bingol-escort/" target="_blank" title="bingöl escort" >bingöl escort</a>
<a href="http://www.gercekescort.com/escort/bitlis-escort/" target="_blank" title="bitlis escort" >bitlis escort</a>
<a href="http://www.gercekescort.com/escort/bolu-escort/" target="_blank" title="bolu escort" >bolu escort</a>
<a href="http://www.gercekescort.com/escort/burdur-escort/" target="_blank" title="burdur escort" >burdur escort</a>
<a href="http://www.gercekescort.com/escort/bursa-escort/" target="_blank" title="bursa escort" >bursa escort</a>
<a href="http://www.gercekescort.com/escort/canakkale-escort/" target="_blank" title="çanakkale escort" >çanakkale escort</a>
<a href="http://www.gercekescort.com/escort/cankiri-escort/" target="_blank" title="çankırı escort" >çankırı escort</a>
<a href="http://www.gercekescort.com/escort/corum-escort/" target="_blank" title="çorum escort" >çorum escort</a>
<a href="http://www.gercekescort.com/escort/denizli-escort/" target="_blank" title="denizli escort" >denizli escort</a>
<a href="http://www.gercekescort.com/escort/diyarbakir-escort/" target="_blank" title="diyarbakır escort" >diyarbakır escort</a>
<a href="http://www.gercekescort.com/escort/duzce-escort/" target="_blank" title="düzce escort" >düzce escort</a>
<a href="http://www.gercekescort.com/escort/edirne-escort/" target="_blank" title="edirne escort" >edirne escort</a>
<a href="http://www.gercekescort.com/escort/elazig-escort/" target="_blank" title="elazığ escort" >elazığ escort</a>
<a href="http://www.gercekescort.com/escort/erzincan-escort/" target="_blank" title="erzincan escort" >erzincan escort</a>
<a href="http://www.gercekescort.com/escort/erzurum-escort/" target="_blank" title="erzurum escort" >erzurum escort</a>
<a href="http://www.gercekescort.com/escort/eskisehir-escort/" target="_blank" title="eskişehir escort" >eskişehir escort</a>
<a href="http://www.gercekescort.com/escort/gaziantep-escort/" target="_blank" title="gaziantep escort" >gaziantep escort</a>
<a href="http://www.gercekescort.com/escort/gebze-escort/" target="_blank" title="gebze escort" >gebze escort</a>
<a href="http://www.gercekescort.com/escort/giresun-escort/" target="_blank" title="giresun escort" >giresun escort</a>
<a href="http://www.gercekescort.com/escort/gumushane-escort/" target="_blank" title="gümüşhane escort" >gümüşhane escort</a>
<a href="http://www.gercekescort.com/escort/hakkari-escort/" target="_blank" title="hakkari escort" >hakkari escort</a>
<a href="http://www.gercekescort.com/escort/hatay-escort/" target="_blank" title="hatay escort" >hatay escort</a>
<a href="http://www.gercekescort.com/escort/igdir-escort/" target="_blank" title="ığdır escort" >ığdır escort</a>
<a href="http://www.gercekescort.com/escort/isparta-escort/" target="_blank" title="ısparta escort" >ısparta escort</a>
<a href="http://www.gercekescort.com/escort/istanbul-escort/" target="_blank" title="istanbul escort" >istanbul escort</a>
<a href="http://www.gercekescort.com/escort/izmir-escort/" target="_blank" title="izmir escort" >izmir escort</a>
<a href="http://www.gercekescort.com/escort/izmit-escort/" target="_blank" title="izmit escort" >izmit escort</a>
<a href="http://www.gercekescort.com/escort/kahramanmaras-escort/" target="_blank" title="kahramanmaraş escort" >kahramanmaraş escort</a>
<a href="http://www.gercekescort.com/escort/karabuk-escort/" target="_blank" title="karabük escort" >karabük escort</a>
<a href="http://www.gercekescort.com/escort/karaman-escort/" target="_blank" title="karaman escort" >karaman escort</a>
<a href="http://www.gercekescort.com/escort/kars-escort/" target="_blank" title="kars escort" >kars escort</a>
<a href="http://www.gercekescort.com/escort/kastamonu-escort/" target="_blank" title="kastamonu escort" >kastamonu escort</a>
<a href="http://www.gercekescort.com/escort/kayseri-escort/" target="_blank" title="kayseri escort" >kayseri escort</a>
<a href="http://www.gercekescort.com/escort/kilis-escort/" target="_blank" title="kilis escort" >kilis escort</a>
<a href="http://www.gercekescort.com/escort/kirikkale-escort/" target="_blank" title="kırıkkale escort" >kırıkkale escort</a>
<a href="http://www.gercekescort.com/escort/kirklareli-escort/" target="_blank" title="kırklareli escort" >kırklareli escort</a>
<a href="http://www.gercekescort.com/escort/kirsehir-escort/" target="_blank" title="kırşehir escort" >kırşehir escort</a>
<a href="http://www.gercekescort.com/escort/kocaeli-escort/" target="_blank" title="kocaeli escort" >kocaeli escort</a>
<a href="http://www.gercekescort.com/escort/konya-escort/" target="_blank" title="konya escort" >konya escort</a>
<a href="http://www.gercekescort.com/escort/kutahya-escort/" target="_blank" title="kütahya escort" >kütahya escort</a>
<a href="http://www.gercekescort.com/escort/malatya-escort/" target="_blank" title="malatya escort" >malatya escort</a>
<a href="http://www.gercekescort.com/escort/manisa-escort/" target="_blank" title="manisa escort" >manisa escort</a>
<a href="http://www.gercekescort.com/escort/mardin-escort/" target="_blank" title="mardin escort" >mardin escort</a>
<a href="http://www.gercekescort.com/escort/mersin-escort/" target="_blank" title="mersin escort" >mersin escort</a>
<a href="http://www.gercekescort.com/escort/mugla-escort/" target="_blank" title="muğla escort" >muğla escort</a>
<a href="http://www.gercekescort.com/escort/mus-escort/" target="_blank" title="muş escort" >muş escort</a>
<a href="http://www.gercekescort.com/escort/nevsehir-escort/" target="_blank" title="nevşehir escort" >nevşehir escort</a>
<a href="http://www.gercekescort.com/escort/nigde-escort/" target="_blank" title="niğde escort" >niğde escort</a>
<a href="http://www.gercekescort.com/escort/ordu-escort/" target="_blank" title="ordu escort" >ordu escort</a>
<a href="http://www.gercekescort.com/escort/osmaniye-escort/" target="_blank" title="osmaniye escort" >osmaniye escort</a>
<a href="http://www.gercekescort.com/escort/rize-escort/" target="_blank" title="rize escort" >rize escort</a>
<a href="http://www.gercekescort.com/escort/sakarya-escort/" target="_blank" title="sakarya escort" >sakarya escort</a>
<a href="http://www.gercekescort.com/escort/samsun-escort/" target="_blank" title="samsun escort" >samsun escort</a>
<a href="http://www.gercekescort.com/escort/sanliurfa-escort/" target="_blank" title="şanlıurfa escort" >şanlıurfa escort</a>
<a href="http://www.gercekescort.com/escort/siirt-escort/" target="_blank" title="siirt escort" >siirt escort</a>
<a href="http://www.gercekescort.com/escort/sinop-escort/" target="_blank" title="sinop escort" >sinop escort</a>
<a href="http://www.gercekescort.com/escort/sirnak-escort/" target="_blank" title="şırnak escort" >şırnak escort</a>
<a href="http://www.gercekescort.com/escort/sivas-escort/" target="_blank" title="sivas escort" >sivas escort</a>
<a href="http://www.gercekescort.com/escort/tekirdag-escort/" target="_blank" title="tekirdağ escort" >tekirdağ escort</a>
<a href="http://www.gercekescort.com/escort/tokat-escort/" target="_blank" title="tokat escort" >tokat escort</a>
<a href="http://www.gercekescort.com/escort/trabzon-escort/" target="_blank" title="trabzon escort" >trabzon escort</a>
<a href="http://www.gercekescort.com/escort/tunceli-escort/" target="_blank" title="tunceli escort" >tunceli escort</a>
<a href="http://www.gercekescort.com/escort/usak-escort/" target="_blank" title="uşak escort" >uşak escort</a>
<a href="http://www.gercekescort.com/escort/van-escort/" target="_blank" title="van escort" >van escort</a>
<a href="http://www.gercekescort.com/escort/yalova-escort/" target="_blank" title="yalova escort" >yalova escort</a>
<a href="http://www.gercekescort.com/escort/yozgat-escort/" target="_blank" title="yozgat escort" >yozgat escort</a>
<a href="http://www.gercekescort.com/escort/zonguldak-escort/" target="_blank" title="zonguldak escort" >zonguldak escort</a>
</p> -->