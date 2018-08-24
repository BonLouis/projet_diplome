<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');

            $table->enum('type', ['stage', 'formation']);
            $table->string('title', 150);
            $table->text('description');
            $table->decimal('price', 7, 2)->nullable();
            $table->smallInteger('max_seats')->nullable();
            $table->dateTime('begin_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->enum('status', ['draft', 'published', 'trash']);
            $table->boolean('open');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
