$(document).ready(function(){

});

function modalEditarTag(id, tag){
	$('#id_tag').val(id);
	$('#edit_input_tag').val(tag);
	$('#md_editar_tag').modal('toggle');
}

function salvarTagEditada(){
	$('#bt_salva_edicao_tag').attr('disabled');
	var url = window.location.href;
	var dados = {
		id: $("#id_tag").val(),
		tag: $("#edit_input_tag").val()
	}

	$.ajax({
		url: 'http://' + location.hostname + '/tags/salvar_edicao',
		type: "POST",
		data: dados,
		dataType: "json",
		success: function(data){
			if (data.status == 'Sucesso'){
				if(url.search('tags/listar') > 0){
					atualizaTabelaTags();
				}
			}
			$('#md_editar_tag').modal('toggle');
			$('#toast_aviso_titulo').text('TAG');
			$('#toast_aviso_msg').text(data.msg);
			$('#toast_aviso').toast('show');
			$('#bt_salva_edicao_tag').removeAttr("disabled");
		}
	});
}