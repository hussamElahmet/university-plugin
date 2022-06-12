<?php

function university_html()
{
	wp_enqueue_script('univesity_main_js', UNIVERSITY_PLUGIN_URL . '/js/university.js', 'jquery');
	wp_enqueue_script('bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js', 'jquery');
	wp_enqueue_style('bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');
	wp_enqueue_script('slimselect_js', UNIVERSITY_PLUGIN_URL . '/js/slimselect.js');
	wp_enqueue_style('slimselect_css', UNIVERSITY_PLUGIN_URL . '/css/slimselect.min.css');

	wp_enqueue_script('datatable_js', UNIVERSITY_PLUGIN_URL . '/js/jquery.dataTables.min.js');
	wp_enqueue_script('datatable_bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.bootstrap4.min.js');
	wp_enqueue_style('datatable_bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/dataTables.bootstrap4.min.css');


	wp_enqueue_script('responsive_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.responsive.min.js');
	wp_enqueue_style('responsive_css', UNIVERSITY_PLUGIN_URL . '/css/responsive.bootstrap4.min.css');

	global $wpdb;
	$result = $wpdb->get_results("SELECT * FROM university");
	$city = $wpdb->get_results("SELECT * FROM city");
?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL . '/img/loader.gif' ?>">
	</div>
	<div class="wrap">
		<input id="operation_type" type="hidden" value="i">
		<input id="operation_id" type="hidden">
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">الجامعات</h1><br><br>
			<div class="row">
				<div class="col-lg-5">
					<div class="form-field form-required term-name-wrap">
						<button class="button university_save">
							حفظ
						</button>
					</div><br><br>
					<div class="row">
						<div class="col-md-3">
							<input name="upload_image" id="upload_image" type="button" class="button" value="اختر صورة">
						</div>
						<div class="col-md-9 university_logo_wrapper">
							<img id="university_logo" src="" width="50px" height="50px">
						</div>
					</div><br>
					<div class="form-field form-required term-name-wrap">
						<label for="university_name">الاسم</label>
						<input name="university_name" id="university_name" type="text">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="university_tel">رقم الهاتف</label>
						<input name="university_tel" id="university_tel" type="text">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="university_email">البريد الالكتروني</label>
						<input name="university_email" id="university_email" type="text">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="university_url">الموقع الالكتروني</label>
						<input name="university_url" id="university_url" type="text">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="university_map">الموقع الجغرافي</label>
						<input name="university_map" id="university_map" type="text">
						<p>لايجاد رابط الموقع الجغرافي <a href="https://www.google.com.tr/maps" target="_blank_">اضغط هنا</a></p>
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="university_city">المدينة</label><br>
						<select name="university_city" id="university_city">
							<option value="0">اختر</option>
							<?php for ($i = 0; $i < count($city); $i++) { ?>
								<option value="<?php echo $city[$i]->city_id ?>"><?php echo $city[$i]->city_name ?></option>
							<?php } ?>
						</select>
					</div><br>
					<div class="form-field form-required term-name-wrap">
						<label for="university_world_order">الترتيب العالمي</label>
						<input name="university_world_order" id="university_world_order" type="number">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="university_local_order">الترتيب المحلي</label>
						<input name="university_local_order" id="university_local_order" type="number">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="university_education_language">لغة التدريس</label>
						<input name="university_education_language" id="university_education_language" type="text">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="university_category">نوع الجامعة</label>
						<select name="university_category" id="university_category">
							<option value="0">حكومية</option>
							<option value="1">خاصة</option>
						</select>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<?php wp_editor('	', 'section_content', $settings = array('textarea_name' => 'your_desired_name_for_$POST')); ?>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button university_save">
							حفظ
						</button>
					</div>
				</div>
				<div class="col-lg-7">
					<table id="university_table" class="display responsive table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>الشعار</th>
								<th>الاسم</th>
								<th>رقم الهاتف</th>
								<th>البريد الالكتروني</th>
								<th>الموقع الالكتروني</th>
								<th>الموقع الجغرافي</th>
								<th>المدينة</th>
								<th>الترتيب العالمي</th>
								<th>الترتيب المحلي</th>
								<th>لغة التدريس</th>
								<th>نوع الجامعة</th>
								<th>شرح عن الجامعة</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="university_content_modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div id="university_content" class="modal-body" style="text-align: right">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
				</div>
			</div>
		</div>
	</div>
<?php
}

function branch_html()
{
	wp_enqueue_script('branch_main_js', UNIVERSITY_PLUGIN_URL . '/js/branch.js', 'jquery');
	wp_enqueue_script('bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js', 'jquery');
	wp_enqueue_style('bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');

	wp_enqueue_script('datatable_js', UNIVERSITY_PLUGIN_URL . '/js/jquery.dataTables.min.js');
	wp_enqueue_script('datatable_bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.bootstrap4.min.js');
	wp_enqueue_style('datatable_bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/dataTables.bootstrap4.min.css');


	wp_enqueue_script('responsive_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.responsive.min.js');
	wp_enqueue_style('responsive_css', UNIVERSITY_PLUGIN_URL . '/css/responsive.bootstrap4.min.css');

?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL . '/img/loader.gif' ?>">
	</div>
	<div class="wrap">
		<input id="operation_type" type="hidden" value="i">
		<input id="operation_id" type="hidden">
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">التخصصات</h1><br><br>
			<div class="row">
				<div class="col-lg-7">
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save">
							حفظ
						</button>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="term_name">الاسم</label>
						<input name="term_name" id="term_name" type="text">
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<?php wp_editor('	', 'section_content', $settings = array('textarea_name' => 'your_desired_name_for_$POST')); ?>
					</div><br><br>
				</div>
				<div class="col-lg-5">
					<table id="term_table" class="display responsive table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>الاسم</th>
								<th>شرح التخصص</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="section_content_modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div id="section_content" class="modal-body" style="text-align: right">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
				</div>
			</div>
		</div>
	</div>
<?php
}

function section_html()
{
	wp_enqueue_script('section_main_js', UNIVERSITY_PLUGIN_URL . '/js/section.js', 'jquery');
	wp_enqueue_script('bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js', 'jquery');
	wp_enqueue_style('bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');

	wp_enqueue_script('datatable_js', UNIVERSITY_PLUGIN_URL . '/js/jquery.dataTables.min.js');
	wp_enqueue_script('datatable_bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.bootstrap4.min.js');
	wp_enqueue_style('datatable_bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/dataTables.bootstrap4.min.css');


	wp_enqueue_script('responsive_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.responsive.min.js');
	wp_enqueue_style('responsive_css', UNIVERSITY_PLUGIN_URL . '/css/responsive.bootstrap4.min.css');

?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL . '/img/loader.gif' ?>">
	</div>
	<div class="wrap">
		<input id="operation_type" type="hidden" value="i">
		<input id="operation_id" type="hidden">
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">أقسام اضافية</h1><br><br>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save">
							حفظ
						</button>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="term_name">الاسم</label>
						<input name="term_name" id="term_name" type="text">
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="term_order">الترتيب</label>
						<input name="term_order" id="term_order" type="number">
					</div><br><br>
				</div>
				<div class="col-lg-8">
					<table id="term_table" class="display responsive table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>الاسم</th>
								<th>الترتيب</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php
}

function exam_html()
{
	wp_enqueue_script('exam_main_js', UNIVERSITY_PLUGIN_URL . '/js/exam.js', 'jquery');
	wp_enqueue_script('bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js', 'jquery');
	wp_enqueue_style('bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');

	wp_enqueue_script('datatable_js', UNIVERSITY_PLUGIN_URL . '/js/jquery.dataTables.min.js');
	wp_enqueue_script('datatable_bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.bootstrap4.min.js');
	wp_enqueue_style('datatable_bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/dataTables.bootstrap4.min.css');


	wp_enqueue_script('responsive_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.responsive.min.js');
	wp_enqueue_style('responsive_css', UNIVERSITY_PLUGIN_URL . '/css/responsive.bootstrap4.min.css');

?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL . '/img/loader.gif' ?>">
	</div>
	<div class="wrap">
		<input id="operation_type" type="hidden" value="i">
		<input id="operation_id" type="hidden">
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">الامتحانات</h1><br><br>
			<div class="row">
				<div class="col-lg-7">
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save" disabled="disabled">
							حفظ
						</button>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="term_name">الاسم</label>
						<input name="term_name" id="term_name" type="text">
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<?php wp_editor('	', 'section_content', $settings = array('textarea_name' => 'your_desired_name_for_$POST')); ?>
					</div><br><br>
				</div>
				<div class="col-lg-5">
					<table id="term_table" class="display responsive table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>الاسم</th>
								<th>شرح الامتحان</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="section_content_modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div id="section_content" class="modal-body" style="text-align: right">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
				</div>
			</div>
		</div>
	</div>
<?php
}

function section_relation_html()
{
	wp_enqueue_script('section_relation_main_js', UNIVERSITY_PLUGIN_URL . '/js/section_relation.js', 'jquery');
	wp_enqueue_script('bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js', 'jquery');
	wp_enqueue_style('bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');

	wp_enqueue_script('datatable_js', UNIVERSITY_PLUGIN_URL . '/js/jquery.dataTables.min.js');
	wp_enqueue_script('datatable_bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.bootstrap4.min.js');
	wp_enqueue_style('datatable_bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/dataTables.bootstrap4.min.css');

	wp_enqueue_script('slimselect_js', UNIVERSITY_PLUGIN_URL . '/js/slimselect.js');
	wp_enqueue_style('slimselect_css', UNIVERSITY_PLUGIN_URL . '/css/slimselect.min.css');

	wp_enqueue_script('responsive_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.responsive.min.js');
	wp_enqueue_style('responsive_css', UNIVERSITY_PLUGIN_URL . '/css/responsive.bootstrap4.min.css');
	global $wpdb;

	$universities = $wpdb->get_results('SELECT * FROM university WHERE university_category = 0');
	$sections = $wpdb->get_results('SELECT * FROM section');
?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL . '/img/loader.gif' ?>">
	</div>
	<div class="wrap">
		<input id="operation_type" type="hidden" value="i">
		<input id="operation_id" type="hidden">
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">ربط الأقسام الاضافية</h1><br><br>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-field form-required term-name-wrap">
						<label for="universities">الجامعة</label>
						<select id="universities" name="universities">
							<option value="-1">اختر</option>
							<?php for ($i = 0; $i < count($universities); $i++) { ?>
								<option value="<?php echo $universities[$i]->university_id ?>">
									<?php echo $universities[$i]->university_name ?>
								</option>
							<?php } ?>
						</select>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="sections">الأقسام الاضافية</label>
						<select id="sections" name="sections">
							<option value="-1">اختر</option>
							<?php for ($i = 0; $i < count($sections); $i++) { ?>
								<option value="<?php echo $sections[$i]->section_id ?>">
									<?php echo $sections[$i]->section_name ?>
								</option>
							<?php } ?>
						</select>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save" disabled="disabled">
							حفظ
						</button>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="term_name">الاسم</label>
						<input name="term_name" id="term_name" type="text">
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="term_order">الترتيب</label>
						<input name="term_order" id="term_order" type="number">
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<?php wp_editor('	', 'section_content', $settings = array('textarea_name' => 'your_desired_name_for_$POST')); ?>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save" disabled="disabled">
							حفظ
						</button>
					</div>
				</div>
				<div class="col-lg-8">
					<table id="term_table" class="display responsive table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>الاسم</th>
								<th>المحتوى</th>
								<th>الترتيب</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="section_content_modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div id="section_content" class="modal-body" style="text-align: right">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
				</div>
			</div>
		</div>
	</div>
<?php
}

function priv_university_html()
{
	wp_enqueue_script('priv_university_js', UNIVERSITY_PLUGIN_URL . '/js/priv_university.js', 'jquery');
	wp_enqueue_script('bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js', 'jquery');
	wp_enqueue_style('bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');

	wp_enqueue_script('datatable_js', UNIVERSITY_PLUGIN_URL . '/js/jquery.dataTables.min.js');
	wp_enqueue_script('datatable_bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.bootstrap4.min.js');
	wp_enqueue_style('datatable_bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/dataTables.bootstrap4.min.css');

	wp_enqueue_script('slimselect_js', UNIVERSITY_PLUGIN_URL . '/js/slimselect.js');
	wp_enqueue_style('slimselect_css', UNIVERSITY_PLUGIN_URL . '/css/slimselect.min.css');

	wp_enqueue_script('responsive_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.responsive.min.js');
	wp_enqueue_style('responsive_css', UNIVERSITY_PLUGIN_URL . '/css/responsive.bootstrap4.min.css');
	global $wpdb;

	$universities = $wpdb->get_results('SELECT * FROM university WHERE university_category = 1');
	$degrees = $wpdb->get_results('SELECT * FROM degree');
	$areas = $wpdb->get_results('SELECT DISTINCT * FROM AREA_OF_STUDY');
	$branches=$wpdb->get_results('SELECT * FROM BRANCH');

?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL . '/img/loader.gif' ?>">
	</div>
	<div class="wrap">
		<input id="operation_type" type="hidden" value="i">
		<input id="operation_id" type="hidden">
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">ربط الجامعات الخاصة</h1><br><br>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-field form-required term-name-wrap">
						<label for="universities">الجامعة</label>
						<select id="universities" name="universities">
							<option value="-1">اختر</option>
							<?php for ($i = 0; $i < count($universities); $i++) { ?>
								<option value="<?php echo $universities[$i]->university_id ?>">
									<?php echo $universities[$i]->university_name ?>
								</option>
							<?php } ?>
						</select>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save" disabled="disabled">
							حفظ
						</button>
					</div><br><br>
					<!-- <div class="form-field form-required term-name-wrap">
						<label for="branch_name">اسم التخصص</label>
						<input name="branch_name" id="branch_name" type="text">
					</div> -->
					
					
				
			
			<br><br>
			<div class="form-field form-required term-name-wrap ss-single-selected">
			<label for="branc_name">اسم الفرع</label>
 	    <select id="branch_name" name="branch_name"  >
							<!-- <option value="-1">اسم التخصص</option> -->
                           
							<?php for ($i = 0; $i < count($branches); $i++) { ?>
								<option style="direction: ltr;" value="<?php echo $branches[$i]->branch_name?>">
									<?php echo $branches[$i]->branch_name ?>
								</option>
							<?php } ?>
						</select>
			</div>
			
			<br><br>	
					<div class="form-field form-required term-name-wrap">
						<label for="branch_study_years">السنوات الدراسية</label>
						<input name="branch_study_years" id="branch_study_years" type="text">
					</div><br><br>
					<!-- <div class="form-field form-required term-name-wrap">
						<label for="branch_language">لغة التدريس</label>
						<input name="branch_language" id="branch_language" type="text" placeholder="التركية و الانكليزية">
					</div> -->
					<div class="form-field form-required term-name-wrap">
						<label for="branch_language">لغة التدريس</label>
						<select id="branch_language">
						<option value="التركية">التركية</option>
						<option value="الانكليزية">الانكليزية</option>
						<option value="التركية و الانكليزية">التركية و الانكليزية</option>
						</select>
					</div>
					<div class="form-field form-required term-name-wrap ss-single-selected">
						<!-- <select id="branch_language" name="branch_language"  >
							 <option value="التركية">التركية</option>
							 <option value="الانكليزية">الانجليزية</option>
						</select> -->
			</div>
					
					
					
					<br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="branch_before_discount">المصروفات الدراسية قبل التخفيض</label>
						<input name="branch_before_discount" id="branch_before_discount" type="text">
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="branch_after_discount">المصروفات الدراسية بعد التخفيض</label>
						<input name="branch_after_discount" id="branch_after_discount" type="text">
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="degrees">الدرجة العلمية</label>
						<select id="degrees" name="degrees">
							<option value="-1">اختر</option>
							<?php for ($i = 0; $i < count($degrees); $i++) { ?>
								<option value="<?php echo $degrees[$i]->degree_id ?>">
									<?php echo $degrees[$i]->degree_name ?>
								</option>
							<?php } ?>
						</select>
					</div>
					<br><br>
					<!-- status -->
					<div class="form-field form-required term-name-wrap">
						<label for="status">الحالة</label>
						<select id="status" name="status">
							<option value="0">Unavailable(غير متاح)</option>
							<option value="1">Available(متاح)</option>
						</select>
					</div>
					<br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save" disabled="disabled">
							حفظ
						</button>
					</div>
				</div>
				<div class="col-lg-8">
					<table id="term_table" class="display responsive table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>الاسم</th>
								<th>سنوات الدراسة</th>
								<th>لغة التدريس</th>
								<th>المصروفات قبل الخصم</th>
								<th>المصروفات بعد الخصم</th>
								<th>الدرجة العلمية</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="section_content_modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div id="section_content" class="modal-body" style="text-align: right">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
				</div>
			</div>
		</div>
	</div>
<?php
}


function exam_relation_html()
{
	wp_enqueue_script('exam_relation_main_js', UNIVERSITY_PLUGIN_URL . '/js/exam_relation.js', 'jquery');
	wp_enqueue_script('bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js', 'jquery');
	wp_enqueue_style('bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');

	wp_enqueue_script('datatable_js', UNIVERSITY_PLUGIN_URL . '/js/jquery.dataTables.min.js');
	wp_enqueue_script('datatable_bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.bootstrap4.min.js');
	wp_enqueue_style('datatable_bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/dataTables.bootstrap4.min.css');

	wp_enqueue_script('slimselect_js', UNIVERSITY_PLUGIN_URL . '/js/slimselect.js');
	wp_enqueue_style('slimselect_css', UNIVERSITY_PLUGIN_URL . '/css/slimselect.min.css');

	wp_enqueue_script('responsive_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.responsive.min.js');
	wp_enqueue_style('responsive_css', UNIVERSITY_PLUGIN_URL . '/css/responsive.bootstrap4.min.css');
	global $wpdb;

	$universities = $wpdb->get_results('SELECT * FROM university WHERE university_category = 0');
?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL . '/img/loader.gif' ?>">
	</div>
	<div class="wrap">
		<input id="operation_type" type="hidden" value="i">
		<input id="operation_id" type="hidden">
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">ربط الامتحانات</h1><br><br>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-field form-required term-name-wrap">
						<label for="universities">الجامعة</label>
						<select id="universities" name="universities">
							<option value="-1">اختر</option>
							<?php for ($i = 0; $i < count($universities); $i++) { ?>
								<option value="<?php echo $universities[$i]->university_id ?>">
									<?php echo $universities[$i]->university_name ?>
								</option>
							<?php } ?>
						</select>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save" disabled="disabled">
							حفظ
						</button>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="exams">الامتحانات</label>
						<select id="exams" name="exams">

						</select>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save" disabled="disabled">
							حفظ
						</button>
					</div>
				</div>
				<div class="col-lg-8">
					<table id="term_table" class="display responsive table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>الاسم</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php
}


function app_calendar_html()
{
	wp_enqueue_script('app_calendar_js', UNIVERSITY_PLUGIN_URL . '/js/app_calendar.js', 'jquery');
	wp_enqueue_script('bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js', 'jquery');
	wp_enqueue_style('bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');
	wp_enqueue_script('slimselect_js', UNIVERSITY_PLUGIN_URL . '/js/slimselect.js');
	wp_enqueue_style('slimselect_css', UNIVERSITY_PLUGIN_URL . '/css/slimselect.min.css');

	wp_enqueue_script('datatable_js', UNIVERSITY_PLUGIN_URL . '/js/jquery.dataTables.min.js');
	wp_enqueue_script('datatable_bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.bootstrap4.min.js');
	wp_enqueue_style('datatable_bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/dataTables.bootstrap4.min.css');


	wp_enqueue_script('responsive_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.responsive.min.js');
	wp_enqueue_style('responsive_css', UNIVERSITY_PLUGIN_URL . '/css/responsive.bootstrap4.min.css');

	global $wpdb;
	$result = $wpdb->get_results("SELECT * FROM university WHERE university_category = 0");
?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL . '/img/loader.gif' ?>">
	</div>
	<div class="wrap">
		<input id="operation_type" type="hidden" value="i">
		<input id="operation_id" type="hidden">
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">تقويم المفاضلات</h1><br><br>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save">
							حفظ
						</button>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="universities">الجامعة</label>
						<select id="universities" name="universities">
							<?php for ($i = 0; $i < count($result); $i++) { ?>
								<option value="<?php echo $result[$i]->university_id ?>">
									<?php echo $result[$i]->university_name ?>
								</option>
							<?php } ?>
						</select>
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="app_name">اسم المفاضلة</label>
						<input name="app_name" id="app_name" type="text">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="app_start_date">بدء لتسجيل</label>
						<input name="app_start_date" id="app_start_date" type="date">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="app_end_date">انتهاء التسجيل</label>
						<input name="app_end_date" id="app_end_date" type="date">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="app_result_date">اعلان النتائج</label>
						<input name="app_result_date" id="app_result_date" type="date">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="app_result_url">رابط النتائج</label>
						<input name="app_result_url" id="app_result_url" type="text">
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="favcolor">اختر اللون</label>
						<input type="color" id="app_color" name="app_color" value="#000000">
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save">
							حفظ
						</button>
					</div>
				</div>
				<div class="col-lg-8">
					<table id="term_table" class="display responsive table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>الجامعة</th>
								<th>المدينة</th>
								<th>المفاضلة</th>
								<th>بدء التسجيل</th>
								<th>انتهاء التسجيل</th>
								<th>اعلان النتائج</th>
								<th>رابط التسجيل</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php
}

function yos_calendar_html()
{
	wp_enqueue_script('yos_calendar_js', UNIVERSITY_PLUGIN_URL . '/js/yos_calendar.js', 'jquery');
	wp_enqueue_script('bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js', 'jquery');
	wp_enqueue_style('bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');
	wp_enqueue_script('slimselect_js', UNIVERSITY_PLUGIN_URL . '/js/slimselect.js');
	wp_enqueue_style('slimselect_css', UNIVERSITY_PLUGIN_URL . '/css/slimselect.min.css');

	wp_enqueue_script('datatable_js', UNIVERSITY_PLUGIN_URL . '/js/jquery.dataTables.min.js');
	wp_enqueue_script('datatable_bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.bootstrap4.min.js');
	wp_enqueue_style('datatable_bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/dataTables.bootstrap4.min.css');


	wp_enqueue_script('responsive_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.responsive.min.js');
	wp_enqueue_style('responsive_css', UNIVERSITY_PLUGIN_URL . '/css/responsive.bootstrap4.min.css');

	global $wpdb;
	$result = $wpdb->get_results("SELECT * FROM university WHERE university_category = 0");
?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL . '/img/loader.gif' ?>">
	</div>
	<div class="wrap">
		<input id="operation_type" type="hidden" value="i">
		<input id="operation_id" type="hidden">
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">تقويم اليوس</h1><br><br>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save">
							حفظ
						</button>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="universities">الجامعة</label>
						<select id="universities" name="universities">
							<?php for ($i = 0; $i < count($result); $i++) { ?>
								<option value="<?php echo $result[$i]->university_id ?>">
									<?php echo $result[$i]->university_name ?>
								</option>
							<?php } ?>
						</select>
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="yos_start_date">بدء لتسجيل</label>
						<input name="yos_start_date" id="yos_start_date" type="date">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="yos_end_date">انتهاء التسجيل</label>
						<input name="yos_end_date" id="yos_end_date" type="date">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="yos_result_date">تاريخ الامتحان</label>
						<input name="yos_result_date" id="yos_result_date" type="date">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="yos_result_url">رابط النتائج</label>
						<input name="yos_result_url" id="yos_result_url" type="text">
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save">
							حفظ
						</button>
					</div>
				</div>
				<div class="col-lg-8">
					<table id="term_table" class="display responsive table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>الجامعة</th>
								<th>المدينة</th>
								<th>بدء التسجيل</th>
								<th>انتهاء التسجيل</th>
								<th>تاريخ الامتحان</th>
								<th>رابط التسجيل</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php
}

function slider_html()
{
	wp_enqueue_script('slider_js', UNIVERSITY_PLUGIN_URL . '/js/slider.js', 'jquery');
	wp_enqueue_script('bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js', 'jquery');
	wp_enqueue_style('bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');
	wp_enqueue_script('slimselect_js', UNIVERSITY_PLUGIN_URL . '/js/slimselect.js');
	wp_enqueue_style('slimselect_css', UNIVERSITY_PLUGIN_URL . '/css/slimselect.min.css');

	wp_enqueue_script('datatable_js', UNIVERSITY_PLUGIN_URL . '/js/jquery.dataTables.min.js');
	wp_enqueue_script('datatable_bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.bootstrap4.min.js');
	wp_enqueue_style('datatable_bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/dataTables.bootstrap4.min.css');


	wp_enqueue_script('responsive_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.responsive.min.js');
	wp_enqueue_style('responsive_css', UNIVERSITY_PLUGIN_URL . '/css/responsive.bootstrap4.min.css');

?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL . '/img/loader.gif' ?>">
	</div>
	<div class="wrap">
		<input id="operation_type" type="hidden" value="i">
		<input id="operation_id" type="hidden">
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">سلايدر</h1><br><br>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save">
							حفظ
						</button>
					</div><br><br>
					<div class="row">
						<div class="col-md-3">
							<input name="upload_image" id="upload_image" type="button" class="button" value="اختر صورة">
						</div>
						<div class="col-md-9 university_logo_wrapper">
							<img id="slider_image" src="" width="50px" height="50px">
						</div>
					</div><br>
					<div class="form-field form-required term-name-wrap">
						<label for="slider_title">العنوان</label>
						<input name="slider_title" id="slider_title" type="text">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="slider_description">الوصف</label>
						<input name="slider_description" id="slider_description" type="text">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="slider_order">الترتيب</label>
						<input name="slider_order" id="slider_order" type="number">
					</div>
					<br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save">
							حفظ
						</button>
					</div>
				</div>
				<div class="col-lg-8">
					<table id="term_table" class="display responsive table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>الصورة</th>
								<th>العنوان</th>
								<th>الوصف</th>
								<th>الترتيب</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php
}

function team_html()
{
	wp_enqueue_script('team_js', UNIVERSITY_PLUGIN_URL . '/js/team.js', 'jquery');
	wp_enqueue_script('bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js', 'jquery');
	wp_enqueue_style('bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');
	wp_enqueue_script('slimselect_js', UNIVERSITY_PLUGIN_URL . '/js/slimselect.js');
	wp_enqueue_style('slimselect_css', UNIVERSITY_PLUGIN_URL . '/css/slimselect.min.css');

	wp_enqueue_script('datatable_js', UNIVERSITY_PLUGIN_URL . '/js/jquery.dataTables.min.js');
	wp_enqueue_script('datatable_bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.bootstrap4.min.js');
	wp_enqueue_style('datatable_bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/dataTables.bootstrap4.min.css');


	wp_enqueue_script('responsive_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.responsive.min.js');
	wp_enqueue_style('responsive_css', UNIVERSITY_PLUGIN_URL . '/css/responsive.bootstrap4.min.css');

?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL . '/img/loader.gif' ?>">
	</div>
	<div class="wrap">
		<input id="operation_type" type="hidden" value="i">
		<input id="operation_id" type="hidden">
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">سلايدر</h1><br><br>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save">
							حفظ
						</button>
					</div><br><br>
					<div class="row">
						<div class="col-md-3">
							<input name="upload_image" id="upload_image" type="button" class="button" value="اختر صورة">
						</div>
						<div class="col-md-9 university_logo_wrapper">
							<img id="team_image" src="" width="50px" height="50px">
						</div>
					</div><br>
					<div class="form-field form-required term-name-wrap">
						<label for="team_name">الاسم</label>
						<input name="team_name" id="team_name" type="text">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="team_position">الدور</label>
						<input name="team_position" id="team_position" type="text">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="team_description">الوصف</label>
						<input name="team_description" id="team_description" type="text">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="team_order">الترتيب</label>
						<input name="team_order" id="team_order" type="number">
					</div>
					<br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save">
							حفظ
						</button>
					</div>
				</div>
				<div class="col-lg-8">
					<table id="term_table" class="display responsive table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>الصورة</th>
								<th>الاسم</th>
								<th>الدور</th>
								<th>الوصف</th>
								<th>الترتيب</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php
}

function site_setting_html()
{
	wp_enqueue_script('site_setting_js', UNIVERSITY_PLUGIN_URL . '/js/site_setting.js', 'jquery');
	wp_enqueue_script('bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js', 'jquery');
	wp_enqueue_style('bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');
	wp_enqueue_script('slimselect_js', UNIVERSITY_PLUGIN_URL . '/js/slimselect.js');
	wp_enqueue_style('slimselect_css', UNIVERSITY_PLUGIN_URL . '/css/slimselect.min.css');
	$categories = get_categories(
		array('hide_empty' => FALSE)
	);
	$menu_category = get_option('university_menu_category');
	$address = get_option('university_address');
	$email = get_option('university_email');
	$facebook = get_option('university_facebook');
	$instagram = get_option('university_instagram');
	$telegram = get_option('university_telegram');
	$tel = get_option('university_tel');
	$tel1 = get_option('university_tel1');
	$tel2 = get_option('university_tel2');
	$tel3 = get_option('university_tel3');
?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL . '/img/loader.gif' ?>">
	</div>
	<div class="wrap setting">
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">اعدادات الموقع</h1><br><br>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-field form-required term-name-wrap">
						<label for="categories">الفئة التي ستعرض في القائمة</label>
						<select id="categories" name="categories">
							<option value="-1">اختر</option>
							<?php for ($i = 0; $i < count($categories); $i++) { ?>
								<option value="<?php echo $categories[$i]->cat_ID ?>" <?php if ($categories[$i]->cat_ID == $menu_category) echo 'selected' ?>>
									<?php echo $categories[$i]->cat_name ?>
								</option>
							<?php } ?>
						</select>
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="university_address">العنوان</label>
						<input id="university_address" name="university_address" type="text" value="<?php echo $address; ?>">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="university_email">الايميل</label>
						<input id="university_email" name="university_email" type="text" value="<?php echo $email; ?>">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="university_facebook">فيس بوك (رابط الصفحة)</label>
						<input id="university_facebook" name="university_facebook" type="text" value="<?php echo $facebook; ?>">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="university_instagram">انستاغرام (رابط الصفحة)</label>
						<input id="university_instagram" name="university_instagram" type="text" value="<?php echo $instagram; ?>">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="university_telegram">تليغرام (اسم الحساب)</label>
						<input id="university_telegram" name="university_telegram" type="text" value="<?php echo $telegram; ?>">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="university_tel">الهاتف 1</label>
						<input id="university_tel" name="university_tel" type="text" value="<?php echo $tel; ?>">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="university_tel1">الهاتف 2</label>
						<input id="university_tel1" name="university_tel1" type="text" value="<?php echo $tel1; ?>">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="university_tel2">الهاتف 3</label>
						<input id="university_tel2" name="university_tel2" type="text" value="<?php echo $tel2; ?>">
					</div>
					<div class="form-field form-required term-name-wrap">
						<label for="university_tel3">الهاتف 4</label>
						<input id="university_tel3" name="university_tel3" type="text" value="<?php echo $tel3; ?>">
					</div>
				</div>
			</div><br><br>

			<div class="row">
				<div class="col-lg-6">
					<button id="save_setting" class="button">حفظ</button>
				</div>
			</div>

		</div>
	</div>
<?php
}
/*
// removed
function faculty_html() {
	wp_enqueue_script( 'faculty_main_js', UNIVERSITY_PLUGIN_URL . '/js/faculty.js','jquery');
	wp_enqueue_script( 'bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js','jquery');
	wp_enqueue_style( 'bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');

	wp_enqueue_script( 'datatable_js', UNIVERSITY_PLUGIN_URL . '/js/jquery.dataTables.min.js');
	wp_enqueue_script( 'datatable_bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.bootstrap4.min.js');
	wp_enqueue_style( 'datatable_bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/dataTables.bootstrap4.min.css');
	

	wp_enqueue_script( 'responsive_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.responsive.min.js');
	wp_enqueue_style( 'responsive_css', UNIVERSITY_PLUGIN_URL . '/css/responsive.bootstrap4.min.css');

	?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL.'/img/loader.gif'?>">
	</div>
	<div class="wrap">
		<input id="operation_type" type="hidden" value="i">	
		<input id="operation_id" type="hidden">	
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">الكليات</h1><br><br>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save" >
							حفظ
						</button>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="term_name">الاسم</label>
						<input name="term_name" id="term_name" type="text">
					</div>
				</div>
				<div class="col-lg-8">
					<table id="term_table" class="display responsive table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>الاسم</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php
}

function institute_html() {
	wp_enqueue_script( 'institute_main_js', UNIVERSITY_PLUGIN_URL . '/js/institute.js','jquery');
	wp_enqueue_script( 'bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js','jquery');
	wp_enqueue_style( 'bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');

	wp_enqueue_script( 'datatable_js', UNIVERSITY_PLUGIN_URL . '/js/jquery.dataTables.min.js');
	wp_enqueue_script( 'datatable_bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.bootstrap4.min.js');
	wp_enqueue_style( 'datatable_bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/dataTables.bootstrap4.min.css');
	

	wp_enqueue_script( 'responsive_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.responsive.min.js');
	wp_enqueue_style( 'responsive_css', UNIVERSITY_PLUGIN_URL . '/css/responsive.bootstrap4.min.css');

	?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL.'/img/loader.gif'?>">
	</div>
	<div class="wrap">
		<input id="operation_type" type="hidden" value="i">	
		<input id="operation_id" type="hidden">	
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">المعاهد</h1><br><br>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save" >
							حفظ
						</button>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="term_name">الاسم</label>
						<input name="term_name" id="term_name" type="text">
					</div>
				</div>
				<div class="col-lg-8">
					<table id="term_table" class="display responsive table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>الاسم</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php
}

function faculty_relation_html() {
	wp_enqueue_script( 'faculty_relation_main_js', UNIVERSITY_PLUGIN_URL . '/js/faculty_relation.js','jquery');
	wp_enqueue_script( 'bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js','jquery');
	wp_enqueue_style( 'bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');

	wp_enqueue_script( 'datatable_js', UNIVERSITY_PLUGIN_URL . '/js/jquery.dataTables.min.js');
	wp_enqueue_script( 'datatable_bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.bootstrap4.min.js');
	wp_enqueue_style( 'datatable_bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/dataTables.bootstrap4.min.css');
	
	wp_enqueue_script( 'slimselect_js', UNIVERSITY_PLUGIN_URL . '/js/slimselect.js');
	wp_enqueue_style( 'slimselect_css', UNIVERSITY_PLUGIN_URL . '/css/slimselect.min.css');

	wp_enqueue_script( 'responsive_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.responsive.min.js');
	wp_enqueue_style( 'responsive_css', UNIVERSITY_PLUGIN_URL . '/css/responsive.bootstrap4.min.css');
	global $wpdb;

	$universities = $wpdb->get_results('SELECT * FROM university');
	?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL.'/img/loader.gif'?>">
	</div>
	<div class="wrap">
		<input id="operation_type" type="hidden" value="i">	
		<input id="operation_id" type="hidden">	
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">ربط الكليات</h1><br><br>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-field form-required term-name-wrap">
						<label for="universities">الجامعة</label>
						<select id="universities" name="universities" >
							<option value="-1">اختر</option>
							<?php for ($i=0; $i < count($universities); $i++) { ?>
								<option value="<?php echo $universities[$i]->university_id ?>">
									<?php echo $universities[$i]->university_name ?>
								</option>
							<?php } ?>
						</select>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save" disabled="disabled">
							حفظ
						</button>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="faculties">الكليات</label>
						<select id="faculties" name="faculties" >

						</select>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="term_url">الرابط</label>
						<input name="term_url" id="term_url" type="text">
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save" disabled="disabled">
							حفظ
						</button>
					</div>
				</div>
				<div class="col-lg-8">
					<table id="term_table" class="display responsive table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>الاسم</th>
								<th>الرابط</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php
}

function institute_relation_html() {
	wp_enqueue_script( 'institute_relation_main_js', UNIVERSITY_PLUGIN_URL . '/js/institute_relation.js','jquery');
	wp_enqueue_script( 'bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js','jquery');
	wp_enqueue_style( 'bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');

	wp_enqueue_script( 'datatable_js', UNIVERSITY_PLUGIN_URL . '/js/jquery.dataTables.min.js');
	wp_enqueue_script( 'datatable_bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.bootstrap4.min.js');
	wp_enqueue_style( 'datatable_bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/dataTables.bootstrap4.min.css');
	
	wp_enqueue_script( 'slimselect_js', UNIVERSITY_PLUGIN_URL . '/js/slimselect.js');
	wp_enqueue_style( 'slimselect_css', UNIVERSITY_PLUGIN_URL . '/css/slimselect.min.css');

	wp_enqueue_script( 'responsive_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.responsive.min.js');
	wp_enqueue_style( 'responsive_css', UNIVERSITY_PLUGIN_URL . '/css/responsive.bootstrap4.min.css');
	global $wpdb;

	$universities = $wpdb->get_results('SELECT * FROM university');
	?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL.'/img/loader.gif'?>">
	</div>
	<div class="wrap">
		<input id="operation_type" type="hidden" value="i">	
		<input id="operation_id" type="hidden">	
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">ربط المعاهد</h1><br><br>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-field form-required term-name-wrap">
						<label for="universities">الجامعة</label>
						<select id="universities" name="universities" >
							<option value="-1">اختر</option>
							<?php for ($i=0; $i < count($universities); $i++) { ?>
								<option value="<?php echo $universities[$i]->university_id ?>">
									<?php echo $universities[$i]->university_name ?>
								</option>
							<?php } ?>
						</select>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save" disabled="disabled">
							حفظ
						</button>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="institutes">المعاهد</label>
						<select id="institutes" name="institutes" >

						</select>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="term_url">الرابط</label>
						<input name="term_url" id="term_url" type="text">
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save" disabled="disabled">
							حفظ
						</button>
					</div>
				</div>
				<div class="col-lg-8">
					<table id="term_table" class="display responsive table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>الاسم</th>
								<th>الرابط</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php
}

function branch_faculty_relation_html() {
	wp_enqueue_script( 'branch_faculty_main_js', UNIVERSITY_PLUGIN_URL . '/js/branch_faculty.js','jquery');
	wp_enqueue_script( 'bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js','jquery');
	wp_enqueue_style( 'bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');

	wp_enqueue_script( 'datatable_js', UNIVERSITY_PLUGIN_URL . '/js/jquery.dataTables.min.js');
	wp_enqueue_script( 'datatable_bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.bootstrap4.min.js');
	wp_enqueue_style( 'datatable_bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/dataTables.bootstrap4.min.css');
	
	wp_enqueue_script( 'slimselect_js', UNIVERSITY_PLUGIN_URL . '/js/slimselect.js');
	wp_enqueue_style( 'slimselect_css', UNIVERSITY_PLUGIN_URL . '/css/slimselect.min.css');

	wp_enqueue_script( 'responsive_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.responsive.min.js');
	wp_enqueue_style( 'responsive_css', UNIVERSITY_PLUGIN_URL . '/css/responsive.bootstrap4.min.css');
	global $wpdb;

	$universities = $wpdb->get_results('SELECT * FROM university');
	?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL.'/img/loader.gif'?>">
	</div>
	<div class="wrap">
		<input id="operation_type" type="hidden" value="i">	
		<input id="operation_id" type="hidden">	
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">ربط التخصصات بالكليات</h1><br><br>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-field form-required term-name-wrap">
						<label for="universities">الجامعة</label>
						<select id="universities" name="universities" >
							<option value="-1">اختر</option>
							<?php for ($i=0; $i < count($universities); $i++) { ?>
								<option value="<?php echo $universities[$i]->university_id ?>">
									<?php echo $universities[$i]->university_name ?>
								</option>
							<?php } ?>
						</select>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="faculties">الكليات</label>
						<select id="faculties" name="faculties" >

						</select>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save" disabled="disabled">
							حفظ
						</button>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="branches">التخصصات</label>
						<select id="branches" name="branches" >

						</select>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="term_url">الرابط</label>
						<input name="term_url" id="term_url" type="text">
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save" disabled="disabled">
							حفظ
						</button>
					</div>
				</div>
				<div class="col-lg-8">
					<table id="term_table" class="display responsive table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>الاسم</th>
								<th>الرابط</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php
}

function branch_institute_relation_html() {
	wp_enqueue_script( 'branch_faculty_main_js', UNIVERSITY_PLUGIN_URL . '/js/branch_institute.js','jquery');
	wp_enqueue_script( 'bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/bootstrap.js','jquery');
	wp_enqueue_style( 'bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/bootstrap.css');

	wp_enqueue_script( 'datatable_js', UNIVERSITY_PLUGIN_URL . '/js/jquery.dataTables.min.js');
	wp_enqueue_script( 'datatable_bootstrap_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.bootstrap4.min.js');
	wp_enqueue_style( 'datatable_bootstrap_css', UNIVERSITY_PLUGIN_URL . '/css/dataTables.bootstrap4.min.css');
	
	wp_enqueue_script( 'slimselect_js', UNIVERSITY_PLUGIN_URL . '/js/slimselect.js');
	wp_enqueue_style( 'slimselect_css', UNIVERSITY_PLUGIN_URL . '/css/slimselect.min.css');

	wp_enqueue_script( 'responsive_js', UNIVERSITY_PLUGIN_URL . '/js/dataTables.responsive.min.js');
	wp_enqueue_style( 'responsive_css', UNIVERSITY_PLUGIN_URL . '/css/responsive.bootstrap4.min.css');
	global $wpdb;

	$universities = $wpdb->get_results('SELECT * FROM university');
	?>
	<div class="loader">
		<img src="<?php echo UNIVERSITY_PLUGIN_URL.'/img/loader.gif'?>">
	</div>
	<div class="wrap">
		<input id="operation_type" type="hidden" value="i">	
		<input id="operation_id" type="hidden">	
		<div class="container-fluid add_university_wrapper" dir="rtl">
			<h1 class="wp-heading-inline">ربط التخصصات بالمعاهد</h1><br><br>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-field form-required term-name-wrap">
						<label for="universities">الجامعة</label>
						<select id="universities" name="universities" >
							<option value="-1">اختر</option>
							<?php for ($i=0; $i < count($universities); $i++) { ?>
								<option value="<?php echo $universities[$i]->university_id ?>">
									<?php echo $universities[$i]->university_name ?>
								</option>
							<?php } ?>
						</select>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="institutes">المعاهد</label>
						<select id="institutes" name="institutes" >
							
						</select>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save" disabled="disabled">
							حفظ
						</button>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="branches">التخصصات</label>
						<select id="branches" name="branches" >

						</select>
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<label for="term_url">الرابط</label>
						<input name="term_url" id="term_url" type="text">
					</div><br><br>
					<div class="form-field form-required term-name-wrap">
						<button class="button term_save" disabled="disabled">
							حفظ
						</button>
					</div>
				</div>
				<div class="col-lg-8">
					<table id="term_table" class="display responsive table table-striped table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>الاسم</th>
								<th>الرابط</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php
}

*/
