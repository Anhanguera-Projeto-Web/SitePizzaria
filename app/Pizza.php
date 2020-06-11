<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
     
    protected $table = 'pizzas';

    protected $primaryKey = 'id_pizza';

    protected $fillable = [
        'preco_pizza', 'disponibilidade','id_tam_pizza','id_sabor_pizza'
    ];

    protected $casts =['id_tam_pizza, id_sabor_pizza'];

    public function sabores(){
        return $this->hasMany('App\Sabor','id_sabor', 'id_sabor_pizza');
    }

    public function tamanhos(){
        return $this->hasMany('App\Tamanho','id_tamanho','id_tam_pizza');
    }
}
