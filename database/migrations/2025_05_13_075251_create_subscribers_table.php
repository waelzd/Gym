<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id(); // Creates the 'id' column as a primary key
            $table->string('name'); // 'name' column
            $table->string('phone'); // 'phone' column
            $table->enum('gender', ['male', 'female']); // 'gender' column with possible values
            $table->date('subscription_date'); // 'subscription_date' column
            $table->decimal('fees', 8, 2); // 'fees' column with decimal value (8 digits, 2 after decimal)
            $table->enum('status', ['paid', 'unpaid']); // 'status' column with values 'paid' or 'unpaid'
            $table->timestamps(); // Automatically creates 'created_at' and 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribers');
    }
}
