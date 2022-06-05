<?php

global $wpdb;

$university_id = $args['university_id'];

$university_query = $wpdb->prepare('SELECT * FROM university u INNER JOIN city c ON u.university_city = c.city_id WHERE university_id = %s',$university_id);
$university = $wpdb->get_row($university_query);

if (!isset($university->university_id)) {
	global $wp_query;
    $wp_query->set_404();
    status_header( 404 );
    get_template_part( 404 ); exit();
}

$university_category;
if ($university->university_category == 0) {
	$university_category = 'حكومية';
} else {
	$university_category = 'خاصة';
}




$section_query = $wpdb->prepare (
	"SELECT s.section_id,s.section_name,GROUP_CONCAT(us.option_name order by us.option_order SEPARATOR '**//bossoft//**' ) AS option_name ,GROUP_CONCAT(us.option_value order by us.option_order SEPARATOR '**//bossoft//**' ) AS option_value FROM university_section us INNER JOIN section s ON us.section_id = s.section_id AND us.university_id = %s GROUP BY us.section_id order by s.section_order
	",
	$university_id);

$section = $wpdb->get_results($section_query);



$exam_query = $wpdb->prepare(
	"
	SELECT GROUP_CONCAT(e.exam_name SEPARATOR ' - ') AS exam_names FROM university_exam ue INNER JOIN exam e ON ue.exam_id = e.exam_id AND university_id = %s GROUP BY ue.university_id
	",
	$university_id);
$exam = $wpdb->get_row($exam_query);

?>

<div class="breadcrumb-area">
    <div class="breadcrumb-top university-detail default-overlay bg-img breadcrumb-overly-4 pt-100 pb-95" 
    style="background-image:url(<?php echo $university->university_logo; ?>);">
        <div class="container" style="text-align: right;" dir="rtl">
            <h2><?php echo $university->university_name; ?></h2>
            <p><?php echo $university_category; ?></p>
        </div>
    </div>
</div>
<div class="container pt-130 pb-130" dir="rtl">
	<div class="row">
		<div class="col-lg-12" style="text-align: right;margin-bottom: 10px;">
			<?php echo  $university->university_description;?>
			<hr><hr>
		</div>
		<div class="col-lg-4">
			<table class="table table-bordered" style="text-align: right">
			  <thead>
			  	<tr>
			  		<th colspan="2">معلومات عامة</th>
			  	</tr>
			  </thead>
			  <tbody>
			    <tr>
			      <th scope="row">المدينة</th>
			      <td><?php echo $university->city_name ?></td>
			    </tr>
			    <tr>
			      <th scope="row">نوع الجامعة</th>
			      <td><?php echo $university_category ?></td>
			    </tr>
			    <tr>
			      <th scope="row">الترتيب العالمي</th>
			      <td><?php echo $university->university_world_order ?></td>
			    <tr>
			      <th scope="row">الترتيب المحلي</th>
			      <td><?php echo $university->university_local_order ?></td>
			    </tr>
			    <tr>
			      <th scope="row">لغات التدريس</th>
			      <td><?php echo $university->university_education_language ?></td>
			    </tr>
			    <tr>
			      <th scope="row">الامتحانات</th>
			      <td><?php echo $exam->exam_names ?></td>
			    </tr>
			  </tbody>
			</table>
			
			<table class="table table-bordered" style="text-align: right">
			  <thead>
			  	<tr>
			  		<th colspan="2">معلومات التواصل</th>
			  	</tr>
			  </thead>
			  <tbody>
			    <tr>
			      <th scope="row">رقم الهاتف</th>
			      <td>
			      	<a href="tel:<?php echo $university->university_tel ?>">
			      		<?php echo $university->university_tel ?>
			      	</a>
			      </td>
			    </tr>
			    <tr>
			      <th scope="row">البريد الالكتروني</th>
			      <td>
			      	<a href="mailto:<?php echo $university->university_email ?>">
			      		<?php echo $university->university_email ?>
			      	</a>
			      </td>
			    </tr>
			    <tr>
			      <th scope="row">الرابط</th>
			      <td>
			      	<a target="_blank" href="<?php echo $university->university_url; ?>">
			      		اضغط هنا
			      	</a>
			      </td>
			  	</tr>
			  	<tr>
			      <th scope="row">الموقع على الخريطة</th>
			      <td>
			      	<a target="_blank" href="<?php echo $university->university_map; ?>">
			      		اضغط هنا
			      	</a>
			      </td>
			  	</tr>
			     
			    
			  </tbody>
			</table>
		</div>
		<div class="col-lg-8">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<?php for ($i=0; $i < count($section); $i++) { ?>
					<li class="nav-item">
						<a class="nav-link <?php if($i==0) echo 'active'; ?>" 
							id="<?php echo $section[$i]->section_id.'-tab' ?>" data-toggle="tab" 
							href="<?php echo '#desc-'.$section[$i]->section_id ?>" role="tab" 
							aria-controls="<?php echo '#desc-'.$section[$i]->section_id ?>" 
							aria-selected="true">
							<?php echo $section[$i]->section_name; ?>
						</a>
				  	</li>
				<?php } ?>
			</ul>
			<div class="tab-content" id="myTabContent" style="text-align: right">
				<?php for ($i=0; $i < count($section); $i++) {  
					$option_names = explode("**//bossoft//**", $section[$i]->option_name);
					$option_values = explode("**//bossoft//**", $section[$i]->option_value);
					?>
					<div class="tab-pane fade show <?php if($i==0) echo 'active'; ?>" 
						id="<?php echo 'desc-'.$section[$i]->section_id ?>" role="tabpanel" 
						aria-labelledby="<?php echo $section[$i]->section_id.'-tab' ?>">
						<div class="accordion" id="<?php echo $section[$i]->section_id.'-accordion' ?>">
							<div class="mfn-acc accordion_wrapper open1st">
						<?php for ($j=0; $j < count($option_names); $j++) { ?>
							<div class="question <?php if($j==0) echo 'active'; ?>">
						        <div class="title">
						            <i class="icon-plus acc-icon-plus"></i><i class="icon-minus acc-icon-minus"></i>
						              <?php echo $option_names[$j]; ?>
						        </div>
						        <div class="answer" style="<?php if($j==0) echo 'display: block;'; ?>">
						            <p>
						               <?php echo $option_values[$j]; ?>
						            </p>
						        </div>
						    </div>
						<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>			  
			</div>
		</div>
	</div>
</div>
