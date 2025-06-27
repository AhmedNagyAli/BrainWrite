<?php

use App\Models\Post;
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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
    $table->foreignIdFor(Post::class)->constrained()->onDelete('cascade');
    $table->string('title')->nullable();
    $table->text('content')->nullable();
    $table->string('image')->nullable();
    $table->string('link')->nullable();
    $table->integer('order')->default(0);
    $table->string('video')->nullable();
    $table->string('video_url')->nullable();
    $table->softDeletes();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
