<?php
get_header();
$category_id = get_option('university_menu_category');
$categories = get_categories(
	array(
	    'hide_empty' => FALSE,
	    'exclude' =>$category_id
	    )
);
?>

<?php if ( have_posts() ) { ?>
<?php while ( have_posts() ) {
		the_post(); ?>
<div class="breadcrumb-area">
    <div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-3 pt-100 pb-95" 
    style="background-image:url(<?php echo get_template_directory_uri().'/assets/img/blog.jpg' ?>);">
        <div class="container" dir="rtl" style="text-align: right;">
            <h2><?php the_title(); ?></h2>
            <p><?php the_excerpt() ;?></p>
        </div>
    </div>
</div>
<div class="event-area pt-130 pb-130">
    <div class="container" dir="rtl">
        <div class="row">
            <div class="col-xl-9 col-lg-8 order-2" >
                <div class="blog-details-wrap mr-40">
                    <div class="blog-details-top" style="text-align: right;">
                        <img src="<?php the_post_thumbnail_url() ;?>" alt="">
                        <div class="blog-details-content-wrap">
                            <div class="b-details-meta-wrap">
                                <div class="b-details-meta">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> <?php the_time( 'F j, Y' ); ?></li>
                                        <li><i class="fa fa-user"></i> <?php the_author(); ?></li>
                                    </ul>
                                </div>
                                <span class="icon-users"><?php the_author(); ?></span>
                            </div>
                            <h3><?php the_title(); ?></h3>
                            <p><?php the_content(); ?></p>
                            <div class="blog-share-tags">
                                <div class="blog-tag">
                                    <?php the_category();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 order-1" style="text-align: right;">
                <div class="sidebar-style">
                    <div class="sidebar-category mb-40">
                        <div class="sidebar-title mb-40">
                            <h4>فئات الأخبار</h4>
                        </div>
                        <div class="category-list">
                            <ul>
                            	<?php 
                            	for ($i=0; $i < count($categories); $i++) {
                            		$category_url = get_category_link($categories[$i]->cat_ID);
                            	  ?>
                            		<li>
                            			<a href="<?php echo $category_url; ?>">
                            				<?php echo $categories[$i]->cat_name; ?> 
                            				<span><?php echo $categories[$i]->count; ?></span>
                            			</a>
                            		</li>
                            	<?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }} ?>


<?php get_footer(); ?>
