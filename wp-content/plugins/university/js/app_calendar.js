var $ = jQuery;
var university_select;
var term_table;
$(document).ready(function() {

	university_select = new SlimSelect({
		select: '#universities'
	});

	term_table = $('#term_table').DataTable({
	 	responsive:true,
	 	ajax:{
	 		url:mBaseUrl+'/wp-json/university/v1/get_app_calendar_all/',
	 		type:'POST'
	 	},
	 	columns:[
	 		{data:'university_name'},
	 		{data:'city_name'},
	 		{data:'app_name'},
	 		{
	 			data:'app_start_date',
	 			render:function(data, type, row){
	 				if (data =='0000-00-00') {
	 					return 'غير محدد' ;
	 				} else{
	 					return data;
	 				}
	 				
	 			}
	 		},
	 		{
	 			data:'app_end_date',
	 			render:function(data, type, row){
	 				if (data =='0000-00-00') {
	 					return 'غير محدد' ;
	 				} else{
	 					return data;
	 				}
	 				
	 			}
	 		},
	 		{
	 			data:'app_result_date',
	 			render:function(data, type, row){
	 				if (data =='0000-00-00') {
	 					return 'غير محدد' ;
	 				} else{
	 					return data;
	 				}
	 				
	 			}
	 		},
	 		{
	 			data:'app_result_url',
	 			render:function(data, type, row){
	 				var el = '<a href="'+data+'" target="_blank">اضغط هنا</a>';
	 				return el;
	 			}
	 		},
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

});


function getPostData () {

	var id = $('#operation_id').val();
	var university_id = university_select.selected();
	var app_name = $('#app_name').val();
	var app_start_date = $('#app_start_date').val();
	var app_end_date = $('#app_end_date').val();
	var app_result_date = $('#app_result_date').val();
	var app_result_url = $('#app_result_url').val();
    var app_color = $('#app_color').val();
    
	var postData = {
		id:id,
		university_id:university_id,
		app_name:app_name,
		app_start_date:app_start_date,
		app_end_date:app_end_date,
		app_result_date:app_result_date,
		app_result_url:app_result_url,
		app_color:app_color
	};

	console.log(postData);

	return postData;
}

function setData (data) {
	emptyFields();
	$('#operation_id').val(data.id);
	university_select.set(data.university_id);
	$('#app_name').val(data.app_name);
	$('#app_start_date').val(data.app_start_date);
	$('#app_end_date').val(data.app_end_date);
	$('#app_result_date').val(data.app_result_date);
	$('#app_result_url').val(data.app_result_url);
	$('#app_color').val(data.app_color);
}

function emptyFields() {
	$('#operation_id').val('');
	university_select.set('');
	$('#app_name').val('');
	$('#app_start_date').val('');
	$('#app_end_date').val('');
	$('#app_result_date').val('');
	$('#app_result_url').val('');
	$('#app_color').val('');
}

function saveTerm(data) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/create_app_calendar',
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
		url:mBaseUrl+'/wp-json/university/v1/update_app_calendar',
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
			url:mBaseUrl+'/wp-json/university/v1/delete_app_calendar',
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
		url:mBaseUrl+'/wp-json/university/v1/get_app_calendar',
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