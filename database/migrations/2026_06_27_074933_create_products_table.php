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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Identity
            $table->string('name');
            $table->string('scientific_name')->nullable();
            $table->string('sku')->unique();
            $table->string('barcode')->nullable()->unique();
            $table->text('description')->nullable();
            
            // Pricing
            $table->decimal('purchase_price', 10, 2);
            $table->decimal('selling_price', 10, 2);

            // Stock
            $table->integer('stock_quantity')->default(0);
            $table->integer('minimum_stock')->default(10);

            // Medical info
            $table->date('expiration_date')->nullable();
            $table->string('batch_number')->nullable();

            $table->string('image')->nullable();

            // Status
            $table->enum('status', [
                'active',
                'inactive',
                'discontinued'
            ])->default('active');

            // Relations
            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('supplier_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
