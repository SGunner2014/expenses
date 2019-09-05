<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weeks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("owner_id");
            $table->foreign("owner_id")->references("id")->on("users");
            $table->bigInteger("monthid")->references("id")->on("months");
            $table->tinyInteger("week"); // 1, 2, 3, 4, 5
            $table->boolean("active")->default(true);
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
        Schema::dropIfExists('weeks');
    }
}
