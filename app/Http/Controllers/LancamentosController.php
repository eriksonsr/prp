<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Lancamentos;

class LancamentosController extends Controller
{
    public function Listar()
	{
		$lancamentos = Lancamentos::where('id_user', Auth::user()->id)->orderBy('data', 'desc')->get();

		return view('layout.app', [
    		'view' => 'lancamentos.listar',
    		'dados' => ['lancamentos' => $lancamentos],
    		'scripts' => [
    			['tipo' => 'local', 'caminho' => 'lancamentos']
    		]
    	]);
	}
}
