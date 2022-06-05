<?php

global $wpdb;

$post_number = $args['post_number'];
$the_query = new WP_Query( array(
    'posts_per_page' => $post_number
)); 
?>

<div class="swiper-container soonu-slider">
    <div class="swiper-wrapper">
        
            <?php
                if ( $the_query->have_posts() ) {
                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();
                        ?>
                        <div class="swiper-slide justify-content-center">
                            <div class="col-12">
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
    <div class="soonu-slider-next swiper-button-next"></div>
    <div class="soonu-slider-prev swiper-button-prev"></div>
</div>