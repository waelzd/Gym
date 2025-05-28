<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Creates the 'id' column as a primary key
            $table->foreignId('subscriber_id')->constrained('subscribers')->onDelete('cascade'); // Foreign key referencing 'subscribers' table
            $table->decimal('amount', 10, 2); // 'amount' column with decimal value
            $table->date('payment_date'); // 'payment_date' column to store the payment date
            $table->timestamps(); // Automatically creates 'created_at' and 'updated_at' columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
