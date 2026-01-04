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
        Schema::create('slot_category_slot_review', function (Blueprint $table) {
            $table->foreignId('slot_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('slot_review_id')->constrained()->onDelete('cascade');
            $table->primary(['slot_category_id', 'slot_review_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot_category_slot_review');
    }
};
