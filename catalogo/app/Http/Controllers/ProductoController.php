<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


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

    private function validarForm( Request $request, $id = null )
    {
        $request->validate(
            [
                'prdNombre'=>'required|unique:productos,prdNombre,'.$id.',idProducto|min:2|max:75',
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
                'prdPrecio.max'=>'El precio máximo no puede superar 999999.99',
                'idMarca.required'=>'Seleccione una marca.',
                'idCategoria.required'=>'Seleccione una categoría.',
                'prdDescripcion.max'=>'Complete el campo Descripción con 600 caractéres como máxino.',
                'prdImagen.mimes'=>'Debe ser una imagen.',
                'prdImagen.max'=>'Debe ser una imagen de 1MB como máximo.'
            ]
        );
    }

    private function subirImagen( Request $request ) : string
    {
        //si no enviaron imagen store()
        $prdImagen = 'noDisponible.png';

        //si no enviaron imagen update()
        if( $request->has('imgActual') ){
            $prdImagen = $request->imgActual;
        }

        //si enviaron imagen
        if( $request->file('prdImagen') ){
            $file = $request->file('prdImagen');
            //renombramos archivo
            $time = time();
            $ext = $file->getClientOriginalExtension();
            $prdImagen = $time.'.'.$ext;
            //subir en:  /imagenes/productos
            try {
                $file->move( public_path('/imagenes/productos/'), $prdImagen );
            }
            catch ( FileException $fe ){
                return false;
            }
        }
        return $prdImagen;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        //validación
        $this->validarForm($request);
        $prdNombre = $request->prdNombre;
        $prdPrecio = $request->prdPrecio;
        $idMarca = $request->idMarca;
        $idCategoria = $request->idCategoria;
        $prdDescripcion = $request->prdDescripcion;
        $prdImagen = $this->subirImagen( $request );
        if( $prdImagen == false ){
            return redirect('/productos')
                ->with([
                    'mensaje'=>'No se pudo subir la imagen',
                    'css'=>'danger'
                ]);
        }
        try {
            $producto = new Producto;
            //asignamos atributos
            $producto->prdNombre = $prdNombre;
            $producto->prdPrecio = $prdPrecio;
            $producto->idMarca = $idMarca;
            $producto->idCategoria = $idCategoria;
            $producto->prdDescripcion = $prdDescripcion;
            $producto->prdImagen = $prdImagen;
            //almacenamos en tabla productos
            $producto->save();
            return redirect('/productos')
                ->with(
                    [
                        'mensaje'=>'Producto: '.$prdNombre.' agregado corectamente',
                        'css'=>'success'
                    ]
                );
        }
        catch ( \Throwable $th ){
            return redirect('/productos')
                ->with([
                    'mensaje'=>'No se pudo agregar el producto: '.$prdNombre,
                    'css'=>'danger'
                ]);
        }
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
    public function edit( string $id ) : View
    {
        //obtenemos listado de marcas y de categorías
        $marcas = Marca::all();
        $categorias = Categoria::all();
        //obtenemos datos de producto filtrado por su id
        $producto = Producto::find( $id );
        return view('productoEdit',[
            'marcas'=>$marcas,
            'categorias'=>$categorias,
            'producto'=>$producto
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $prdNombre = $request->prdNombre;
        //validación
        $this->validarForm($request, $request->idProducto);
        $prdImagen = $this->subirImagen($request);

        try {
            $producto = Producto::find($request->idProducto);
            //asignamos atributos
            $producto->prdNombre =  $prdNombre;
            $producto->prdPrecio = $request->prdPrecio;
            $producto->idMarca = $request->idMarca;
            $producto->idCategoria = $request->idCategoria;
            $producto->prdDescripcion = $request->prdDescripcion;
            $producto->prdImagen = $prdImagen;
            //almacenamos en tabla productos
            $producto->save();
            return redirect('/productos')
                ->with(
                    [
                        'mensaje'=>'Producto: '.$prdNombre.' mopdificado corectamente',
                        'css'=>'success'
                    ]
                );
        }
        catch ( \Throwable $th ){
            return redirect('/productos')
                ->with([
                    'mensaje'=>'No se pudo modificar el producto: '.$prdNombre,
                    'css'=>'danger'
                ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
