$(document).ready(function(){
	$('.bt_filtra_lancamentos').on('click', function(){
		$('#md_filtrar_lancamento').modal('toggle');
	});
});

function filtrarLancamentos(){
	var dados = {
		descricao: $("#input_filtro_descricao").val(),
		criterio_valor: $("#criterio_valor").val(),
		valor: $("#input_filtro_valor").val(),
		criterio_data_inicial: $("#filtro_criterio_data_inicial").val(),
		data_inicial: $("#input_filtro_data_inicial").val(),
		criterio_data_final: $("#filtro_criterio_data_final").val(),
		data_final: $("#input_filtro_data_final").val(),
		tipo: $("#select_filtro_tipo").val(),
		ids_tags: []
	}

	$("#select_filtro_tags option:selected").each(function(){
		dados.ids_tags.push($(this).val());
	});

	var tabela = $('#table_lancamentos tbody');
	$(tabela).html('');

	$.ajax({
		url: 'http://' + location.hostname + '/lancamentos/lancamentos_json',
		type: "GET",
		data: {'filtros':dados},
		dataType: "json",
		success: function(data){
			if (data.status == 'Sucesso'){
				if (data.qtd_registros > 0){
					$(tabela).append(`
						<tr>
							<td colspan='3'><strong>${data.qtd_registros} registros encontrados</strong></td>
							<td colspan='2'><strong>Total: R$ ${data.valor_total}</strong></td>
						</tr>
					`);

					$(data.dados).each(function(i, v){
						var cor_linha = 'class="table-success"';
						if (v.tipo_c == 'd'){
							cor_linha = 'class="table-danger"'
						}
						$(tabela).append(`
							<tr ${cor_linha}>
								<td>${v.descricao}</td>
								<td>${v.data}</td>
								<td>R$ ${v.valor}</td>
								<td>${v.tags}</td>
								<td>
									<button class="btn btn-success btn-sm text-center" onclick="modalEditarLancamento(${v.id});">
										<i class="fa fa-edit"></i>
									</button>
									<button class="btn btn-danger btn-sm text-center" onclick="deletarLancamento(${v.id}, '{$v->descricao}')">
										<i class="fa fa-remove"></i>
									</button>
								</td>
							</tr>
						`);
					});

					$(tabela).append(`
						<tr>
							<td colspan='3'><strong>${data.qtd_registros} registros encontrados</strong></td>
							<td colspan='2'><strong>Total: R$ ${data.valor_total}</strong></td>
						</tr>
					`);
					$('#md_filtrar_lancamento').modal('toggle');
				}else{
					$('#md_filtrar_lancamento').modal('toggle');
					$('#toast_aviso_titulo').text('LANÇAMENTO');
					$('#toast_aviso_msg').text('Nenhum resultado encontrado');
					$('#toast_aviso').toast('show');
				}
			}else{
				$('#md_filtrar_lancamento').modal('toggle');
				$('#toast_aviso_titulo').text('LANÇAMENTO');
				$('#toast_aviso_msg').text(data.msg);
				$('#toast_aviso').toast('show');
			}
		}
	});
}

function deletarLancamento(id, lancamento){
	var deletar = confirm(`Deseja realmente excluir o lancamento "${lancamento}"?`);
	if (deletar){
		$.ajax({
			url: 'http://' + location.hostname + '/lancamentos/deletar/' + id,
			type: "DELETE",
			dataType: "json",
			success: function(data){
				if (data.status == 'Sucesso'){
					atualizaTabelaLancamentos();
				}else{
					$('#toast_aviso_titulo').text('LANÇAMENTOS');
					$('#toast_aviso_msg').text(data.msg);
					$('#toast_aviso').toast('show');
				}
			}
		});
	}
}

function modalEditarLancamento(id){
	$("#id_lancamento").val('');
	$("#edit_input_descricao").val('');
	$("#edit_input_valor").val('');
	$("#edit_input_data").val('');
	$('#edit_select_tags').val('').trigger('change');
	var dados = {
		id_lancamento: id
	}

	$.ajax({
		url: 'http://' + location.hostname + '/lancamentos/lancamentos_json',
		type: "GET",
		data: {'filtros':dados},
		dataType: "json",
		success: function(data){
			if (data.status == 'Sucesso'){
				var tags_lanc = data.dados[0].tags.split(', ');

				$('#id_lancamento').val(id);
				$('#edit_input_descricao').val(data.dados[0].descricao);
				$('#edit_input_valor').val(data.dados[0].valor);
				$('#edit_input_data').val(data.dados[0].data);
				if (data.dados[0].tipo_c == 'r'){
					$('#edit_select_tipo').prop("selectedIndex", 1);
				}else{
					$('#edit_select_tipo').prop("selectedIndex", 0);
				}

				$('#edit_select_tags option').each(function(i, v){
					for (var itls = 0; itls < tags_lanc.length; itls++) {
						if ($(v).text() == tags_lanc[itls]) {
							$(v).prop("selected", true);
						}
					}
				});
				$('#edit_select_tags').select2();

				$('#md_editar_lancamento').modal('toggle');
			}
		},
	});
}

function SalvarLancamentoEditado(botao_salvar){
	$(botao_salvar).attr('disabled');
	var url = window.location.href;
	var dados = {
		id: $("#id_lancamento").val(),
		descricao: $("#edit_input_descricao").val(),
		valor: $("#edit_input_valor").val(),
		data: $("#edit_input_data").val(),
		tipo: $("#edit_select_tipo").val(),
		tags: []
	}

	$("#edit_select_tags option:selected").each(function(){
		dados.tags.push($(this).val());
	});

	$.ajax({
		url: 'http://' + location.hostname + '/lancamentos/salvar_edicao',
		type: "POST",
		data: dados,
		dataType: "json",
		success: function(data){
			if (data.status == 'Sucesso'){
				atualizaTabelaLancamentos();
				$('#md_editar_lancamento').modal('toggle');
				$('#toast_aviso_titulo').text('LANCAMENTO');
				$('#toast_aviso_msg').text(data.msg);
				$('#toast_aviso').toast('show');
			}
		},
		complete: function(){
			$("#id_lancamento").val(''),
			$("#edit_input_descricao").val(''),
			$("#edit_input_valor").val(''),
			$("#edit_input_data").val(''),
			$('#edit_select_tags').val('').trigger('change');
			$(botao_salvar).removeAttr("disabled");
		}
	});
}