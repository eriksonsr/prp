<?php 
use App\Helpers\Utils;
extract($dados);
?>
<section class="container mt-2 mb-4">
	<h3>Lançamentos</h3>
	<button class="btn btn-success btn-sm text-center add_lancamento mb-2">
		Add lançamento
    </button>
	<button class="btn btn-success btn-sm text-center bt_filtra_lancamentos mb-2">
		Filtros
    </button>
	<div class="row">
		<table class="table table-striped table-hover" id="table_lancamentos">
			<thead>
				<th>Descrição</th>
				<th>Data</th>
				<th>Valor</th>
				<th>Tags</th>
				<th>Ações</th>
			</thead>
			<tbody>
				@foreach ($lancamentos as $l)
					@if($l->tipo == 'r')
					<tr class="table-success">
					@else
					<tr class="table-danger">
					@endif
						<td>{{$l->descricao}}</td>
						<td>{{Utils::DataDbToPtBr($l->data)}}, {{Utils::DiaSemanaFromDataDb($l->data)}}</td>
						<td>R$ {{Utils::DecimalToReal($l->valor)}}</td>
						<td>
							<?php $tags = []; ?>
							@foreach($l->Tags()->orderBy('tag')->get() as $t)
								<?php array_push($tags, $t->tag); ?>
							@endforeach()
							{{implode(', ', $tags)}}
						</td>
						<td>
							<button class="btn btn-success btn-sm text-center">
								<i class="fa fa-edit"></i>
							</button>
							<button class="btn btn-danger btn-sm text-center" onclick="deletarLancamento({{$l->id}}, '{{$l->descricao}}')">
								<i class="fa fa-remove"></i>
							</button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<button class="btn btn-success btn-sm text-center add_lancamento">
		Add lançamento
    </button>
	<button class="btn btn-success btn-sm text-center bt_filtra_lancamentos">
		Filtros
    </button>
</section>
@include('lancamentos.md_add_lancamento')
@include('lancamentos.md_filtros_lancamentos')