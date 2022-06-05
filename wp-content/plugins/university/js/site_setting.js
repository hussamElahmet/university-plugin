var $ = jQuery;
$(document).ready(function() {

	$('#save_setting').on('click',function() {

		var menu_category = $('#categories').val();
		var address = $('#university_address').val();
		var email = $('#university_email').val();
		var facebook = $('#university_facebook').val();
		var instagram = $('#university_instagram').val();
		var telegram = $('#university_telegram').val();
		var tel = $('#university_tel').val();
		var tel1 = $('#university_tel1').val();
		var tel2 = $('#university_tel2').val();
		var tel3 = $('#university_tel3').val();

		var data = {
			menu_category:menu_category,
			address:address,
			email:email,
			facebook:facebook,
			instagram:instagram,
			telegram:telegram,
			tel:tel,
			tel1:tel1,
			tel2:tel2,
			tel3:tel3
		};

		$.ajax({
			type: 'POST',
			url:mBaseUrl+'/wp-json/university/v1/save_setting',
			data: data,
			success:function(result) {
				location.reload();
			},
			error:function(e){
				// alert('error');

			},
			beforeSend: function() {
		     	$('div.loader').css('display','block');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		   	}
		});

	});
 		
	 

});
