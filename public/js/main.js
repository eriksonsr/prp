mask_money_config = {
	prefix:'R$ ', 
	allowNegative: false, 
	thousands:'.', 
	decimal:',',
	affixesStay: false
}

date_picker_config = {
	closeText: 'Fechar',
	prevText: '&#x3c;Anterior',
	nextText: 'Pr&oacute;ximo&#x3e;',
	currentText: 'Hoje',
	monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho', 'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
	monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
	dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
	dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
	dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
	weekHeader: 'Sm',
	dateFormat: 'dd/mm/yy',
	firstDay: 0,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''
}

$(document).ready(function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$('.add_tag').on('click', function(){
		$('#md_add_tag').modal('toggle');
	});

	$('.add_lancamento').on('click', function(){
		$('#md_add_lancamento').modal('toggle');
	});

	$('.select_2').select2();
	$(".data").datepicker(date_picker_config);
	$(".real").maskMoney(mask_money_config);
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
						<button class="btn btn-danger btn-sm text-center" onclick="deletarTag(${v.id}, '${v.tag}');">
							<i class="fa fa-remove"></i>
						</button>
					</td>
				</tr>
			`);
    	});
  	});
}

function addLancamento(elemento){
	$(elemento).attr('disabled');
	var url = window.location.href;
	var dados = {
		descricao: $("#input_descricao").val(),
		valor: $("#input_valor").val(),
		data: $("#input_data").val(),
		tipo: $("#select_tipo").val(),
		ids_tags: []
	}
	
	$("#select_tags option:selected").each(function(){
		dados.ids_tags.push($(this).val());
	});

	$.ajax({
		url: 'http://' + location.hostname + '/lancamentos/salvar',
		type: "POST",
		data: dados,
		dataType: "json",
		success: function(data){
			if (data.status == 'Sucesso'){
				if(url.search('lancamentos/listar') > 0){
					atualizaTabelaLancamentos();
				}
			}

			if (window.location.pathname == "/" || window.location.pathname == '/home'){
				atualizaDadosHome()
			}

			$("#input_descricao").val('');
			$("#input_valor").val('');
			$("#input_data").val('');
			$('#select_tags').val('').trigger('change');

			$('#md_add_lancamento').modal('toggle');
			$('#toast_aviso_titulo').text('LANÇAMENTO');
			$('#toast_aviso_msg').text(data.msg);
			$('#toast_aviso').toast('show');
			$(elemento).removeAttr("disabled");
		}
	});
}

function atualizaTabelaLancamentos()
{
	var tabela = $('#table_lancamentos tbody');
	$(tabela).html('');
	$.getJSON('http://' + location.hostname + '/lancamentos/lancamentos_json', function(result){
		$.each(result.dados, function(i, v){
			var cor = 'danger';
			if (v.tipo == 'Receita' || v.tipo == 'r'){
				cor = 'success';
			};

			$(tabela).append(`
				<tr class="table-${cor}">
					<td>${v.descricao}</td>
					<td>${v.data}</td>
					<td>R$ ${v.valor}</td>
					<td>${v.tags}</td>
					<td>
						<button class="btn btn-success btn-sm text-center">
							<i class="fa fa-edit"></i>
						</button>
						<button class="btn btn-danger btn-sm text-center" onclick="deletarLancamento(${v.id}, '${v.descricao}');">
							<i class="fa fa-remove"></i>
						</button>
					</td>
				</tr>
			`);
    	});
  	});
}

function atualizaDadosHome(){
	console.log('Atualizando dados home...');
}