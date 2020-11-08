<?php
namespace App\Helpers;

class Utils
{
	public static function DecimalToReal($valor)
	{
        $v_final = number_format($valor, 2,',','.');
        return $v_final;
	}
}