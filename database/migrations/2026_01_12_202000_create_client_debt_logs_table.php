<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Client;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('client_debt_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Client::class, 'client_id');
            $table->decimal('debt_before', 15, 2);
            $table->decimal('debt_after', 15, 2);
            $table->decimal('change_amount', 15, 2);
            $table->string('source_type')->nullable(); // Transaction, InstallmentPayment, manual, etc.
            $table->unsignedBigInteger('source_id')->nullable();
            $table->text('description')->nullable();
            $table->foreignIdFor(User::class, 'created_by');
            $table->timestamps();

            $table->index(['source_type', 'source_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_debt_logs');
    }
};
