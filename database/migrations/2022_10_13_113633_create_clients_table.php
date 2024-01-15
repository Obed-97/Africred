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
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('marche_id');
            $table->foreign('marche_id')
                ->references('id')
                ->on('marches')
                ->onDelete('cascade')->nullable();
            $table->string('carte_id')->nullable();
            $table->string('nom_prenom');
            $table->string('activite')->nullable();
            $table->string('telephone')->unique()->nullable();
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->date('date_n')->nullable();
            $table->string('lieu_n')->nullable();
            $table->string('sexe')->nullable();
            $table->string('image')->default('avatar.png');
            $table->rememberToken();
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
        Schema::dropIfExists('clients');
    }
};
