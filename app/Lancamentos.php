<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lancamentos extends Model
{
    public $timestamps = false;

    public function Tags()
    {
    	return $this->belongsToMany('App\Tags', 'tags_x_lancamentos', 'id_lancamento', 'id_tag');
    }
}
