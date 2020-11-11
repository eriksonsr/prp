$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('.add_tag').on('click', function(){
		$('#md_add_tag').modal('toggle');
	});
});

function addTag(elemento){
	$(elemento).attr('disabled');
	var url = window.location.href;
	var dados = {
		tag: $("#input_tag").val()
	}

	$.ajax({
		url: 'http://' + location.hostname + '/tags/salvar',
		type: "POST",
		data: dados,
		dataType: "json",
		success: function(data){
			if (data.status == 'Sucesso'){
				if(url.search('tags/listar') > 0){
					atualizaTabelaTags();
				}
			}
			$('#md_add_tag').modal('toggle');
			$('#toast_aviso_titulo').text('TAG');
			$('#toast_aviso_msg').text(data.msg);
			$('#toast_aviso').toast('show');
			$(elemento).removeAttr("disabled");
		}
	});
}

function atualizaTabelaTags()
{
	var tabela = $('#table_tags tbody')
	$(tabela).html('');
	$.getJSON('http://' + location.hostname + '/tags/tags_json', function(result){
		$.each(result, function(i, v){
			$(tabela).append(`
				<tr data-tr-tag="${v.id}">
					<td>${v.tag}</td>
					<td>
						<button class="btn btn-success btn-sm text-center" onclick="modalEditarTag(${v.id}, '${v.tag}');">
							<i class="fa fa-edit"></i>
						</button>
						<button class="btn btn-danger btn-sm text-center">
							<i class="fa fa-remove"></i>
						</button>
					</td>
				</tr>
			`);
    	});
  	});
}