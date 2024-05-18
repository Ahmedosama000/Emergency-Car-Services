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
        Schema::create('warshas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('img',420);
            $table->enum('stars',[1,2,3,4,5]);
            $table->string('location',128);
            $table->string('info',128)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warshas');
    }
};
