<?php

use App\Models\SubCategory;
use App\Models\Category;
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
            $table->string('title', 200);
            $table->string('slug');
            $table->longtext('description')->nullable();
            $table->string('image');
            $table->integer('quantity');
            $table->decimal('old_price', 10, 2)->nullable();
            $table->decimal('new_price', 10, 2);
            $table->foreignIdFor(Category::class, 'category_id')->nullable();
            $table->foreignIdFor(SubCategory::class, 'subcategory_id')->nullable();
            $table->boolean('inStock')->default(0);
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
