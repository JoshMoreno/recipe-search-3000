<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Recipe::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->text('description')->fulltext();
            $table->integer('order')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('steps');
    }
};
