var $ = jQuery;
$(document).ready(function() {

	$('#select_logo').click(function(e) {
		var image_frame;
		if(image_frame){
		     image_frame.open();
		}
		image_frame = wp.media({
		    title: 'Select Media',
		    multiple : false,
		    library : {
		        type : 'image',
		    }
	    });

	    image_frame.on('select',function() {
	        var attachment = image_frame.state().get('selection').first().toJSON();
	        $('#logo').attr('src',attachment.url);	        
	    });
	    image_frame.open();
	});

	$('#save_setting').on('click',function() {

		var whatsapp = $('#whatsapp').val();
		var telegram = $('#telegram').val();
		var instagram = $('#instagram').val();
		var facebook = $('#facebook').val();
		var address = $('#address').val();
		var telephone = $('#telephone').val();
		var email = $('#email').val();
		var logo = $('#logo').attr('src');
		var about_us = $('#about_us').val();

		var data = {
			whatsapp:whatsapp,
			telegram:telegram,
			instagram:instagram,
			facebook:facebook,
			address:address,
			telephone:telephone,
			email:email,
			logo:logo,
			about_us:about_us
		};

		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/save_settings',
			data: data,
			success:function(result) {
				location.reload();
			},
			error:function(e){
				alert('error');

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
