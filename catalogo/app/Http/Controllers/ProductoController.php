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

    private function validarForm( Request $request )
    {
        $request->validate(
            [
                'prdNombre'=>'required|unique:productos,prdNombre|min:2|max:75',
                'prdPrecio'=>'required|numeric|min:0|max:999999.99',
                'idMarca'=>'required',
                'idCategoria'=>'required',
                'prdDescripcion'=>'max:600',
                'prdImagen'=>'mimes:jpg,jpeg,png,gif,svg,webp|max:1024'
            ],
            [
                'prdNombre.required'=>'El campo "Nombre del producto" es obligatorio.',
                'prdNombre.unique'=>'El "Nombre del producto" ya existe.',
                'prdNombre.min'=>'El campo "Nombre del producto" debe tener como mínimo 2 caractéres.',
                'prdNombre.max'=>'El campo "Nombre" debe tener 75 caractéres como máximo.',
                'prdPrecio.required'=>'Complete el campo Precio.',
                'prdPrecio.numeric'=>'Complete el campo Precio con un número.',
                'prdPrecio.min'=>'Complete el campo Precio con un número mayor a 0.',
                'prdPrecio.max'=>'El precio m´´aximo no puede superar 999999.99',
                'idMarca.required'=>'Seleccione una marca.',
                'idCategoria.required'=>'Seleccione una categoría.',
                'prdDescripcion.max'=>'Complete el campo Descripción con 600 caractéres como máxino.',
                'prdImagen.mimes'=>'Debe ser una imagen.',
                'prdImagen.max'=>'Debe ser una imagen de 1MB como máximo.'
            ]
        );
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validación
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
