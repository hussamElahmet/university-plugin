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
                        <div class="one_university">
                            <div class="university_logo"
                            style="background-image: url(<?php echo $result[$i]->university_logo ?>);">
                            </div>
                            <div class="university_name">
                                <?php echo $result[$i]->university_name ?>
                            </div>
                            <div class="university_city">
                                <?php echo $result[$i]->city_name ?>
                            </div>
                            <div class="university_more">
                                <a href="<?php echo site_url().'/university-detail/'.$result[$i]->university_id  ?>" class="btn btn-primary">اقرأ المزيد</a>
                            </div>
                        </div>
                    </div>
                    <?php }}  ?>
                    

                    
                </div>
            </div>
        </div>
    </div>
</div>