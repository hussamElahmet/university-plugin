var $ = jQuery;
var term_table;
$(document).ready(function(){

	term_table = $('#term_table').DataTable({
	 	responsive:true,
	 	ajax:{
	 		url:mBaseUrl+'/wp-json/university/v1/get_branch_all/',
	 		type:'POST'
	 	},
	 	columns:[
	 		{data:'branch_name'},
	 		{
	 			data:'branch_description',
	 			render:function(data, type, row){
	 				var el = "<button class='button show_content' data-term-content='"+data+"'>عرض</button>";
	 				return el;
	 			}
	 		},
	 		{
	 			data:'branch_id',
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

	$('#term_table tbody').on('click','button.show_content',function() {
		$('div#section_content').empty();
		var content = $(this).attr('data-term-content');
		$('div#section_content').append(content);
		$('#section_content_modal').modal('show');
	});

});

function getPostData () {

	var branch_id = $('#operation_id').val();
	var branch_name = $('#term_name').val();
	var branch_description = tinymce.activeEditor.getContent();

	var postData = {
		branch_id:branch_id,
		branch_name:branch_name,
		branch_description:branch_description
	};

	return postData;
}

function setData (data) {
	emptyFields();
	$('#operation_id').val(data.branch_id);
	$('#term_name').val(data.branch_name);
	tinymce.activeEditor.setContent(data.branch_description);
}

function emptyFields() {
	$('#operation_id').val('');
	$('#term_name').val('');
	tinymce.activeEditor.setContent('');
}

function saveTerm(data) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/create_branch',
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
		url:mBaseUrl+'/wp-json/university/v1/update_branch',
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

function deleteTerm(branch_id){
	var ok = confirm("متأكد من الحذف");
	if (ok) {
		$.ajax({
			type: 'POST',
			url:mBaseUrl+'/wp-json/university/v1/delete_branch',
			data: {
				branch_id:branch_id
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

function getTerm(branch_id){
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/get_branch',
		data: {
			branch_id:branch_id
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