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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('age')->nullable();
            $table->string('permission')->default('user'); // admin or user
            $table->string('tel', 15)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

/*         Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->date('date');
            //$table->string('type'); // يمكن أن يكون الصنف أو النوع
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->date('date');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('word');
            $table->timestamps();
        });

        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->string('word');
            $table->timestamps();
        });*/

/*         Schema::create('user_reaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('reaction_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reaction_id')->references('id')->on('reactions')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('post_reaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('reaction_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('reaction_id')->references('id')->on('reactions')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->timestamps();
        }); */

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
