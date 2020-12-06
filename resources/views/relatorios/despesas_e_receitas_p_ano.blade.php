<?php 
use App\Helpers\Utils;
extract($dados);
?>
<section class="container mt-2 mb-5">
	<h3>Relatório - Despesas e Receitas no ano</h3>
	<input type="hidden" id="dados_grafico" value="{{json_encode($dados)}}">
	<div class="row mb-2">
		<input type="text" class="form-control col-md-3" id="ano" placeholder="Informe o ano...">
		<button class="btn btn-success btn-sm text-center">Filtrar</button>
	</div>
	<div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
            <div class="col-lg-12">
                <canvas id="chart_desp_e_rec_p_ano"></canvas>
            </div>
        </div>
    </div>
	<div class="row">
		<table class="table table-striped table-hover" id="table_lancamentos">
			<thead>
				<th>PERÍODO</th>
				<th>TOTAL</th>
			</thead>
			<tbody>
				@foreach ($dados as $d)
					@if($d->tipo == 'Receita')
					<tr class="table-success">
					@else
					<tr class="table-danger">
					@endif
						<td>{{$d->mes}} de {{$ano}}</td>
						<td>R$ {{Utils::DecimalToReal($d->total)}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</section>