var $ = jQuery;
var ctrlPressed = false;
$(document).ready(function(){

	var fakulte_select = new SlimSelect({
		select: '#fakulte_select',
		closeOnSelect: false,
		beforeOnChange: (info) => {
		    compare_values_fakulte(fakulte_select.selected(),info)
		}

	});


	var enistitu_select = new SlimSelect({
		select: '#enistitu_select',
		closeOnSelect: false,
		beforeOnChange: (info) => {
		    compare_values_enistitu(enistitu_select.selected(),info)
		}
	});

	var category_select = new SlimSelect({
		select: '#category_select',
		closeOnSelect: false,
		beforeOnChange: (info) => {
			compare_values_category(category_select.selected(),info)
		}
	});

	var exam_select = new SlimSelect({
		select: '#exam_select',
		closeOnSelect: false,
		beforeOnChange: (info) => {
			compare_values_exam(exam_select.selected(),info)
		}
	});

	var universite_yos_1_select = new SlimSelect({
		select: '#universite_yos_1_select',
		closeOnSelect: false,
		beforeOnChange: (info) => {
			compare_values_universite_yos_1(universite_yos_1_select.selected(),info)
		}
	});

	var universite_yos_0_select = new SlimSelect({
		select: '#universite_yos_0_select',
		closeOnSelect: false,
		beforeOnChange: (info) => {
			compare_values_universite_yos_0(universite_yos_0_select.selected(),info)
		}
	});

	




	var fakulte_ssid = $('#fakulte_select').attr('data-ssid');
	var enistitu_ssid = $('#enistitu_select').attr('data-ssid');
	var category_ssid = $('#category_select').attr('data-ssid');
	var exam_ssid = $('#exam_select').attr('data-ssid');
	var universite_yos_1_ssid = $('#universite_yos_1_select').attr('data-ssid');
	var universite_yos_0_ssid = $('#universite_yos_0_select').attr('data-ssid');


	$('div.'+universite_yos_1_ssid+' div.ss-values').on('click', function (e) {
		var target = e.target;
		if ($(target).hasClass('ss-value-delete')) {

			var id = $(target).parent().attr('data-id');
			var index = $('div.ss-option[data-id='+id+']').index('div.'+universite_yos_1_ssid+' div.ss-option');
			var universite_id = $('#universite_yos_1_select option').eq(index).val();

			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/delete_selected_universite_yos',
				data: {
					yos_id:$('#selected_universite').val(),
					universite_id:universite_id,
					toggler:1
				},
				success:function(data) {

				},
				error:function(error){
					alert('error refresh the page');
					
				},
				beforeSend: function(){
			     	$('div.loader').css('display','block');
			     	$('body').css('pointer-events','none');
			   	},
			   	complete: function(){
			    	$('div.loader').css('display','none');
			    	$('body').css('pointer-events','all');
			   	}
			});
		}
	});

	$('div.'+universite_yos_0_ssid+' div.ss-values').on('click', function (e) {
		var target = e.target;
		if ($(target).hasClass('ss-value-delete')) {

			var id = $(target).parent().attr('data-id');
			var index = $('div.ss-option[data-id='+id+']').index('div.'+universite_yos_0_ssid+' div.ss-option');
			var yos_id = $('#universite_yos_0_select option').eq(index).val();

			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/delete_selected_universite_yos',
				data: {
					universite_id:$('#selected_universite').val(),
					yos_id:yos_id,
					toggler:0
				},
				success:function(data) {

				},
				error:function(error){
					alert('error refresh the page');
					
				},
				beforeSend: function(){
			     	$('div.loader').css('display','block');
			     	$('body').css('pointer-events','none');
			   	},
			   	complete: function(){
			    	$('div.loader').css('display','none');
			    	$('body').css('pointer-events','all');
			   	}
			});
		}
	});

	$('div.'+category_ssid+' div.ss-values').on('click', function (e) {
		var target = e.target;
		if ($(target).hasClass('ss-value-delete')) {

			var id = $(target).parent().attr('data-id');
			var index = $('div.ss-option[data-id='+id+']').index('div.'+category_ssid+' div.ss-option');
			var category_id = $('#category_select option').eq(index).val();

			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/delete_selected_category',
				data: {
					universite_id:$('#selected_universite').val(),
					category_id:category_id
				},
				success:function(data) {

				},
				error:function(error){
					alert('error refresh the page');
					
				},
				beforeSend: function(){
			     	$('div.loader').css('display','block');
			     	$('body').css('pointer-events','none');
			   	},
			   	complete: function(){
			    	$('div.loader').css('display','none');
			    	$('body').css('pointer-events','all');
			   	}
			});
		}
	});

	$('div.'+exam_ssid+' div.ss-values').on('click', function (e) {
		var target = e.target;
		if ($(target).hasClass('ss-value-delete')) {

			var id = $(target).parent().attr('data-id');
			var index = $('div.ss-option[data-id='+id+']').index('div.'+exam_ssid+' div.ss-option');
			var exam_id = $('#exam_select option').eq(index).val();

			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/delete_selected_exam',
				data: {
					universite_id:$('#selected_universite').val(),
					exam_id:exam_id
				},
				success:function(data) {

				},
				error:function(error){
					alert('error refresh the page');
					
				},
				beforeSend: function(){
			     	$('div.loader').css('display','block');
			     	$('body').css('pointer-events','none');
			   	},
			   	complete: function(){
			    	$('div.loader').css('display','none');
			    	$('body').css('pointer-events','all');
			   	}
			});
		}
	});

	$('div.'+fakulte_ssid+' div.ss-values').on('click', function (e) {
		var target = e.target;
		//section fakulte url
		if (($('span.ss-value-text').is(target)) && e.ctrlKey) {
			e.stopImmediatePropagation();


			if ($('div.'+fakulte_ssid+' div.redActive').length) {
				$('div.'+fakulte_ssid+' div.redActive').removeClass('redActive');
				$(target).parent().addClass('redActive');
			} else {
				$(target).parent().addClass('redActive');
			}


			var id = $(target).parent().attr('data-id');
			var index = $('div.ss-option[data-id='+id+']').index('div.'+fakulte_ssid+' div.ss-option');
			var fakulte_id = $('#fakulte_select option').eq(index).val();
			$('#selected_fakulte').val(fakulte_id);

			$('#term_type').val('f');
			$('#term_id').val(fakulte_id);

			
			$('div.fakulte_brans_wrapper').css('display','none');
			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/search_fakulte_url',
				data: {
					universite_id:$('#selected_universite').val(),
					fakulte_id:$('#selected_fakulte').val()
				},
				success:function(data) {
					console.log(data);
					if (data.result == false) {
						$('#term_type').val('f');
						$('#operation_type').val('i');
						$('#term_url').val('');
					} else {
						$('#term_type').val('f');
						$('#operation_type').val('u');
						$('#term_url').val(data.result);
					}
					$('#all_url').modal('show');
					
				},
				error:function(error){
					alert('error refresh the page');
					
				},
				beforeSend: function(){
			     	$('div.loader').css('display','block');
			     	$('body').css('pointer-events','none');
			   	},
			   	complete: function(){
			    	$('div.loader').css('display','none');
			    	$('body').css('pointer-events','all');
			   	}
			});

			console.log(fakulte_id);
		}
		else if (($('span.ss-value-text').is(target))) {
			e.stopImmediatePropagation();

			if ($('div.'+fakulte_ssid+' div.redActive').length) {
				$('div.'+fakulte_ssid+' div.redActive').removeClass('redActive');
				$(target).parent().addClass('redActive');
			} else {
				$(target).parent().addClass('redActive');
			}


			var id = $(target).parent().attr('data-id');
			var index = $('div.ss-option[data-id='+id+']').index('div.'+fakulte_ssid+' div.ss-option');
			var fakulte_id = $('#fakulte_select option').eq(index).val();
			$('#selected_fakulte').val(fakulte_id);
			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/get_selected_fakulte_brans',
				data: {
					universite_id:$('#selected_universite').val(),
					fakulte_id:fakulte_id
				},
				success:function(result) {
					$('div.fakulte_brans_wrapper').empty();
					$('div.fakulte_brans_wrapper').css('display','block');
					console.log(result);
					for (var i = 0; i < result.length; i++) {
						var option = '';
						option = option + '<label>';
						if (result[i]['selected'] == 1 ) {
							option = option + '<input type="checkbox" onchange="fakulte_brans()" class="'+result[i]['brans_id']+'" value="'+result[i]['brans_id']+'" checked="checked">';
						} else {
							option = option + '<input type="checkbox" onchange="fakulte_brans()" class="'+result[i]['brans_id']+'" value="'+result[i]['brans_id']+'">';
						}
						
						option = option +'  '+ result[i]['brans_name'];
						option = option + '</label>';
						$('div.fakulte_brans_wrapper').append(option);
					}
					//section fakulte brans url
					$('div.fakulte_brans_wrapper input').on('click',function(e) {
						if (!e.target.checked) {
							if (e.ctrlKey) {
								e.preventDefault();
								var brans_id = $(this).val();
								$.ajax({
									type: 'POST',
									url:base_url+'/wp-json/university/v1/search_fakulte_brans_url',
									data: {
										universite_id:$('#selected_universite').val(),
										fakulte_id:$('#selected_fakulte').val(),
										brans_id: brans_id
									},
									success:function(data) {
										if (data.result == false) {
											$('#term_id').val(brans_id);
											$('#term_type').val('fb');
											$('#operation_type').val('i');
											$('#term_url').val('');
										} else {
											$('#term_id').val(brans_id);
											$('#term_type').val('fb');
											$('#operation_type').val('u');
											$('#term_url').val(data.result);
										}
										$('#all_url').modal('show');
									},
									error:function(error){
										alert('error refresh the page');
										
									},
									beforeSend: function(){
								     	$('div.loader').css('display','block');
								     	$('body').css('pointer-events','none');
								   	},
								   	complete: function(){
								    	$('div.loader').css('display','none');
								    	$('body').css('pointer-events','all');
								   	}
								});
								
								
							}
						}
						
						
						
					});
				},
				error:function(){
					alert('error');
				},
				beforeSend: function(){
			     	$('div.loader').css('display','block');
			     	$('body').css('pointer-events','none');
			   	},
			   	complete: function(){
			    	$('div.loader').css('display','none');
			    	$('body').css('pointer-events','all');
			   	}
			});
			console.log(fakulte_id);
		}
		else if ($(target).hasClass('ss-value-delete')) {
			
			if ($(target).parent().hasClass('redActive')) {
				$('#selected_fakulte').val('');
				$('div.fakulte_brans_wrapper').empty();
			}


			var id = $(target).parent().attr('data-id');
			var index = $('div.ss-option[data-id='+id+']').index('div.'+fakulte_ssid+' div.ss-option');
			var fakulte_id = $('#fakulte_select option').eq(index).val();

			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/delete_selected_fakulte',
				data: {
					universite_id:$('#selected_universite').val(),
					fakulte_id:fakulte_id
				},
				success:function(data) {

				},
				error:function(error){
					console.log(error);
					alert('error refresh the page');
					
				},
				beforeSend: function(){
			     	$('div.loader').css('display','block');
			     	$('body').css('pointer-events','none');
			   	},
			   	complete: function(){
			    	$('div.loader').css('display','none');
			    	$('body').css('pointer-events','all');
			   	}
			});
		}	
	});

	$('div.'+enistitu_ssid+' div.ss-values').on('click', function (f) {
		//section enistitu url
		if (($('span.ss-value-text').is(f.target)) && f.ctrlKey) {
			f.stopImmediatePropagation();


			if ($('div.'+enistitu_ssid+' div.redActive').length) {
				$('div.'+enistitu_ssid+' div.redActive').removeClass('redActive');
				$(f.target).parent().addClass('redActive');
			} else {
				$(f.target).parent().addClass('redActive');
			}

			var eid = $(f.target).parent().attr('data-id');
			var eindex = $('div.ss-option[data-id='+eid+']').index('div.'+enistitu_ssid+' div.ss-option');
			var enistitu_id = $('#enistitu_select option').eq(eindex).val();

			$('#selected_enistitu').val(enistitu_id);

			

			$('div.enistitu_brans_wrapper').css('display','none');
			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/search_enistitu_url',
				data: {
					universite_id:$('#selected_universite').val(),
					enistitu_id:$('#selected_enistitu').val()
				},
				success:function(data) {
					console.log(data);
					if (data.result == false) {
						$('#term_type').val('e');
						$('#operation_type').val('i');
						$('#term_url').val('');
					} else {
						$('#term_type').val('e');
						$('#operation_type').val('u');
						$('#term_url').val(data.result);
					}
					$('#all_url').modal('show');
					
				},
				error:function(error){
					alert('error refresh the page');
					
				},
				beforeSend: function(){
			     	$('div.loader').css('display','block');
			     	$('body').css('pointer-events','none');
			   	},
			   	complete: function(){
			    	$('div.loader').css('display','none');
			    	$('body').css('pointer-events','all');
			   	}
			});

			console.log('ok');
		}
		else if (($('span.ss-value-text').is(f.target))) {
			f.stopImmediatePropagation();

			if ($('div.'+enistitu_ssid+' div.redActive').length) {
				$('div.'+enistitu_ssid+' div.redActive').removeClass('redActive');
				$(f.target).parent().addClass('redActive');
			} else {
				$(f.target).parent().addClass('redActive');
			}

			var eid = $(f.target).parent().attr('data-id');
			var eindex = $('div.ss-option[data-id='+eid+']').index('div.'+enistitu_ssid+' div.ss-option');
			var enistitu_id = $('#enistitu_select option').eq(eindex).val();

			$('#selected_enistitu').val(enistitu_id);
			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/get_selected_enistitu_brans',
				data: {
					universite_id:$('#selected_universite').val(),
					enistitu_id:enistitu_id
				},
				success:function(result) {
					$('div.enistitu_brans_wrapper').empty();
					$('div.enistitu_brans_wrapper').css('display','block');
					console.log(result);
					for (var i = 0; i < result.length; i++) {
						var option = '';
						option = option + '<label>';
						if (result[i]['selected'] == 1 ) {
							option = option + '<input type="checkbox" onchange="enistitu_brans()" class="'+result[i]['brans_id']+'" value="'+result[i]['brans_id']+'" checked="checked">';
						} else {
							option = option + '<input type="checkbox" onchange="enistitu_brans()" class="'+result[i]['brans_id']+'" value="'+result[i]['brans_id']+'">';
						}
						
						option = option +'  '+ result[i]['brans_name'];
						option = option + '</label>';
						$('div.enistitu_brans_wrapper').append(option);


					}

					$('div.enistitu_brans_wrapper input').on('click',function(e) {
						if (!e.target.checked) {
							if (e.ctrlKey) {
								e.preventDefault();
								var brans_id = $(this).val();
								$.ajax({
									type: 'POST',
									url:base_url+'/wp-json/university/v1/search_enistitu_brans_url',
									data: {
										universite_id:$('#selected_universite').val(),
										enistitu_id:$('#selected_enistitu').val(),
										brans_id: $(this).val() 
									},
									success:function(data) {
										if (data.result == false) {
											$('#term_id').val(brans_id);
											$('#term_type').val('eb');
											$('#operation_type').val('i');
											$('#term_url').val('');
										} else {
											$('#term_id').val(brans_id);
											$('#term_type').val('eb');
											$('#operation_type').val('u');
											$('#term_url').val(data.result);
										}
										$('#all_url').modal('show');
									},
									error:function(error){
										alert('error refresh the page');
										
									},
									beforeSend: function(){
								     	$('div.loader').css('display','block');
								     	$('body').css('pointer-events','none');
								   	},
								   	complete: function(){
								    	$('div.loader').css('display','none');
								    	$('body').css('pointer-events','all');
								   	}
								});
							}
						}
						
						
					});
				},
				error:function(){
					alert('error');
				},
				beforeSend: function(){
			     	$('div.loader').css('display','block');
			     	$('body').css('pointer-events','none');
			   	},
			   	complete: function(){
			    	$('div.loader').css('display','none');
			    	$('body').css('pointer-events','all');
			   	}
			});
			console.log(enistitu_id);
		}
		else if ($(f.target).hasClass('ss-value-delete')) {

			if ($(f.target).parent().hasClass('redActive')) {
				$('#selected_enistitu').val('');
				$('div.enistitu_brans_wrapper').empty();
			}

			var eid = $(f.target).parent().attr('data-id');
			var eindex = $('div.ss-option[data-id='+eid+']').index('div.'+enistitu_ssid+' div.ss-option');
			var enistitu_id = $('#enistitu_select option').eq(eindex).val();

			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/delete_selected_enistitu',
				data: {
					universite_id:$('#selected_universite').val(),
					enistitu_id:enistitu_id
				},
				success:function(data) {

				},
				error:function(error){
					alert('error refresh the page');
					
				},
				beforeSend: function(){
			     	$('div.loader').css('display','block');
			     	$('body').css('pointer-events','none');
			   	},
			   	complete: function(){
			    	$('div.loader').css('display','none');
			    	$('body').css('pointer-events','all');
			   	}
			});
		}
	});

	//section save url
	$('#save_url').on('click',function(){
		var term_type = $('#term_type').val();
		var operation_type = $('#operation_type').val();

		if (term_type == 'f') {
			if (operation_type == 'i') {
				var selected_universite = $('#selected_universite').val();
				var selected_fakulte = $('#selected_fakulte').val();
				var fakulte_url = $('#term_url').val();
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/create_fakulte_url',
					data: {
						universite_id:selected_universite,
						fakulte_id:selected_fakulte,
						fakulte_url:fakulte_url
					},
					success:function(data) {
						
						$('#all_url').modal('hide');
					},
					error:function(error){
						$('#all_url').modal('hide');
						
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				     	$('body').css('pointer-events','none');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				    	$('body').css('pointer-events','all');
				   	}
				});

			} else if (operation_type == 'u') {
				var selected_universite = $('#selected_universite').val();
				var selected_fakulte = $('#selected_fakulte').val();
				var fakulte_url = $('#term_url').val();
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/update_fakulte_url',
					data: {
						universite_id:selected_universite,
						fakulte_id:selected_fakulte,
						fakulte_url:fakulte_url
					},
					success:function(data) {
						
						$('#all_url').modal('hide');
					},
					error:function(error){
						$('#all_url').modal('hide');
						
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				     	$('body').css('pointer-events','none');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				    	$('body').css('pointer-events','all');
				   	}
				});
			}
		} else if (term_type == 'e' ){
			if (operation_type == 'i') {
				var selected_universite = $('#selected_universite').val();
				var selected_enistitu = $('#selected_enistitu').val();
				var enistitu_url = $('#term_url').val();
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/create_enistitu_url',
					data: {
						universite_id:selected_universite,
						enistitu_id:selected_enistitu,
						enistitu_url:enistitu_url
					},
					success:function(data) {
						
						$('#all_url').modal('hide');
					},
					error:function(error){
						$('#all_url').modal('hide');
						
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				     	$('body').css('pointer-events','none');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				    	$('body').css('pointer-events','all');
				   	}
				});

			} else if (operation_type == 'u') {
				var selected_universite = $('#selected_universite').val();
				var selected_enistitu = $('#selected_enistitu').val();
				var enistitu_url = $('#term_url').val();
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/update_enistitu_url',
					data: {
						universite_id:selected_universite,
						enistitu_id:selected_enistitu,
						enistitu_url:enistitu_url
					},
					success:function(data) {
						
						$('#all_url').modal('hide');
					},
					error:function(error){
						$('#all_url').modal('hide');
						
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				     	$('body').css('pointer-events','none');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				    	$('body').css('pointer-events','all');
				   	}
				});
			}
		} else if (term_type == 'fb'){

			if (operation_type == 'i') {
				var selected_universite = $('#selected_universite').val();
				var selected_fakulte = $('#selected_fakulte').val();
				var brans_url = $('#term_url').val();
				var brans_id = $('#term_id').val();
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/create_fakulte_brans_url',
					data: {
						universite_id:selected_universite,
						fakulte_id:selected_fakulte,
						brans_id:brans_id,
						brans_url:brans_url
					},
					success:function(data) {
						$('#all_url').modal('hide');
					},
					error:function(error){
						$('#all_url').modal('hide');
						
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				     	$('body').css('pointer-events','none');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				    	$('body').css('pointer-events','all');
				   	}
				});

			} else if (operation_type == 'u') {
				var selected_universite = $('#selected_universite').val();
				var selected_fakulte = $('#selected_fakulte').val();
				var brans_url = $('#term_url').val();
				var brans_id = $('#term_id').val();
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/update_fakulte_brans_url',
					data: {
						universite_id:selected_universite,
						fakulte_id:selected_fakulte,
						brans_id:brans_id,
						brans_url:brans_url
					},
					success:function(data) {
						console.log(data);
						$('#all_url').modal('hide');
					},
					error:function(error){
						console.log(error);
						$('#all_url').modal('hide');
						
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				     	$('body').css('pointer-events','none');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				    	$('body').css('pointer-events','all');
				   	}
				});
			}
		} else if (term_type == 'eb') {
			if (operation_type == 'i') {
				var selected_universite = $('#selected_universite').val();
				var selected_enistitu = $('#selected_enistitu').val();
				var brans_url = $('#term_url').val();
				var brans_id = $('#term_id').val();
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/create_enistitu_brans_url',
					data: {
						universite_id:selected_universite,
						enistitu_id:selected_enistitu,
						brans_id:brans_id,
						brans_url:brans_url
					},
					success:function(data) {
						$('#all_url').modal('hide');
					},
					error:function(error){
						$('#all_url').modal('hide');
						
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				     	$('body').css('pointer-events','none');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				    	$('body').css('pointer-events','all');
				   	}
				});

			} else if (operation_type == 'u') {
				var selected_universite = $('#selected_universite').val();
				var selected_enistitu = $('#selected_enistitu').val();
				var brans_url = $('#term_url').val();
				var brans_id = $('#term_id').val();
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/update_enistitu_brans_url',
					data: {
						universite_id:selected_universite,
						enistitu_id:selected_enistitu,
						brans_id:brans_id,
						brans_url:brans_url
					},
					success:function(data) {
						console.log(data);
						$('#all_url').modal('hide');
					},
					error:function(error){
						console.log(error);
						$('#all_url').modal('hide');
						
					},
					beforeSend: function(){
				     	$('div.loader').css('display','block');
				     	$('body').css('pointer-events','none');
				   	},
				   	complete: function(){
				    	$('div.loader').css('display','none');
				    	$('body').css('pointer-events','all');
				   	}
				});
			}
		}
	});

});

function compare_values_fakulte (selected,info) {
	if (selected.length < info.length) {
		var fakulte_id = info[info.length-1];
		console.log($('#selected_universite').val());
		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/create_selected_fakulte',
			data: {
				universite_id:$('#selected_universite').val(),
				fakulte_id:fakulte_id.value
			},
			success:function(data) {
				console.log(data);
				if (data.result == 1) {
					return true;
				}
				else{
					return false;
				}
				
			},
			error:function(error){
				return false;
				
			},
			beforeSend: function(){
		     	$('div.loader').css('display','block');
		     	$('body').css('pointer-events','none');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		    	$('body').css('pointer-events','all');
		   	}
		});

	}

}

function compare_values_enistitu (selected,info) {
	if (selected.length < info.length) {
		var enistitu_id = info[info.length-1];
		console.log($('#selected_universite').val());
		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/create_selected_enistitu',
			data: {
				universite_id:$('#selected_universite').val(),
				enistitu_id:enistitu_id.value
			},
			success:function(data) {
				console.log(data);
				if (data.result == 1) {
					return true;
				}
				else{
					return false;
				}
				
			},
			error:function(error){
				return false;
				
			},
			beforeSend: function(){
		     	$('div.loader').css('display','block');
		     	$('body').css('pointer-events','none');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		    	$('body').css('pointer-events','all');
		   	}
		});

	}

}

function compare_values_category (selected,info) {

	if (selected.length < info.length) {
		var category_id = info[info.length-1];

		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/create_selected_category',
			data: {
				universite_id:$('#selected_universite').val(),
				category_id:category_id.value
			},
			success:function(data) {
				console.log(data);
				if (data.result == 1) {
					return true;
				}
				else{
					return false;
				}
				
			},
			error:function(error){
				return false;
				
			},
			beforeSend: function(){
		     	$('div.loader').css('display','block');
		     	$('body').css('pointer-events','none');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		    	$('body').css('pointer-events','all');
		   	}
		});

	}

}

function compare_values_exam (selected,info) {

	if (selected.length < info.length) {
		var exam_id = info[info.length-1];

		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/create_selected_exam',
			data: {
				universite_id:$('#selected_universite').val(),
				exam_id:exam_id.value
			},
			success:function(data) {
				console.log(data);
				if (data.result == 1) {
					return true;
				}
				else{
					return false;
				}
				
			},
			error:function(error){
				return false;
				
			},
			beforeSend: function(){
		     	$('div.loader').css('display','block');
		     	$('body').css('pointer-events','none');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		    	$('body').css('pointer-events','all');
		   	}
		});

	}

}

function compare_values_universite_yos_1 (selected,info) {

	if (selected.length < info.length) {
		var universite_id = info[info.length-1];

		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/create_selected_universite_yos',
			data: {
				yos_id:$('#selected_universite').val(),
				universite_id:universite_id.value,
				toggler:1
			},
			success:function(data) {
				console.log(data);
				if (data.result == 1) {
					return true;
				}
				else{
					return false;
				}
				
			},
			error:function(error){
				return false;
				
			},
			beforeSend: function(){
		     	$('div.loader').css('display','block');
		     	$('body').css('pointer-events','none');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		    	$('body').css('pointer-events','all');
		   	}
		});

	}

}

function compare_values_universite_yos_0 (selected,info) {

	if (selected.length < info.length) {
		var yos_id = info[info.length-1];

		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/create_selected_universite_yos',
			data: {
				universite_id:$('#selected_universite').val(),
				yos_id:yos_id.value,
				toggler:0
			},
			success:function(data) {
				console.log(data);
				if (data.result == 1) {
					return true;
				}
				else{
					return false;
				}
				
			},
			error:function(error){
				return false;
				
			},
			beforeSend: function(){
		     	$('div.loader').css('display','block');
		     	$('body').css('pointer-events','none');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		    	$('body').css('pointer-events','all');
		   	}
		});

	}

}

function fakulte_brans () {

	if (event.target.checked) {
		var post_data = {
			universite_id:$('#selected_universite').val(),
			fakulte_id:$('#selected_fakulte').val(),
			brans_id:$(event.target).val()
		};

		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/create_selected_fakulte_brans',
			data: post_data,
			success:function(data) {
				
			},
			error:function(error){
				alert('error');
				
			},
			beforeSend: function(){
		     	$('div.loader').css('display','block');
		     	$('body').css('pointer-events','none');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		    	$('body').css('pointer-events','all');
		   	}
		});
		
	} else {
		var post_data = {
			universite_id:$('#selected_universite').val(),
			fakulte_id:$('#selected_fakulte').val(),
			brans_id:$(event.target).val()
		};

		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/delete_selected_fakulte_brans',
			data: post_data,
			success:function(data) {
				
			},
			error:function(error){
				alert('error');
				
			},
			beforeSend: function(){
		     	$('div.loader').css('display','block');
		     	$('body').css('pointer-events','none');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		    	$('body').css('pointer-events','all');
		   	}
		});
		
	}
}

function enistitu_brans () {
	if (event.target.checked) {
		var post_data = {
			universite_id:$('#selected_universite').val(),
			enistitu_id:$('#selected_enistitu').val(),
			brans_id:$(event.target).val()
		};

		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/create_selected_enistitu_brans',
			data: post_data,
			success:function(data) {
				
			},
			error:function(error){
				alert('error');
				
			},
			beforeSend: function(){
		     	$('div.loader').css('display','block');
		     	$('body').css('pointer-events','none');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		    	$('body').css('pointer-events','all');
		   	}
		});
		
	} else {
		var post_data = {
			universite_id:$('#selected_universite').val(),
			enistitu_id:$('#selected_enistitu').val(),
			brans_id:$(event.target).val()
		};

		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/delete_selected_enistitu_brans',
			data: post_data,
			success:function(data) {
				
			},
			error:function(error){
				alert('error');
				
			},
			beforeSend: function(){
		     	$('div.loader').css('display','block');
		     	$('body').css('pointer-events','none');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		    	$('body').css('pointer-events','all');
		   	}
		});
		
	}
}





