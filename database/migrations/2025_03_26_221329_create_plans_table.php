<?php

use App\Models\Feature;
use App\Models\Plan;
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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->integer('compare_price');
            $table->text('description')->nullable();
            $table->string('icon');
            $table->timestamps();
        });

        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('key');
            $table->string('value');
        });

        Schema::create('plan_feature', function (Blueprint $table) {
           $table->foreignIdFor(Feature::class)
           ->constrained()
           ->cascadeOnDelete();

           $table->foreignIdFor(Plan::class)
               ->constrained()
               ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
        Schema::dropIfExists('features');
        Schema::dropIfExists('plan_feature');
    }
};
