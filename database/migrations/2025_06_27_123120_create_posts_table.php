<?php

use App\Models\Category;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Category::class)->nullable()->constrained()->onDelete('set null');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('video_url')->nullable();
            $table->enum('status', allowed: ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->unsignedBigInteger('visited')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
