<?php

global $wpdb;

$result = $args['result'];

?>
<div class="container  pb-130" dir="rtl">
	<div class="row">
		<div class="col-lg-12 table-wrapper" style="text-align: center;">
			<p><span style="color:red;"> ملاحظة:</span> يتم ترتيب الجامعات في الأسفل حسب تاريخ انتهاء التسجيل (الجامعة التي ستغلق قريبا في الأعلى)</p>
            <p>الجامعات التي انتهى  التسجيل عليها موضحة بلون <span style="color:red"> الاطار الاحمر </span></p>
            <p>الجامعات التي تطلب اليوس او السات ك شرط للتسجيل عليها موضحة بلون <span style="color:blue"> الاطار الازرق </span></p>
            <p>الجامعات التي تقبل بجميع الشهادات موضحة بلون  <span style="color:#000000;font-weight: bolder;">الاطار الاسود</span></p>


			<table class="table table-bordered calendar-table">
				<thead>
					<tr>
						<th>الجامعة</th>
						<th>المدينة</th>
						<th>اسم المفاضلة</th>
						<th>تاريخ البدء</th>
						<th>تاريخ الانتهاء</th>
						<th>تاريخ النتائج</th>
						<th>رابط التسجيل</th>
						<th>معلومات اكثر عن الجامعة</th>
					</tr>
				</thead>
				<tbody>
					<?php for ($i=0; $i < count($result); $i++) {  ?>
						<tr>
						  <?php
						    $color = $result[$i]->app_color;
                            $today = date("Y-m-d");
                            $expire = $result[$i]->app_end_date;
                            if($expire != '0000-00-00') {
                                $today_dt = new DateTime($today);
                                $expire_dt = new DateTime($expire);
                                
                                if ($expire_dt < $today_dt) { 
                                    $color = 'red';
                                }
                            }
                            
                            
                            
                            
						  ?>
						  <td style="border:2px <?php echo $color; ?> solid;width:150px!important"><?php echo $result[$i]->university_name ?></td>
						  <td style="border:2px <?php echo $color; ?> solid">
						  	<?php 
						  		echo $result[$i]->city_name 
						  	?>
						  </td>
						  <td style="border:2px <?php echo $color; ?> solid">
						  	<?php 
						  		echo $result[$i]->app_name
						  	?>
						  </td>
						  <td style="border:2px <?php echo $color; ?> solid">
						  	<?php 
						  		if ($result[$i]->app_start_date == '0000-00-00') {
						  		 	echo 'غير محدد';
						  		} else {
						  			echo $result[$i]->app_start_date;
						  		} 
						  	?>
						  </td>
						  <td style="border:2px <?php echo $color; ?> solid">
						  	<?php 
						  		if ($result[$i]->app_end_date == '0000-00-00') {
						  		 	echo 'غير محدد';
						  		} else {
						  			echo $result[$i]->app_end_date;
						  		}
						  	?>
						  </td>
						  <td style="border:2px <?php echo $color; ?> solid">
						  	<?php 
						  		if ($result[$i]->app_result_date == '0000-00-00') {
						  		 	echo 'غير محدد';
						  		} else {
						  			echo $result[$i]->app_result_date;
						  		}
						  	?>
						  </td>
						  <td style="border:2px <?php echo $color; ?> solid">
						  	<?php 
						  		if ($result[$i]->app_result_date == '0000-00-00') {
						  		 	echo 'غير محدد';
						  		} else {
						  			?>
						  			<a target="_blank" href="<?php echo $result[$i]->app_result_url; ?>">
						  				اضغط هنا
						  			</a>
						  			<?php
						  			
						  		}
						  	?>
						  </td>
						  <td style="border:2px <?php echo $color; ?> solid">
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



