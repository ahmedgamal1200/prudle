<?php

use App\Models\Payment;
use App\Models\Subscription;
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
        Schema::create('subscription_histories', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->date('trial_start')->nullable();
            $table->date('trial_end')->nullable();
            $table->enum('type', ['active', 'paused', 'canceled', 'expired'])->default('active');
            $table->date('stop_date')->nullable();
            $table->date('pause_date')->nullable();
            $table->string('status');

            $table->foreignIdFor(Subscription::class)
                ->constrained()
                ->CascadeOnDelete();
            $table->foreignIdFor(Payment::class)
                ->constrained()
                ->CascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_histories');
    }
};
