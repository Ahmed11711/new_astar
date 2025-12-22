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
        Schema::create('ai_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('student_attempt_id');
            $table->unsignedBigInteger('question_id');
            $table->text('response_ai')->nullable();
            $table->text('feadback')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_answers');
    }
};
