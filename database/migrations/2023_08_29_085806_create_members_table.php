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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('grade_id')->unsigned();
            $table->string('name');
            $table->string('image');
            $table->string('card');
            $table->string('email')->unique();
            $table->enum('gender', ['L', 'P'])->nullable()->default('L');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('gudep');
            $table->string('kwarran');
            $table->string('number_id');
            $table->string('level');
            $table->text('address');
            $table->string('phone');
            $table->string('instagram');
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
        Schema::dropIfExists('members');
    }
};
