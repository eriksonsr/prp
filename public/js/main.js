$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('.add_tag').on('click', function(){
		$('#md_add_tag').modal('toggle');
	});

	$('#bt_salvar_tag').on('click', function(){
		$('#bt_salvar_tag').attr('disabled');
		var dados = {
			tag: $("#input_tag").val()
		}
		$.ajax({
			url: 'http://' + location.hostname + '/tags/salvar',
			type: "POST",
			data: dados,
			dataType: "json",
			success: function(data) {
				$("#bt_salvar_tag").removeAttr("disabled");
				$('#md_add_tag').modal('toggle');
				$('#toast_aviso_titulo').text('TAG');
				$('#toast_aviso_msg').text(data.msg);
				$('#toast_aviso').toast('show');
			}
		});
	});

});