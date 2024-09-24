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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->text("body");
            $table->boolean("status") -> default(0);
            $table->boolean('fav') -> default(0);
            $table->boolean('isRead') -> default(0);
            $table->timestamp('created_at');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sender_id')
            -> nullable();
            $table->foreign("user_id")
            ->references("id")
            ->on("users")
            ->onUpdate("cascade")
            ->onDelete("cascade");
            $table->foreign("sender_id") -> nullable()
            ->references("id")
            ->on("users")
            ->onUpdate("cascade")
            ->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('messages');
    }

};
