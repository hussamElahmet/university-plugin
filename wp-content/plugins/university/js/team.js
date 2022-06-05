var $ = jQuery;
var term_table;
$(document).ready(function() {



	term_table = $('#term_table').DataTable({
	 	responsive:true,
	 	ajax:{
	 		url:mBaseUrl+'/wp-json/university/v1/get_team_all/',
	 		type:'POST'
	 	},
	 	columns:[
	 		{
	 			data:'team_image',
	 			render:function(data, type, row){
	 				return '<img width="50px" height="50px" src="'+data+'" >';
	 				
	 			}
	 		},
	 		{data:'team_name'},
	 		{data:'team_name'},
	 		{data:'team_description'},
	 		{data:'team_order'},
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
	        $('#team_image').attr('src',attachment.url);	        
	    });
	    image_frame.open();
	});

});


function getPostData () {

	var id = $('#operation_id').val();
	var team_image = $('#team_image').attr('src');
	var team_name = $('#team_name').val();
	var team_position = $('#team_position').val();
	var team_description = $('#team_description').val();
	var team_order = $('#team_order').val();

	var postData = {
		id:id,
		team_image:team_image,
		team_name:team_name,
		team_position:team_position,
		team_description:team_description,
		team_order:team_order,
	};

	console.log(postData);

	return postData;
}

function setData (data) {
	emptyFields();
	$('#operation_id').val(data.id);
	$('#team_image').attr('src',data.team_image);
	$('#team_name').val(data.team_name);
	$('#team_position').val(data.team_position);
	$('#team_description').val(data.team_description);
	$('#team_order').val(data.team_order);
}

function emptyFields() {
	$('#operation_id').val('');
	$('#team_image').attr('src','');
	$('#team_name').val('');
	$('#team_position').val('');
	$('#team_description').val('');
	$('#team_order').val('');
}

function saveTerm(data) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/create_team',
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
		url:mBaseUrl+'/wp-json/university/v1/update_team',
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
			url:mBaseUrl+'/wp-json/university/v1/delete_team',
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
		url:mBaseUrl+'/wp-json/university/v1/get_team',
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