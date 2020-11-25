<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Lancamentos;
use App\Tags;
use App\Helpers\Utils;
use App\Relatorios;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('layout.app', [
            'view' => 'layout.home',
            'dados' => [
                'tags' => Tags::where('id_user', Auth::user()->id)->orderBy('tag')->get()
            ],
            'scripts' => [
                ['tipo' => 'online', 'caminho' => 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js']
            ]
        ]);
    }

    public function GetInfosDashBoardJson()
    {
        $tipos_lancamentos = ['r' => 'Receita', 'd' => 'Despesa'];
        $dados_recs_desp_p_mes_ults_meses = Relatorios::ReceitasDespesasPorMesUltimosMeses(Auth::user()->id);
        for ($i=0; $i < count($dados_recs_desp_p_mes_ults_meses); $i++) {
            $dados_recs_desp_p_mes_ults_meses[$i]->total = $dados_recs_desp_p_mes_ults_meses[$i]->total;
            $dados_recs_desp_p_mes_ults_meses[$i]->total_br = Utils::DecimalToReal($dados_recs_desp_p_mes_ults_meses[$i]->total);
            $dados_recs_desp_p_mes_ults_meses[$i]->tipo = $tipos_lancamentos[$dados_recs_desp_p_mes_ults_meses[$i]->tipo];
            $dados_recs_desp_p_mes_ults_meses[$i]->mes = Utils::MesPorExtensoByNumMes($dados_recs_desp_p_mes_ults_meses[$i]->mes);
        }
        $mes_corrente = date('m');
        $ano_corrente = date('Y');
        $user = auth()->user()->id;
        $dados = [
            'tot_desp_mes_corrente' => Utils::DecimalToReal(Lancamentos::where('id_user', $user)
                ->where('tipo', 'd')
                ->whereMonth('data', $mes_corrente)->sum('valor')),
            'tot_desp_ano_corrente' => Utils::DecimalToReal(Lancamentos::where('id_user', $user)
                ->where('tipo', 'd')
                ->whereYear('data', $ano_corrente)->sum('valor')),
            'tot_rec_mes_corrente' => Utils::DecimalToReal(Lancamentos::where('id_user', $user)
                ->where('tipo', 'r')
                ->whereMonth('data', $mes_corrente)->sum('valor')),
            'tot_rec_ano_corrente' => Utils::DecimalToReal(Lancamentos::where('id_user', $user)
                ->where('tipo', 'r')
                ->whereYear('data', $ano_corrente)->sum('valor')),
            'tot_desp_rec_ults_periodos' => $dados_recs_desp_p_mes_ults_meses,
            'total_principais_desp' => Relatorios::PrincipaisDespesas(Auth::user()->id)
        ];
        return json_encode($dados);
    }
}