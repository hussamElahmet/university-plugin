var $ = jQuery;
var city_select;
var university_table;
var selected_city;
$(document).ready(function() {

	city_select = new SlimSelect({
		select: '#university_city',
		onChange:(info) => {
		    selected_city = {
		    	value:info.value,
		    	text:info.text
		    };
		}
	});

	university_table = $('#university_table').DataTable({
	 	responsive:true,
	 	ajax:{
	 		url:mBaseUrl+'/wp-json/university/v1/get_university_all/',
	 		type:'POST'
	 	},
	 	columns:[
	 		{
	 			data:'university_logo',
	 			render:function(data, type, row){
	 				return '<img width="50px" height="50px" src="'+data+'">';
	 			}
	 		},
	 		{data:'university_name'},
	 		{data:'university_tel'},
	 		{data:'university_email'},
	 		{
	 			data:'university_url',
	 			render:function(data, type, row){
	 				return '<a target="_blank" href="'+data+'">اضغط هنا</a>';
	 			}

	 		},
	 		{
	 			data:'university_map',
	 			render:function(data, type, row){
	 				return '<a target="_blank" href="'+data+'">اضغط هنا</a>';
	 			}
	 		},
	 		{data:'city_name'},
	 		{data:'university_world_order'},
	 		{data:'university_local_order'},
	 		{data:'university_education_language'},
	 		{
	 			data:'university_category',
	 			render:function(data, type, row){
	 				if (data == '0') {
	 					return 'حكومية';
	 				} else {
	 					return 'خاصة';
	 				}
	 			}
	 		},
	 		{
	 			data:'university_description',
	 			render:function(data, type, row){
	 				var el = "<button class='button show_content' data-term-content='"+data+"'>عرض</button>";
	 				return el;
	 			}
	 		},
	 		{
	 			data:'university_id',
	 			render:function(data, type, row){
	 				var el = '<button class="button university_delete" data-university-id="'+data+'">حذف</button>';
	 				el = el + '<button class="button university_update" data-university-id="'+data+'">تعديل</button>';

	 				return el;
	 			}
	 		}
	 	]
	 });

	$('button.university_save').on('click',function() {
		var data = getPostData();
		var operation_type = $('#operation_type').val();
		

		if (operation_type == 'i') {
			saveUniversity(data);
			$('#operation_type').val('i');
		}
		else if (operation_type == 'u') {
			updateUniversity(data);
			$('#operation_type').val('i');
		}
		
	});

	$('#university_table tbody').on('click','button.university_update',function(e) {
		$('#operation_type').val('u');
		var university_id = $(this).attr('data-university-id');
		getUniversity(university_id);
	});

	$('#university_table tbody').on('click','button.university_delete',function() {
		var university_id = $(this).attr('data-university-id');
		deleteUniversity(university_id);
	});

	$('#university_table tbody').on('click','button.show_content',function() {
		$('div#university_content').empty();
		var content = $(this).attr('data-term-content');
		$('div#university_content').append(content);
		$('#university_content_modal').modal('show');
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
	        $('#university_logo').attr('src',attachment.url);	        
	    });
	    image_frame.open();
	});
});


function getPostData () {

	var university_id = $('#operation_id').val();
	var university_logo = $('#university_logo').attr('src');
	var university_name = $('#university_name').val();
	var university_tel = $('#university_tel').val();
	var university_url = $('#university_url').val();
	var university_map = $('#university_map').val();
	var university_email = $('#university_email').val();
	var university_world_order = $('#university_world_order').val();
	var university_local_order = $('#university_local_order').val();
	var university_city = city_select.selected();
	var university_education_language = $('#university_education_language').val();
	var university_category = $( "#university_category" ).val();
	var university_description = tinymce.activeEditor.getContent();

	var university_city_text = selected_city.text;
	var university_category_text = $( "#university_category option:selected" ).text();


	var postData = {
		university_id:university_id,
		university_logo:university_logo,
		university_name:university_name,
		university_tel:university_tel,
		university_url:university_url,
		university_map:university_map,
		university_email:university_email,
		university_world_order:university_world_order,
		university_local_order:university_local_order,
		university_city:university_city,
		university_education_language:university_education_language,
		university_category:university_category,
		university_city_text:university_city_text,
		university_category_text:university_category_text,
		university_description:university_description
	};

	return postData;
}

function setData (data) {
	emptyFields();
	$('#operation_id').val(data.university_id);
	$('#university_logo').attr('src',data.university_logo);
	$('#university_name').val(data.university_name);
	$('#university_tel').val(data.university_tel);
	$('#university_url').val(data.university_url);
	$('#university_map').val(data.university_map);
	$('#university_email').val(data.university_email);
	$('#university_world_order').val(data.university_world_order);
	$('#university_local_order').val(data.university_local_order);
	city_select.set(data.university_city);
	$('#university_education_language').val(data.university_education_language);
	$( "#university_category" ).val(data.university_category);
	if (data.university_description == null) {
		tinymce.activeEditor.setContent('');
	}
	else {
		tinymce.activeEditor.setContent(data.university_description);
	}
}

function emptyFields() {
	$('#operation_id').val('');
	$('#university_logo').attr('src','');
	$('#university_name').val('');
	$('#university_tel').val('');
	$('#university_url').val('');
	$('#university_map').val('');
	$('#university_email').val('');
	$('#university_world_order').val('');
	$('#university_local_order').val('');
	city_select.set('0');
	$('#university_education_language').val('');
	$( "#university_category" ).val('0');
	tinymce.activeEditor.setContent('');
}

function saveUniversity(data) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/create_university',
		data: data,
		success:function(result) {
			console.log(result);
			emptyFields();
			university_table.ajax.reload();
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

function updateUniversity(data){
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/update_university',
		data: data,
		success:function(result) {
			console.log(result);
			emptyFields();
			university_table.ajax.reload();
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

function deleteUniversity(university_id){
	var ok = confirm("متأكد من الحذف");
	if (ok) {
		$.ajax({
			type: 'POST',
			url:mBaseUrl+'/wp-json/university/v1/delete_university',
			data: {
				university_id:university_id
			},
			success:function(result) {
				console.log(result);
				emptyFields();
				university_table.ajax.reload();
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

function getUniversity(university_id){
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/get_university',
		data: {
			university_id:university_id
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