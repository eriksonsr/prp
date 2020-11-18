<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagsLancamentos extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = null;
	protected $table = 'tags_x_lancamentos';
}
