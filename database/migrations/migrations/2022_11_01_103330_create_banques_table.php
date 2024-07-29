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
        Schema::create('banques', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('micro_finance_id');
            $table->foreign('micro_finance_id')
                  ->references('id')
                  ->on('micro_finances')
                  ->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')->nullable();
            $table->string('type');
            $table->date('date');
            $table->string('nom_banque');
            $table->unsignedBigInteger('montant')->default(0);
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
        Schema::dropIfExists('banques');
    }
};
