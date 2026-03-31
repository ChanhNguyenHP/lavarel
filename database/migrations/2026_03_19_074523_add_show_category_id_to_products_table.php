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
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('show')->default(1)->after('id'); // mặc định hiển thị
            $table->unsignedBigInteger('category_id')->nullable()->default(null)->after('show'); // mặc định rỗng
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('show');
            $table->dropColumn('category_id');
        });
    }
};
