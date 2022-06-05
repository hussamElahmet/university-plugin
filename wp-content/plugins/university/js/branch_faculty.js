var $ = jQuery;
var term_table;
var selected_university='-1';
var selected_faculty='-1';
var universities_select;
var faculties_select;
var branches_select;
$(document).ready(function() {

	universities_select = new SlimSelect({
		select: '#universities',
		onChange:(info) => {
		    selected_university = info.value;
		    selected_faculty = '-1';
		    checkUniversitySelect();

		}
	});

	faculties_select = new SlimSelect({
		select: '#faculties',
		onChange:(info) => {
		    selected_faculty = info.value;
		    checkFacultySelect();
		}
	});

	branches_select = new SlimSelect({
		select: '#branches'
	});

	term_table = $('#term_table').DataTable({
	 	responsive:true,
	 	ajax:{
	 		url:mBaseUrl+'/wp-json/university/v1/get_branch_f_relation_all/',
	 		type:'POST',
	 		data:function(d) {
	 			d.university_faculty_id = selected_faculty;
	 		}
	 	},
	 	columns:[
	 		{data:'branch_name'},
	 		{
	 			data:'branch_url',
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
	var id = $('#operation_id').val();
	var university_faculty_id = selected_faculty;
	var branch_id = branches_select.selected();
	var branch_url = $('#term_url').val();


	var postData = {
		id:id,
		university_faculty_id:university_faculty_id,
		branch_id:branch_id,
		branch_url:branch_url
	};

	return postData;
}

function emptyFields() {
	$('#term_url').val('');
}

function setData(data) {
	emptyFields();
	$('#operation_id').val(data.id);
	$('#term_url').val(data.branch_url);
	emptyRelatedBranches();
	$('#branches').append('<option value="'+data.branch_id+'" >'+data.branch_name+'</option>');
}

function saveTerm(data) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/create_branch_f_relation',
		data: data,
		success:function(result) {
			console.log(result);
			emptyFields();
			getRelatedBranches(selected_faculty);
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
		url:mBaseUrl+'/wp-json/university/v1/update_branch_f_relation',
		data: data,
		success:function(result) {
			console.log(result);
			emptyFields();
			getRelatedBranches(selected_faculty);
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

function deleteTerm(id) {
	var ok = confirm("متأكد من الحذف");
	if (ok) {
		$.ajax({
			type: 'POST',
			url:mBaseUrl+'/wp-json/university/v1/delete_branch_f_relation',
			data: {
				id:id
			},
			success:function(result) {
				console.log(result);
				emptyFields();
				getRelatedBranches(selected_faculty);
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

function getTerm(id) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/get_branch_f_relation',
		data: {
			id:id
		},
		success:function(result) {
			console.log(result);
			setData(result);
			// term_table.ajax.reload();
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


function checkUniversitySelect() {

	if (selected_university == '-1') {
		$('button.term_save').prop('disabled', true);
		$('#operation_type').val('i');
		emptyFields();
		emptyRelatedFaculties();
		emptyRelatedBranches();
		// term_table.ajax.reload();
	} else {
		$('#operation_type').val('i');
		emptyFields();
		emptyRelatedFaculties();
		emptyRelatedBranches();
		// $('button.term_save').prop('disabled', false);
		getRelatedFaculties(selected_university);
		
		term_table.ajax.reload();
	}
}

function checkFacultySelect() {

	if (selected_faculty == '-1') {
		$('button.term_save').prop('disabled', true);
		$('#operation_type').val('i');
		emptyFields();
		emptyRelatedBranches();
		term_table.ajax.reload();
	} else {
		$('#operation_type').val('i');
		$('button.term_save').prop('disabled', false);
		getRelatedBranches(selected_faculty);
		term_table.ajax.reload();
	}
	
}

function getRelatedFaculties (university_id) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/get_related_faculties',
		data: {
			university_id:university_id
		},
		success:function(result) {
			console.log(result);
			setRelatedFaculties(result);
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

function setRelatedFaculties (data) {
	emptyRelatedFaculties();
	$('#faculties').append('<option value="-1">اختر</option>');
	for (var i = 0; i < data.length; i++) {
		var el = '<option value = "'+data[i].university_faculty_id+'">'+data[i].faculty_name+'</option>';
		$('#faculties').append(el);
	}
}

function emptyRelatedFaculties () {
	$('#faculties').empty();
}

function getRelatedBranches (university_faculty_id) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/get_unselected_branches_f',
		data: {
			university_faculty_id:university_faculty_id
		},
		success:function(result) {
			console.log(result);
			setRelatedBranches(result);
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

function setRelatedBranches (data) {
	emptyRelatedBranches();
	for (var i = 0; i < data.length; i++) {
		var el = '<option value = "'+data[i].branch_id+'">'+data[i].branch_name+'</option>';
		$('#branches').append(el);
	}
}

function emptyRelatedBranches () {
	$('#branches').empty();
}