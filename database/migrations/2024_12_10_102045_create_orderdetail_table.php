<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up():void
{
Schema::create('orderdetail', function (Blueprint $table) {
$table->id();
$table->unsignedInteger('order_id');
$table->unsignedInteger('product_id');
$table->unsignedInteger('qty');
$table->double('price');
$table->double('discount');
$table->double('amount');
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderdetail');
    }
};
