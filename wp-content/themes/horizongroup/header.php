<?php 
$category_id = get_option('university_menu_category');
$parent_category = get_category($category_id);
$parent_category_url = get_category_link($category_id);
$child_categories=get_categories(
    array( 'parent' => $category_id ,'hide_empty' => FALSE )
);

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Horizon Group</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri().'/assets/img/favicon.png' ?>">
    
    <!-- CSS
	============================================ -->
   
    <?php wp_head(); ?>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>

<body>
<header class="header-area">
    <div class="header-bottom sticky-bar clearfix">
        <div class="container align-items-center">
            <div class="row">
                <div class="col-lg-2 col-md-6 col-4">
                    <div class="logo">
                        <a href="<?php echo site_url(); ?>">
                            <img alt="" src="<?php echo get_template_directory_uri().'/assets/img/logo.png' ?>">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10 col-md-6 col-8" >
                    <div class="menu-cart-wrap">
                        <div class="main-menu" dir="rtl">
                            <nav>
                                <ul>
                                    <li><a href="<?php echo site_url(); ?>"> الرئيسية </a></li>
                                    <li><a href="<?php echo site_url().'/university/priv/';  ?>">الجامعات الخاصة</a></li>
                                    <!-- <li><a href="<?php echo site_url().'/university/gov/'; ?>">الجامعات الحكومية</a></li> -->
                                    <!-- <li><a href="<?php echo site_url().'/calendar/app/'; ?>">تقويم المفاضلات</a></li> -->
                                    <!-- <li><a href="#">الامتحانات <i class="fa fa-angle-down"></i> </a>
                                        <ul class="submenu">
                                            <li><a href="<?php echo site_url().'/exam/yos/'; ?>">
                                                امتحان اليوس – تقويم اليوس
                                            </a></li>
                                            <li><a href="<?php echo site_url().'/exam/sat/'; ?>">السات</a></li>
                                            <li><a href="<?php echo site_url().'/exam/tomer/'; ?>">التومر</a></li>
                                            
                                        </ul>
                                    </li> -->
                                    <li><a href="<?php echo site_url().'/search-branch/'; ?>">ابحث عن تخصصك</a></li>
                                    <li><a href="<?php echo site_url().'/blog/'; ?>"> الأخبار  </a>
                                    </li>
                                    <li>
                                    <a href="<?php echo $parent_category_url ?>"><?php echo $parent_category->cat_name ?> 
                                        <?php if (count($child_categories)>0) { ?>
                                            <i class="fa fa-angle-down"></i> 
                                        <?php } ?>
                                    </a>
                                        <?php if (count($child_categories)==0) {
                                            
                                        } else { ?>
                                        
                                        <ul class="submenu">
                                        <?php for ($i=0; $i < count($child_categories) ; $i++) {
                                            $category_url = get_category_link($child_categories[$i]->cat_ID);
                                         ?>
                                            <li>
                                                <a href="<?php echo $category_url ?>">
                                                <?php echo $child_categories[$i]->cat_name; ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                        <?php  } ?>
                                        </ul>

                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="cart-search-wrap">
                            <div class="cart-wrap">
                                <button class="language-wrap" style="font-size:13px">
                                    <img src="<?php echo get_template_directory_uri().'/assets/img/saudi-arabia.png' ?>"> AR
                                </button>
                                <div class="languages">
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="<?php echo site_url().'/maintenance/'; ?>">
                                                <img src="<?php echo get_template_directory_uri().'/assets/img/english.png' ?>"> EN
                                            </a>
                                        </div>
                                        <div class="col-12">
                                            <a href="<?php echo site_url().'/maintenance/'; ?>">
                                                <img src="<?php echo get_template_directory_uri().'/assets/img/turkish.png' ?>"> TR
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-area" dir="rtl">
                <div class="mobile-menu">
                    <nav id="mobile-menu-active">
                        <ul class="menu-overflow">
                            <li><a href="<?php echo site_url(); ?>"> الرئيسية </a></li>
                            <li><a href="<?php echo site_url().'/university/priv/'; ?>">الجامعات الخاصة</a></li>
                            <!-- <li><a href="<?php echo site_url().'/university/gov/'; ?>">الجامعات الحكومية</a></li>
                            <li><a href="<?php echo site_url().'/calendar/app/'; ?>">تقويم المفاضلات</a></li>
                            <li><a href="#">الامتحانات  </a>
                                <ul>
                                    <li><a href="<?php echo site_url().'/exam/yos/'; ?>">
                                        امتحان اليوس – تقويم اليوس
                                    </a></li>
                                    <li><a href="<?php echo site_url().'/exam/sat/'; ?>">السات</a></li>
                                    <li><a href="<?php echo site_url().'/exam/tomer/'; ?>">التومر</a></li>
                                    
                                </ul>
                            </li> -->
                            <li><a href="<?php echo site_url().'/search-branch/'; ?>">ابحث عن تخصصك</a></li>
                            <li><a href="<?php echo site_url().'/blog/'; ?>"> الأخبار  </a>
                            </li>
                            <li>
                            <a href="<?php echo $parent_category_url ?>"><?php echo $parent_category->cat_name ?> 
                            </a>
                                <?php if (count($child_categories)==0) {
                                    
                                } else { ?>
                                
                                <ul>
                                <?php for ($i=0; $i < count($child_categories) ; $i++) {
                                    $category_url = get_category_link($child_categories[$i]->cat_ID);
                                 ?>
                                    <li>
                                        <a href="<?php echo $category_url ?>">
                                        <?php echo $child_categories[$i]->cat_name; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php  } ?>
                                </ul>

                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>


<?php

