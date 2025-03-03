<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('loaisanpham', function (Blueprint $table) {
            $table->id(); // Tạo khóa chính tự động tăng
            $table->string('ten', 200); // Cột 'ten' giới hạn 200 ký tự
            $table->timestamps(); // Tạo created_at và updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loaisanpham');
    }
};
