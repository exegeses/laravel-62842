<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    use HasFactory;
    protected $primaryKey = 'idProducto';
    public $timestamps = false;

    static function cantidadProductosPorMarca( $idMarca ) : int
    {
        //$producto = Producto::where('idMarca', $idMarca)->first();
        //$producto = Producto::firstWhere('idMarca', $idMarca);
        $cantidad = Producto::where('idMarca', $idMarca)->count();
        return $cantidad;
    }

    ### m´´etodos de relación
    public function getMarca() : BelongsTo
    {
        return $this->belongsTo(
            Marca::class,
            'idMarca',
            'idMarca'
        );
    }

    public function getCategoria() : BelongsTo
    {
        return $this->belongsTo(
            Categoria::class,
            'idCategoria',
            'idCategoria'
        );
    }
}
