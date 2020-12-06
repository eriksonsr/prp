<?php
namespace App;
use DB;

class Relatorios
{
	public static function ReceitasDespesasPorMesUltimosMeses($id_user, $limite = Null)
	{
		$filtro = '';
		if ($limite) {
			$filtro = 'LIMIT ' . $limite;
		}
		$sql = "
			SELECT EXTRACT(month FROM data) mes, EXTRACT(year FROM data) ano, SUM(valor) total, tipo
			FROM lancamentos
			WHERE id_user = $id_user
			GROUP BY ano, mes, tipo
			ORDER BY ano, mes DESC
			$filtro
		";
		return DB::select($sql);
	}

	public static function PrincipaisDespesas($id_user)
	{
		$sql = "
			SELECT
			    t.tag,
			    sum(l.valor) AS total
			FROM lancamentos AS l
			INNER JOIN tags_x_lancamentos AS tl ON tl.id_lancamento = l.id
			INNER JOIN tags AS t ON t.id = tl.id_tag
			WHERE l.id_user = $id_user
			AND l.tipo = 'd'
			GROUP BY tag
			ORDER BY total DESC
			LIMIT 5
		";
		return DB::select($sql);
	}
}