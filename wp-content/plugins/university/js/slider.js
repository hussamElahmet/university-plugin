var $ = jQuery;
var term_table;
$(document).ready(function() {



	term_table = $('#term_table').DataTable({
	 	responsive:true,
	 	ajax:{
	 		url:mBaseUrl+'/wp-json/university/v1/get_slider_all/',
	 		type:'POST'
	 	},
	 	columns:[
	 		{
	 			data:'slider_image',
	 			render:function(data, type, row){
	 				return '<img width="50px" height="50px" src="'+data+'" >';
	 				
	 			}
	 		},
	 		{data:'slider_title'},
	 		{data:'slider_description'},
	 		{data:'slider_order'},
	 		{
	 			data:'id',
	 			render:function(data, type, row){
	 				var el = '<button class="button term_delete" data-term-id="'+data+'">حذف</button>';
	 				el = el + '<button class="button term_update" data-term-id="'+data+'">تعديل</button>';

	 				return el;
	 			}
	 		}
	 	]
	 });

	$('button.term_save').on('click',function() {
		var data = getPostData();
		var operation_type = $('#operation_type').val();
		

		if (operation_type == 'i') {
			saveTerm(data);
			$('#operation_type').val('i');
		}
		else if (operation_type == 'u') {
			updateTerm(data);
			$('#operation_type').val('i');
		}
		
	});

	$('#term_table tbody').on('click','button.term_update',function(e) {
		$('#operation_type').val('u');
		var id = $(this).attr('data-term-id');
		getTerm(id);
	});

	$('#term_table tbody').on('click','button.term_delete',function() {
		var id = $(this).attr('data-term-id');
		deleteTerm(id);
	});

	$('input#upload_image').click(function(e) {
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
	        $('#slider_image').attr('src',attachment.url);	        
	    });
	    image_frame.open();
	});

});


function getPostData () {

	var id = $('#operation_id').val();
	var slider_image = $('#slider_image').attr('src');
	var slider_title = $('#slider_title').val();
	var slider_description = $('#slider_description').val();
	var slider_order = $('#slider_order').val();

	var postData = {
		id:id,
		slider_image:slider_image,
		slider_title:slider_title,
		slider_description:slider_description,
		slider_order:slider_order,
	};

	console.log(postData);

	return postData;
}

function setData (data) {
	emptyFields();
	$('#operation_id').val(data.id);
	$('#slider_image').attr('src',data.slider_image);
	$('#slider_title').val(data.slider_title);
	$('#slider_description').val(data.slider_description);
	$('#slider_order').val(data.slider_order);
}

function emptyFields() {
	$('#operation_id').val('');
	$('#slider_image').attr('src','');
	$('#slider_title').val('');
	$('#slider_description').val('');
	$('#slider_order').val('');
}

function saveTerm(data) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/create_slider',
		data: data,
		success:function(result) {
			console.log(result);
			emptyFields();
			term_table.ajax.reload();
		},
		error:function(e) {
			console.log(e);
			alert('error');

		},
		beforeSend: function() {
	     	$('div.loader').css('display','block');
	   	},
	   	complete: function(){
	    	$('div.loader').css('display','none');
	   	}
	});
}

function updateTerm(data){
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/update_slider',
		data: data,
		success:function(result) {
			console.log(result);
			emptyFields();
			term_table.ajax.reload();
		},
		error:function(e) {
			console.log(e);
			alert('error');

		},
		beforeSend: function() {
	     	$('div.loader').css('display','block');
	   	},
	   	complete: function(){
	    	$('div.loader').css('display','none');
	   	}
	});
}

function deleteTerm(id){
	var ok = confirm("متأكد من الحذف");
	if (ok) {
		$.ajax({
			type: 'POST',
			url:mBaseUrl+'/wp-json/university/v1/delete_slider',
			data: {
				id:id
			},
			success:function(result) {
				console.log(result);
				emptyFields();
				term_table.ajax.reload();
			},
			error:function(e) {
				console.log(e);
				alert('error');

			},
			beforeSend: function() {
		     	$('div.loader').css('display','block');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		   	}
		});
	}	
}

function getTerm(id){
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/get_slider',
		data: {
			id:id
		},
		success:function(result) {
			console.log(result);
			setData(result);
		},
		error:function(e) {
			console.log(e);
			alert('error');

		},
		beforeSend: function() {
	     	$('div.loader').css('display','block');
	   	},
	   	complete: function(){
	    	$('div.loader').css('display','none');
	   	}
	});
}