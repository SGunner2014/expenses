<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonths extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('months', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("owner_id");
            $table->foreign("owner_id")->references("id")->on("users");
            $table->bigInteger("yearid")->references("id")->on("years"); // The year this month belongs to
            $table->text("name"); // Text form of month (January, etc.)
            $table->tinyInteger("month"); // 1 = January, etc.
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
        Schema::dropIfExists('months');
    }
}
