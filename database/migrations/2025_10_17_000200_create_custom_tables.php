<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Admins
        Schema::create('admins', function (Blueprint $table) {
            $table->id('admin_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // 2. Costumes
        Schema::create('costumes', function (Blueprint $table) {
            $table->id('costume_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->decimal('price_per_day', 10, 2);
            $table->integer('stock')->default(0);
            $table->string('image_url')->nullable();
            $table->enum('status', ['available', 'unavailable'])->default('available');
            $table->timestamps();
        });

        // 3. Accessories
        Schema::create('accessories', function (Blueprint $table) {
            $table->id('accessory_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->string('image_url')->nullable();
            $table->enum('status', ['available', 'out_of_stock'])->default('available');
            $table->timestamps();
        });

        // 4. Events
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->date('date');
            $table->timestamps();
        });

        // 5. Carts
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // => unsignedBigInteger
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });


        // 6. Cart Items
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained('carts')->onDelete('cascade');
            $table->enum('product_type', ['costume', 'accessory']);
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity')->default(1);
            $table->integer('rental_days')->nullable();
            $table->timestamps();
        });


        // 7. Sewa
        Schema::create('sewa', function (Blueprint $table) {
            $table->id('sewa_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('costume_id')->constrained('costumes')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_price', 10, 2);
            $table->enum('payment_method', ['quris', 'ambil_di_tempat']);
            $table->enum('status', ['pending', 'ongoing', 'returned', 'cancelled'])->default('pending');
            $table->timestamps();
        });

        // 8. Beli
        Schema::create('beli', function (Blueprint $table) {
            $table->id('beli_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('accessory_id')->constrained('accessories')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 10, 2);
            $table->enum('payment_method', ['quris'])->default('quris');
            $table->enum('status', ['pending', 'paid', 'shipped', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });

        // 9. Notifications
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notif_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->text('message')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });

        // 10. Chats
        Schema::create('chats', function (Blueprint $table) {
            $table->id('chat_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->text('message');
            $table->enum('sender_role', ['user', 'admin']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('beli');
        Schema::dropIfExists('sewa');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');
        Schema::dropIfExists('events');
        Schema::dropIfExists('accessories');
        Schema::dropIfExists('costumes');
        Schema::dropIfExists('admins');
    }
};
