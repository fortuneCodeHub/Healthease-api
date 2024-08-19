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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('age');
            $table->string('weight');
            $table->string('height');
            $table->string('allergies');
            $table->string('health_issues');
            $table->string('genotype');
            $table->string('blood_group');
            $table->string('user_lang');
            $table->string('postal_code');
            $table->string('plan');
            $table->string('plan_exp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
