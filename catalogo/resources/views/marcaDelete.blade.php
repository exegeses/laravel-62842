@extends('layouts.plantilla')
@section('contenido')

    <h1 class="mb-4">Baja de una marca</h1>

    <div class="alert shadow text-danger col-6 mx-auto p-4">


        Se eliminará la marca:
        <span class="lead">
                {{ $marca->mkNombre }}
            </span>
        <form action="/marca/destroy" method="post">
        @method('delete')
        @csrf
            <input type="hidden" name="mkNombre"
                   value="{{ $marca->mkNombre }}">
            <input type="hidden" name="idMarca"
                   value="{{ $marca->idMarca }}">
            <button class="btn btn-danger btn-block my-3">
                Confirmar baja
            </button>
            <a href="/marcas" class="btn btn-light btn-block">
                volver a panel
            </a>
        </form>
    </div>
    <script>
        Swal.fire(
            '¡Advertencia!',
            'Si pulsa el botón "Confirmar baja", se eliminará la marca seleccionada',
            'warning'
        );
    </script>

@endsection
