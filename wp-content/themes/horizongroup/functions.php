<?php

function hozirongroup_register_styles() {

	wp_enqueue_style( 'hozirongroup-style', get_stylesheet_uri(), array(), '1.0.12' );

	
	wp_enqueue_style( 'hozirongroup-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', null, '1.0.2' );
	
	wp_enqueue_style( 'hozirongroup-plugins', get_template_directory_uri() . '/assets/css/plugins.css', null, '1.0.2' );
	wp_enqueue_style( 'hozirongroup-mfn-icons', get_template_directory_uri() . '/assets/fonts/mfn-icons.css', null, '1.0.2' );
	wp_enqueue_script( 'hozirongroup-modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.8.3.min.js', array(), '1.0.2' );
	
	wp_enqueue_style( 'hozirongroup-social-css', get_template_directory_uri() . '/assets/css/socialfloating.css', null, '1.0.2' );
	wp_enqueue_style( 'hozirongroup-icons', get_template_directory_uri() . '/assets/css/fontawesome.css', null, '1.0.2' );
	if (is_page('search-branch')) {
		wp_enqueue_style( 'hozirongroup-ss-css', get_template_directory_uri() . '/assets/css/slimselect.min.css', null, '1.0.2' );
	}

}
add_action( 'wp_enqueue_scripts', 'hozirongroup_register_styles' );

function hozirongroup_register_scripts() {


	
	wp_enqueue_script( 'hozirongroup-jquery-js', get_template_directory_uri() . '/assets/js/vendor/jquery-1.12.4.min.js', array(), '1.0.2',true );
	wp_enqueue_script( 'jquery-ui-accordion');
	wp_enqueue_script( 'jquery-ui-tabs');
	wp_enqueue_script( 'hozirongroup-popper-js', get_template_directory_uri() . '/assets/js/popper.min.js', array(), '1.0.2',true );
	wp_enqueue_script( 'hozirongroup-bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '1.0.2',true );
	wp_enqueue_script( 'hozirongroup-plugins-js', get_template_directory_uri() . '/assets/js/plugins.js', array(), '1.0.2',true );
	wp_enqueue_script( 'hozirongroup-ajax-mail-js', get_template_directory_uri() . '/assets/js/ajax-mail.js', array(), '1.0.2',true );
	
	wp_enqueue_script( 'hozirongroup-social-js', get_template_directory_uri() . '/assets/js/jquery.socialfloating.js', array(), '1.0.2',true );
	wp_enqueue_script( 'hozirongroup-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.5',true );

	if (is_page('search-branch')) {
		wp_enqueue_script( 'hozirongroup-ss-js', get_template_directory_uri() . '/assets/js/slimselect.min.js', array(), '1.0.2',true );
		wp_enqueue_script( 'hozirongroup-search-branch', get_template_directory_uri() . '/assets/js/search-branch.js', array(), '1.0.2',true );
	}

}
add_action( 'wp_enqueue_scripts', 'hozirongroup_register_scripts' );



function wpse26388_rewrites_init() {
	add_theme_support( 'post-thumbnails' );

    add_rewrite_rule(
        '^university/([a-z0-9-]+)[/]?$',
        'index.php?pagename=university&university_category=$matches[1]',
        'top' );
    add_rewrite_rule(
        '^university/detail/([0-9-]+)[/]?$',
        'index.php?pagename=university&university_id=$matches[1]',
        'top' );

    add_rewrite_rule(
        '^calendar/([a-z0-9-]+)[/]?$',
        'index.php?pagename=calendar&calendar_category=$matches[1]',
        'top' );

    add_rewrite_rule(
        '^exam/([a-z]+)[/]?$',
        'index.php?pagename=exam&exam_slug=$matches[1]',
        'top' );

    add_rewrite_rule(
        'university-detail/([0-9-]+)[/]?$',
        'index.php?pagename=university-detail&university_id=$matches[1]',
        'top' );

    add_rewrite_rule(
        'maintenance/',
        'index.php?pagename=maintenance',
        'top' );
    add_rewrite_rule(
        'search-branch/',
        'index.php?pagename=search-branch',
        'top' );
}
add_action( 'init', 'wpse26388_rewrites_init' );


function wpse26388_query_vars( $query_vars ) {
    $query_vars[] = 'university_category';
    $query_vars[] = 'calendar_category';
    $query_vars[] = 'university_id';
    $query_vars[] = 'exam_slug';
    return $query_vars;
}
add_filter( 'query_vars', 'wpse26388_query_vars' );


function searchBranch() {
	$branch_id = $_POST['branch_id'];
	global $wpdb;
	$result_query = $wpdb->prepare(
		"
		SELECT * FROM branch WHERE branch_id = %s;
		"
		,$branch_id
	);

	$result = $wpdb->get_row($result_query);
	get_template_part('template-parts/content','branch',array(
		'result' => $result
	));
}
add_action( 'wp_ajax_searchBranch', 'searchBranch' );
add_action('wp_ajax_nopriv_searchBranch','searchBranch' );


function redirect_dashboard( $current_screen ) {
	$redirect_to =  'http://localhost/horizon_group/wp-admin/admin.php?page=university';
    if($current_screen->base == 'dashboard') {
    	wp_redirect($redirect_to,'302');
    }
}
add_action( 'current_screen', 'redirect_dashboard' );