<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tamanho extends Model
{
    protected $table = 'tamanho_pizza';

    protected $primaryKey = 'id_tamanho';

    public function pizza(){
        return $this->belongsTo('App\Pizza');
    }

}
