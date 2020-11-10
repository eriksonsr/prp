<?php extract($dados); ?>
<section class="container mt-2 mb-4">
	<h3>Minhas tags</h3>
	<button class="btn btn-success btn-sm text-center add_tag mb-2">
		Add tag
    </button>
	<div class="row">
		<table class="table table-striped table-hover" id="table_tags">
			<thead>
				<th>Tag</th>
				<th>Ações</th>
			</thead>
			<tbody>
				@foreach ($tags as $t)
					<tr data-tr-tag="{{$t->id}}">
						<td>{{$t->tag}}</td>
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
	<button class="btn btn-success btn-sm text-center add_tag">
		Add tag
    </button>
</section>
@include('tags.md_add_tag')