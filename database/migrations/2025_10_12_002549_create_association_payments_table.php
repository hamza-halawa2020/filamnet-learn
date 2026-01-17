<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Association;
use App\Models\Transaction;
use App\Models\AssociationMember;
use App\Models\User;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('association_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Association::class, 'association_id');
            $table->foreignIdFor(Transaction::class, 'transaction_id')->nullable();
            $table->foreignIdFor(AssociationMember::class, 'member_id');
            $table->decimal('amount', 15, 2);
            $table->date('payment_date');
            $table->enum('status',['paid','pending','late'])->default('paid');
            $table->foreignIdFor(User::class, 'created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('association_payments');
    }
};
