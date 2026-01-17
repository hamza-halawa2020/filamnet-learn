<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Client;
use App\Models\Product;
use App\Models\User;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('installment_contracts', function (Blueprint $table) {
            $table->id();
            $table->decimal('product_price', 10, 2); 
            $table->decimal('down_payment', 10, 2)->default(0); 
            $table->decimal('remaining_amount', 10, 2)->default(0); 
            $table->integer('installment_count');  
            $table->decimal('interest_rate', 5, 2)->default(0); 
            $table->decimal('interest_amount', 10, 2)->default(0); 
            $table->decimal('total_amount', 10, 2); 
            $table->decimal('installment_amount', 10, 2); 
            $table->date('start_date');
            $table->foreignIdFor(Client::class, 'client_id')->nullable();
            $table->foreignIdFor(Product::class, 'product_id')->nullable();
            $table->foreignIdFor(User::class, 'created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installment_contracts');
    }
};
