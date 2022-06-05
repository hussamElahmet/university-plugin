var $ = jQuery;
var base_url = 'http://localhost/';
$(document).ready(function() {

	$('#blog_modal')
	  .on('show.bs.modal', function (e) {
	    $('body').addClass('bs-modal-open');
	  })
	  .on('hidden.bs.modal', function (e) {
	    $('body').removeClass('bs-modal-open');
	 });


	$('#blog_table').DataTable({
	 	responsive:true
	 });

	$('#add_blog').on('click',function() {
		$('#operation_type').val('i');
		$('#blog_modal').modal('show');
	});

	$('#modal_blog_image_upload').on('click',function(){
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
	        $('#modal_blog_image').attr('src',attachment.url);	        
	    });
	    image_frame.open();
	});

	$('#save_blog').on('click',function() {
		var id = $('#operation_blog_id').val();
		var date = $('#modal_blog_date').val();
		var title = $('#modal_blog_title').val();
		var image = $('#modal_blog_image').attr('src');
		var content = tinymce.activeEditor.getContent();

		var postData = {
			blog_id:id,
			blog_title:title,
			blog_date:date,
			blog_image:image,
			blog_content:content
		};

		var operation = $('#operation_type').val();

		if (operation == 'i') {
			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/create_blog',
				data: postData,
				success:function(result) {
					console.log(result);
					location.reload();
				},
				error:function(e){
					console.log(e);
					location.reload();
				},
				beforeSend: function() {
			     	$('div.loader').css('display','block');
			   	},
			   	complete: function(){
			    	$('div.loader').css('display','none');
			   	}
			});
		} else {
			$.ajax({
				type: 'POST',
				url:base_url+'/wp-json/university/v1/update_blog',
				data: postData,
				success:function(result) {
					console.log(result);
					location.reload();
				},
				error:function(e){
					console.log(e);
					location.reload();
				},
				beforeSend: function() {
			     	$('div.loader').css('display','block');
			   	},
			   	complete: function(){
			    	$('div.loader').css('display','none');
			   	}
			});
		}

		

		console.log(data);
	});


	$('input.blog_content_show').on('click',function() {
		var content = $(this).attr('data-content');
		$('#blog_content_modal_wrapper').empty();
		$('#blog_content_modal_wrapper').append(content);
		$('#blog_content_modal').modal('show');

	});

	$('.blog_delete').on('click',function(){
		var blog_id = $(this).attr('data-blog-id');
		$('#modal_delete_blog_id').val(blog_id);
		$('#blog_delete_modal').modal('show');


	});

	$('#confirm_delete_blog').on('click',function() {
		var blog_id = $('#modal_delete_blog_id').val();
		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/delete_blog',
			data: {
				blog_id:blog_id
			},
			success:function(result) {
				console.log(result);
				location.reload();
			},
			error:function(e){
				console.log(e);
				location.reload();
			},
			beforeSend: function() {
		     	$('div.loader').css('display','block');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		   	}
		});
	});

	$('.blog_edit').on('click',function() {
		$('#operation_type').val('u');
		var blog_id = $(this).attr('data-blog-id');
		$('#operation_blog_id').val(blog_id);

		var blog_title = $(this).parent().parent().children('.table_blog_title').text();
		var blog_date = $(this).parent().parent().children('.table_blog_date').text();
		var blog_image = $(this).parent().parent().children('.table_blog_image').children('img').attr('src');
		var blog_content = $(this).parent().parent().children('.table_blog_content').children('input').attr('data-content');


		$('#modal_blog_date').val(blog_date);
		$('#modal_blog_title').val(blog_title);
		$('#modal_blog_image').attr('src',blog_image);
		tinymce.activeEditor.setContent(blog_content);


		$('#blog_modal').modal('show');
	});
 		
	 

});
