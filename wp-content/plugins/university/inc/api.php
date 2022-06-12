<?php
// section university
add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/create_university/', array(
		'methods' => 'POST',
		'callback' => 'api_create_university',
	));

	register_rest_route('university/v1', '/update_university/', array(
		'methods' => 'POST',
		'callback' => 'api_update_university',
	));

	register_rest_route('university/v1', '/delete_university/', array(
		'methods' => 'POST',
		'callback' => 'api_delete_university',
	));

	register_rest_route('university/v1', '/get_university/', array(
		'methods' => 'POST',
		'callback' => 'api_get_university',
	));

	register_rest_route('university/v1', '/get_university_all/', array(
		'methods' => 'POST',
		'callback' => 'api_get_university_all',
	));

	register_rest_route('university/v1', '/get_university_related/', array(
		'methods' => 'POST',
		'callback' => 'api_get_university_related',
	));
});

function api_create_university($payload)
{
	global $wpdb;

	$university_logo = $payload['university_logo'];
	$university_name = $payload['university_name'];
	$university_tel = $payload['university_tel'];
	$university_url = $payload['university_url'];
	$university_map = $payload['university_map'];
	$university_email = $payload['university_email'];
	$university_world_order = $payload['university_world_order'];
	$university_local_order = $payload['university_local_order'];
	$university_city = $payload['university_city'];
	$university_education_language = $payload['university_education_language'];
	$university_category = $payload['university_category'];
	$university_description = $payload['university_description'];

	$data = array(
		'university_id' => null,
		'university_logo' => $university_logo,
		'university_name' => $university_name,
		'university_tel' => $university_tel,
		'university_url' => $university_url,
		'university_map' => $university_map,
		'university_email' => $university_email,
		'university_world_order' => $university_world_order,
		'university_local_order' => $university_local_order,
		'university_city' => $university_city,
		'university_education_language' => $university_education_language,
		'university_category' => $university_category,
		'university_description' => $university_description
	);

	$format = array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');

	$result = $wpdb->insert('university', $data, $format);


	return array(
		'university_id' => $result->insert_id
	);
}

function api_update_university($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];
	$university_logo = $payload['university_logo'];
	$university_name = $payload['university_name'];
	$university_tel = $payload['university_tel'];
	$university_url = $payload['university_url'];
	$university_map = $payload['university_map'];
	$university_email = $payload['university_email'];
	$university_world_order = $payload['university_world_order'];
	$university_local_order = $payload['university_local_order'];
	$university_city = $payload['university_city'];
	$university_education_language = $payload['university_education_language'];
	$university_category = $payload['university_category'];
	$university_description = $payload['university_description'];

	$data = array(
		'university_logo' => $university_logo,
		'university_name' => $university_name,
		'university_tel' => $university_tel,
		'university_url' => $university_url,
		'university_map' => $university_map,
		'university_email' => $university_email,
		'university_world_order' => $university_world_order,
		'university_local_order' => $university_local_order,
		'university_city' => $university_city,
		'university_education_language' => $university_education_language,
		'university_category' => $university_category,
		'university_description' => $university_description
	);


	$result = $wpdb->update('university', $data, array(
		'university_id' => $university_id
	));

	return $result;
}

function api_delete_university($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];
	$query = $wpdb->prepare(
		"DELETE FROM university WHERE university_id = %s",
		$university_id
	);

	$result = $wpdb->query($query);

	return $result;
}

function api_get_university($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];

	$query = $wpdb->prepare(
		"SELECT * FROM university WHERE university_id = %s",
		$university_id
	);

	$result = $wpdb->get_row($query);

	return $result;
}

function api_get_university_all($payload)
{
	global $wpdb;

	$result = $wpdb->get_results("SELECT * FROM university u INNER JOIN city c on u.university_city = c.city_id;");

	return array(
		'data' => $result
	);
}

function api_get_university_related($payload)
{
	global $wpdb;

	$areas=$payload['areas'];
	$lang=$payload['lang'];
	$branch_name=$payload['branch_name'];
	$degrees=$payload['degrees'];
	$cities=$payload['cities'];
	$status=$payload['status'];
	$university=$payload['university'];
	// $query = $wpdb->prepare(
	// 	"SELECT * FROM university WHERE university_id IN (SELECT DISTINCT university_id FROM university_degree where TRIM(branch_name) = TRIM(%s)) ORDER BY university_id",
	// 	$branch_name
	// );
	// if ($branch_name != -1 && $degree == -1 && $status == -1 && $universities == -1 && $language == -1) {

	// 	$str = "SELECT * FROM university WHERE university_id IN 
	// 	(SELECT DISTINCT university_id FROM university_degree where TRIM(branch_name) = TRIM(%s)) ORDER BY university_id";
	// 	$query = $wpdb->prepare($str, $branch_name);
	// } else if ($branch_name != -1 && $degree != -1 && $status == -1 && $universities == -1 && $language == -1) {
	// 	$str = "SELECT * FROM university WHERE university_id IN 
	// 	(SELECT DISTINCT university_id FROM university_degree where TRIM(branch_name) = TRIM(%s)
	// 	AND degree_id = TRIM(%s)) ORDER BY university_id
	// 	";
	// 	$query = $wpdb->prepare($str, $branch_name, $degree);
	// } else if ($branch_name != -1 && $degree != -1 && $status != -1 && $universities == -1 && $language == -1) {
	// 	$str = "SELECT * FROM university WHERE university_id IN 
	// 	(SELECT DISTINCT university_id FROM university_degree where TRIM(branch_name) = TRIM(%s)
	// 	AND degree_id = TRIM(%s) AND Status=TRIM(%s)) ORDER BY university_id
	// 	";
	// 	$query = $wpdb->prepare($str, $branch_name, $degree, $status);
	// } else if ($branch_name != -1 && $degree != -1 && $status != -1 && $universities != -1 && $language == -1) {
	// 	$str = "SELECT * FROM university WHERE university_id IN 
	// 	(SELECT DISTINCT university_id FROM university_degree where TRIM(branch_name) = TRIM(%s)
	// 	AND degree_id = TRIM(%s) AND Status=TRIM(%s)) AND university.university_id=TRIM(%s) ORDER BY university_id";
	// 	$query = $wpdb->prepare($str, $branch_name, $degree, $status, $universities);
	// } else if ($branch_name != -1 && $degree != -1 && $status != -1 && $universities != -1 && $language != -1) {
	// 	$str = "SELECT * FROM university WHERE university_id IN 
	// 	(SELECT DISTINCT university_id FROM university_degree where TRIM(branch_name) = TRIM(%s)
	// 	AND degree_id = TRIM(%s) AND Status=TRIM(%s)) AND university.university_id=TRIM(%s)
	// 	AND university.university_education_language LIKE '%$language%'  ORDER BY university_id";
	// 	$query = $wpdb->prepare($str, $branch_name, $degree, $status, $universities);
	// } else {
	// 	echo "error_hussam";
	// }
// 	$query = 'SELECT * from clients';
// if ($param !== null) {
//     $query .= " where name='{$parm}'";
// }
	//Query builder
	// echo "lang=$university";
	$query="select university.university_logo as logo,university.university_name as university,degree.degree_name as program,university_degree.branch_name as degree_name,
	university_degree.branch_before_discount as price_befor_discount,
	university_degree.branch_after_discount as price_after_discount,
	(
	 select area_name from area_of_study inner join branch on branch.area_id=area_of_study.area_id where  branch.branch_name=TRIM(university_degree.branch_name)
	) area_of_study
	,
	university.university_education_language as program_language ,
	(select degree_name from degree where degree.degree_id=university_degree.degree_id) as program_level,
	university.university_city as location,
	university_degree.Status,
	university.university_url as link from university inner join university_degree on university_degree.university_id=university.university_id
	inner join degree on degree.degree_id=university_degree.degree_id  WHERE";
	// if($areas !=-1)
	// {
	// 	$query2="select * from  branch where area_id=$areas";
	// 	$result2 = $wpdb->get_results($query2);
	// 	$str="(";
	// 	foreach($result2 as $res)
	// 	{
	// 		$str.="'$res',";
	// 	}
    //     $str=rtrim($str,',');
	// 	echo "$result2";
	//     if($result2 != null)
	// 	{
	// 		$query.=" university.university_id IN 
	// 		(SELECT DISTINCT university_id FROM university_degree where TRIM(branch_name) IN $str ) AND ";
	// 	}
	// }

	if($lang !=-1)
	{
		$query.=" university.university_education_language like '%$lang%' AND ";
	}
	if($branch_name !=-1)
	{
	    $query.=" university.university_id IN 
		(SELECT DISTINCT university_id FROM university_degree where TRIM(branch_name) like '%$branch_name%' ";
		if ($status == -1 && $degrees == -1) {
			$query .= ") AND";
		}else{
			$query.=" AND ";
		}
	}
	
	if($degrees !=-1 && $branch_name !=-1)
	{
		$query.=" university_degree.degree_id =$degrees  ";
		if($status !=-1)
		{
			$query.=" AND ";
		}else{
			$query.=") AND";
		}
	}
	if($status !=-1  && $branch_name !=-1)
	{   
		$query.=" Status =$status ) AND";
	}else if($status !=-1  && $branch_name ==-1)
	{
		$query.=" university.university_id IN 
		(SELECT DISTINCT university_id FROM university_degree where status=$status ) AND  ";
	}
	if($cities !=-1)
	{
		$query.=" university.university_city =$cities AND";
	}
	if($university !=-1)
	{
		$query.=" university.university_id =$university AND";
	}
	
$query.=" university_category=1";
// echo ".$query.";
	$result = $wpdb->get_results($query);
	ob_start();
	get_template_part('template-parts/content', 'university-priv', array(
		'result' => $result
	));
	$html_result = ob_get_clean();
	return $html_result;
}


// section faculty
add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/create_faculty/', array(
		'methods' => 'POST',
		'callback' => 'api_create_faculty',
	));

	register_rest_route('university/v1', '/update_faculty/', array(
		'methods' => 'POST',
		'callback' => 'api_update_faculty',
	));

	register_rest_route('university/v1', '/delete_faculty/', array(
		'methods' => 'POST',
		'callback' => 'api_delete_faculty',
	));

	register_rest_route('university/v1', '/get_faculty/', array(
		'methods' => 'POST',
		'callback' => 'api_get_faculty',
	));

	register_rest_route('university/v1', '/get_faculty_all/', array(
		'methods' => 'POST',
		'callback' => 'api_get_faculty_all',
	));
});

function api_create_faculty($payload)
{
	global $wpdb;

	$faculty_name = $payload['faculty_name'];


	$data = array(
		'faculty_id' => null,
		'faculty_name' => $faculty_name
	);

	$format = array('%s', '%s');

	$result = $wpdb->insert('faculty', $data, $format);


	return array(
		'faculty_id' => $result->insert_id
	);
}

function api_update_faculty($payload)
{
	global $wpdb;

	$faculty_id = $payload['faculty_id'];
	$faculty_name = $payload['faculty_name'];


	$data = array(
		'faculty_id' => null,
		'faculty_name' => $faculty_name
	);



	$result = $wpdb->update('faculty', $data, array(
		'faculty_id' => $faculty_id
	));

	return $result;
}

function api_delete_faculty($payload)
{
	global $wpdb;

	$faculty_id = $payload['faculty_id'];
	$query = $wpdb->prepare(
		"DELETE FROM faculty WHERE faculty_id = %s",
		$faculty_id
	);

	$result = $wpdb->query($query);

	return $result;
}

function api_get_faculty($payload)
{
	global $wpdb;

	$faculty_id = $payload['faculty_id'];

	$query = $wpdb->prepare(
		"SELECT * FROM faculty WHERE faculty_id = %s",
		$faculty_id
	);

	$result = $wpdb->get_row($query);

	return $result;
}

function api_get_faculty_all($payload)
{
	global $wpdb;

	$result = $wpdb->get_results("SELECT * FROM faculty");

	return array(
		'data' => $result
	);
}


// section institute

add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/create_institute/', array(
		'methods' => 'POST',
		'callback' => 'api_create_institute',
	));

	register_rest_route('university/v1', '/update_institute/', array(
		'methods' => 'POST',
		'callback' => 'api_update_institute',
	));

	register_rest_route('university/v1', '/delete_institute/', array(
		'methods' => 'POST',
		'callback' => 'api_delete_institute',
	));

	register_rest_route('university/v1', '/get_institute/', array(
		'methods' => 'POST',
		'callback' => 'api_get_institute',
	));

	register_rest_route('university/v1', '/get_institute_all/', array(
		'methods' => 'POST',
		'callback' => 'api_get_institute_all',
	));
});

function api_create_institute($payload)
{
	global $wpdb;

	$institute_name = $payload['institute_name'];


	$data = array(
		'institute_id' => null,
		'institute_name' => $institute_name
	);

	$format = array('%s', '%s');

	$result = $wpdb->insert('institute', $data, $format);


	return array(
		'institute_id' => $result->insert_id
	);
}

function api_update_institute($payload)
{
	global $wpdb;

	$institute_id = $payload['institute_id'];
	$institute_name = $payload['institute_name'];


	$data = array(
		'institute_id' => null,
		'institute_name' => $institute_name
	);



	$result = $wpdb->update('institute', $data, array(
		'institute_id' => $institute_id
	));

	return $result;
}

function api_delete_institute($payload)
{
	global $wpdb;

	$institute_id = $payload['institute_id'];
	$query = $wpdb->prepare(
		"DELETE FROM institute WHERE institute_id = %s",
		$institute_id
	);

	$result = $wpdb->query($query);

	return $result;
}

function api_get_institute($payload)
{
	global $wpdb;

	$institute_id = $payload['institute_id'];

	$query = $wpdb->prepare(
		"SELECT * FROM institute WHERE institute_id = %s",
		$institute_id
	);

	$result = $wpdb->get_row($query);

	return $result;
}

function api_get_institute_all($payload)
{
	global $wpdb;

	$result = $wpdb->get_results("SELECT * FROM institute");

	return array(
		'data' => $result
	);
}

//section branch

add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/create_branch/', array(
		'methods' => 'POST',
		'callback' => 'api_create_branch',
	));

	register_rest_route('university/v1', '/update_branch/', array(
		'methods' => 'POST',
		'callback' => 'api_update_branch',
	));

	register_rest_route('university/v1', '/delete_branch/', array(
		'methods' => 'POST',
		'callback' => 'api_delete_branch',
	));

	register_rest_route('university/v1', '/get_branch/', array(
		'methods' => 'POST',
		'callback' => 'api_get_branch',
	));

	register_rest_route('university/v1', '/search_branch/', array(
		'methods' => 'POST',
		'callback' => 'api_search_branch',
	));

	register_rest_route('university/v1', '/get_branch_all/', array(
		'methods' => 'POST',
		'callback' => 'api_get_branch_all',
	));
});

function api_create_branch($payload)
{
	global $wpdb;

	$branch_name = $payload['branch_name'];
	$branch_description = $payload['branch_description'];


	$data = array(
		'branch_id' => null,
		'branch_name' => $branch_name,
		'branch_description' => $branch_description
	);

	$format = array('%s', '%s', '%s');

	$result = $wpdb->insert('branch', $data, $format);


	return array(
		'branch_id' => $result->insert_id
	);
}

function api_update_branch($payload)
{
	global $wpdb;

	$branch_id = $payload['branch_id'];
	$branch_name = $payload['branch_name'];
	$branch_description = $payload['branch_description'];

	$data = array(
		'branch_name' => $branch_name,
		'branch_description' => $branch_description
	);



	$result = $wpdb->update('branch', $data, array(
		'branch_id' => $branch_id
	));

	return $result;
}

function api_delete_branch($payload)
{
	global $wpdb;

	$branch_id = $payload['branch_id'];
	$query = $wpdb->prepare(
		"DELETE FROM branch WHERE branch_id = %s",
		$branch_id
	);

	$result = $wpdb->query($query);

	return $result;
}

function api_get_branch($payload)
{
	global $wpdb;

	$branch_id = $payload['branch_id'];

	$query = $wpdb->prepare(
		"SELECT * FROM branch WHERE branch_id = %s",
		$branch_id
	);

	$result = $wpdb->get_row($query);

	return $result;
}

function api_search_branch($payload)
{
	global $wpdb;
	$search_text = $payload['search_text'];
	$areas = $payload['areas'];
	$lang = $payload['lang'];
	if ($search_text != -1 && $areas == -1 && $lang == -1) {
		$query = $wpdb->prepare(
			"SELECT DISTINCT TRIM(branch_name) as branch_name FROM branch where branch_name like %s",
			'%' . $wpdb->esc_like($search_text) . '%'
		);
	} else if ($search_text != -1 && $areas != -1 && $lang == -1) {
		$query = $wpdb->prepare(
			"SELECT DISTINCT TRIM(branch_name) as branch_name FROM branch where branch_name like %s AND branch.area_id=$areas",
			'%' . $wpdb->esc_like($search_text) . '%'
		);
	} else if ($search_text != -1 && $areas != -1 && $lang != -1) {
		
		$query = $wpdb->prepare(
			"SELECT branch.branch_name FROM branch inner join university_degree on university_degree.branch_name=branch.branch_name
		where  BRANCH.branch_name like %s AND BRANCH.area_id=%s AND university_degree.branch_language LIKE %s ",
			'%' . $wpdb->esc_like($search_text) . '%',
			$areas,
			'%' . $wpdb->esc_like($lang) . '%'
		);
	}
	// echo  " . $query . ";
	$result = $wpdb->get_results($query);
	return $result;
}

function api_get_branch_all($payload)
{
	global $wpdb;

	$result = $wpdb->get_results("SELECT * FROM branch");

	return array(
		'data' => $result
	);
}

// section exam

add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/create_exam/', array(
		'methods' => 'POST',
		'callback' => 'api_create_exam',
	));

	register_rest_route('university/v1', '/update_exam/', array(
		'methods' => 'POST',
		'callback' => 'api_update_exam',
	));

	register_rest_route('university/v1', '/delete_exam/', array(
		'methods' => 'POST',
		'callback' => 'api_delete_exam',
	));

	register_rest_route('university/v1', '/get_exam/', array(
		'methods' => 'POST',
		'callback' => 'api_get_exam',
	));

	register_rest_route('university/v1', '/get_exam_all/', array(
		'methods' => 'POST',
		'callback' => 'api_get_exam_all',
	));
});

function api_create_exam($payload)
{
	global $wpdb;

	$exam_name = $payload['exam_name'];
	$exam_description = $payload['exam_description'];


	$data = array(
		'exam_id' => null,
		'exam_name' => $exam_name,
		'exam_description' => $exam_description
	);

	$format = array('%s', '%s');

	$result = $wpdb->insert('exam', $data, $format);


	return array(
		'exam_id' => $result->insert_id
	);
}

function api_update_exam($payload)
{
	global $wpdb;

	$exam_id = $payload['exam_id'];
	$exam_name = $payload['exam_name'];
	$exam_description = $payload['exam_description'];

	$data = array(
		'exam_name' => $exam_name,
		'exam_description' => $exam_description
	);



	$result = $wpdb->update('exam', $data, array(
		'exam_id' => $exam_id
	));

	return $result;
}

function api_delete_exam($payload)
{
	global $wpdb;

	$exam_id = $payload['exam_id'];
	$query = $wpdb->prepare(
		"DELETE FROM exam WHERE exam_id = %s",
		$exam_id
	);

	$result = $wpdb->query($query);

	return $result;
}

function api_get_exam($payload)
{
	global $wpdb;

	$exam_id = $payload['exam_id'];

	$query = $wpdb->prepare(
		"SELECT * FROM exam WHERE exam_id = %s",
		$exam_id
	);

	$result = $wpdb->get_row($query);

	return $result;
}

function api_get_exam_all($payload)
{
	global $wpdb;

	$result = $wpdb->get_results("SELECT * FROM exam");

	return array(
		'data' => $result
	);
}

// section section

add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/create_section/', array(
		'methods' => 'POST',
		'callback' => 'api_create_section',
	));

	register_rest_route('university/v1', '/update_section/', array(
		'methods' => 'POST',
		'callback' => 'api_update_section',
	));

	register_rest_route('university/v1', '/delete_section/', array(
		'methods' => 'POST',
		'callback' => 'api_delete_section',
	));

	register_rest_route('university/v1', '/get_section/', array(
		'methods' => 'POST',
		'callback' => 'api_get_section',
	));

	register_rest_route('university/v1', '/get_section_all/', array(
		'methods' => 'POST',
		'callback' => 'api_get_section_all',
	));
});

function api_create_section($payload)
{
	global $wpdb;

	$section_name = $payload['section_name'];
	$section_order = $payload['section_order'];


	$data = array(
		'section_id' => null,
		'section_name' => $section_name,
		'section_order' => $section_order
	);

	$format = array('%s', '%s');

	$result = $wpdb->insert('section', $data, $format);


	return array(
		'section_id' => $result->insert_id
	);
}

function api_update_section($payload)
{
	global $wpdb;

	$section_id = $payload['section_id'];
	$section_name = $payload['section_name'];
	$section_order = $payload['section_order'];

	$data = array(
		'section_name' => $section_name,
		'section_order' => $section_order
	);



	$result = $wpdb->update('section', $data, array(
		'section_id' => $section_id
	));

	return $result;
}

function api_delete_section($payload)
{
	global $wpdb;

	$section_id = $payload['section_id'];
	$query = $wpdb->prepare(
		"DELETE FROM section WHERE section_id = %s",
		$section_id
	);

	$result = $wpdb->query($query);

	return $result;
}

function api_get_section($payload)
{
	global $wpdb;

	$section_id = $payload['section_id'];

	$query = $wpdb->prepare(
		"SELECT * FROM section WHERE section_id = %s",
		$section_id
	);

	$result = $wpdb->get_row($query);

	return $result;
}

function api_get_section_all($payload)
{
	global $wpdb;

	$result = $wpdb->get_results("SELECT * FROM section");

	return array(
		'data' => $result
	);
}

// section relation section

add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/create_section_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_create_section_relation',
	));

	register_rest_route('university/v1', '/update_section_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_update_section_relation',
	));

	register_rest_route('university/v1', '/delete_section_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_delete_section_relation',
	));

	register_rest_route('university/v1', '/get_section_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_get_section_relation',
	));

	register_rest_route('university/v1', '/get_section_relation_all/', array(
		'methods' => 'POST',
		'callback' => 'api_get_section_relation_all',
	));
});

function api_create_section_relation($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];
	$section_id = $payload['section_id'];
	$option_name = $payload['option_name'];
	$option_value = $payload['option_value'];
	$option_order = $payload['option_order'];


	$data = array(
		'id' => null,
		'university_id' => $university_id,
		'section_id' => $section_id,
		'option_name' => $option_name,
		'option_value' => $option_value,
		'option_order' => $option_order
	);

	$format = array('%s', '%s', '%s', '%s', '%s');

	$result = $wpdb->insert('university_section', $data, $format);


	return array(
		'id' => $result->insert_id
	);
}

function api_update_section_relation($payload)
{
	global $wpdb;

	$id = $payload['id'];
	$university_id = $payload['university_id'];
	$section_id = $payload['section_id'];
	$option_name = $payload['option_name'];
	$option_value = $payload['option_value'];
	$option_order = $payload['option_order'];

	$data = array(
		'university_id' => $university_id,
		'section_id' => $section_id,
		'option_name' => $option_name,
		'option_value' => $option_value,
		'option_order' => $option_order
	);



	$result = $wpdb->update('university_section', $data, array(
		'id' => $id
	));

	return $result;
}

function api_delete_section_relation($payload)
{
	global $wpdb;

	$id = $payload['id'];

	$query = $wpdb->prepare(
		"DELETE FROM university_section WHERE id = %s",
		$id
	);

	$result = $wpdb->query($query);

	return $result;
}

function api_get_section_relation($payload)
{
	global $wpdb;

	$id = $payload['id'];

	$query = $wpdb->prepare(
		"SELECT * FROM university_section WHERE id = %s",
		$id
	);

	$result = $wpdb->get_row($query);

	return $result;
}

function api_get_section_relation_all($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];
	$section_id = $payload['section_id'];


	$query = $wpdb->prepare(
		"SELECT * FROM university_section WHERE university_id = %s AND section_id = %s",
		$university_id,
		$section_id
	);

	$result = $wpdb->get_results($query);

	return array(
		'data' => $result
	);
}

// section relation faculty

add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/create_faculty_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_create_faculty_relation',
	));

	register_rest_route('university/v1', '/update_faculty_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_update_faculty_relation',
	));

	register_rest_route('university/v1', '/delete_faculty_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_delete_faculty_relation',
	));

	register_rest_route('university/v1', '/get_faculty_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_get_faculty_relation',
	));

	register_rest_route('university/v1', '/get_faculty_relation_all/', array(
		'methods' => 'POST',
		'callback' => 'api_get_faculty_relation_all',
	));

	register_rest_route('university/v1', '/get_unselected_faculties/', array(
		'methods' => 'POST',
		'callback' => 'api_get_unselected_faculties',
	));
});

function api_create_faculty_relation($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];
	$faculty_id = $payload['faculty_id'];
	$faculty_url = $payload['faculty_url'];


	$data = array(
		'university_faculty_id' => null,
		'university_id' => $university_id,
		'faculty_id' => $faculty_id,
		'faculty_url' => $faculty_url
	);

	$format = array('%s', '%s', '%s', '%s');

	$result = $wpdb->insert('university_faculty', $data, $format);


	return array(
		'university_faculty_id' => $result->insert_id
	);
}

function api_update_faculty_relation($payload)
{
	global $wpdb;

	$university_faculty_id = $payload['university_faculty_id'];
	$university_id = $payload['university_id'];
	$faculty_id = $payload['faculty_id'];
	$faculty_url = $payload['faculty_url'];


	$data = array(
		'university_id' => $university_id,
		'faculty_id' => $faculty_id,
		'faculty_url' => $faculty_url
	);


	$result = $wpdb->update('university_faculty', $data, array(
		'university_faculty_id' => $university_faculty_id
	));


	return $result;
}

function api_delete_faculty_relation($payload)
{
	global $wpdb;

	$university_faculty_id = $payload['university_faculty_id'];

	$query = $wpdb->prepare(
		"DELETE FROM university_faculty WHERE university_faculty_id = %s",
		$university_faculty_id
	);

	$result = $wpdb->query($query);

	return $result;
}

function api_get_faculty_relation($payload)
{
	global $wpdb;

	$university_faculty_id = $payload['university_faculty_id'];


	$query = $wpdb->prepare(
		"SELECT * FROM university_faculty uf INNER JOIN faculty f ON uf.faculty_id = f.faculty_id WHERE university_faculty_id = %s",
		$university_faculty_id
	);

	$result = $wpdb->get_row($query);

	return $result;
}

function api_get_faculty_relation_all($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];


	$query = $wpdb->prepare(
		"SELECT * FROM university_faculty uf INNER JOIN faculty f ON uf.faculty_id = f.faculty_id WHERE university_id = %s",
		$university_id
	);

	$result = $wpdb->get_results($query);

	return array(
		'data' => $result
	);
}

function api_get_unselected_faculties($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];


	$query = $wpdb->prepare(
		"SELECT f.* FROM faculty f LEFT JOIN university_faculty uf ON f.faculty_id = uf.faculty_id AND uf.university_id = %s WHERE uf.university_faculty_id IS NULL",
		$university_id
	);

	$result = $wpdb->get_results($query);

	return $result;
}

// section relation institute

add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/create_institute_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_create_institute_relation',
	));

	register_rest_route('university/v1', '/update_institute_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_update_institute_relation',
	));

	register_rest_route('university/v1', '/delete_institute_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_delete_institute_relation',
	));

	register_rest_route('university/v1', '/get_institute_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_get_institute_relation',
	));

	register_rest_route('university/v1', '/get_institute_relation_all/', array(
		'methods' => 'POST',
		'callback' => 'api_get_institute_relation_all',
	));

	register_rest_route('university/v1', '/get_unselected_institutes/', array(
		'methods' => 'POST',
		'callback' => 'api_get_unselected_institutes',
	));
});

function api_create_institute_relation($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];
	$institute_id = $payload['institute_id'];
	$institute_url = $payload['institute_url'];


	$data = array(
		'university_institute_id' => null,
		'university_id' => $university_id,
		'institute_id' => $institute_id,
		'institute_url' => $institute_url
	);

	$format = array('%s', '%s', '%s', '%s');

	$result = $wpdb->insert('university_institute', $data, $format);


	return array(
		'university_institute_id' => $result->insert_id
	);
}

function api_update_institute_relation($payload)
{
	global $wpdb;

	$university_institute_id = $payload['university_institute_id'];
	$university_id = $payload['university_id'];
	$institute_id = $payload['institute_id'];
	$institute_url = $payload['institute_url'];


	$data = array(
		'university_id' => $university_id,
		'institute_id' => $institute_id,
		'institute_url' => $institute_url
	);


	$result = $wpdb->update('university_institute', $data, array(
		'university_institute_id' => $university_institute_id
	));


	return $result;
}

function api_delete_institute_relation($payload)
{
	global $wpdb;

	$university_institute_id = $payload['university_institute_id'];

	$query = $wpdb->prepare(
		"DELETE FROM university_institute WHERE university_institute_id = %s",
		$university_institute_id
	);

	$result = $wpdb->query($query);

	return $result;
}

function api_get_institute_relation($payload)
{
	global $wpdb;

	$university_institute_id = $payload['university_institute_id'];


	$query = $wpdb->prepare(
		"SELECT * FROM university_institute uf INNER JOIN institute f ON uf.institute_id = f.institute_id WHERE university_institute_id = %s",
		$university_institute_id
	);

	$result = $wpdb->get_row($query);

	return $result;
}

function api_get_institute_relation_all($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];


	$query = $wpdb->prepare(
		"SELECT * FROM university_institute uf INNER JOIN institute f ON uf.institute_id = f.institute_id WHERE university_id = %s",
		$university_id
	);

	$result = $wpdb->get_results($query);

	return array(
		'data' => $result
	);
}

function api_get_unselected_institutes($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];


	$query = $wpdb->prepare(
		"SELECT f.* FROM institute f LEFT JOIN university_institute uf ON f.institute_id = uf.institute_id AND uf.university_id = %s WHERE uf.university_institute_id IS NULL",
		$university_id
	);

	$result = $wpdb->get_results($query);

	return $result;
}

// section relation exam

add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/create_exam_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_create_exam_relation',
	));

	register_rest_route('university/v1', '/update_exam_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_update_exam_relation',
	));

	register_rest_route('university/v1', '/delete_exam_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_delete_exam_relation',
	));

	register_rest_route('university/v1', '/get_exam_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_get_exam_relation',
	));

	register_rest_route('university/v1', '/get_exam_relation_all/', array(
		'methods' => 'POST',
		'callback' => 'api_get_exam_relation_all',
	));

	register_rest_route('university/v1', '/get_unselected_exams/', array(
		'methods' => 'POST',
		'callback' => 'api_get_unselected_exams',
	));
});

function api_create_exam_relation($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];
	$exam_id = $payload['exam_id'];


	$data = array(
		'id' => null,
		'university_id' => $university_id,
		'exam_id' => $exam_id
	);

	$format = array('%s', '%s', '%s', '%s');

	$result = $wpdb->insert('university_exam', $data, $format);


	return array(
		'id' => $result->insert_id
	);
}

function api_update_exam_relation($payload)
{
	global $wpdb;

	$id = $payload['id'];
	$university_id = $payload['university_id'];
	$exam_id = $payload['exam_id'];


	$data = array(
		'university_id' => $university_id,
		'exam_id' => $exam_id
	);


	$result = $wpdb->update('university_exam', $data, array(
		'id' => $id
	));


	return $result;
}

function api_delete_exam_relation($payload)
{
	global $wpdb;

	$id = $payload['id'];

	$query = $wpdb->prepare(
		"DELETE FROM university_exam WHERE id = %s",
		$id
	);

	$result = $wpdb->query($query);

	return $result;
}

function api_get_exam_relation($payload)
{
	global $wpdb;

	$id = $payload['id'];


	$query = $wpdb->prepare(
		"SELECT * FROM university_exam ue INNER JOIN exam e ON ue.exam_id = e.exam_id WHERE id = %s",
		$id
	);

	$result = $wpdb->get_row($query);

	return $result;
}

function api_get_exam_relation_all($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];


	$query = $wpdb->prepare(
		"SELECT * FROM university_exam ue INNER JOIN exam e ON ue.exam_id = e.exam_id WHERE university_id = %s",
		$university_id
	);

	$result = $wpdb->get_results($query);

	return array(
		'data' => $result
	);
}

function api_get_unselected_exams($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];


	$query = $wpdb->prepare(
		"SELECT e.* FROM exam e LEFT JOIN university_exam ue ON e.exam_id = ue.exam_id AND ue.university_id = %s WHERE ue.id IS NULL",
		$university_id
	);

	$result = $wpdb->get_results($query);

	return $result;
}

// section relation branch faculty

add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/create_branch_f_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_create_branch_f_relation',
	));

	register_rest_route('university/v1', '/update_branch_f_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_update_branch_f_relation',
	));

	register_rest_route('university/v1', '/delete_branch_f_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_delete_branch_f_relation',
	));

	register_rest_route('university/v1', '/get_branch_f_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_get_branch_f_relation',
	));

	register_rest_route('university/v1', '/get_branch_f_relation_all/', array(
		'methods' => 'POST',
		'callback' => 'api_get_branch_f_relation_all',
	));
	register_rest_route('university/v1', '/get_unselected_branches_f/', array(
		'methods' => 'POST',
		'callback' => 'api_get_unselected_branches_f',
	));

	register_rest_route('university/v1', '/get_related_faculties/', array(
		'methods' => 'POST',
		'callback' => 'api_get_related_faculties',
	));
});

function api_create_branch_f_relation($payload)
{
	global $wpdb;

	$university_faculty_id = $payload['university_faculty_id'];
	$branch_id = $payload['branch_id'];
	$branch_url = $payload['branch_url'];


	$data = array(
		'id' => null,
		'university_faculty_id' => $university_faculty_id,
		'branch_id' => $branch_id,
		'branch_url' => $branch_url
	);

	$format = array('%s', '%s', '%s', '%s');

	$result = $wpdb->insert('university_faculty_branch', $data, $format);


	return array(
		'id' => $result->insert_id
	);
}

function api_update_branch_f_relation($payload)
{
	global $wpdb;

	$id = $payload['id'];
	$university_faculty_id = $payload['university_faculty_id'];
	$branch_id = $payload['branch_id'];
	$branch_url = $payload['branch_url'];


	$data = array(
		'university_faculty_id' => $university_faculty_id,
		'branch_id' => $branch_id,
		'branch_url' => $branch_url
	);

	$result = $wpdb->update('university_faculty_branch', $data, array(
		'id' => $id
	));

	return $result;
}

function api_delete_branch_f_relation($payload)
{
	global $wpdb;

	$id = $payload['id'];

	$query = $wpdb->prepare(
		"DELETE FROM university_faculty_branch WHERE id = %s",
		$id
	);

	$result = $wpdb->query($query);

	return $result;
}

function api_get_branch_f_relation($payload)
{
	global $wpdb;

	$id = $payload['id'];


	$query = $wpdb->prepare(
		"SELECT * FROM university_faculty_branch ufb INNER JOIN branch b ON ufb.branch_id = b.branch_id WHERE id = %s",
		$id
	);

	$result = $wpdb->get_row($query);

	return $result;
}

function api_get_branch_f_relation_all($payload)
{
	global $wpdb;

	$university_faculty_id = $payload['university_faculty_id'];


	$query = $wpdb->prepare(
		"SELECT * FROM university_faculty_branch ufb INNER JOIN branch b ON ufb.branch_id = b.branch_id WHERE ufb.university_faculty_id = %s",
		$university_faculty_id
	);

	$result = $wpdb->get_results($query);

	return array(
		'data' => $result
	);
}


function api_get_unselected_branches_f($payload)
{
	global $wpdb;

	$university_faculty_id = $payload['university_faculty_id'];


	$query = $wpdb->prepare(
		"SELECT b.* FROM branch b LEFT JOIN university_faculty_branch ufb ON b.branch_id = ufb.branch_id AND ufb.university_faculty_id = %s WHERE ufb.id IS NULL",
		$university_faculty_id
	);

	$result = $wpdb->get_results($query);

	return $result;
}

function api_get_related_faculties($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];


	$query = $wpdb->prepare(
		"SELECT * FROM faculty f INNER JOIN university_faculty uf ON f.faculty_id = uf.faculty_id AND uf.university_id = %s",
		$university_id
	);

	$result = $wpdb->get_results($query);

	return $result;
}

// section relation branch institue

add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/create_branch_i_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_create_branch_i_relation',
	));

	register_rest_route('university/v1', '/update_branch_i_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_update_branch_i_relation',
	));

	register_rest_route('university/v1', '/delete_branch_i_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_delete_branch_i_relation',
	));

	register_rest_route('university/v1', '/get_branch_i_relation/', array(
		'methods' => 'POST',
		'callback' => 'api_get_branch_i_relation',
	));

	register_rest_route('university/v1', '/get_branch_i_relation_all/', array(
		'methods' => 'POST',
		'callback' => 'api_get_branch_i_relation_all',
	));
	register_rest_route('university/v1', '/get_unselected_branches_i/', array(
		'methods' => 'POST',
		'callback' => 'api_get_unselected_branches_i',
	));

	register_rest_route('university/v1', '/get_related_institutes/', array(
		'methods' => 'POST',
		'callback' => 'api_get_related_institutes',
	));
});

function api_create_branch_i_relation($payload)
{
	global $wpdb;

	$university_institute_id = $payload['university_institute_id'];
	$branch_id = $payload['branch_id'];
	$branch_url = $payload['branch_url'];


	$data = array(
		'id' => null,
		'university_institute_id' => $university_institute_id,
		'branch_id' => $branch_id,
		'branch_url' => $branch_url
	);

	$format = array('%s', '%s', '%s', '%s');

	$result = $wpdb->insert('university_institute_branch', $data, $format);


	return array(
		'id' => $result->insert_id
	);
}

function api_update_branch_i_relation($payload)
{
	global $wpdb;

	$id = $payload['id'];
	$university_institute_id = $payload['university_institute_id'];
	$branch_id = $payload['branch_id'];
	$branch_url = $payload['branch_url'];


	$data = array(
		'university_institute_id' => $university_institute_id,
		'branch_id' => $branch_id,
		'branch_url' => $branch_url
	);

	$result = $wpdb->update('university_institute_branch', $data, array(
		'id' => $id
	));

	return $result;
}

function api_delete_branch_i_relation($payload)
{
	global $wpdb;

	$id = $payload['id'];

	$query = $wpdb->prepare(
		"DELETE FROM university_institute_branch WHERE id = %s",
		$id
	);

	$result = $wpdb->query($query);

	return $result;
}

function api_get_branch_i_relation($payload)
{
	global $wpdb;

	$id = $payload['id'];


	$query = $wpdb->prepare(
		"SELECT * FROM university_institute_branch uib INNER JOIN branch b ON uib.branch_id = b.branch_id WHERE id = %s",
		$id
	);

	$result = $wpdb->get_row($query);

	return $result;
}

function api_get_branch_i_relation_all($payload)
{
	global $wpdb;

	$university_institute_id = $payload['university_institute_id'];


	$query = $wpdb->prepare(
		"SELECT * FROM university_institute_branch uib INNER JOIN branch b ON uib.branch_id = b.branch_id WHERE uib.university_institute_id = %s",
		$university_institute_id
	);

	$result = $wpdb->get_results($query);

	return array(
		'data' => $result
	);
}


function api_get_unselected_branches_i($payload)
{
	global $wpdb;

	$university_institute_id = $payload['university_institute_id'];


	$query = $wpdb->prepare(
		"SELECT b.* FROM branch b LEFT JOIN university_institute_branch uib ON b.branch_id = uib.branch_id AND uib.university_institute_id = %s WHERE uib.id IS NULL",
		$university_institute_id
	);

	$result = $wpdb->get_results($query);

	return $result;
}

function api_get_related_institutes($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];


	$query = $wpdb->prepare(
		"SELECT * FROM institute f INNER JOIN university_institute ui ON f.institute_id = ui.institute_id AND ui.university_id = %s",
		$university_id
	);

	$result = $wpdb->get_results($query);

	return $result;
}

// section app calendar

add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/create_app_calendar/', array(
		'methods' => 'POST',
		'callback' => 'api_create_app_calendar',
	));

	register_rest_route('university/v1', '/update_app_calendar/', array(
		'methods' => 'POST',
		'callback' => 'api_update_app_calendar',
	));

	register_rest_route('university/v1', '/delete_app_calendar/', array(
		'methods' => 'POST',
		'callback' => 'api_delete_app_calendar',
	));

	register_rest_route('university/v1', '/get_app_calendar/', array(
		'methods' => 'POST',
		'callback' => 'api_get_app_calendar',
	));

	register_rest_route('university/v1', '/get_app_calendar_all/', array(
		'methods' => 'POST',
		'callback' => 'api_get_app_calendar_all',
	));
});

function api_create_app_calendar($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];
	$app_name = $payload['app_name'];
	$app_start_date = $payload['app_start_date'];
	$app_end_date = $payload['app_end_date'];
	$app_result_date = $payload['app_result_date'];
	$app_result_url = $payload['app_result_url'];
	$app_color = $payload['app_color'];


	$data = array(
		'id' => null,
		'university_id' => $university_id,
		'app_name' => $app_name,
		'app_start_date' => $app_start_date,
		'app_end_date' => $app_end_date,
		'app_result_date' => $app_result_date,
		'app_result_url' => $app_result_url,
		'app_color' => $app_color
	);

	$format = array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');

	$result = $wpdb->insert('app_calendar', $data, $format);


	return array(
		'id' => $result->insert_id
	);
}

function api_update_app_calendar($payload)
{
	global $wpdb;

	$id = $payload['id'];
	$university_id = $payload['university_id'];
	$app_name = $payload['app_name'];
	$app_start_date = $payload['app_start_date'];
	$app_end_date = $payload['app_end_date'];
	$app_result_date = $payload['app_result_date'];
	$app_result_url = $payload['app_result_url'];
	$app_color = $payload['app_color'];

	$data = array(
		'university_id' => $university_id,
		'app_name' => $app_name,
		'app_start_date' => $app_start_date,
		'app_end_date' => $app_end_date,
		'app_result_date' => $app_result_date,
		'app_result_url' => $app_result_url,
		'app_color' => $app_color
	);


	$result = $wpdb->update('app_calendar', $data, array(
		'id' => $id
	));

	return $result;
}

function api_delete_app_calendar($payload)
{
	global $wpdb;

	$id = $payload['id'];
	$query = $wpdb->prepare(
		"DELETE FROM app_calendar WHERE id = %s",
		$id
	);

	$result = $wpdb->query($query);

	return $result;
}

function api_get_app_calendar($payload)
{
	global $wpdb;

	$id = $payload['id'];

	$query = $wpdb->prepare(
		"SELECT * FROM app_calendar WHERE id = %s",
		$id
	);

	$result = $wpdb->get_row($query);

	return $result;
}

function api_get_app_calendar_all($payload)
{
	global $wpdb;

	$result = $wpdb->get_results("SELECT * FROM university u INNER JOIN app_calendar ac on u.university_id = ac.university_id INNER JOIN city c on c.city_id = u.university_city;");

	return array(
		'data' => $result
	);
}

// section yos calendar

add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/create_yos_calendar/', array(
		'methods' => 'POST',
		'callback' => 'api_create_yos_calendar',
	));

	register_rest_route('university/v1', '/update_yos_calendar/', array(
		'methods' => 'POST',
		'callback' => 'api_update_yos_calendar',
	));

	register_rest_route('university/v1', '/delete_yos_calendar/', array(
		'methods' => 'POST',
		'callback' => 'api_delete_yos_calendar',
	));

	register_rest_route('university/v1', '/get_yos_calendar/', array(
		'methods' => 'POST',
		'callback' => 'api_get_yos_calendar',
	));

	register_rest_route('university/v1', '/get_yos_calendar_all/', array(
		'methods' => 'POST',
		'callback' => 'api_get_yos_calendar_all',
	));
});

function api_create_yos_calendar($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];
	$yos_start_date = $payload['yos_start_date'];
	$yos_end_date = $payload['yos_end_date'];
	$yos_result_date = $payload['yos_result_date'];
	$yos_result_url = $payload['yos_result_url'];


	$data = array(
		'id' => null,
		'university_id' => $university_id,
		'yos_start_date' => $yos_start_date,
		'yos_end_date' => $yos_end_date,
		'yos_result_date' => $yos_result_date,
		'yos_result_url' => $yos_result_url
	);

	$format = array('%s', '%s', '%s', '%s', '%s', '%s');

	$result = $wpdb->insert('yos_calendar', $data, $format);


	return array(
		'id' => $result->insert_id
	);
}

function api_update_yos_calendar($payload)
{
	global $wpdb;

	$id = $payload['id'];
	$university_id = $payload['university_id'];
	$yos_start_date = $payload['yos_start_date'];
	$yos_end_date = $payload['yos_end_date'];
	$yos_result_date = $payload['yos_result_date'];
	$yos_result_url = $payload['yos_result_url'];


	$data = array(
		'university_id' => $university_id,
		'yos_start_date' => $yos_start_date,
		'yos_end_date' => $yos_end_date,
		'yos_result_date' => $yos_result_date,
		'yos_result_url' => $yos_result_url
	);


	$result = $wpdb->update('yos_calendar', $data, array(
		'id' => $id
	));

	return $result;
}

function api_delete_yos_calendar($payload)
{
	global $wpdb;

	$id = $payload['id'];
	$query = $wpdb->prepare(
		"DELETE FROM yos_calendar WHERE id = %s",
		$id
	);

	$result = $wpdb->query($query);

	return $result;
}

function api_get_yos_calendar($payload)
{
	global $wpdb;

	$id = $payload['id'];

	$query = $wpdb->prepare(
		"SELECT * FROM yos_calendar WHERE id = %s",
		$id
	);

	$result = $wpdb->get_row($query);

	return $result;
}

function api_get_yos_calendar_all($payload)
{
	global $wpdb;

	$result = $wpdb->get_results("SELECT * FROM university u INNER JOIN yos_calendar yc on u.university_id = yc.university_id INNER JOIN city c on c.city_id = u.university_city;");

	return array(
		'data' => $result
	);
}

// section setting

add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/save_setting/', array(
		'methods' => 'POST',
		'callback' => 'api_save_setting',
	));
});

function api_save_setting($payload)
{
	$menu_category = $payload['menu_category'];
	$address = $payload['address'];
	$email = $payload['email'];
	$facebook = $payload['facebook'];
	$instagram = $payload['instagram'];
	$telegram = $payload['telegram'];
	$tel = $payload['tel'];
	$tel1 = $payload['tel1'];
	$tel2 = $payload['tel2'];
	$tel3 = $payload['tel3'];


	update_option('university_menu_category', $menu_category);
	update_option('university_address', $address);
	update_option('university_email', $email);
	update_option('university_facebook', $facebook);
	update_option('university_instagram', $instagram);
	update_option('university_telegram', $telegram);
	update_option('university_tel', $tel);
	update_option('university_tel1', $tel1);
	update_option('university_tel2', $tel2);
	update_option('university_tel3', $tel3);
}


// section slider
add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/create_slider/', array(
		'methods' => 'POST',
		'callback' => 'api_create_slider',
	));

	register_rest_route('university/v1', '/update_slider/', array(
		'methods' => 'POST',
		'callback' => 'api_update_slider',
	));

	register_rest_route('university/v1', '/delete_slider/', array(
		'methods' => 'POST',
		'callback' => 'api_delete_slider',
	));

	register_rest_route('university/v1', '/get_slider/', array(
		'methods' => 'POST',
		'callback' => 'api_get_slider',
	));

	register_rest_route('university/v1', '/get_slider_all/', array(
		'methods' => 'POST',
		'callback' => 'api_get_slider_all',
	));
});

function api_create_slider($payload)
{
	global $wpdb;

	$slider_image = $payload['slider_image'];
	$slider_title = $payload['slider_title'];
	$slider_description = $payload['slider_description'];
	$slider_order = $payload['slider_order'];

	$data = array(
		'id' => null,
		'slider_image' => $slider_image,
		'slider_title' => $slider_title,
		'slider_description' => $slider_description,
		'slider_order' => $slider_order,
	);

	$format = array('%s', '%s', '%s', '%s', '%s');

	$result = $wpdb->insert('slider', $data, $format);


	return array(
		'id' => $result->insert_id
	);
}

function api_update_slider($payload)
{
	global $wpdb;

	$id = $payload['id'];
	$slider_image = $payload['slider_image'];
	$slider_title = $payload['slider_title'];
	$slider_description = $payload['slider_description'];
	$slider_order = $payload['slider_order'];

	$data = array(
		'slider_image' => $slider_image,
		'slider_title' => $slider_title,
		'slider_description' => $slider_description,
		'slider_order' => $slider_order
	);


	$result = $wpdb->update('slider', $data, array(
		'id' => $id
	));

	return $result;
}

function api_delete_slider($payload)
{
	global $wpdb;

	$id = $payload['id'];
	$query = $wpdb->prepare(
		"DELETE FROM slider WHERE id = %s",
		$id
	);

	$result = $wpdb->query($query);

	return $result;
}

function api_get_slider($payload)
{
	global $wpdb;

	$id = $payload['id'];

	$query = $wpdb->prepare(
		"SELECT * FROM slider WHERE id = %s",
		$id
	);

	$result = $wpdb->get_row($query);

	return $result;
}

function api_get_slider_all($payload)
{
	global $wpdb;

	$result = $wpdb->get_results("SELECT * FROM slider;");

	return array(
		'data' => $result
	);
}

// section team
add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/create_team/', array(
		'methods' => 'POST',
		'callback' => 'api_create_team',
	));

	register_rest_route('university/v1', '/update_team/', array(
		'methods' => 'POST',
		'callback' => 'api_update_team',
	));

	register_rest_route('university/v1', '/delete_team/', array(
		'methods' => 'POST',
		'callback' => 'api_delete_team',
	));

	register_rest_route('university/v1', '/get_team/', array(
		'methods' => 'POST',
		'callback' => 'api_get_team',
	));

	register_rest_route('university/v1', '/get_team_all/', array(
		'methods' => 'POST',
		'callback' => 'api_get_team_all',
	));
});

function api_create_team($payload)
{
	global $wpdb;

	$team_image = $payload['team_image'];
	$team_name = $payload['team_name'];
	$team_position = $payload['team_position'];
	$team_description = $payload['team_description'];
	$team_order = $payload['team_order'];

	$data = array(
		'id' => null,
		'team_image' => $team_image,
		'team_name' => $team_name,
		'team_position' => $team_position,
		'team_description' => $team_description,
		'team_order' => $team_order,
	);

	$format = array('%s', '%s', '%s', '%s', '%s');

	$result = $wpdb->insert('team', $data, $format);


	return array(
		'id' => $result->insert_id
	);
}

function api_update_team($payload)
{
	global $wpdb;

	$id = $payload['id'];
	$team_image = $payload['team_image'];
	$team_name = $payload['team_name'];
	$team_position = $payload['team_position'];
	$team_description = $payload['team_description'];
	$team_order = $payload['team_order'];

	$data = array(
		'team_image' => $team_image,
		'team_name' => $team_name,
		'team_position' => $team_position,
		'team_description' => $team_description,
		'team_order' => $team_order
	);


	$result = $wpdb->update('team', $data, array(
		'id' => $id
	));

	return $result;
}

function api_delete_team($payload)
{
	global $wpdb;

	$id = $payload['id'];
	$query = $wpdb->prepare(
		"DELETE FROM team WHERE id = %s",
		$id
	);

	$result = $wpdb->query($query);

	return $result;
}

function api_get_team($payload)
{
	global $wpdb;

	$id = $payload['id'];

	$query = $wpdb->prepare(
		"SELECT * FROM team WHERE id = %s",
		$id
	);

	$result = $wpdb->get_row($query);

	return $result;
}

function api_get_team_all($payload)
{
	global $wpdb;

	$result = $wpdb->get_results("SELECT * FROM team;");

	return array(
		'data' => $result
	);
}

// section relation degree

add_action('rest_api_init', function () {

	register_rest_route('university/v1', '/create_university_degree/', array(
		'methods' => 'POST',
		'callback' => 'api_create_university_degree',
	));

	register_rest_route('university/v1', '/update_university_degree/', array(
		'methods' => 'POST',
		'callback' => 'api_update_university_degree',
	));

	register_rest_route('university/v1', '/delete_university_degree/', array(
		'methods' => 'POST',
		'callback' => 'api_delete_university_degree',
	));

	register_rest_route('university/v1', '/get_university_degree/', array(
		'methods' => 'POST',
		'callback' => 'api_get_university_degree',
	));

	register_rest_route('university/v1', '/get_university_degree_all/', array(
		'methods' => 'POST',
		'callback' => 'api_get_university_degree_all',
	));
});

function api_create_university_degree($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];
	$degree_id = $payload['degree_id'];
	$branch_name = $payload['branch_name'];
	$branch_study_years = $payload['branch_study_years'];
	$branch_language = $payload['branch_language'];
	$branch_before_discount = $payload['branch_before_discount'];
	$branch_after_discount = $payload['branch_after_discount'];
	$status = $payload['status'];
	$data = array(
		'id' => null,
		'university_id' => $university_id,
		'degree_id' => $degree_id,
		'branch_name' => $branch_name,
		'branch_study_years' => $branch_study_years,
		'branch_language' => $branch_language,
		'branch_before_discount' => $branch_before_discount,
		'branch_after_discount' => $branch_after_discount,
		'Status' => $status
	);

	$format = array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');

	$result = $wpdb->insert('university_degree', $data, $format);


	return array(
		'id' => $result->insert_id
	);
}

function api_update_university_degree($payload)
{
	global $wpdb;

	$id = $payload['id'];
	$university_id = $payload['university_id'];
	$degree_id = $payload['degree_id'];
	$branch_name = $payload['branch_name'];
	$branch_study_years = $payload['branch_study_years'];
	$branch_language = $payload['branch_language'];
	$branch_before_discount = $payload['branch_before_discount'];
	$branch_after_discount = $payload['branch_after_discount'];

	$data = array(
		'university_id' => $university_id,
		'degree_id' => $degree_id,
		'branch_name' => $branch_name,
		'branch_study_years' => $branch_study_years,
		'branch_language' => $branch_language,
		'branch_before_discount' => $branch_before_discount,
		'branch_after_discount' => $branch_after_discount
	);

	$result = $wpdb->update('university_degree', $data, array(
		'id' => $id
	));

	return $result;
}

function api_delete_university_degree($payload)
{
	global $wpdb;

	$id = $payload['id'];
	$query = $wpdb->prepare(
		"DELETE FROM university_degree WHERE id = %s",
		$id
	);

	$result = $wpdb->query($query);

	return $result;
}

function api_get_university_degree($payload)
{
	global $wpdb;

	$id = $payload['id'];

	$query = $wpdb->prepare(
		"SELECT * FROM university_degree WHERE id = %s",
		$id
	);

	$result = $wpdb->get_row($query);

	return $result;
}

function api_get_university_degree_all($payload)
{
	global $wpdb;

	$university_id = $payload['university_id'];

	$query = $wpdb->prepare("SELECT * FROM university_degree ud INNER JOIN university u ON ud.university_id = u.university_id INNER JOIN degree d ON ud.degree_id = d.degree_id WHERE ud.university_id = %s", $university_id);

	$result = $wpdb->get_results($query);

	return array(
		'data' => $result
	);
}
