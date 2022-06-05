<?php
get_header();

global $wpdb;

$query;

$exam_slug = get_query_var('exam_slug');
$query = $wpdb->prepare("SELECT *  FROM exam WHERE exam_slug = %s",$exam_slug);
$result = $wpdb->get_row($query);

if (!isset($result->exam_id)) {
    global $wp_query;
    $wp_query->set_404();
    status_header( 404 );
    get_template_part( 404 ); exit();
}

?>

<div class="breadcrumb-area">
    <div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-3 pt-100 pb-95" style="background-image:url(<?php echo get_template_directory_uri().'/assets/img/exam.jpg' ?>);">
        <div class="container" style="text-align: right" dir="rtl">
            <h2><?php echo 'امتحان ال'.$result->exam_name ?></h2>
        </div>
    </div>
</div>

<div class="container pt-100 pb-95" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-12" style="text-align: right">
            <?php echo $result->exam_description; ?>
        </div>
    </div>
</div>

<?php
    
    if ($exam_slug == 'yos') {
        $yos_calendar = $wpdb->get_results("SELECT * FROM university u INNER JOIN city c ON u.university_city = c.city_id INNER JOIN yos_calendar yc ON u.university_id = yc.university_id ORDER BY yc.yos_end_date");
        get_template_part('template-parts/content','yos-calendar',array(
            'result' => $yos_calendar
        ));
    }

?>

<?php
get_footer();
