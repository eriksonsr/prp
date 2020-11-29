<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Helpers\Utils;

class Lancamentos extends Model
{
    public $timestamps = false;

    public function Tags()
    {
    	return $this->belongsToMany('App\Tags', 'tags_x_lancamentos', 'id_lancamento', 'id_tag');
    }

    public static function Busca($filtros = null)
    {
    	$filtros_str = '';
    	$parametros = [];

    	if ($filtros) {
    		$filtros_str = ' WHERE 0 = 0 ';

    		if (isset($filtros['descricao'])){
    			$filtros_str .= " AND l.descricao ILIKE '%" . $filtros['descricao'] . "%'";
    		}

    		if (isset($filtros['criterio_data_inicial'])){
    			$filtros_str .= ' AND data ' . $filtros['criterio_data_inicial'] . ' :data_inicial';
    			$parametros['data_inicial'] = Utils::DataPtBrToDb($filtros['data_inicial']);
    		}

    		if (isset($filtros['criterio_data_final'])){
    			$filtros_str .= ' AND data ' . $filtros['criterio_data_final'] . ' :data_final';
    			$parametros['data_final'] = Utils::DataPtBrToDb($filtros['data_final']);
    		}

    		if (isset($filtros['tipo'])){
				$filtros_str .= ' AND tipo = ' . ' :tipo';
				$parametros['tipo'] = $filtros['tipo'];
    		}

    		if (isset($filtros['ids_tags'])){
				$filtros_str .= ' AND t.id IN(' . implode(',', $filtros['ids_tags']) . ')';
    		}    		

    		if (isset($filtros['id_user'])){
				$filtros_str .= ' AND l.id_user = ' . $filtros['id_user'];
    		} 		

    		if (isset($filtros['id_lancamento'])){
				$filtros_str .= ' AND l.id = ' . $filtros['id_lancamento'];
    		}

    		if (isset($filtros['criterio_valor']) && isset($filtros['valor'])){
    			$filtros_str .= ' AND valor ' . $filtros['criterio_valor'] . ' :valor';
    			$parametros['valor'] = Utils::RealToDecimal($filtros['valor']);
    		}
    	}

    	$sql = "SELECT
				    l.id,
				    l.descricao,
				    l.valor,
				    to_char(l.data, 'dd/mm/yyyy') AS data,
				    l.tipo AS tipo_c,
				    CASE l.tipo
				        WHEN 'r' THEN
				            'Receita'
				        ELSE
				            'Despesa'
				        END tipo,
				string_agg(t.tag , ', ' order by t.tag) as tags
				FROM lancamentos AS l
				INNER JOIN tags_x_lancamentos AS tl ON l.id = tl.id_lancamento
				INNER JOIN tags AS t ON t.id = tl.id_tag
				$filtros_str
				GROUP BY l.id
				ORDER BY l.data DESC";

		return DB::select($sql, $parametros);
    }
}
