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
  Schema::create('user_grades', function (Blueprint $table) {
   $table->id();
   $table->unsignedBigInteger('user_id');
   $table->unsignedBigInteger('grade_id');
   $table->boolean('is_active')->nullable()->default(true);
   $table->timestamps();
  });
 }

 /**
  * Reverse the migrations.
  */
 public function down(): void
 {
  Schema::dropIfExists('user_grades');
 }
};
