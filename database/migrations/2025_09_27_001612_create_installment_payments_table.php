<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Installment;
use App\Models\Transaction;
use App\Models\User;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('installment_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Installment::class, 'installment_id');
            $table->foreignIdFor(Transaction::class, 'transaction_id')->nullable();
            $table->decimal('amount', 10, 2);
            $table->date('payment_date');
            $table->foreignIdFor(User::class, 'paid_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installment_payments');
    }
};
