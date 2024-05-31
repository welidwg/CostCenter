<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandeurs', function (Blueprint $table) {
            $table->id();
            $table->string("matricule")->unique();
            $table->string("name");
            $table->foreignId("id_departement")->nullable()->references("id")->on("departements")->nullOnDelete();
            $table->foreignId("id_fonction")->nullable()->references("id")->on("fonctions")->nullOnDelete();
            $table->foreignId("id_site")->nullable()->references("id")->on("sites")->nullOnDelete();
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
        Schema::dropIfExists('demandeurs');
    }
}
