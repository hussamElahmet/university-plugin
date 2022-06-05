<?php

global $wpdb;

$result = $args['result'];
?>

<div class="container">
    <div class="row">
        <div class="col-xl-12 col-lg-11">
            <div class="blog-all-wrap mr-40">
                <div class="row" dir="rtl">
                	<?php if (count($result) == 0) { ?>
                		<div class="col-lg-12">
                			<h3 style="text-align: center;">
                				لم يتم العثور على جامعات
                			</h3>
                		</div>
                	<?php } else { ?>
                    <?php for ($i=0; $i < count($result); $i++) {  ?>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="single-blog mb-30">
                            <div class="blog-img" 
                            style="background-image:url(<?php echo $result[$i]->university_logo ?>);"
                            >
                            </div>
                            <div class="blog-content-wrap">
                                <span>
                                    <?php
                                    if ($result[$i]->university_category == 0) {
                                        echo 'حكومية';
                                    } else if($result[$i]->university_category == 1){
                                        echo 'خاصة';
                                    } 
                                    ?>
                                </span>
                                <div class="blog-content">
                                    <h4 style="text-align: right;">
                                        <a href="<?php echo site_url().'/university-detail/'.$result[$i]->university_id  ?>">
                                            <?php echo $result[$i]->university_name  ?>
                                        </a>
                                    </h4>
                                    <p>
                                        <?php echo $result[$i]->city_name  ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }}  ?>
                </div>
            </div>
        </div>
    </div>
</div>