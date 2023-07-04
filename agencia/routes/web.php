<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//ruta para entregar una vista
Route::view('/saludo', 'hola');

//ruta para ejecutar un proceso (action) closure
Route::get('/mensaje', function ()
{

    //proceso a ejecutar
    return view('hola');
});

/* pasaje de datyos a una vista*/
Route::get('/datos', function ()
{

    $nombre = 'marcos';
    $marcas = [
        'Samsung', 'Motorola', 'Adidas','Nike','Puma','Reebook', 'Apple'
    ];
    return view('datos',
        [
            'nombre'=>$nombre,
            'marcas'=>$marcas
        ]
    );
});

//Route::metodo('/peticion', acción)

Route::view('/inicio', 'inicio');
Route::view('/formulario', 'formulario');
Route::post('/proceso', function ()
{
    //$nombre = $_POST['nombre'];
    //capturamos dato enviado por el form
    //$nombre = request()->post('nombre');
    //$nombre = request()->input('nombre');
    //$nombre = request()->nombre;
    $nombre = request('nombre');

    return view('resultado', [ 'nombre'=>$nombre ]);
});

Route::get('/regions', function ()
{
    //obtenemnos listado de regiones
    $regiones = DB::select(
                    'SELECT idRegion, regNombre FROM regiones'
                );
    //pasamos listado a la vista
    return view('regiones', [ 'regiones'=>$regiones ]);
});
Route::get('/region/create', function ()
{
    return view('regionCreate');
});
Route::post('/region/store', function ()
{
    //capturamos dato enviado por el form
    $regNombre = request('regNombre');

    try {
        //insertar dato en tabla
        DB::insert(
            'INSERT INTO regiones
                ( regNombre )
                VALUE
                ( :regNombre )',
            [ $regNombre ]
        );

/*        $regiones = DB::select('SELECT * FROM regiones');
        return view('/regions', ['regiones'=>$regiones]); */

        return redirect('/regions')
                    ->with(
                        [
                            'mensaje'=>'Región: '.$regNombre.' agregada correctamente',
                            'css'=>'success'
                        ]
                    );
    }
    catch ( Throwable $th ){
        // mensaje de ok/error
        return redirect('/regions')
            ->with(
                [
                    'mensaje'=>'No se pudo agregar la región: '.$regNombre,
                    'css'=>'danger'
                ]
            );
    }

});
Route::get('/region/edit/{id}', function ($id)
{
    /*$region = DB::select('
                        SELECT idRegion, regNombre
                        FROM regiones
                        WHERE idRegion = :id
                        ',
                        [ $id ]
    );*/
    $region = DB::table('regiones')
                    ->where('idRegion', $id)
                    ->first();
    //->toSQL();
    return view('regionEdit', [ 'region'=>$region ]);
});
Route::post('/region/update', function ()
{
    //capturamos datos enviados por el form
    $idRegion = request('idRegion');
    $regNombre = request('regNombre');

    try {
        //modificamos
        /*versión Raw SQL
         * DB::update('UPDATE regiones
                    SET regNombre = :regNombre
                    WHERE idRegion = :idRegion',
                    [ $regNombre, $idRegion ]
        );*/
        //Fluent Query Builder
        DB::table('regiones')
            ->where('idRegion', $idRegion)
            ->update([ 'regNombre'=>$regNombre ]);
        return redirect('/regions')
                ->with(
                    [
                        'mensaje'=>'Región: '.$regNombre.' modificada correctamente.',
                        'css'=>'success'
                    ]
                );
    }
    catch ( Throwable $th ){
        // mensaje de ok/error
        return redirect('/regions')
            ->with(
                [
                    'mensaje'=>'No se pudo modificar la región: '.$regNombre,
                    'css'=>'danger'
                ]
            );
    }
});
Route::get('/region/delete/{id}', function ($id)
{
    //obtenemos datos de la región
    $region = DB::table('regiones')
                ->where('idRegion', $id)->first();
    ### chequeamos destinos relacionados a la región
    $check = DB::table('destinos')
                ->where('idRegion', $id)->count();
    //si hay destinos de esa región, NO se puede eliminar
    if( $check ){
        return redirect('/regions')
            ->with(
                [
                    'mensaje'=>'No se puede eliminar la región: '.$region->regNombre.' porque tiene destinos relacionados',
                    'css'=>'warning'
                ]
            );
    }

});
