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
        Schema::create('transferts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')->nullable();
            $table->string('pays_e');
            $table->string('pays_d');
            $table->string('nom_e');
            $table->string('prenom_e');
            $table->string('tel_e');
            $table->string('email_e');
            $table->string('nom_d');
            $table->string('prenom_d');
            $table->string('tel_d');
            $table->string('email_d');
            $table->unsignedBigInteger('montant');
            $table->unsignedBigInteger('frais');
            $table->unsignedBigInteger('montant_p');
            $table->unsignedBigInteger('recepteur');
            $table->string('statut')->default('En cours..');
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
        Schema::dropIfExists('transferts');
    }
};
