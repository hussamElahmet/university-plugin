<?php

global $wpdb;

$university_id = $args['university_id'];
$university = $args['university'];


$university_category;
if ($university->university_category == 0) {
	$university_category = 'حكومية';
} else {
	$university_category = 'خاصة';
}



$degree_query = $wpdb->prepare(
	"
	SELECT d.degree_id,d.degree_name,
	GROUP_CONCAT(ud.branch_name SEPARATOR '**//bossoft//**' ) AS branch_name ,
	GROUP_CONCAT(ud.branch_study_years SEPARATOR '**//bossoft//**' ) AS branch_study_years ,
	GROUP_CONCAT(ud.branch_language SEPARATOR '**//bossoft//**' ) AS branch_language ,
	GROUP_CONCAT(ud.branch_before_discount SEPARATOR '**//bossoft//**' ) AS branch_before_discount ,
	GROUP_CONCAT(ud.branch_after_discount SEPARATOR '**//bossoft//**' ) AS branch_after_discount ,
	GROUP_CONCAT(ud.Status SEPARATOR '**//bossoft//**' ) AS branch_status 
	FROM university_degree ud INNER JOIN degree d ON ud.degree_id = d.degree_id AND ud.university_id = %s GROUP BY ud.degree_id order by d.degree_order
	",
	$university_id);

$degree = $wpdb->get_results($degree_query);


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
				<?php for ($i=0; $i < count($degree); $i++) { ?>
					<li class="nav-item">
						<a class="nav-link <?php if($i==0) echo 'active'; ?>" 
							id="<?php echo $degree[$i]->degree_id.'-tab' ?>" data-toggle="tab" 
							href="<?php echo '#desc-'.$degree[$i]->degree_id ?>" role="tab" 
							aria-controls="<?php echo '#desc-'.$degree[$i]->degree_id ?>" 
							aria-selected="true">
							<?php echo $degree[$i]->degree_name; ?>
						</a>
				  	</li>
				<?php } ?>
			</ul>
			<div class="tab-content" id="myTabContent" style="text-align: right">
				<?php for ($i=0; $i < count($degree); $i++) {  
					$branch_names = explode("**//bossoft//**", $degree[$i]->branch_name);
					$branch_study_years = explode("**//bossoft//**", $degree[$i]->branch_study_years);
					$branch_languages = explode("**//bossoft//**", $degree[$i]->branch_language);
					$branch_before_discounts = explode("**//bossoft//**", $degree[$i]->branch_before_discount);
					$branch_after_discounts = explode("**//bossoft//**", $degree[$i]->branch_after_discount);
					$status = explode("**//bossoft//**", $degree[$i]->branch_status);
					?>
					<div class="tab-pane fade show <?php if($i==0) echo 'active'; ?>" 
						id="<?php echo 'desc-'.$degree[$i]->degree_id ?>" role="tabpanel" 
						aria-labelledby="<?php echo $degree[$i]->degree_id.'-tab' ?>">
						<div class="col-lg-12 table-wrapper">
							<table class="table table-bordered calendar-table">
								<thead>
									<tr>
										<th>اسم التخصص</th>
										<th>السنوات الدراسية</th>
										<th>لغة التدريس</th>
										<th>المصروفات قبل التخفيض</th>
										<th>المصروفات بعد التخفيض</th>
										<th>الحالة</th>
									</tr>
								</thead>
								<tbody>
						<?php for ($j=0; $j < count($branch_names); $j++) { ?>
									<tr>
										<td><?php echo $branch_names[$j] ?></td>
										<td><?php echo $branch_study_years[$j] ?></td>
										<td><?php echo $branch_languages[$j] ?></td>
										<td><?php echo $branch_before_discounts[$j] ?></td>
										<td><?php echo $branch_after_discounts[$j] ?></td>
										<td><?php echo $status[$j]==0?'غير متاح':'متاح' ?></td>
									</tr>
						<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				<?php } ?>			  
			</div>
		</div>
	</div>
</div>
