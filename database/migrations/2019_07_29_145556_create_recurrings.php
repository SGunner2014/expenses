<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecurrings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recurrings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("owner_id");
            $table->foreign("owner_id")->references("id")->on("users");
            $table->text("details");
            $table->integer("amount");
            $table->integer("category");
            $table->boolean("active");
            $table->boolean("monthly")->default(true);
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
        Schema::dropIfExists('recurrings');
    }
}
