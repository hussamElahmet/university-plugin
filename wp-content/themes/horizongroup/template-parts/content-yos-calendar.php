<?php

global $wpdb;

$result = $args['result'];

?>
<div class="container  pb-130" dir="rtl">
	<div class="row">
		<div class="col-lg-12 table-wrapper" style="text-align: center;">
			<h2>تقويم اليوس</h2>
			<br>
			<p><span style="color:red;"> ملاحظة:</span> يتم ترتيب الجامعات في الأسفل حسب تاريخ انتهاء التسجيل (الجامعة التي ستغلق قريبا في الأعلى)</p>
			<table class="table table-bordered calendar-table">
				<thead>
					<tr>
						<th>الجامعة</th>
						<th>المدينة</th>
						<th>تاريخ البدء</th>
						<th>تاريخ الانتهاء</th>
						<th>تاريخ الامتحان</th>
						<th>رابط التسجيل</th>
						<th>معلومات اكثر عن الجامعة</tة</th>
					</tr>
				</thead>
				<tbody>
					<?php for ($i=0; $i < count($result); $i++) {  ?>
						<tr>
						  <td><?php echo $result[$i]->university_name ?></td>
						  <td>
						  	<?php 
						  		echo $result[$i]->city_name 
						  	?>
						  </td>
						  <td>
						  	<?php 
						  		if ($result[$i]->yos_start_date == '0000-00-00') {
						  		 	echo 'غير محدد';
						  		} else {
						  			echo $result[$i]->yos_start_date;
						  		} 
						  	?>
						  </td>
						  <td>
						  	<?php 
						  		if ($result[$i]->yos_end_date == '0000-00-00') {
						  		 	echo 'غير محدد';
						  		} else {
						  			echo $result[$i]->yos_end_date;
						  		}
						  	?>
						  </td>
						  <td>
						  	<?php 
						  		if ($result[$i]->yos_result_date == '0000-00-00') {
						  		 	echo 'غير محدد';
						  		} else {
						  			echo $result[$i]->yos_result_date;
						  		}
						  	?>
						  </td>
						  <td>
						  	<?php 
						  		if ($result[$i]->yos_result_date == '0000-00-00') {
						  		 	echo 'غير محدد';
						  		} else {
						  			?>
						  			<a target="_blank" href="<?php echo $result[$i]->yos_result_url; ?>">
						  				اضغط هنا
						  			</a>
						  			<?php
						  			
						  		}
						  	?>
						  </td>
						  <td>
						  	<a target="_blank" href="<?php echo site_url().'/university-detail/'.$result[$i]->university_id; ?>">
						  		اضغط هنا
				  			</a>
						  </td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		
	</div>
</div>