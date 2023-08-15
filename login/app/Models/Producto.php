<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;


    static function cantidadProductosPorMarca( $idMarca ) : int
    {
        //$producto = Producto::where('idMarca', $idMarca)->first();
        //$producto = Producto::firstWhere('idMarca', $idMarca);
        $cantidad = Producto::where('idMarca', $idMarca)->count();
        return $cantidad;
    }
}
