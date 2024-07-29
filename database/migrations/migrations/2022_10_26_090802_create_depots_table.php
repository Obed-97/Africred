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
        Schema::create('depots', function (Blueprint $table) {
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
            $table->unsignedBigInteger('type_depot_id');
            $table->foreign('type_depot_id')
                ->references('id')
                ->on('type_depots')
                ->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('nature')->nullable();
            $table->string('sexe')->nullable();
            $table->unsignedBigInteger('depot')->default(0);
            $table->unsignedBigInteger('retrait')->default(0);
            $table->unsignedBigInteger('solde')->default(0);
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
        Schema::dropIfExists('depots');
    }
};
