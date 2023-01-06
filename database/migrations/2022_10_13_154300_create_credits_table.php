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
        Schema::create('credits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade')->nullable();
            $table->foreign('marche_id')
                ->references('id')
                ->on('marches')
                ->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('montant');
            $table->date('date_deblocage');
            $table->date('date_fin');
            $table->unsignedBigInteger('interet');
            $table->unsignedBigInteger('frais_deblocage');
            $table->unsignedBigInteger('frais_carte');
            $table->unsignedBigInteger('montant_interet');
            $table->unsignedBigInteger('montant_par_jour');
             $table->string('statut')->default('Accordé');
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
        Schema::dropIfExists('credits');
    }
};
