<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class TaobangController extends Controller
{
    public function createTable()
    {
        if (!Schema::hasTable('loaisanpham')) {
            Schema::create('loaisanpham', function (Blueprint $table) {
                $table->id();
                $table->string('ten', 200);
                $table->timestamps();
            });

            return "✅ Bảng 'loaisanpham' đã được tạo thành công!";
        } else {
            return "⚠️ Bảng 'loaisanpham' đã tồn tại!";
        }
    }

    public function dropTable()
    {
        if (Schema::hasTable('loaisanpham')) {
            Schema::dropIfExists('loaisanpham');
            return "🗑️ Bảng 'loaisanpham' đã bị xóa!";
        } else {
            return "⚠️ Bảng 'loaisanpham' không tồn tại!";
        }
    }
}
