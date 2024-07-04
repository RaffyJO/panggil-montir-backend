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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('order_type_id')->constrained('order_types');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('motorcycle_id')->constrained('motorcycles');
            $table->foreignId('garage_id')->nullable()->constrained('garages');
            $table->foreignId('montir_id')->nullable()->constrained('montirs');
            $table->foreignId('payment_id')->constrained('payments');
            $table->dateTime('order_date');
            $table->dateTime('booked_date')->nullable();
            $table->dateTime('completed_date')->nullable();
            $table->double('service_fee');
            $table->double('delivery_fee')->nullable();
            $table->string('issue');
            $table->string('notes')->nullable();
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->enum('status', ['ongoing', 'cancelled', 'completed'])->default('ongoing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
