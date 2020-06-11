<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sabor extends Model{
    
    protected $table = 'sabor_pizza';

    protected $primaryKey = 'id_sabor';

    protected $fillable = [
        'sabor', 'desc_sabor'
    ];

    public function pizza(){
        return $this->belongsTo('App\Pizza');
    }
}
