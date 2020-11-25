<?php
namespace App;
use DB;

class Relatorios
{
	public static function ReceitasDespesasPorMesUltimosMeses($id_user)
	{
		$sql = "
			SELECT EXTRACT(month FROM data) mes, EXTRACT(year FROM data) ano, SUM(valor) total, tipo
			FROM lancamentos
			WHERE id_user = $id_user
			GROUP BY ano, mes, tipo
			ORDER BY ano, mes
			LIMIT 6
		";
		return DB::select($sql);
	}
}