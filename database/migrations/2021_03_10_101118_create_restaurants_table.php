<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   //relatioships
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name', 50);
            $table->string('slug', 70);
            $table->string('address', 50);
            $table->string('phone', 15);
            $table->text('description');
            $table->string('email', 50);
            $table->string('p_iva', 11)->unique();
            $table->boolean('sponsored');
            $table->string('photo', 250)->nullable();
            $table->string('photo_jumbo', 250)->nullable();
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
}
