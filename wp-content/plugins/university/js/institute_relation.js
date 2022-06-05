var $ = jQuery;
var term_table;
var selected_university='-1';
var universities_select;
var institutes_select;
$(document).ready(function() {

	universities_select = new SlimSelect({
		select: '#universities',
		onChange:(info) => {
		    selected_university = info.value;
		    checkSelects();

		}
	});

	institutes_select = new SlimSelect({
		select: '#institutes'
	});

	term_table = $('#term_table').DataTable({
	 	responsive:true,
	 	ajax:{
	 		url:mBaseUrl+'/wp-json/university/v1/get_institute_relation_all/',
	 		type:'POST',
	 		data:function(d) {
	 			d.university_id = selected_university;
	 		}
	 	},
	 	columns:[
	 		{data:'institute_name'},
	 		{
	 			data:'institute_url',
	 			render:function(data, type, row){
	 				var el = '<a href="'+data+'" target="_blank">اضغط هنا</a>';
	 				return el;
	 			}
	 		},
	 		{
	 			data:'university_institute_id',
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
	var university_institute_id = $('#operation_id').val();
	var university_id = universities_select.selected();
	var institute_id = institutes_select.selected();
	var institute_url = $('#term_url').val();


	var postData = {
		university_institute_id:university_institute_id,
		university_id:university_id,
		institute_id:institute_id,
		institute_url:institute_url
	};

	return postData;
}

function emptyFields() {

	$('#term_url').val('');
}

function setData(data) {
	emptyFields();
	$('#operation_id').val(data.university_institute_id);
	$('#term_url').val(data.institute_url);
	emptyinstituteSelect();
	$('#institutes').append('<option value="'+data.institute_id+'" >'+data.institute_name+'</option>');
}

function saveTerm(data) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/create_institute_relation',
		data: data,
		success:function(result) {
			console.log(result);
			emptyFields();
			getUnselectedinstitutes(selected_university);
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
		url:mBaseUrl+'/wp-json/university/v1/update_institute_relation',
		data: data,
		success:function(result) {
			console.log(result);
			emptyFields();
			getUnselectedinstitutes(selected_university);
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

function deleteTerm(university_institute_id) {
	var ok = confirm("متأكد من الحذف");
	if (ok) {
		$.ajax({
			type: 'POST',
			url:mBaseUrl+'/wp-json/university/v1/delete_institute_relation',
			data: {
				university_institute_id:university_institute_id
			},
			success:function(result) {
				console.log(result);
				emptyFields();
				getUnselectedinstitutes(selected_university);
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

function getTerm(university_institute_id) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/get_institute_relation',
		data: {
			university_institute_id:university_institute_id
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
		emptyinstituteSelect();
	} else {
		$('button.term_save').prop('disabled', false);
		getUnselectedinstitutes(selected_university);
		term_table.ajax.reload();
	}
}

function getUnselectedinstitutes(university_id) {
	$.ajax({
		type: 'POST',
		url:mBaseUrl+'/wp-json/university/v1/get_unselected_institutes',
		data: {
			university_id:university_id
		},
		success:function(result) {
			console.log(result);
			setUnselectedinstitutesData(result);
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

function setUnselectedinstitutesData(data) {
	emptyinstituteSelect();
	for (var i = 0; i < data.length; i++) {
		var el = '<option value = "'+data[i].institute_id+'">'+data[i].institute_name+'</option>';
		$('#institutes').append(el);
	}
}

function emptyinstituteSelect() {
	$('#institutes').empty();
}