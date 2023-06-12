<?php

use App\Enums\ImageType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->morphs('imageable');
            $table->string('type')->default(ImageType::DEFAULT->value);
            $table->string('url');
            $table->string('filename')->nullable();
            $table->string('path')->nullable();
            $table->string('size')->nullable();
            $table->string('extension')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
