<?php
get_header();

global $wpdb;


$university_id = get_query_var('university_id');
$university_query = $wpdb->prepare('SELECT * FROM university u INNER JOIN city c ON u.university_city = c.city_id WHERE university_id = %s',$university_id);
$university = $wpdb->get_row($university_query);

?>

<?php

	if (!isset($university->university_id)) {
		global $wp_query;
	    $wp_query->set_404();
	    status_header( 404 );
	    get_template_part( 404 ); exit();
	}

	if ($university->university_category == 0) {
		get_template_part('template-parts/content','university-detail',array(
            'university_id' => $university_id,
            'university' => $university
        ));
	} else if ($university->university_category == 1) {
		get_template_part('template-parts/content','university-detail-priv',array(
            'university_id' => $university_id,
            'university' => $university
        ));
	}
   
?>


<?php
get_footer();
