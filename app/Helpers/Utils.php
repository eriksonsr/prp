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
}