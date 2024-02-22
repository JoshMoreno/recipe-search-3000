<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Recipe::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->decimal('quantity', unsigned: true);
            $table->string('unit');
            $table->string('name')->fulltext();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
