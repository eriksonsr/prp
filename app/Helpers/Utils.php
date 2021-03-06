<?php
namespace App\Helpers;

class Utils
{
	public static function DecimalToReal($valor)
	{
        $v_final = number_format($valor, 2,',','.');
        return $v_final;
	}

	public static function DataDbToPtBr($data)
	{
		$data = explode('-', $data);
		return $data[2] . '/' . $data[1] . '/' . $data[0];
	}

	public static function DiaSemanaFromDataDb($data)
	{
		$dias = [
			'Sunday' => 'Domingo',
			'Monday' => 'Segunda',
			'Tuesday' => 'Terça',
			'Wednesday' => 'Quarta',
			'Thursday' => 'Quinta',
			'Friday' => 'Sexta',
			'Saturday' => 'Sábado'
		];

		return $dias[\DateTime::createFromFormat('Y-m-d', $data)->format('l')];
	}

	public static function DataPtBrToDb($data)
	{
		$data = explode('/', $data);
		return $data[2] . '-' . $data[1] . '-' . $data[0];
	}

	public static function RealToDecimal($valor)
	{
		$v_final = str_replace(',', '.', str_replace('.', '', $valor));
		return $v_final;
	}

	public static function MesPorExtensoByNumMes($mes)
	{
		$meses = [
			'1' => 'Janeiro',
			'2' => 'Fevereiro',
			'3' => 'Março',
			'4' => 'Abril',
			'5' => 'Maio',
			'6' => 'Junho',
			'7' => 'Julho',
			'8' => 'Agosto',
			'9' => 'Setembro',
			'10' => 'Outubro',
			'11' => 'Novembro',
			'12' => 'Dezembro'
		];
		return $meses[$mes];
	}
}