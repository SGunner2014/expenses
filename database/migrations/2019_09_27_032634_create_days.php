<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text("name")->nullable(); // for future (tuesday, wednesday, etc...)
            $table->smallInteger("monthNo"); // the day number in the month
            $table->bigInteger("weekid")->references("id")->on("weeks");
            $table->bigInteger("timestamp"); // this represents the unix epoch time of the day
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
        Schema::dropIfExists('days');
    }
}
