<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('account_id')->constrained()->onDelete('cascade');            
            $table->date('booking_date'); 
            $table->date('value_date');
            $table->string('booking_text')->nullable(); 
            $table->text('purpose')->nullable();
            $table->decimal('amount', 15, 2)->nullable();             
            $table->char('currency', 3)->nullable();
            $table->decimal('balance_after_booking', 15, 2)->nullable();
                       
            $table->string('remark')->nullable(); 
            $table->boolean('tax_relevant')->default(false);
            $table->unsignedBigInteger('creditor_id')->nullable(); 
            $table->string('mandate_reference')->nullable(); 
            
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
