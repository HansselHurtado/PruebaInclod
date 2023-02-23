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
        Schema::create('pro_procesos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pro_prefijo');
            $table->string('pro_nombre');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tip_tipo_docs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tip_nombre');
            $table->string('tip_prefijo');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('doc_documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('doc_nombre');
            $table->string('doc_codigo');
            $table->string('doc_contenido', 500);

            $table->unsignedInteger('doc_id_tipo');
            $table->foreign('doc_id_tipo')->references('id')->on('tip_tipo_docs');

            $table->unsignedInteger('doc_id_proceso');
            $table->foreign('doc_id_proceso')->references('id')->on('pro_procesos');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('esquema_doc');
    }
};
