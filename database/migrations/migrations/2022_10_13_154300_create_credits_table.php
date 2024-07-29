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
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')
                  ->references('id')
                  ->on('types')
                  ->onDelete('cascade')->default(1);
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
            $table->unsignedBigInteger('marche_id');
            $table->foreign('marche_id')
                ->references('id')
                ->on('marches')
                ->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('filiere_id');
            $table->foreign('filiere_id')
                ->references('id')
                ->on('filieres')
                ->onDelete('cascade')->default(1);
            $table->unsignedBigInteger('secteur_id');
            $table->foreign('secteur_id')
                ->references('id')
                ->on('secteurs')
                ->onDelete('cascade')->default(1);
            $table->unsignedBigInteger('nature');
            $table->string('sexe');
            $table->unsignedBigInteger('montant');
            $table->date('date_deblocage');
            $table->date('date_fin');
            $table->integer('nbre_jrs');
            $table->unsignedBigInteger('interet');
            $table->unsignedBigInteger('frais_deblocage');
            $table->unsignedBigInteger('frais_carte');
            $table->unsignedBigInteger('montant_interet');
            $table->unsignedBigInteger('montant_par_jour');
            $table->unsignedBigInteger('capital_par_jour');
            $table->unsignedBigInteger('interet_par_jour');
            $table->unsignedBigInteger('epargne_par_jour');
            $table->string('statut')->default('Accordé');
            $table->string('motif')->nullable();
            $table->unsignedBigInteger('n_montant')->default(0);
            $table->date('date_r');
            $table->integer('n_delai');
            $table->date('date_fin_r');
            $table->string('motif_r')->nullable();
            $table->string('reecheloner')->nullable();
            $table->string('adresse')->nullable();
            $table->string('telephone')->nullable();
            $table->string('situation_familiale')->nullable();
            $table->unsignedBigInteger('nbre_enfant')->nullable();
            $table->unsignedBigInteger('nbre_femme')->nullable();
            $table->string('projet_immobilier')->nullable();
            $table->string('projet_immobilier')->nullable();
            $table->string('nom_entreprise')->nullable();
            $table->string('type_activite')->nullable();
            $table->date('date_entreprise')->nullable();
            $table->string('structure')->nullable();
            $table->string('adresse_entreprise')->nullable();
            $table->string('rccm')->nullable();
            $table->unsignedBigInteger('annee_experience')->nullable();
            $table->string('description_produit')->nullable();
            $table->unsignedBigInteger('revenu_brute')->nullable();
            $table->unsignedBigInteger('revenu_net')->nullable();
            $table->string('autre_source')->nullable();
            $table->string('dettes_existantes')->nullable();
            $table->unsignedBigInteger('valeur_actif')->nullable();
            $table->unsignedBigInteger('duree_souhaitee')->nullable();
            $table->string('utilisation_fonds')->nullable();
            $table->string('plan_remboursement')->nullable();
            $table->string('note')->nullable();
            $table->string('sponsor')->nullable();
            $table->string('perte')->default('non');
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
