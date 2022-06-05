var $ = jQuery;
var term_table;
var selected_university='-1';
var universities_select;
var exams_select;
$(document).ready(function() {

	universities_select = new SlimSelect({
		select: '#universities',
		onChange:(info) => {
		    selected_university = info.value;
		    checkSelects();

		}
	});

	exams_select = new SlimSelect({
		select: '#exams'
	});

	term_table = $('#term_table').DataTable({
	 	responsive:true,
	 	ajax:{
	 		url:mBaseUrl+'/wp-json/university/v1/get_exam_relation_all/',
	 		type:'POST',
	 		data:function(d) {
	 			d.university_id = selected_university;
	 		}
	 	},
	 	columns:[
	 		{data:'exam_name'},
	 		{
	 			data:'id',
	 			render:function(data, type, row){
	 				var el = '<button class="button term_delete" data-term-id="'+data+'">حذف</button>';
	 				// el = el + '<button class="button term_update" data-term-id="'+data+'">تعديل</button>';
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
		// else if (operation_type == 'u') {
		// 	updateTerm(data);
		// 	$('#operation_type').val('i');
		// }
		
	});

	$('#term_table tbody').on('click','button.term_delete',function() {
		var term_id = $(this).attr('data-term-id');
		deleteTerm(term_id);
	});

	// $('#term_table tbody').on('click','button.term_update',function() {
	// 	$('#operation_type').val('u');
	// 	var term_id = $(this).attr('data-term-id');
	// 	getTerm(term_id);
	// });

});

function getPostData () {
	var id = $('#operation_id').val();
	var university_id = universities_select.selected();
	var exam_id = exams_select.selected();
	// var exam_url = $('#term_url').val();


	var postData = {
		id:id,
		university_id:university_id,
		exam_id:exam_id,
		// exam_url:exam_url
	};

	return postData;
}

function emptyFields() {

	// $('#term_url').val('');
}

function setData(data) {
	emptyFields();
	$('#operation_id').val(data.university_exam_id);
	$('#term_url').val(data.exam_url);
	emptyexamSelect();
	$('#exams').append('<option value="'+data.exam_id+'" >'+data.exam_name+'</option>');
}

function saveTerm(data) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/create_exam_relation',
		data: data,
		success:function(result) {
			console.log(result);
			emptyFields();
			getUnselectedexams(selected_university);
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
		url:mBaseUrl+'/wp-json/university/v1/update_exam_relation',
		data: data,
		success:function(result) {
			console.log(result);
			emptyFields();
			getUnselectedexams(selected_university);
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
			url:mBaseUrl+'/wp-json/university/v1/delete_exam_relation',
			data: {
				id:id
			},
			success:function(result) {
				console.log(result);
				emptyFields();
				getUnselectedexams(selected_university);
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
		url:mBaseUrl+'/wp-json/university/v1/get_exam_relation',
		data: {
			id:id
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
		emptyexamSelect();
	} else {
		$('button.term_save').prop('disabled', false);
		getUnselectedexams(selected_university);
		term_table.ajax.reload();
	}
}

function getUnselectedexams(university_id) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/get_unselected_exams',
		data: {
			university_id:university_id
		},
		success:function(result) {
			console.log(result);
			setUnselectedexamsData(result);
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

function setUnselectedexamsData(data) {
	emptyexamSelect();
	for (var i = 0; i < data.length; i++) {
		var el = '<option value = "'+data[i].exam_id+'">'+data[i].exam_name+'</option>';
		$('#exams').append(el);
	}
}

function emptyexamSelect() {
	$('#exams').empty();
}