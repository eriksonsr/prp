<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Utils;
use App\Relatorios;

class RelatoriosController extends Controller
{
	public function DespesaseReceitasPorAno()
	{
		$dados = Relatorios::DespesasReceitasPorAno(auth()->user()->id, date('Y'));
		foreach ($dados as $d) {
			$d->mes = Utils::MesPorExtensoByNumMes($d->mes);
			$d->total = $d->total;
		}

		return view('layout.app', [
    		'view' => 'relatorios.despesas_e_receitas_p_ano',
    		'dados' => $dados,
    		'ano' => date('Y'),
            'scripts' => [
                ['tipo' => 'online', 'caminho' => 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js'],
                ['tipo' => 'local', 'caminho' => 'relatorios/desp_rec_p_ano']
            ]
    	]);
	}
}
