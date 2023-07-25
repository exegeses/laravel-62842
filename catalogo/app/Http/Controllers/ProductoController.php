<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        //obtenemos listado de productos
        //$productos = Producto::paginate(4);
        /*$productos = Producto::join('marcas', 'productos.idMarca', '=', 'marcas.idMarca')
                            ->join('categorias', 'productos.idCategoria', '=', 'categorias.idCategoria')
                            ->paginate(4);*/
        $productos = Producto::with([ 'getMarca', 'getCategoria' ])->paginate(4);

        return view('productos', [ 'productos'=>$productos ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //obtenemos listados de marcas y categorias
        $marcas = Marca::all();
        $categorias = Categoria::all();
        return view('productoCreate',
            [
                'marcas'=>$marcas,
                'categorias'=>$categorias
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
