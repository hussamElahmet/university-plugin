var $ = jQuery;
var term_table;
var selected_university='-1';
var universities_select;
var faculties_select;
$(document).ready(function() {

	universities_select = new SlimSelect({
		select: '#universities',
		onChange:(info) => {
		    selected_university = info.value;
		    checkSelects();

		}
	});

	faculties_select = new SlimSelect({
		select: '#faculties'
	});

	term_table = $('#term_table').DataTable({
	 	responsive:true,
	 	ajax:{
	 		url:mBaseUrl+'/wp-json/university/v1/get_faculty_relation_all/',
	 		type:'POST',
	 		data:function(d) {
	 			d.university_id = selected_university;
	 		}
	 	},
	 	columns:[
	 		{data:'faculty_name'},
	 		{
	 			data:'faculty_url',
	 			render:function(data, type, row){
	 				var el = '<a href="'+data+'" target="_blank">اضغط هنا</a>';
	 				return el;
	 			}
	 		},
	 		{
	 			data:'university_faculty_id',
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
		} else if (operation_type == 'u') {
			updateTerm(data);
			$('#operation_type').val('i');
		}
		
	});

	$('#term_table tbody').on('click','button.term_delete',function() {
		var term_id = $(this).attr('data-term-id');
		deleteTerm(term_id);
	});

	$('#term_table tbody').on('click','button.term_update',function() {
		$('#operation_type').val('u');
		var term_id = $(this).attr('data-term-id');
		getTerm(term_id);
	});

});

function getPostData () {
	var university_faculty_id = $('#operation_id').val();
	var university_id = universities_select.selected();
	var faculty_id = faculties_select.selected();
	var faculty_url = $('#term_url').val();


	var postData = {
		university_faculty_id:university_faculty_id,
		university_id:university_id,
		faculty_id:faculty_id,
		faculty_url:faculty_url
	};

	return postData;
}

function emptyFields() {

	$('#term_url').val('');
}

function setData(data) {
	emptyFields();
	$('#operation_id').val(data.university_faculty_id);
	$('#term_url').val(data.faculty_url);
	emptyFacultySelect();
	$('#faculties').append('<option value="'+data.faculty_id+'" >'+data.faculty_name+'</option>');
}

function saveTerm(data) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/create_faculty_relation',
		data: data,
		success:function(result) {
			console.log(result);
			emptyFields();
			getUnselectedFaculties(selected_university);
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

function updateTerm(data) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/update_faculty_relation',
		data: data,
		success:function(result) {
			console.log(result);
			emptyFields();
			getUnselectedFaculties(selected_university);
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

function deleteTerm(university_faculty_id) {
	var ok = confirm("متأكد من الحذف");
	if (ok) {
		$.ajax({
			type: 'POST',
			url:mBaseUrl+'/wp-json/university/v1/delete_faculty_relation',
			data: {
				university_faculty_id:university_faculty_id
			},
			success:function(result) {
				console.log(result);
				emptyFields();
				getUnselectedFaculties(selected_university);
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

function getTerm(university_faculty_id) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/get_faculty_relation',
		data: {
			university_faculty_id:university_faculty_id
		},
		success:function(result) {
			console.log(result);
			setData(result);
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


function checkSelects() {

	if (selected_university == '-1') {
		$('button.term_save').prop('disabled', true);
		term_table.ajax.reload();
		emptyFacultySelect();
	} else {
		$('button.term_save').prop('disabled', false);
		getUnselectedFaculties(selected_university);
		term_table.ajax.reload();
	}
}

function getUnselectedFaculties(university_id) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/get_unselected_faculties',
		data: {
			university_id:university_id
		},
		success:function(result) {
			console.log(result);
			setUnselectedFacultiesData(result);
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

function setUnselectedFacultiesData(data) {
	emptyFacultySelect();
	for (var i = 0; i < data.length; i++) {
		var el = '<option value = "'+data[i].faculty_id+'">'+data[i].faculty_name+'</option>';
		$('#faculties').append(el);
	}
}

function emptyFacultySelect() {
	$('#faculties').empty();
}