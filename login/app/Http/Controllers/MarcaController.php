<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $marcas = Marca::orderBy('idMarca', 'desc')->paginate(5);
        return view('marcas', [ 'marcas'=>$marcas ]);
    }

    private function validarForm( Request $request ) : void
    {
        $request->validate(
        /*
            [ 'campo'=>'reglas' ],
            [ 'campo.regla1'=>'mensaje1' ]
         */
            [ 'mkNombre'=>'required|unique:marcas,mkNombre|min:2|max:50' ],
            [
                'mkNombre.required'=>'El campo "Nombre de la marca" es obligatorio',
                'mkNombre.unique'=>'Ya existe una marca con ese nombre',
                'mkNombre.min'=>'El campo "Nombre de la marca" debe tener al menos 2 caractéres',
                'mkNombre.max'=>'El campo "Nombre de la marca" debe tener 50 caractéres como máximo'
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('marcaCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $mkNombre = $request->mkNombre;
        $this->validarForm( $request );
        try {
           /*
            $marca = new Marca;
            $marca->mkNombre = $mkNombre;
            $marca->save(); */
            Marca::create(
                [ 'mkNombre'=>$mkNombre ]
            );
            return redirect('/marcas')
                    ->with(
                        [
                            'mensaje'=>'Marca: '.$mkNombre.' agregada correctamente',
                            'css'=>'green'
                        ]
                    );
        }
        catch ( Throwable $th ){
            return redirect('/marcas')
                ->with(
                    [
                        'mensaje'=>'No se pudo agregar la marca: '.$mkNombre,
                        'css'=>'red'
                    ]
                );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Marca $marca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca) : View
    {
        //$marca = Marca::find($id);
        return view('marcaEdit', [ 'marca'=>$marca ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marca $marca)
    {
        $this->validarForm($request);
        $mkNombre = $request->mkNombre;
        try {
            /*
            $marca = Marca::find($request->idMarca);
            $marca->mkNombre = $mkNombre;
            $marca->save(); */
            $marca->update(
                [ 'mkNombre'=>$mkNombre ]
            );
            return redirect('/marcas')
                ->with(
                    [
                        'mensaje'=>'Marca: '.$mkNombre.' modificada correctamente',
                        'css'=>'green'
                    ]
                );
        }
        catch ( Throwable $th ){
            return redirect('/marcas')
                ->with(
                    [
                        'mensaje'=>'No se pudo agregar la marca: '.$mkNombre,
                        'css'=>'red'
                    ]
                );
        }
    }

    public function delete( Marca $marca )
    {
        //si HAY productos de ese marca
       /* if( Producto::cantidadProductosPorMarca( $marca->idMarca ) ){
            return redirect('/marcas')
                    ->with(
                        [
                            'mensaje'=>'No se puede eliminar la marca: '.$marca->mkNombre.' porque tiene productos relacionados',
                            'css'=>'red'
                        ]
                    );
        }*/
        return view('marcaDelete', [ 'marca'=>$marca ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marca $marca)
    {
        $mkNombre = $marca->mkNombre;
        try {
            //Marca::destroy($id);
            $marca->delete();

            return redirect('/marcas')
                ->with(
                    [
                        'mensaje'=>'Marca: '.$mkNombre.' eliminada correctamente',
                        'css'=>'green'
                    ]
                );
        }
        catch ( Throwable $th ){
            return redirect('/marcas')
                ->with(
                    [
                        'mensaje'=>'No se pudo eliminar la marca: '.$mkNombre,
                        'css'=>'red'
                    ]
                );
        }
    }
}
