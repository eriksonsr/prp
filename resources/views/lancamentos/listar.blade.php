<?php 
use App\Helpers\Utils;
extract($dados);
?>
<section class="container mt-2 mb-4">
	<h3>Lançamentos</h3>
	<button class="btn btn-success btn-sm text-center mb-2">
		Add lançamento
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
					<tr>
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
							<button class="btn btn-danger btn-sm text-center">
								<i class="fa fa-remove"></i>
							</button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<button class="btn btn-success btn-sm text-center">
		Add lançamento
    </button>
</section>
@include('tags.md_add_tag')
@include('tags.md_editar_tag')