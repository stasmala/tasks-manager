<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->integer('parent_id')->nullable();
            $table->string('status')->nullable();
            $table->unsignedTinyInteger('priority')->default(1);
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamp('createdAt')->useCurrent();
            $table->timestamp('completedAt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
