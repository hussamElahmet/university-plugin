var $ = jQuery;
var term_table;
$(document).ready(function(){

	term_table = $('#term_table').DataTable({
	 	responsive:true,
	 	ajax:{
	 		url:mBaseUrl+'/wp-json/university/v1/get_exam_all/',
	 		type:'POST'
	 	},
	 	columns:[
	 		{data:'exam_name'},
	 		{
	 			data:'exam_description',
	 			render:function(data, type, row){
	 				var el = "<button class='button show_content' data-term-content='"+data+"'>عرض</button>";
	 				return el;
	 			}
	 		},
	 		{
	 			data:'exam_id',
	 			render:function(data, type, row){
	 				var el = '<button class="button term_update" data-term-id="'+data+'">تعديل</button>';
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
		

		if (operation_type == 'u') {
			updateTerm(data);
			$('#operation_type').val('i');
			$('button.term_save').prop('disabled',true);
		}
		
	});

	$('#term_table tbody').on('click','button.term_update',function(e) {
		$('#operation_type').val('u');
		var term_id = $(this).attr('data-term-id');
		getTerm(term_id);
		$('button.term_save').prop('disabled',false);
	});


	$('#term_table tbody').on('click','button.show_content',function() {
		$('div#section_content').empty();
		var content = $(this).attr('data-term-content');
		$('div#section_content').append(content);
		$('#section_content_modal').modal('show');
	});

});

function getPostData () {

	var exam_id = $('#operation_id').val();
	var exam_name = $('#term_name').val();
	var exam_description = tinymce.activeEditor.getContent();

	var postData = {
		exam_id:exam_id,
		exam_name:exam_name,
		exam_description:exam_description
	};

	return postData;
}

function setData (data) {
	emptyFields();
	$('#operation_id').val(data.exam_id);
	$('#term_name').val(data.exam_name);
	tinymce.activeEditor.setContent(data.exam_description);
}

function emptyFields() {
	$('#operation_id').val('');
	$('#term_name').val('');
	tinymce.activeEditor.setContent('');
}


function updateTerm(data){
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/update_exam',
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


function getTerm(exam_id){
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/get_exam',
		data: {
			exam_id:exam_id
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