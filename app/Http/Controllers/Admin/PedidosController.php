<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PedidosController extends Controller
{
    public static function getPriceBitcoin(){
        try{
            $json = file_get_contents('https://api.coindesk.com/v1/bpi/currentprice/BRL.json');
            $value = json_decode($json);
            $novoValor  = str_replace(',', '', $value->bpi->BRL->rate);
            return round(50 / floatval($novoValor), 8);
        }catch(Exception $err){
            return $err->get_message();
        }
       
    }
}
