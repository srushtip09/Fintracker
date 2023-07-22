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
            $table->text('reference_no');
            $table->date('date');
            $table->text('description');
            $table->enum('amt_type', \App\Helpers\Constants\TransactionConstants::AMT_TYPE);
            $table->enum('type', \App\Helpers\Constants\TransactionConstants::TRANSACTION_TYPE);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->string('bank_name')->nullable();
            $table->integer('amt_debit')->nullable();
            $table->integer('amt_credit')->nullable();
            $table->bigInteger('balance');
            $table->timestamps();

            $table->foreign('bank_id')
                ->on('banks')
                ->references('id');

            $table->foreign('user_id')
                ->on('users')
                ->references('id');

            $table->foreign('category_id')
                ->on('categories')
                ->references('id');
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
