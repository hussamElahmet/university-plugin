var $ = jQuery;
var term_table;
var selected_university='-1';
var selected_degree='-1';
var universities_select;
var degrees_select;
$(document).ready(function() {

	universities_select = new SlimSelect({
		select: '#universities',
		onChange:(info) => {
		    selected_university = info.value;
		    checkSelects();

		}
	});

	degrees_select = new SlimSelect({
		select: '#degrees',
		onChange:(info) => {
		    selected_degree = info.value;
		}
	});

	term_table = $('#term_table').DataTable({
	 	responsive:true,
	 	ajax:{
	 		url:mBaseUrl+'/wp-json/university/v1/get_university_degree_all/',
	 		type:'POST',
	 		data:function(d) {
	 			d.university_id = selected_university;
	 		}
	 	},
	 	columns:[
	 		{data:'branch_name'},
	 		{data:'branch_study_years'},
	 		{data:'branch_language'},
	 		{data:'branch_before_discount'},
	 		{data:'branch_after_discount'},
	 		{data:'degree_name'},
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
		debugger

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
	var degree_id = selected_degree;
	var branch_name = $('#branch_name').val();
	var branch_study_years = $('#branch_study_years').val();
	var branch_language = $('#branch_language').val();
	var branch_before_discount = $('#branch_before_discount').val();
	var branch_after_discount = $('#branch_after_discount').val();
    var status=$('#status').val();

	var postData = {
		id:id,
		university_id:university_id,
		degree_id:degree_id,
		branch_name:branch_name,
		branch_study_years:branch_study_years,
		branch_language:branch_language,
		branch_before_discount:branch_before_discount,
		branch_after_discount:branch_after_discount,
		status:status
	};

	return postData;
}

function setData (data) {
	emptyFields();
	$('#operation_id').val(data.id);
	universities_select.set(data.university_id);
	degrees_select.set(data.degree_id);
	$('#branch_name').val(data.branch_name);
	$('#branch_study_years').val(data.branch_study_years);
	$('#branch_language').val(data.branch_language);
	$('#branch_before_discount').val(data.branch_before_discount);
	$('#branch_after_discount').val(data.branch_after_discount);
}

function emptyFields() {
	$('#operation_id').val('');
	degrees_select.set('-1');
	$('#branch_name').val('');
	$('#branch_study_years').val('');
	$('#branch_language').val('');
	$('#branch_before_discount').val('');
	$('#branch_after_discount').val('');
}

function saveTerm(data) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/create_university_degree',
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
		url:mBaseUrl+'/wp-json/university/v1/update_university_degree',
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
			url:mBaseUrl+'/wp-json/university/v1/delete_university_degree',
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
		url:mBaseUrl+'/wp-json/university/v1/get_university_degree',
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

	if (selected_university == '-1') {
		$('button.term_save').prop('disabled', true);
		term_table.ajax.reload();
	} else {
		term_table.ajax.reload();
		$('button.term_save').prop('disabled', false);
	}
}