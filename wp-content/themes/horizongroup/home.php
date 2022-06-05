<?php
get_header();
$category_id = get_option('university_menu_category');
$categories = get_categories(
	array(
	    'hide_empty' => FALSE,
	    'exclude' =>$category_id
	    )
);
$the_query = new WP_Query(array(
        'category__not_in'=>$category_id
    ));
// print_r(json_encode($categories));
?>
<div class="breadcrumb-area">
    <div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-3 pt-100 pb-95" style="background-image:url(<?php echo get_template_directory_uri().'/assets/img/blog.jpg' ?>);">
        <div class="container" dir="rtl" style="text-align: right">
            <h2>الأخبار</h2>
            <p>جميع الأخبار التي تتعلق بالدراسة في تركيا</p>
        </div>
    </div>
</div>
<div class="event-area pt-130 pb-130">
    <div class="container">
        <div class="row" dir="rtl">
            <div class="col-xl-9 col-lg-8 order-2">
                <div class="blog-all-wrap mr-40">
                    <div class="row">
                    	<?php
							if ( $the_query->have_posts() ) {
								while ( $the_query->have_posts() ) {
									$the_query->the_post();
									?>
									<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12">
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
            <div class="col-xl-3 col-lg-4 order-1" dir="rtl" style="text-align: right;">
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



<?php
get_footer();
