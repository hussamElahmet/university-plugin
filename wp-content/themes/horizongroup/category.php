<?php
get_header();
?>
<div class="breadcrumb-area">
    <div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-3 pt-100 pb-95" style="background-image:url(<?php echo get_template_directory_uri().'/assets/img/blog.jpg' ?>);">
        <div class="container" dir="rtl" style="text-align: right">
            <h2><?php single_cat_title(); ?></h2>
            <p><?php echo category_description(); ?></p>
        </div>
    </div>
</div>
<div class="event-area pt-130 pb-130">
    <div class="container">
        <div class="row" dir="rtl">
            <div class="col-xl-12 col-lg-8 order-2">
                <div class="blog-all-wrap mr-40">
                    <div class="row">
                    	<?php
							if ( have_posts() ) {
								while ( have_posts() ) {
									the_post();
									?>
									<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
			                            <div class="single-blog mb-30" style="text-align: right">
			                                <div class="blog-img" 
			                                style="background:url(<?php the_post_thumbnail_url(); ?>);">

			                                </div>
			                                <div class="blog-content-wrap">
			                                    <span><?php the_author(); ?></span>
			                                    <div class="blog-content">
				                                    <h4>
				                                        <a href="<?php the_permalink(); ?>">
				                                        	<?php the_title(); ?>
				                                        </a>
				                                    </h4>
				                                    <!-- <p><?php the_excerpt() ;?></p> -->
				                                    <p><?php the_category( ' | ' );?></p>
			                                    </div>
			                                    <div class="blog-date">
			                                        <a href="<?php the_permalink(); ?>">
			                                        	<i class="fa fa-calendar-o"></i> 
			                                        	<?php the_time( 'F jS, Y' ); ?>
			                                    	</a>
			                                    </div>
			                                </div>
			                            </div>
			                        </div>
									<?php
								}
							} else {
								?>
									<h3>لا توجد منشورات</h3>
								<?php

							}
						?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
get_footer();
