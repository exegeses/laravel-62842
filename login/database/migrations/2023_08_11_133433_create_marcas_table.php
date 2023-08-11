<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('marcas', function (Blueprint $table) {
            $time = date('d-m-y H:i:s');
            $table->tinyIncrements('idMarca');
            $table->string('mkNombre', 50);
            $table->timestamps();
            /* si vamos a usar softDeletes,
            * debemos agregar el trait
            * en el model
            * */
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marcas');
    }
};
