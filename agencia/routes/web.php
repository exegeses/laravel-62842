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
