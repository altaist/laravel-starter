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
        Schema::table('users', function (Blueprint $table) {
            $table->string('auth_token')->nullable();
            $table->nullableMorphs('social');
            $table->string('contact_email')->nullable();
            $table->string('contact_tel')->nullable();

            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->dateTime('birthday')->nullable();
            $table->smallInteger('age')->nullable();
            $table->smallInteger('gender')->nullable();
            $table->string('region')->nullable();
            $table->string('address')->nullable();
            $table->json('user_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('auth_token');
            $table->dropMorphs('social');
            $table->dropColumn('contact_email');
            $table->dropColumn('contact_tel');

            $table->dropColumn('first_name');
            $table->dropColumn('middle_name');
            $table->dropColumn('last_name');
            $table->dropColumn('age');
            $table->dropColumn('birthday');
            $table->dropColumn('gender');
            $table->dropColumn('region');
            $table->dropColumn('address');
            $table->dropColumn('user_data');
        });
    }
};
