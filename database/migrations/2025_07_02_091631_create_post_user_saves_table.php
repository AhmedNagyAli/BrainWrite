<?php

use App\Models\Post;
use App\Models\User;
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
        Schema::create('post_user_saves', function (Blueprint $table) {
    $table->id();
    $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
    $table->foreignIdFor(Post::class)->constrained()->onDelete('cascade');
    $table->timestamps();
    $table->unique(['user_id', 'post_id']); // prevent duplicate saves
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_user_saves');
    }
};
