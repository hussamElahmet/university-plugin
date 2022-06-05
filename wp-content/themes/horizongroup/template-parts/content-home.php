<?php
global $wpdb;
$slider = $wpdb->get_results('SELECT * FROM slider ORDER BY slider_order');
$team = $wpdb->get_results('SELECT * FROM team ORDER BY team_order');

?>

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

