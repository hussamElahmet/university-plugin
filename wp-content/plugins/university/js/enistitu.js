var $ = jQuery;
$(document).ready(function(){


	$('#create_enistitu').click(function() {
		$('#edit_enistitu_id').val('');
		$('#enistitu_name').val('');
		$('#enistitu_url').val('');
		$('#create_enistitu_modal').modal('show');
	});

	$('button#save_enistitu').on('click',function() {
		var enistitu_id = $('#edit_enistitu_id').val();
		var enistitu_name = $('#enistitu_name').val();
		var enistitu_url = $('#enistitu_url').val();

		var postData = {
			enistitu_id:enistitu_id,
			enistitu_name:enistitu_name,
			enistitu_url:enistitu_url
		};

		if ($('#edit_enistitu_id').val()=='') {
			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/create_enistitu',
				data: postData,
				success:function(result) {
					$('#create_enistitu_modal').modal('hide');
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
				url:base_url+'/wp-json/university/v1/update_enistitu',
				data: postData,
				success:function(result){
					$('#create_enistitu_modal').modal('hide');
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

		
	});

	$('.enistitu').on('click',function(e) {
		console.log(e.target);
		if ($(e.target).parent().hasClass('delete_enistitu')) {
			$('#delete_enistitu_modal').modal('show');

			$('#confirm_delete_enistitu').click(function() {
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/delete_enistitu',
					data: {enistitu_id:$(e.target).parent().parent().children('.edit_enistitu_id').val()},
					success:function(result) {
						$('#confirm_delete_enistitu').modal('hide');
						location.reload();
					},
					error:function() {
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
			
		}
		else if($(e.target).is($('a'))) {

		}
		else{
			$('#edit_enistitu_id').val($(this).children('.edit_enistitu_id').val());
			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/get_enistitu',
				data: {enistitu_id:$(this).children('.edit_enistitu_id').val()},
				success:function(result) {
					$('#enistitu_name').val(result[0].enistitu_name);
					$('#enistitu_url').val(result[0].enistitu_url);
					console.log(result);
					$('#create_enistitu_modal').modal('show');
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
	});

});