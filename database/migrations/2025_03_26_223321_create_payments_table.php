<?php

use App\Models\Gateway;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
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
        Schema::create('gateways', function (Blueprint $table) {
            $table->id();
            $table->string('gateway_name');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->CascadeOnDelete();
            $table->foreignIdFor(Plan::class)
                ->constrained()
                ->CascadeOnDelete();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->string('transaction_date');
            $table->decimal('amount');

            $table->foreignIdFor(Gateway::class)
                ->constrained()
                ->CascadeOnDelete()
                ->CascadeOnUpdate();
            $table->foreignIdFor(Subscription::class)
                ->constrained()
                ->CascadeOnDelete()
                ->CascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
