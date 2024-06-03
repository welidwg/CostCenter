<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeurActsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandeur_acts', function (Blueprint $table) {
            $table->id();
            $table->string("matricule")->unique();
            $table->string("name");
            $table->foreignId("id_departement")->nullable()->references("id")->on("departements")->nullOnDelete();
            $table->foreignId("id_fonction")->nullable()->references("id")->on("fonctions")->nullOnDelete();
            $table->string("groupe_article");
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
        Schema::dropIfExists('demandeur_acts');
    }
}
