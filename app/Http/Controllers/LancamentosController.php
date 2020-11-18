<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Lancamentos;
use App\Tags;
use App\TagsLancamentos;
use App\Helpers\Utils;

class LancamentosController extends Controller
{
    public function Listar()
	{
		$lancamentos = Lancamentos::where('id_user', Auth::user()->id)->orderBy('data', 'desc')->get();

		return view('layout.app', [
    		'view' => 'lancamentos.listar',
    		'dados' => [
                'lancamentos' => $lancamentos,
                'tags' => Tags::where('id_user', Auth::user()->id)->orderBy('tag')->get()
            ]
    	]);
	}

    public function Salvar(Request $request)
    {
        $tags = $request->input('ids_tags');
        try {
            $lancamentos = new Lancamentos();
            $lancamentos->id_user = Auth::user()->id;
            $lancamentos->descricao = $request->input('descricao');
            $lancamentos->valor = Utils::RealToDecimal($request->input('valor'));
            $lancamentos->data = Utils::DataPtBrToDb($request->input('data'));
            $lancamentos->tipo = $request->input('tipo');
            if ($lancamentos->save()) {
                foreach ($tags as $t) {
                    $tag_lanc = new TagsLancamentos();
                    $tag_lanc->id_tag = $t;
                    $tag_lanc->id_lancamento = $lancamentos->id;
                    $tag_lanc->save();
                }
            }
            return json_encode(['status' => 'Sucesso', 'msg' => 'Lançamento adicionado com sucesso!']);
        } catch (Exception $e) {
            return json_encode(['status' => 'Erro', 'msg' => 'Ocorreu um erro ao adicionar os lançamento.']);
        }
    }

    public function LancamentosJson()
    {
        $lancamentos = Lancamentos::where('id_user', Auth::user()->id)->orderBy('data', 'desc')->get();
        foreach ($lancamentos as $l) {
            $l->data = Utils::DataDbToPtBr($l->data) . ', '. Utils::DiaSemanaFromDataDb($l->data);
            $l->valor = 'R$ ' . Utils::DecimalToReal($l->valor);
            if ($l->tipo == 'd') {
                $l->tipo = 'Despesa';
            }else{
                $l->tipo = 'Receita';
            }
            $tags = [];
            foreach ($l->Tags()->orderBy('tag')->get() as $t){
                array_push($tags, $t->tag);
            }
            $l->tags = implode(', ', $tags);
        }
        return json_encode($lancamentos);
    }
}