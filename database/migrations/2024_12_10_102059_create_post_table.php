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
Schema::create('post', function (Blueprint $table) {
$table->id();
$table->unsignedInteger('topic_id')->nullable();
$table->string('title', 1000);
$table->string('slug', 1000);
$table->longText('content');
$table->text('description');
$table->string('thumbnail', 1000);
$table->enum ('type', ['post', 'page'])->default('post');
$table->unsignedInteger('created_by');
$table->unsignedInteger('updated_by')->nullable();
$table->timestamps();
$table->softDeletes ('deleted_at');
$table->unsignedInteger('status');
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post');
    }
};
