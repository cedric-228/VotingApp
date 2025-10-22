<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('candidates', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('prenom');
        $table->string('nationalite');
        $table->integer('age');
        $table->decimal('poids', 5, 2); // ex: 70.50 kg
        $table->decimal('taille', 5, 2); // ex: 175.50 cm
        $table->text('description_rapide');
        $table->text('description_complete');
        $table->string('photo_profil')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
