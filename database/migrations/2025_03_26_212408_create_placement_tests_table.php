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
        Schema::create('placement_tests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('logo');
            $table->decimal('timer');
            $table->integer('total_mark');
            $table->integer('passing_mark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('placement_tests');
    }
};
