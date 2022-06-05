var $ = jQuery;
$(document).ready(function(){


	$('#create_brans').click(function() {
		$('#edit_brans_id').val('');
		$('#brans_name').val('');
		$('#brans_url').val('');
		$('#create_brans_modal').modal('show');
	});

	$('button#save_brans').on('click',function() {
		var brans_id = $('#edit_brans_id').val();
		var brans_name = $('#brans_name').val();
		var brans_url = $('#brans_url').val();

		var postData = {
			brans_id:brans_id,
			brans_name:brans_name,
			brans_url:brans_url
		};

		if ($('#edit_brans_id').val()=='') {
			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/create_brans',
				data: postData,
				success:function(result) {
					$('#create_brans_modal').modal('hide');
					location.reload();
				},
				error:function(e){	
					console.log(e);
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
				url:base_url+'/wp-json/university/v1/update_brans',
				data: postData,
				success:function(result){
					$('#create_brans_modal').modal('hide');
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

	$('.brans').on('click',function(e) {
		console.log(e.target);
		if ($(e.target).parent().hasClass('delete_brans')) {
			$('#delete_brans_modal').modal('show');

			$('#confirm_delete_brans').click(function() {
				$.ajax({
					type: 'POST',
					url:base_url+'/wp-json/university/v1/delete_brans',
					data: {brans_id:$(e.target).parent().parent().children('.edit_brans_id').val()},
					success:function(result) {
						$('#confirm_delete_brans').modal('hide');
						location.reload();
					},
					error:function(e) {
						console.log(e);
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
			$('#edit_brans_id').val($(this).children('.edit_brans_id').val());
			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/get_brans',
				data: {brans_id:$(this).children('.edit_brans_id').val()},
				success:function(result) {
					$('#brans_name').val(result[0].brans_name);
					$('#brans_url').val(result[0].brans_url);
					console.log(result);
					$('#create_brans_modal').modal('show');
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