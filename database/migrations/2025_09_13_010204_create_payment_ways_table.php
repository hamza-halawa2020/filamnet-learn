<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_ways', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class, 'category_id')->nullable();
            $table->foreignIdFor(Category::class, 'sub_category_id')->nullable();
            $table->string('name');
            $table->enum('type', ['cash', 'wallet', 'balance_machine']);
            $table->string('phone_number')->nullable();
            $table->decimal('send_limit', 12, 2)->nullable();
            $table->decimal('send_limit_alert', 12, 2)->nullable();
            $table->decimal('receive_limit', 12, 2)->nullable();
            $table->decimal('receive_limit_alert', 12, 2)->nullable();
            $table->decimal('balance', 12, 2)->default(0);
            $table->integer('position')->default(0);
            $table->enum('client_type',['client','merchant'])->default('client');
            $table->foreignIdFor(User::class, 'created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_ways');
    }
};
