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

	GetInfosDashBoard();
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
						<button class="btn btn-success btn-sm text-center" onclick="modalEditarLancamento(${v.id});">
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

function GetInfosDashBoard(){
	$.getJSON('http://' + location.hostname + '/get_infos_dashboard_json', function(result){
		$('#card_v_rec_no_mes').text(`R$ ${result.tot_rec_mes_corrente}`);
		$('#card_v_desp_no_mes').text(`R$ ${result.tot_desp_mes_corrente}`);
		$('#card_v_rec_no_ano').text(`R$ ${result.tot_rec_ano_corrente}`);
		$('#card_v_desp_no_ano').text(`R$ ${result.tot_desp_ano_corrente}`);
		ExibeGraficoReceitasDespesasUltimosPeriodos(result.tot_desp_rec_ults_periodos);
		ExibeGraficoPrincipaisDespesas(result.total_principais_desp);
  	});
}

function ExibeGraficoReceitasDespesasUltimosPeriodos(dados){
	var config = {
		type: 'line',
		data: {
			labels: [],
			datasets: [
				{
					label: 'Despesas',
					backgroundColor: 'rgba(255, 99, 132, 0.3)',
					data: [],
				},
				{
					label: 'Receitas',
					backgroundColor: 'rgba(94, 255, 98, 0.3)',
					data: [],
				}
			]
		},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'Receitas e despesas nos últimso três meses'
			},
			tooltips: {
				mode: 'index',
				callbacks: {
	                label: function(tooltipItem, data) {
	                    var label = data.datasets[tooltipItem.datasetIndex].label || '';
	                    if (label) {
	                        label += ': ';
	                    }
	                    label += tooltipItem.yLabel.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});
	                    return label;
	                }
            	}
			},
			hover: {
				mode: 'index'
			},
			scales: {
				xAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'Mês'
					}
				}],
				yAxes: [{
					stacked: true,
					scaleLabel: {
						display: true,
						labelString: 'Valor'
					},
					ticks: {
						callback: function(value, index, values) {
							return value.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});
						}
					}
				}]
			}
		}
	};
	config.data.labels.push(dados[0].mes);
	config.data.labels.push(dados[2].mes);
	config.data.labels.push(dados[4].mes);
	for (var i = 0; i < dados.length; i++) {
		if (dados[i].tipo == 'Despesa'){
			config.data.datasets[0].data.push(dados[i].total);
		}else{
			config.data.datasets[1].data.push(dados[i].total);
		}
	}

	var ctx = document.getElementById('chart-area').getContext('2d');
	window.myLine = new Chart(ctx, config);
}

function ExibeGraficoPrincipaisDespesas(dados){
	var config = {
	    type: 'bar',
	    data: {
			labels: [],
			datasets: [{
				label: "Tags despesas",
				backgroundColor: 'rgba(255, 99, 132, 0.3)',
				data: []
			}]
	    },
	    options: {
			legend: { display: false },
			title: {
				display: true,
				text: 'Principais despesas'
			},
			tooltips: {
				mode: 'index',
				callbacks: {
	                label: function(tooltipItem, data) {
	                    var label = data.datasets[tooltipItem.datasetIndex].label || '';
	                    if (label) {
	                        label += ': ';
	                    }
	                    label += tooltipItem.yLabel.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});
	                    return label;
	                }
            	}
			},
			scales: {
				xAxes: [{
					scaleLabel: {
						display: true,
						labelString: 'Tag'
					}
				}],
				yAxes: [{
					stacked: true,
					scaleLabel: {
						display: true,
						labelString: 'Valor'
					},
					ticks: {
						callback: function(value, index, values) {
							return value.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"});
						}
					}
				}]
			}
	    }
	};
	for (var i = 0; i < dados.length; i++) {
		config.data.datasets[0].data.push(dados[i].total);
		config.data.labels.push(dados[i].tag);
	}

	var chart_principais_despesas = document.getElementById('chart_principais_despesas').getContext('2d');
	new Chart(chart_principais_despesas, config);
}