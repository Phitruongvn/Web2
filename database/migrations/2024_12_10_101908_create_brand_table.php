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
Schema::create('brand', function (Blueprint $table) {
$table->id();
$table->string('name', 1000);
$table->string('slug', 1000);
$table->string('image', 1000);
$table->text('description');
$table->unsignedInteger('sort_order');
$table->unsignedInteger('created_by');
$table->unsignedInteger('updated_by')->nullable();
$table->timestamps();
$table->unsignedInteger('status');
$table->softDeletes ('deleted_at');

});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand');
    }
};
