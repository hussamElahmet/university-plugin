var $ = jQuery;
$(document).ready(function() {

	$('#calendar_table').DataTable({
	 	responsive:true
	 });

	$('#calendar_add').on('click',function(){
		$('#calendar_operation').val('i');
		$('#calendar_modal').modal('show');
	});

	var fakulte_select = new SlimSelect({
		select: '#universite_select',
		closeOnSelect: true
	});


	$('#save_calendar').on('click',function() {
		var operation = $('#calendar_operation').val();
		var rest_url = '';
		if (operation == 'i') {
			rest_url = 'create_calendar';
		} else {
			rest_url = 'update_calendar';
		}
		var calendar_id = $('#modal_calendar_id').val();
		var universite_id = fakulte_select.selected();
		var basvuru = $('#basvuru').val();
		var basvuru_baslangic = $('#basvuru_baslangic').val();
		var basvuru_bitis = $('#basvuru_bitis').val();
		var basvuru_sonuc = $('#basvuru_sonuc').val();
		var basvuru_url = $('#basvuru_url').val();

		postData = {
			calendar_id:calendar_id,
			universite_id:universite_id,
			basvuru:basvuru,
			basvuru_baslangic:basvuru_baslangic,
			basvuru_bitis:basvuru_bitis,
			basvuru_sonuc:basvuru_sonuc,
			basvuru_url:basvuru_url
		}

		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/'+rest_url,
			data: postData,
			success:function(result) {
				console.log(result);
				location.reload();
			},
			error:function(e){
				console.log(e);
				location.reload();
			},
			beforeSend: function() {
		     	$('div.loader').css('display','block');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		   	}
		});

	});

	$('button.calendar_edit').on('click',function() {
		
		var calendar_id= $(this).attr('data-calendar-id');
		var universite_id= $(this).attr('data-universite-id');
		$('#calendar_operation').val('u');
		$('#modal_calendar_id').val(calendar_id);

		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/search_calendar',
			data: {
				calendar_id:calendar_id
			},
			success:function(result) {
				console.log(result);
				fakulte_select.set(result.universite_id)
				$('#basvuru').val(result.basvuru)
				$('#basvuru_baslangic').val(result.basvuru_baslangic)
				$('#basvuru_bitis').val(result.basvuru_bitis)
				$('#basvuru_sonuc').val(result.basvuru_sonuc)
				$('#basvuru_url').val(result.basvuru_url)
				$('#calendar_modal').modal('show');
			},
			error:function(e){
				console.log(e);
			},
			beforeSend: function() {
		     	$('div.loader').css('display','block');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		   	}
		});
	});

	$('button.calendar_delete').on('click',function(){
		var calendar_id= $(this).attr('data-calendar-id');
		$('#modal_delete_calendar_id').val(calendar_id);
		$('#calendar_delete_modal').modal('show');
	});


	$('#confirm_delete_calendar').on('click',function() {
		var calendar_id = $('#modal_delete_calendar_id').val();

		$.ajax({
			type: 'POST',
			url:base_url+'/wp-json/university/v1/delete_calendar',
			data: {
				calendar_id:calendar_id
			},
			success:function(result) {
				console.log(result);
				location.reload();
			},
			error:function(e){
				console.log(e);
				location.reload();
			},
			beforeSend: function() {
		     	$('div.loader').css('display','block');
		   	},
		   	complete: function(){
		    	$('div.loader').css('display','none');
		   	}
		});
	});
 		
	 

});
