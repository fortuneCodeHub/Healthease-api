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
        Schema::create('specialists', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('other');
            $table->string('username');
            $table->string("image")->nullable();
            $table->string("rating")->nullable();
            $table->string('email')->unique();
            $table->string('specialty');
            $table->string('experience');
            $table->string('about_me');
            $table->string('address');
            $table->string('number');
            $table->string('language');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialists');
    }
};
