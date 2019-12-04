<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //se não seguisse o padrão do laravel, precisariamos fazer o codigo abaixo:
//    public $tableName = "products";
//    public $primaryKey = "id";
//    public $timestamps = false;

// tem que ser user no singular, senao o laravel entende que tem varios usuarios e por isso dah problemas para executar, pois comeca a buscar varios ususarios e nao consegue.
    public function user(){
        return $this->belongsTo('App\User');
        // para vincular a criacao do produto ao id do usuario que o cadastrou.
    }

    // para listar o nome do usuario que cadastrou o produto id zero (primeira posicao):
    // $listProducts = Product::All();
    // $listProducts[0]->users->name;
}
