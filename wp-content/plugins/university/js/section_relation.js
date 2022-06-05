var $ = jQuery;
var term_table;
var selected_university='-1';
var selected_section='-1';
var universities_select;
var sections_select;
$(document).ready(function() {

	universities_select = new SlimSelect({
		select: '#universities',
		onChange:(info) => {
		    selected_university = info.value;
		    checkSelects();

		}
	});

	sections_select = new SlimSelect({
		select: '#sections',
		onChange:(info) => {
		    selected_section = info.value;
		    checkSelects();
		}
	});

	term_table = $('#term_table').DataTable({
	 	responsive:true,
	 	ajax:{
	 		url:mBaseUrl+'/wp-json/university/v1/get_section_relation_all/',
	 		type:'POST',
	 		data:function(d) {
	 			d.university_id = selected_university;
	 			d.section_id = selected_section;
	 		}
	 	},
	 	columns:[
	 		{data:'option_name'},
	 		{
	 			data:'option_value',
	 			render:function(data, type, row){
	 				var el = "<button class='button show_content' data-term-content='"+data+"'>عرض</button>";
	 				return el;
	 			}
	 		},
	 		{data:'option_order'},
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

	var id = $('#operation_id').val();
	var university_id = selected_university;
	var section_id = selected_section;
	var option_name = $('#term_name').val();
	var option_value = tinymce.activeEditor.getContent();
	var option_order = $('#term_order').val();


	var postData = {
		id:id,
		university_id:university_id,
		section_id:section_id,
		option_name:option_name,
		option_value:option_value,
		option_order:option_order
	};

	return postData;
}

function setData (data) {
	emptyFields();
	$('#operation_id').val(data.id);
	universities_select.set(data.university_id);
	sections_select.set(data.section_id);
	$('#term_name').val(data.option_name);
	tinymce.activeEditor.setContent(data.option_value);
	$('#term_order').val(data.option_order);
}

function emptyFields() {
	$('#operation_id').val('');
	$('#term_name').val('');
	tinymce.activeEditor.setContent('');
	$('#term_order').val('');
}

function saveTerm(data) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/create_section_relation',
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
		url:mBaseUrl+'/wp-json/university/v1/update_section_relation',
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
			url:mBaseUrl+'/wp-json/university/v1/delete_section_relation',
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
		url:mBaseUrl+'/wp-json/university/v1/get_section_relation',
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


function checkSelects() {

	if (selected_university == '-1' || selected_section == '-1') {
		$('button.term_save').prop('disabled', true);
		term_table.ajax.reload();
	} else {
		term_table.ajax.reload();
		$('button.term_save').prop('disabled', false);
	}
}