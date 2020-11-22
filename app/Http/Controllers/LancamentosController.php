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
            ],
            'scripts' => [
                ['tipo' => 'local', 'caminho' => 'lancamentos']
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

    public function LancamentosJson(Request $request)
    {
        $retorno = ['status' => '', 'msg' => '', 'dados' => ''];
        try {
            $filtros = ['id_user' => Auth::user()->id];
            if ($request->input('filtros')) {
                if (isset($request->input('filtros')['descricao']) && !empty($request->input('filtros')['descricao'])) {
                    $filtros['descricao'] = $request->input('filtros')['descricao'];
                }
                if (isset($request->input('filtros')['valor']) && !empty($request->input('filtros')['valor'])) {
                    $filtros['valor'] = $request->input('filtros')['valor'];
                    $filtros['criterio_valor'] = $request->input('filtros')['criterio_valor'];
                }
                if (isset($request->input('filtros')['data_inicial']) && !empty($request->input('filtros')['data_inicial'])) {
                    $filtros['data_inicial'] = $request->input('filtros')['data_inicial'];
                    $filtros['criterio_data_inicial'] = $request->input('filtros')['criterio_data_inicial'];
                }
                if (isset($request->input('filtros')['data_final']) && !empty($request->input('filtros')['data_final'])) {
                    $filtros['data_final'] = $request->input('filtros')['data_final'];
                    $filtros['criterio_data_final'] = $request->input('filtros')['criterio_data_final'];
                }
                if (isset($request->input('filtros')['tipo']) && !empty($request->input('filtros')['tipo'])) {
                    if ($request->input('filtros')['tipo'] == 'r' || $request->input('filtros')['tipo'] == 'd') {
                        $filtros['tipo'] = $request->input('filtros')['tipo'];
                    }
                }
                if (isset($request->input('filtros')['ids_tags']) && !empty($request->input('filtros')['ids_tags'])) {
                    $filtros['ids_tags'] = $request->input('filtros')['ids_tags'];
                }
            }
            $dados = Lancamentos::Busca($filtros);
            $qtd_registros = count($dados);
            $valor_total = 0;
            foreach ($dados as $v) {
                $valor_total += $v->valor;
                $v->valor = Utils::DecimalToReal($v->valor);
            }
            return json_encode([
                'status' => 'Sucesso', 
                'dados' => $dados,
                'qtd_registros' => $qtd_registros,
                'valor_total' => Utils::DecimalToReal($valor_total)
            ]);
        } catch (Exception $e) {
            return json_encode(['status' => 'Erro', 'msg' => 'Ocorreu um erro ao fazer a busca.']);
        }
    }   

    public function Deletar($id_lancamento)
    {
        try {
            Lancamentos::where('id_user', Auth::user()->id)->where('id', $id_lancamento)->delete();
            TagsLancamentos::where('id_lancamento', $id_lancamento)->delete();
            return json_encode(['status' => 'Sucesso', 'msg' => 'Lançamento excluído com sucesso!']);
        } catch (Exception $e) {
            return json_encode(['status' => 'Erro', 'msg' => 'Ocorreu um erro ao excluir lançamento.']);
        }
    }
}