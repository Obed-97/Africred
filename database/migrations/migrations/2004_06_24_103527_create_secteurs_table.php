<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secteurs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('marche_id')
                  ->references('id')
                  ->on('marches')
                  ->onDelete('cascade')->nullable();
            $table->foreign('filiere_id')
                  ->references('id')
                  ->on('filieres')
                  ->onDelete('cascade')->nullable();
            $table->string('libelle');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('secteurs');
    }
};
