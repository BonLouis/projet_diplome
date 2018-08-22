<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_registration', function (Blueprint $table) {
            $table->unsignedInteger('post_id');
            $table->foreign('post_id')
                ->references('id')
                ->on('posts');

            $table->unsignedInteger('registration_id');
            $table->foreign('registration_id')
                ->references('id')
                ->on('registrations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_registration');
    }
}
