<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
Schema::create('trajets', function (Blueprint $table) {
    $table->id();
    $table->foreignId('conducteur_id')->constrained('users')->onDelete('cascade');
    $table->string('depart');
    $table->string('destination');
    $table->date('date');
    $table->time('heure');
    $table->float('prix');
    $table->integer('nb_places');
    $table->boolean('valide')->default(false);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trajets');
    }
};
