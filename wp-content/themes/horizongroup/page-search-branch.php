<?php
get_header();
global $wpdb;
$degrees = $wpdb->get_results('SELECT DISTINCT * FROM degree');
$university = $wpdb->get_results('SELECT DISTINCT * FROM university where university_category=1');
$branches = $wpdb->get_results('SELECT DISTINCT * FROM BRANCH');
$cities = $wpdb->get_results('SELECT DISTINCT * FROM CITY');
$areas = $wpdb->get_results('SELECT DISTINCT * FROM AREA_OF_STUDY');
?>
<style>
	.hussamtest {
		cursor: not-allowed;
		pointer-events: none;
	}
</style>
<div class="breadcrumb-area">
	<div class="breadcrumb-top default-overlay bg-img breadcrumb-overly-3 pt-100 pb-95" style="background-image:url(<?php echo get_template_directory_uri() . '/assets/img/university.jpg' ?>);">
		<div class="container" style="text-align: right" dir="rtl">
			<h2>ابحث عن تخصصك</h2>
		</div>
	</div>
</div>


<div class="container pt-100 pb-90" dir="ltr">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<!-- <select id="branch">
                <option value="-1">ابحث عن تخصصك</option>
            </select> -->

			<div class="form-field form-required term-name-wrap ss-single-selected">
				<select id="areas" name="areas">
					<option value="-1">Area Of Study</option>
					<?php for ($i = 0; $i < count($areas); $i++) { ?>
						<option value="<?php echo $areas[$i]->area_id ?>">
							<?php echo $areas[$i]->area_name ?>
						</option>
					<?php } ?>
				</select>
			</div>

			<br>
			<!-- <div class="form-field form-required term-name-wrap ss-single-selected">
						<select id="branches" name="branches" onChange="changeEvent()"  >
							<option value="-1">Search Branch</option>
                           
							<?php for ($i = 0; $i < count($branches); $i++) { ?>
								<option  value="<?php echo $branches[$i]->branch_name ?>">
									<?php echo $branches[$i]->branch_name ?>
								</option>
							<?php } ?>
						</select>
			</div> -->
			<div class="form-field form-required term-name-wrap ss-single-selected">
				<select id="language" name="language">
					<option value="-1"> Language</option>
					<option value="التركية">Turkish</option>
					<option value="الانكليزية">English</option>
				</select>
			</div>
			<br>
			<select id="searchBranch">
				<option value="-1">Find Your Branch</option>
			</select>

			<br>
			<br>
			<div class="form-field form-required term-name-wrap ss-single-selected">
				<select id="degrees" name="degrees">
					<option value="-1">Degree</option>
					<?php for ($i = 0; $i < count($degrees); $i++) { ?>
						<option value="<?php echo $degrees[$i]->degree_id ?>">
							<?php echo $degrees[$i]->degree_name ?>
						</option>
					<?php } ?>
				</select>
			</div>
			<br>
			<div class="form-field form-required term-name-wrap ss-single-selected">
				<select id="cities" name="cities">
					<option value="-1">Cities</option>
					<?php for ($i = 0; $i < count($cities); $i++) { ?>
						<option value="<?php echo $cities[$i]->city_id ?>">
							<?php echo $cities[$i]->city_name ?>
						</option>
					<?php } ?>
				</select>
			</div>
			<br>
			<div class="form-field form-required term-name-wrap ss-single-selected">
				<select id="status" name="status">
					<option value="-1"> Status</option>
					<option value="0">Unavailable</option>
					<option value="1">Available</option>
				</select>
			</div>
			<br>
			<div class="form-field form-required term-name-wrap ss-single-selected">
				<select id="university" name="university">
					<option value="-1">University</option>
					<?php for ($i = 0; $i < count($university); $i++) { ?>
						<option value="<?php echo $university[$i]->university_id ?>">
							<?php echo $university[$i]->university_name ?>
						</option>
					<?php } ?>
				</select>
			</div>

		</div>
	</div>
</div>

<!-- <div style="width:100%;height:100px"></div> -->


<div class="result_wrapper">

</div>

<script>
	function changeEvent() {


	}
</script>
<?php
get_footer();
