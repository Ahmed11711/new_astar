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
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('country')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('iban')->nullable();
            $table->string('software')->nullable();
            $table->string('address')->nullable();
            $table->enum('status', ['pending', 'confirmed','reject'])->default('pending');
            $table->decimal('amount', 15, 2)->default(0);
            $table->enum('method', ['bank', 'bank_dollar','wallet'])->default('bank');
            $table->text('note')->nullable();
            $table->enum('type_withdraw', ['affiliate', 'profit_ads'])->default('profit_ads');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraws');
    }
};
