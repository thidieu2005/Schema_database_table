<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class BanhangController extends Controller
{
    public function createTables()
    {
        // Tạo bảng categories trước (vì articles có khóa ngoại category_id)
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('parent_id')->default(0);
                $table->unsignedInteger('lft')->nullable();
                $table->unsignedInteger('rgt')->nullable();
                $table->unsignedInteger('depth')->nullable();
                $table->string('name');
                $table->string('slug');
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Tạo bảng addresses
        if (!Schema::hasTable('addresses')) {
            Schema::create('addresses', function (Blueprint $table) {
                $table->id();
                $table->string('street')->nullable();
                $table->string('country');
                $table->integer('icon_id')->nullable();
                $table->integer('monster_id');
                $table->timestamps();
            });
        }

        // Tạo bảng articles
        if (!Schema::hasTable('articles')) {
            Schema::create('articles', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('category_id');
                $table->string('title');
                $table->string('slug')->default('');
                $table->text('content');
                $table->string('image')->nullable();
                $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('PUBLISHED');
                $table->date('date');
                $table->boolean('featured')->default(0);
                $table->timestamps();
                $table->softDeletes();

                // Add foreign key constraint for category_id
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            });
        }

        // Tạo bảng article_tag (bảng trung gian giữa articles và tags)
        if (!Schema::hasTable('article_tag')) {
            Schema::create('article_tag', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('article_id');
                $table->unsignedBigInteger('tag_id');
                $table->timestamps();
                $table->softDeletes();

                // Khóa ngoại
                $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
                $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            });
        }

        // Tạo bảng tags
        if (!Schema::hasTable('tags')) {
            Schema::create('tags', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug');
                $table->timestamps();
                $table->softDeletes();
            });
        }

        // Tạo bảng products
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100)->nullable();
                $table->unsignedBigInteger('id_type')->nullable();
                $table->text('description')->nullable();
                $table->float('unit_price')->nullable();
                $table->float('promotion_price')->nullable();
                $table->string('image')->nullable();
                $table->string('unit')->nullable();
                $table->tinyInteger('new')->default(0);
                $table->timestamps();
            });
        }

        // Tạo bảng bills
        if (!Schema::hasTable('bills')) {
            Schema::create('bills', function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('id_customer')->nullable();
                $table->date('date_order')->nullable();
                $table->float('total')->nullable()->comment('tổng tiền');
                $table->string('payment', 200)->nullable()->comment('hình thức thanh toán');
                $table->string('note', 500)->nullable();
                $table->timestamps();
                $table->softDeletes();  // You may want to add soft deletes here for bills
            });
        }

        // Tạo bảng bill_detail
        if (!Schema::hasTable('bill_detail')) {
            Schema::create('bill_detail', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('id_bill');
                $table->unsignedBigInteger('id_product');
                $table->integer('quantity')->comment('số lượng');
                $table->double('unit_price');
                $table->timestamps();
                $table->softDeletes();

                // Khóa ngoại
                $table->foreign('id_bill')->references('id')->on('bills')->onDelete('cascade');
                $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');
            });
        }

        // Tạo bảng users
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }

        // Tạo bảng slides
        if (!Schema::hasTable('slide')) {
            Schema::create('slide', function (Blueprint $table) {
                $table->id();
                $table->string('link', 100);
                $table->string('image', 100);
            });
        }

        // Tạo bảng roles
        if (!Schema::hasTable('roles')) {
            Schema::create('roles', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('guard_name');
                $table->timestamps();
            });
        }

        // Tạo bảng role_has_permissions
        if (!Schema::hasTable('role_has_permissions')) {
            Schema::create('role_has_permissions', function (Blueprint $table) {
                $table->unsignedInteger('permission_id');
                $table->unsignedInteger('role_id');
            });
        }

        // Tạo bảng permissions
        if (!Schema::hasTable('permissions')) {
            Schema::create('permissions', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('guard_name');
                $table->timestamps();
            });
        }

        // Tạo bảng model_has_permissions
        if (!Schema::hasTable('model_has_permissions')) {
            Schema::create('model_has_permissions', function (Blueprint $table) {
                $table->unsignedBigInteger('permission_id');
                $table->string('model_type');
                $table->unsignedBigInteger('model_id');
            });
        }

        // Tạo bảng model_has_roles
        if (!Schema::hasTable('model_has_roles')) {
            Schema::create('model_has_roles', function (Blueprint $table) {
                $table->unsignedBigInteger('role_id');
                $table->string('model_type');
                $table->unsignedBigInteger('model_id');
            });
        }

        // Tạo bảng failed_jobs
        if (!Schema::hasTable('failed_jobs')) {
            Schema::create('failed_jobs', function (Blueprint $table) {
                $table->id();
                $table->text('connection');
                $table->text('queue');
                $table->longText('payload');
                $table->longText('exception');
                $table->timestamp('failed_at')->useCurrent();
            });
        }

        // Tạo bảng revisions
        if (!Schema::hasTable('revisions')) {
            Schema::create('revisions', function (Blueprint $table) {
                $table->id();
                $table->string('revisionable_type');
                $table->unsignedBigInteger('revisionable_id');
                $table->unsignedBigInteger('user_id')->nullable();
                $table->string('key');
                $table->text('old_value')->nullable();
                $table->text('new_value')->nullable();
                $table->timestamps();
            });
        }

        // Tạo bảng comments
        if (!Schema::hasTable('comments')) {
            Schema::create('comments', function (Blueprint $table) {
                $table->id();
                $table->string('username');
                $table->text('comment');
                $table->unsignedBigInteger('id_product');
                $table->timestamps();
            });
        }

        // Tạo bảng customer
        if (!Schema::hasTable('customer')) {
            Schema::create('customer', function (Blueprint $table) {
                $table->id();
                $table->string('name', 100);
                $table->string('gender', 10);
                $table->string('email', 50);
                $table->string('address', 100);
                $table->string('phone_number', 20);
                $table->string('note', 200);
                $table->timestamps();
            });
        }

        // Tạo bảng wishlists
        if (!Schema::hasTable('wishlists')) {
            Schema::create('wishlists', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('id_customer');
                $table->unsignedBigInteger('id_product');
                $table->timestamps();
            });
        }
        return "Các bảng đã được tạo thành công";
    }
    
}
