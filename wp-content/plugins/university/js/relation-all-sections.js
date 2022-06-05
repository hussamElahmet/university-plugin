var $ = jQuery;
$(document).ready(function() {

	$('#lisans_accordion').accordion({
		collapsible: true,
		active: false
	});
	$('#yatay_gecis_accordion').accordion({
		collapsible: true,
		active: false
	});
	$('#master_accordion').accordion({
		collapsible: true,
		active: false
	});
	$('#yuksek_lisans_accordion').accordion({
		collapsible: true,
		active: false
	});
	$('#yos_accordion').accordion({
		collapsible: true,
		active: false
	});

	$('#save_section_content').on('click',function() {

		var section = $('#sections').children("option:selected").val();
		var option_name = $('#section_content_title').val();
		var option_value = tinymce.activeEditor.getContent();
		var universite_id = $('#selected_universite').val();


		if ( section=='lisans' ) {

			var selected_lisans = $('#selected_lisans').val();
			if (selected_lisans == '') {
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/create_lisans',
					data: {
						universite_id:universite_id,
						option_name:option_name,
						option_value:option_value
					},
					success:function(result) {
						location.reload();
					},
					error:function(){
						alert('error');
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				   	}
				});
			} else {
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/update_lisans',
					data: {
						lisans_id:selected_lisans,
						option_name:option_name,
						option_value:option_value
					},
					success:function(result) {
						location.reload();
					},
					error:function(){
						alert('error');
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				   	}
				});
			}
			

		} else if ( section=='yatay_gecis' ) {
			var selected_yatay_gecis = $('#selected_yatay_gecis').val();
			if (selected_yatay_gecis == '') {
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/create_yatay_gecis',
					data: {
						universite_id:universite_id,
						option_name:option_name,
						option_value:option_value
					},
					success:function(result) {
						location.reload();
					},
					error:function(){
						alert('error');
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				   	}
				});
			} else {
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/update_yatay_gecis',
					data: {
						yatay_gecis_id:selected_yatay_gecis,
						option_name:option_name,
						option_value:option_value
					},
					success:function(result) {
						location.reload();
					},
					error:function(){
						alert('error');
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				   	}
				});
			}
		} else if ( section=='master' ) {
			var selected_master = $('#selected_master').val();
			if (selected_master == '') {
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/create_master',
					data: {
						universite_id:universite_id,
						option_name:option_name,
						option_value:option_value
					},
					success:function(result) {
						location.reload();
					},
					error:function(){
						alert('error');
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				   	}
				});
			} else {
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/update_master',
					data: {
						master_id:selected_master,
						option_name:option_name,
						option_value:option_value
					},
					success:function(result) {
						location.reload();
					},
					error:function(){
						alert('error');
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				   	}
				});
			}
		} else if ( section=='yuksek_lisans' ) {
			var selected_yuksek_lisans = $('#selected_yuksek_lisans').val();
			if (selected_yuksek_lisans == '') {
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/create_yuksek_lisans',
					data: {
						universite_id:universite_id,
						option_name:option_name,
						option_value:option_value
					},
					success:function(result) {
						location.reload();
					},
					error:function(){
						alert('error');
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				   	}
				});
			} else {
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/update_yuksek_lisans',
					data: {
						yuksek_lisans_id:selected_yuksek_lisans,
						option_name:option_name,
						option_value:option_value
					},
					success:function(result) {
						location.reload();
					},
					error:function(){
						alert('error');
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				   	}
				});
			}
		} else if ( section=='yos' ) {
			var selected_yos = $('#selected_yos').val();
			if (selected_yos == '') {
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/create_yos',
					data: {
						universite_id:universite_id,
						option_name:option_name,
						option_value:option_value
					},
					success:function(result) {
						location.reload();
					},
					error:function(){
						alert('error');
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				   	}
				});
			} else {
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/update_yos',
					data: {
						yos_id:selected_yos,
						option_name:option_name,
						option_value:option_value
					},
					success:function(result) {
						location.reload();
					},
					error:function(){
						alert('error');
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				   	}
				});
			}
		}

		

		
		
	});

	$('span#lisans_update').on('click',function(e) {
		
		e.stopImmediatePropagation()
		$('#sections').val('lisans');
		var lisans_id = $(this).parent().attr('data-id');
		var option_name = $.trim($(this).parent().text());
		var option_value = $('div#lisans_accordion div[data-id="'+lisans_id+'"]').children().prevObject[0].innerHTML;

		$('#selected_lisans').val(lisans_id);
		$('#section_content_title').val(option_name);
		tinymce.activeEditor.setContent(option_value);

		$('html, body').animate({
            scrollTop: $("#sections").offset().top
        }, 1000);


	});

	$('span#lisans_delete').on('click',function(e) {
		e.stopImmediatePropagation()

		var lisans_id = $(this).parent().attr('data-id');
		
		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/delete_lisans',
			data: {
				lisans_id:lisans_id
			},
			success:function(result) {
				location.reload();
			},
			error:function(){
				alert('error');
			},
			beforeSend: function(){
		     	$('div.loader').css('display','block');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		   	}
		});


	});

	$('span#yatay_gecis_update').on('click',function(e) {
		e.stopImmediatePropagation()
		$('#sections').val('yatay_gecis');
		var yatay_gecis_id = $(this).parent().attr('data-id');
		var option_name = $.trim($(this).parent().text());
		var option_value = $('div#yatay_gecis_accordion div[data-id="'+yatay_gecis_id+'"]').children().prevObject[0].innerHTML;

		$('#selected_yatay_gecis').val(yatay_gecis_id);
		$('#section_content_title').val(option_name);
		tinymce.activeEditor.setContent(option_value);

		$('html, body').animate({
            scrollTop: $("#sections").offset().top
        }, 1000);


	});

	$('span#yatay_gecis_delete').on('click',function(e) {
		e.stopImmediatePropagation()

		var yatay_gecis_id = $(this).parent().attr('data-id');
		
		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/delete_yatay_gecis',
			data: {
				yatay_gecis_id:yatay_gecis_id
			},
			success:function(result) {
				location.reload();
			},
			error:function(){
				alert('error');
			},
			beforeSend: function(){
		     	$('div.loader').css('display','block');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		   	}
		});


	});

	$('span#master_update').on('click',function(e) {
		e.stopImmediatePropagation()
		$('#sections').val('master');
		var master_id = $(this).parent().attr('data-id');
		var option_name = $.trim($(this).parent().text());
		var option_value = $('div#master_accordion div[data-id="'+master_id+'"]').children().prevObject[0].innerHTML;

		$('#selected_master').val(master_id);
		$('#section_content_title').val(option_name);
		tinymce.activeEditor.setContent(option_value);

		$('html, body').animate({
            scrollTop: $("#sections").offset().top
        }, 1000);


	});

	$('span#master_delete').on('click',function(e) {
		e.stopImmediatePropagation()

		var master_id = $(this).parent().attr('data-id');
		
		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/delete_master',
			data: {
				master_id:master_id
			},
			success:function(result) {
				location.reload();
			},
			error:function(){
				alert('error');
			},
			beforeSend: function(){
		     	$('div.loader').css('display','block');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		   	}
		});


	});

	$('span#yuksek_lisans_update').on('click',function(e) {
		e.stopImmediatePropagation()
		$('#sections').val('yuksek_lisans');
		var yuksek_lisans_id = $(this).parent().attr('data-id');
		var option_name = $.trim($(this).parent().text());
		var option_value = $('div#yuksek_lisans_accordion div[data-id="'+yuksek_lisans_id+'"]').children().prevObject[0].innerHTML;

		$('#selected_yuksek_lisans').val(yuksek_lisans_id);
		$('#section_content_title').val(option_name);
		tinymce.activeEditor.setContent(option_value);

		$('html, body').animate({
            scrollTop: $("#sections").offset().top
        }, 1000);


	});

	$('span#yuksek_lisans_delete').on('click',function(e) {
		e.stopImmediatePropagation()

		var yuksek_lisans_id = $(this).parent().attr('data-id');
		
		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/delete_yuksek_lisans',
			data: {
				yuksek_lisans_id:yuksek_lisans_id
			},
			success:function(result) {
				location.reload();
			},
			error:function(){
				alert('error');
			},
			beforeSend: function(){
		     	$('div.loader').css('display','block');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		   	}
		});


	});


	$('span#yos_update').on('click',function(e) {
		e.stopImmediatePropagation()
		$('#sections').val('yos');
		var yos_id = $(this).parent().attr('data-id');
		var option_name = $.trim($(this).parent().text());
		var option_value = $('div#yos_accordion div[data-id="'+yos_id+'"]').children().prevObject[0].innerHTML;

		$('#selected_yos').val(yos_id);
		$('#section_content_title').val(option_name);
		tinymce.activeEditor.setContent(option_value);

		$('html, body').animate({
            scrollTop: $("#sections").offset().top
        }, 1000);


	});

	$('span#yos_delete').on('click',function(e) {
		e.stopImmediatePropagation()

		var yos_id = $(this).parent().attr('data-id');
		
		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/delete_yos',
			data: {
				yos_id:yos_id
			},
			success:function(result) {
				location.reload();
			},
			error:function(){
				alert('error');
			},
			beforeSend: function(){
		     	$('div.loader').css('display','block');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		   	}
		});


	});



});







