<?php
global $wpdb;
$slider = $wpdb->get_results('SELECT * FROM slider ORDER BY slider_order');
$team = $wpdb->get_results('SELECT * FROM team ORDER BY team_order');

?>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900|Material+Icons'>
<style>


@media screen and (max-width: 800px) {
    .containerhussam {
        margin-left:-1rem;
    margin-top: 4rem;
    text-align: -webkit-center;
}
}
@media screen and (min-width: 900px) {
    .containerhussam {
        margin-left: 40rem;
    margin-top: 4rem;
}
}



.btn {
  outline: 0;
  display: inline-flex;
  align-items: center;
  justify-content: space-between;
  background: #5380F7;
  min-width: 260px;
  border: 0;
  border-radius: 4px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  box-sizing: border-box;
  padding: 16px 20px;
  color: #FFFFFF;
  font-size: 18px;
  font-weight: 600;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  overflow: hidden;
  cursor: pointer;
}
.btn:focus .dropdown, .btn:active .dropdown {
  -webkit-transform: translate(0, 20px);
          transform: translate(0, 20px);
  opacity: 1;
  visibility: visible;
}
.btn .material-icons {
  border-radius: 100%;
  -webkit-animation: ripple 0.6s linear infinite;
          animation: ripple 0.6s linear infinite;
}
.btn .dropdown {
  position: absolute;
  top: 100%;
  left: 0;
  background: #FFFFFF;
  width: 100%;
  border-radius: 4px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  text-align: left;
  opacity: 0;
  visibility: hidden;
  transition: 0.3s ease;
}
.btn .dropdown:before {
  content: '';
  position: absolute;
  top: -6px;
  left: 20px;
  width: 0;
  height: 0;
  box-shadow: 2px -2px 6px rgba(0, 0, 0, 0.05);
  border-top: 6px solid #FFFFFF;
  border-right: 6px solid #FFFFFF;
  border-bottom: 6px solid transparent;
  border-left: 6px solid transparent;
  -webkit-transform: rotate(-45deg);
          transform: rotate(-45deg);
  mix-blend-mode: multiple;
}
.btn .dropdown li {
  z-index: 1;
  position: relative;
  background: #FFFFFF;
  padding: 0 20px;
  color: #666;
}
.btn .dropdown li.active {
  color: #5380F7;
}
.btn .dropdown li:first-child {
  border-radius: 4px 4px 0 0;
}
.btn .dropdown li:last-child {
  border-radius: 0 0 4px 4px;
}
.btn .dropdown li:last-child a {
  border-bottom: 0;
}
</style>
</head>
<div class="slider-area">
    <div class="slider-active owl-carousel">
    <?php for ($i=0; $i < count($slider); $i++) {  ?>
        <div class="single-slider slider-height-4 bg-img" 
        style="background-image:url(<?php echo $slider[$i]->slider_image ?>);">
            <div class="container-fluid h-100 text-center" dir="rtl">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                        <div class="slider-content py-3" style="background-color:#0000006e">
                            <h1 class=""><?php echo $slider[$i]->slider_title ?></h1>
                            <!--<p class="animated"><?php echo $slider[$i]->slider_description ?></p>-->
                        </div>
                    </div>
                </div>
                <!--<div class="slider-single-img slider-animated-1">-->
                <!--    <img class="animated" src="<?php echo get_template_directory_uri().'/assets/img/logo.png' ?>" alt="">-->
                <!--</div>-->
            </div>
        </div>
    <?php }  ?>
    </div>
</div>
<div class="choose-us section-padding-1">
    <div class="container-fluid" dir="rtl">
        <div class="row no-gutters choose-negative-mrg justify-content-center" >
            <div class="col-lg-3 col-md-6">
                <div class="single-choose-us choose-bg-light-blue">
                    <div class="choose-img">
                        <img class="animated" 
                        src="<?php echo get_template_directory_uri().'/assets/img/icon-img/service-1.png' ?>" 
                        alt="">
                    </div>
                    <div class="choose-content">
                        <h3>قبولك الجامعي مجانا</h3>
                        <p>نقدم لكم خدمة القبول مجانا في في جميع الجامعات الخاصة التركية </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-choose-us choose-bg-yellow">
                    <div class="choose-img">
                        <img class="animated" src="<?php echo get_template_directory_uri().'/assets/img/icon-img/service-1.png' ?>" alt="">
                    </div>
                    <div class="choose-content">
                        <h3>الاستشارات المجانية</h3>
                        <p>تهتم هوريزون كروب بتقديم جميع الاستشارات التعليمية والقانونية مجانا خلال مدة اقامة الطالب في تركيا</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-choose-us choose-bg-blue">
                    <div class="choose-img">
                        <img class="animated" src="<?php echo get_template_directory_uri().'/assets/img/icon-img/service-1.png' ?>" alt="">
                    </div>
                    <div class="choose-content">
                        <h3>تحضير ملفات الاقامة مجانا</h3>
                        <p>تقدم هوريزون كروب خدمات تجهيز ملف الاقامة للطالب مجانا</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-choose-us choose-bg-green">
                    <div class="choose-img">
                        <img class="animated" src="<?php echo get_template_directory_uri().'/assets/img/icon-img/service-1.png' ?>" alt="">
                    </div>
                    <div class="choose-content">
                        <h3>ترجمة الاوراق الرسمية مجانا</h3>
                        <p>خدمات ترجمة لجميع طلابنا مجانا خلال فترة دراستهم في تركيا</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  <!-- Btn-->
  <div class="containerhussam"> 
  <button class="btn" onclick="location.href='<?php echo site_url().'/search-branch/'; ?>'" ><span>ابحث عن تخصصك</span><i class="material-icons">public</i>

  </button>
    </div>
<div class="blog-area pt-130 pb-100">
    <div class="container" dir="rtl" style="text-align: center;">
        <div class="section-title mb-75">
            <h2>آخر <span>الأخبار</span></h2>
            <p>آخر أخبارنا عن ما يتعلق بالتعليم في تركيا</p>
        </div>
        <?php get_template_part('template-parts/content','latest-news',array(
            'post_number' => 10
        )); ?>
    </div>
</div>

