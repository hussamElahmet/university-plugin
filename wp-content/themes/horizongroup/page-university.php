<?php
get_header();

global $wpdb;

$query;

$university_category = get_query_var('university_category');
$header;
if ($university_category == 'gov') {
    $query = $wpdb->prepare("SELECT * FROM university u INNER JOIN city c ON u.university_city = c.city_id WHERE university_category = '0'");
    $header = 'حكومية';
} elseif ($university_category == 'priv') {
    $query = $wpdb->prepare("SELECT * FROM university u INNER JOIN city c ON u.university_city = c.city_id WHERE university_category = '1'");
    $header = 'خاصة';
} else {
    global $wp_query;
    $wp_query->set_404();
    status_header( 404 );
    get_template_part( 404 ); exit();
}

$result = $wpdb->get_results($query);
?>

<div class="breadcrumb-area">
    <div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-3 pt-100 pb-95" style="background-image:url(<?php echo get_template_directory_uri().'/assets/img/university.jpg' ?>);">
        <div class="container" style="text-align: right" dir="rtl">
            <h2>الجامعات</h2>
            <p><?php echo $header; ?></p>
        </div>
    </div>
</div>
<?php if ($university_category != 'gov' && $university_category != 'priv') {  ?>
<div class="container pt-100 pb-95" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <select id="searchBranch">
                <option value="-1">ابحث عن تخصصك</option>
            </select>
        </div>
    </div>
</div>
<?php }  ?>
<div class="event-area pt-130 pb-130">
    <?php 
    if ($university_category == 'priv') {
        get_template_part('template-parts/content','university-priv',array(
            'result' => $result
        ));
    } elseif ($university_category == 'gov') {
        get_template_part('template-parts/content','university',array(
            'result' => $result
        ));
    }
     
    ?>
</div>


<?php
get_footer();
