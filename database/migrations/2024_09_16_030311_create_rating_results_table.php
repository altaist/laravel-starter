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
        Schema::create('rating_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->nullableMorphs('related');
            $table->string('rating_key');
            $table->smallInteger('rating_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating_results');
    }
};
