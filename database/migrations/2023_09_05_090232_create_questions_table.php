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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('exam_id')->unsigned();
            $table->enum('type', ['Multiple Choice', 'Essay'])->nullable()->default('Multiple Choice');
            $table->longText('question');
            $table->longText('a')->nullable();
            $table->longText('b')->nullable();
            $table->longText('c')->nullable();
            $table->longText('d')->nullable();
            $table->longText('e')->nullable();
            $table->enum('key', ['a', 'b', 'c', 'd', 'e'])->nullable()->default('a');
            $table->timestamps();
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
