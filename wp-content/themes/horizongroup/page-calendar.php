<?php
get_header();

global $wpdb;

$query;

$calendar_category = get_query_var('calendar_category');
$header;
if ($calendar_category == 'app') {
    $query = $wpdb->prepare("SELECT * FROM university u INNER JOIN city c ON u.university_city = c.city_id INNER JOIN app_calendar ac ON u.university_id = ac.university_id ORDER BY ac.app_end_date");
    $header = 'تقويم المفاضلات';
} elseif ($calendar_category == 'yos') {
    $query = $wpdb->prepare("SELECT * FROM university u INNER JOIN city c ON u.university_city = c.city_id INNER JOIN yos_calendar yc ON u.university_id = yc.university_id");
    $header = 'تقويم اليوس';
} else {
    global $wp_query;
    $wp_query->set_404();
    status_header( 404 );
    get_template_part( 404 ); exit();
}

$result = $wpdb->get_results($query);
?>

<div class="breadcrumb-area">
    <div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-3 pt-100 pb-95" style="background-image:url(<?php echo get_template_directory_uri().'/assets/img/calendar.jpg' ?>);">
        <div class="container" style="text-align: right" dir="rtl">
            <h2><?php echo $header ?></h2>
        </div>
    </div>
</div>

<div class="event-area pt-130 pb-130">
   <?php
    if ($calendar_category == 'app') {
        get_template_part('template-parts/content','app-calendar',array(
            'result' => $result
        )); 
    } elseif ($calendar_category == 'yos') {
        get_template_part('template-parts/content','yos-calendar',array(
            'result' => $result
        ));
    } 
   
    ?>
</div>

<?php

get_footer();
