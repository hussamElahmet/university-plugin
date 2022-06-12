<?php
/*
  Plugin Name: University
  Author: Bossoft
  Author URI: https://bossoft.com.tr
  Version: 1.0.0
*/

define( 'UNIVERSITY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'UNIVERSITY_PLUGIN_URL', plugin_dir_url( __FILE__ ) );



function university_options_page() {

    add_menu_page(
        'الجامعات',
        'الجامعات',
        'manage_options',
        'university',
        'university_html',
        'dashicons-building'
    );

    add_menu_page(
        'ربط الجميع',
        'ربط الجميع',
        'manage_options',
        'relation_all',
        'section_relation_html',
        'dashicons-building'
    );

    add_menu_page(
        'التقاويم',
        'التقاويم',
        'manage_options',
        'calendar',
        'app_calendar_html',
        'dashicons-building'
    );

    add_menu_page(
        'اعدادات الموقع',
        'اعدادات الموقع',
        'manage_options',
        'site_setting',
        'site_setting_html',
        'dashicons-building'
    );

    add_menu_page(
        'السلايدر',
        'السلايدر',
        'manage_options',
        'slider',
        'slider_html',
        'dashicons-building'
    );

    add_menu_page(
        'الفريق',
        'الفريق',
        'manage_options',
        'team',
        'team_html',
        'dashicons-building'
    );
    
    // add_submenu_page(
    // 	'university',
    //     'الكليات',
    //     'الكليات',
    //     'manage_options',
    //     'faculty',
    //     'faculty_html'
    // );

    // add_submenu_page (
    //     'university',
    //     'المعاهد',
    //     'المعاهد',
    //     'manage_options',
    //     'institute',
    //     'institute_html'
    // );

    add_submenu_page (
        'university',
        'التخصصات',
        'التخصصات',
        'manage_options',
        'branch',
        'branch_html'
    );

    // add_submenu_page (
    //     'university',
    //     'الامتحانات',
    //     'الامتحانات',
    //     'manage_options',
    //     'exam',
    //     'exam_html'
    // );

    add_submenu_page (
        'university',
        'أقسام اضافية',
        'أقسام اضافية',
        'manage_options',
        'section',
        'section_html'
    );

    // add_submenu_page (
    //     'relation_all',
    //     'ربط الجامعات الحكومية',
    //     'ربط الجامعات الحكومية',
    //     'manage_options',
    //     'relation_all'
    // );

    // add_submenu_page (
    //     'relation_all',
    //     'ربط الكليات',
    //     'ربط الكليات',
    //     'manage_options',
    //     'faculty_relation',
    //     'faculty_relation_html'
    // );

    // add_submenu_page (
    //     'relation_all',
    //     'ربط المعاهد',
    //     'ربط المعاهد',
    //     'manage_options',
    //     'institute_relation',
    //     'institute_relation_html'
    // );

    add_submenu_page (
        'relation_all',
        'ربط الجامعات الخاصة',
        'ربط الجامعات الخاصة',
        'manage_options',
        'priv_university',
        'priv_university_html'
    );

    // add_submenu_page (
    //     'relation_all',
    //     'ربط التخصص بالكليات',
    //     'ربط التخصص بالكليات',
    //     'manage_options',
    //     'branch_faculty_relation',
    //     'branch_faculty_relation_html'
    // );

    // add_submenu_page (
    //     'relation_all',
    //     'ربط التخصص بالمعاهد',
    //     'ربط التخصص بالمعاهد',
    //     'manage_options',
    //     'branch_institute_relation',
    //     'branch_institute_relation_html'
    // );

    add_submenu_page (
        'relation_all',
        'ربط الامتحانات',
        'ربط الامتحانات',
        'manage_options',
        'exam_relation',
        'exam_relation_html'
    );

    add_submenu_page (
        'calendar',
        'تقويم المفاضلات',
        'تقويم المفاضلات',
        'manage_options',
        'calendar'
    );

    add_submenu_page (
        'calendar',
        'تقويم اليوس',
        'تقويم اليوس',
        'manage_options',
        'yos_calendar',
        'yos_calendar_html'
    );
    
}
add_action( 'admin_menu', 'university_options_page' );


function university_init(){
    wp_enqueue_style( 'style_css', UNIVERSITY_PLUGIN_URL . '/css/university.css');
}
add_action('init','university_init');

function load_media_files() {
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_media_files' );

function add_base_url(){
    $site_url = get_site_url();
    $ajax_url = admin_url( 'admin-ajax.php');
    echo "<script type='text/javascript'>var mBaseUrl='".$site_url."'</script>";
    echo "<script type='text/javascript'>var ajaxurl='".$ajax_url."'</script>";
}
add_action('wp_print_scripts', 'add_base_url');

require_once(UNIVERSITY_PLUGIN_PATH.'inc/views.php');
require_once(UNIVERSITY_PLUGIN_PATH.'inc/api.php');




