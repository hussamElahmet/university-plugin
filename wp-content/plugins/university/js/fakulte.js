var $ = jQuery;
$(document).ready(function(){


	$('#create_fakulte').click(function() {
		$('#edit_fakulte_id').val('');
		$('#fakulte_name').val('');
		$('#fakulte_url').val('');
		$('#create_fakulte_modal').modal('show');
	});

	$('button#save_fakulte').on('click',function() {
		var fakulte_id = $('#edit_fakulte_id').val();
		var fakulte_name = $('#fakulte_name').val();
		var fakulte_url = $('#fakulte_url').val();

		var postData = {
			fakulte_id:fakulte_id,
			fakulte_name:fakulte_name,
			fakulte_url:fakulte_url
		};

		if ($('#edit_fakulte_id').val()=='') {
			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/create_fakulte',
				data: postData,
				success:function(result) {
					$('#create_fakulte_modal').modal('hide');
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
				url:base_url+'/wp-json/university/v1/update_fakulte',
				data: postData,
				success:function(result){
					$('#create_fakulte_modal').modal('hide');
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

	$('.fakulte').on('click',function(e) {
		console.log(e.target);
		if ($(e.target).parent().hasClass('delete_fakulte')) {
			$('#delete_fakulte_modal').modal('show');

			$('#confirm_delete_fakulte').click(function() {
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/delete_fakulte',
					data: {fakulte_id:$(e.target).parent().parent().children('.edit_fakulte_id').val()},
					success:function(result) {
						$('#confirm_delete_fakulte').modal('hide');
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
			$('#edit_fakulte_id').val($(this).children('.edit_fakulte_id').val());
			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/get_fakulte',
				data: {fakulte_id:$(this).children('.edit_fakulte_id').val()},
				success:function(result) {
					$('#fakulte_name').val(result[0].fakulte_name);
					$('#fakulte_url').val(result[0].fakulte_url);
					console.log(result);
					$('#create_fakulte_modal').modal('show');
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