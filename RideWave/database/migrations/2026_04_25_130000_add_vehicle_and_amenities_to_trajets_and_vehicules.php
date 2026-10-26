<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('vehicules', function (Blueprint $table) {
            $table->string('type')->default('car')->after('user_id');
        });

        Schema::table('trajets', function (Blueprint $table) {
            $table->foreignId('vehicule_id')->nullable()->after('conducteur_id')->constrained('vehicules')->nullOnDelete();
            $table->boolean('smoking_allowed')->default(false)->after('valide');
            $table->boolean('pets_allowed')->default(false)->after('smoking_allowed');
            $table->boolean('baggage_allowed')->default(true)->after('pets_allowed');
            $table->boolean('food_drinks_allowed')->default(false)->after('baggage_allowed');
            $table->boolean('ac_included')->default(false)->after('food_drinks_allowed');
        });
    }

    public function down(): void
    {
        Schema::table('trajets', function (Blueprint $table) {
            $table->dropConstrainedForeignId('vehicule_id');
            $table->dropColumn([
                'smoking_allowed',
                'pets_allowed',
                'baggage_allowed',
                'food_drinks_allowed',
                'ac_included',
            ]);
        });

        Schema::table('vehicules', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
