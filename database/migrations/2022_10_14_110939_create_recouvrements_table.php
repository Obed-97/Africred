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
        Schema::create('recouvrements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('credit_id');
            $table->foreign('credit_id')
                ->references('id')
                ->on('credits')
                ->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('marche_id');
            $table->foreign('marche_id')
                ->references('id')
                ->on('marches')
                ->onDelete('cascade')->nullable();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('encours_actualise')->default(0);
            $table->unsignedBigInteger('interet_jrs')->default(0);
            $table->unsignedBigInteger('recouvrement_jrs')->default(0);
            $table->unsignedBigInteger('epargne_jrs')->default(0);
            $table->unsignedBigInteger('assurance')->default(0);
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
        Schema::dropIfExists('recouvrements');
    }
};
