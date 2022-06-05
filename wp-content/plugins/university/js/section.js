var $ = jQuery;
var term_table;
$(document).ready(function(){

	term_table = $('#term_table').DataTable({
	 	responsive:true,
	 	ajax:{
	 		url:mBaseUrl+'/wp-json/university/v1/get_section_all/',
	 		type:'POST'
	 	},
	 	columns:[
	 		{data:'section_name'},
	 		{data:'section_order'},
	 		{
	 			data:'section_id',
	 			render:function(data, type, row){
	 				var el = '<button class="button term_delete" data-term-id="'+data+'">حذف</button>';
	 				el = el + '<button class="button term_update" data-term-id="'+data+'">تعديل</button>';
	 				return el;
	 			}
	 		}
	 	]
	 });

	$('#term_name').keypress(function (e) {
		var key = e.which;
		if(key == 13){
			$('button.term_save').click();
			return false;  
		}
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
		var term_id = $(this).attr('data-term-id');
		getTerm(term_id);
	});

	$('#term_table tbody').on('click','button.term_delete',function() {
		var term_id = $(this).attr('data-term-id');
		deleteTerm(term_id);
	});

});

function getPostData () {

	var section_id = $('#operation_id').val();
	var section_name = $('#term_name').val();
	var section_order = $('#term_order').val();


	var postData = {
		section_id:section_id,
		section_name:section_name,
		section_order:section_order
	};

	return postData;
}

function setData (data) {
	emptyFields();
	$('#operation_id').val(data.section_id);
	$('#term_name').val(data.section_name);
	$('#term_order').val(data.section_order);
}

function emptyFields() {
	$('#operation_id').val('');
	$('#term_name').val('');
	$('#term_order').val('');
}

function saveTerm(data) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/create_section',
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
		url:mBaseUrl+'/wp-json/university/v1/update_section',
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

function deleteTerm(section_id){
	var ok = confirm("متأكد من الحذف");
	if (ok) {
		$.ajax({
			type: 'POST',
			url:mBaseUrl+'/wp-json/university/v1/delete_section',
			data: {
				section_id:section_id
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

function getTerm(section_id){
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/get_section',
		data: {
			section_id:section_id
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