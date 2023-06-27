@extends('layouts.plantilla')

    @section('contenido')
        <h1>Formulario de envío</h1>

        <div class="alert col-8 mx-auto shadow">
            <form action="/proceso" method="post">
            @csrf
                <input type="text" name="nombre" class="form-control">
                <button class="btn btn-dark">enviar</button>
            </form>
        </div>

    @endsection
