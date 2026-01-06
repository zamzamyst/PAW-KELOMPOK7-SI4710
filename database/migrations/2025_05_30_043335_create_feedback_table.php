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
        Schema::connection('mysql_feedback')->create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('rating')->nullable()->comment('Nilai Rating (1-5)');
            $table->text('comment')->nullable();
            $table->timestamps();

            // Foreign key constraints removed - orders and users tables are in separate databases
            // References are maintained via order_id and user_id without DB constraints
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('mysql_feedback')->dropIfExists('feedbacks');
    }
};
