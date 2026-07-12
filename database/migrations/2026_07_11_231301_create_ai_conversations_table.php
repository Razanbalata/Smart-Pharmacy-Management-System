<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ai_conversations', function (Blueprint $table) {
            $table->id();

            /*
             * |--------------------------------------------------------------------------
             * | Owner
             * |--------------------------------------------------------------------------
             */

            $table
                ->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
             * |--------------------------------------------------------------------------
             * | Future Multi Tenant Support
             * |--------------------------------------------------------------------------
             */

            $table
                ->foreignId('pharmacy_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            /*
             * |--------------------------------------------------------------------------
             * | Conversation Info
             * |--------------------------------------------------------------------------
             */

            $table
                ->string('title')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_conversations');
    }
};
