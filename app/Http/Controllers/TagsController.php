<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tags;

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
}
