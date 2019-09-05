<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("owner_id");
            $table->foreign("owner_id")->references("id")->on("users");
            $table->tinyInteger("type"); // 1 = child, 2 = one-off, 3 = recurring
            $table->tinyInteger("category"); // 1 = food and drink, 2 = toys and equip., etc.
            $table->bigInteger("date")->nullable();
            $table->bigInteger("weekid")->references("id")->on("weeks");
            $table->text("details")->nullable();
            $table->integer("amount");
            $table->bigInteger("childid")->references("id")->on("children")->nullable();
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
        Schema::dropIfExists('expenses');
    }
}
