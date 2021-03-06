<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tags;
use App\TagsLancamentos;

class TagsController extends Controller
{
	public function Salvar(Request $request)
	{
		$tags = Tags::where('id_user', Auth::user()->id)->where('tag', $request->input('tag'))->get();
		if (count($tags) > 0) {
			return json_encode(['status' => 'Erro', 'msg' => 'Tag já cadastrada!']);
		}

		try {
			$tag = new Tags();
			$tag->id_user = Auth::user()->id;
			$tag->tag = $request->input('tag');
			$tag->save();
			return json_encode(['status' => 'Sucesso', 'msg' => 'Tag adicionada com sucesso!']);
		} catch (Exception $e) {
			return json_encode(['status' => 'Erro', 'msg' => 'Ocorreu um erro ao adicionar a tag']);
		}
	}

	public function Listar()
	{
		$tags = Tags::where('id_user', Auth::user()->id)->orderBy('tag')->get();
		return view('layout.app', [
    		'view' => 'tags.listar',
    		'dados' => ['tags' => $tags],
    		'scripts' => [
    			['tipo' => 'local', 'caminho' => 'tags']
    		]
    	]);
	}

	public function TagsJson()
	{
		$tags = Tags::where('id_user', Auth::user()->id)->orderBy('tag')->get();
		return json_encode($tags);
	}

	public function SalvarEdicao(Request $request)
	{
		$tags = Tags::where('id_user', Auth::user()->id)->where('tag', $request->input('tag'))->get();
		if (count($tags) > 0) {
			return json_encode(['status' => 'Erro', 'msg' => 'Tag já cadastrada!']);
		}

		try {
			$tag = Tags::find($request->input('id'));
			$tag->tag = $request->input('tag');
			$tag->save();
			return json_encode(['status' => 'Sucesso', 'msg' => 'Tag editada com sucesso!']);
		} catch (Exception $e) {
			return json_encode(['status' => 'Erro', 'msg' => 'Ocorreu um erro ao editar a tag.']);
		}
	}

	public function Deletar($id_tag)
	{
		$tags = TagsLancamentos::where('id_tag', $id_tag)->get();
		if (count($tags) > 0) {
			return json_encode(['status' => 'Erro', 'msg' => 'Não foi possível excluir a tag pois existem lançamentos usando a mesma!']);
		}else{
			$tag = Tags::find($id_tag);
			if ($tag->delete()) {
				return json_encode(['status' => 'Sucesso', 'msg' => 'Tag excluída com sucesso!']);
			}else{
				return json_encode(['status' => 'Erro', 'msg' => 'Ocorreu um erro ao excluir a tag.']);
			}
		}
	}
}
