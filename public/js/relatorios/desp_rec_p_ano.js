$(document).ready(function(){
	ExibeGraficoDespesaseReceitasPorAno();
});

function ExibeGraficoDespesaseReceitasPorAno(){
	var dados = JSON.parse($('#dados_grafico').val());
	var config = {
		type: 'line',
		data: {
			labels: [],
			datasets: [
				{
					label: 'Despesas',
					backgroundColor: '#FF0303',
					borderColor: '#FF0303',
					data: [],
					fill: false
				},
				{
					label: 'Receitas',
					backgroundColor: '#00FF0F',
					borderColor: '#00FF0F',
					data: [],
					fill: false
				}
			],
		},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'Receitas e despesas no ano'
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
		if (!config.data.labels.includes(dados[i].mes)){
			config.data.labels.push(dados[i].mes);
		}

		if (dados[i].tipo == 'Despesa'){
			config.data.datasets[0].data.push(dados[i].total);
		}else{
			config.data.datasets[1].data.push(dados[i].total);
		}
	}

	var ctx = document.getElementById('chart_desp_e_rec_p_ano').getContext('2d');
	window.myLine = new Chart(ctx, config);
}