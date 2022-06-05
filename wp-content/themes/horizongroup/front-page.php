<?php


get_header();
$university_id = get_query_var('university_id');
?>

<?php

	get_template_part('template-parts/content','home');

?>

<?php
get_footer();
