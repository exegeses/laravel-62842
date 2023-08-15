<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Marcas
        </h2>
    </x-slot>


    <div class="py-12">

        @if( session('mensaje') )
        <div id="alert-border-2" class="max-w-lg mx-auto sm:px-6 lg:px-8 rounded-lg
                                        flex p-4 mb-4 text-{{ session('css') }}-800 border-t-4 border-{{ session('css') }}-300 bg-{{ session('css') }}-50
                                        dark:text-{{ session('css') }}-400 dark:bg-gray-800 dark:border-{{ session('css') }}-800">
            <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <div class="ml-3 text-base font-medium">
                {{ session('mensaje') }}
            </div>
        </div>
        @endif

        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!--<div class="p-6 text-gray-900 dark:text-gray-100">-->
                    <div class="shadow-md sm:rounded-lg">
                                <table class="w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                                    <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="p-4 text-gray-700 dark:text-gray-400">
                                            #
                                        </th>
                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Marca
                                        </th>
                                        <th scope="col" class="p-4">
                                            <a href="/marca/create" class="text-gray-700 dark:text-gray-400 hover:underline flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Agregar
                                            </a>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach( $marcas as $marca )
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <th class="p-4 text-gray-700 dark:text-gray-400">
                                            {{ $marca->idMarca }}
                                        </th>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                            {{ $marca->mkNombre }}
                                        </td>
                                        <td class="py-4 px-6 text-sm font-medium text-right ">
                                            <a href="/marca/edit/{{ $marca->idMarca }}" class="text-gray-700 dark:text-gray-400 hover:underline py-3 flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 align-middle">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                                Modificar
                                            </a>
                                            <a href="/marca/delete/{{ $marca->idMarca }}" class="text-gray-700 dark:text-gray-400 hover:underline py-3 flex">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2 align-middle">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                                Eliminar
                                            </a>
                                        </td>
                                    </tr>
                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                <!--</div>-->
            </div>
        </div>
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8 py-4">
        {{ $marcas->links() }}
        </div>
    </div>


</x-app-layout>
