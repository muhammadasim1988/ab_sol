<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name',100)->after("id");
            $table->string('last_name',100)->after("first_name");
            $table->string('address',150)->after("last_name");
            $table->string('dob',100)->after("address");
        });

        Schema::create('interest', function (Blueprint $table) {
            $table->id();
            $table->string("title",200);
            $table->timestamps();
        });

        Schema::create('user_interest', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("interest_id");
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on("users")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("interest_id")->references("id")->on("interest")->onUpdate("cascade")->onDelete("cascade");
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interest');
        Schema::dropIfExists('user_interest');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(["first_name","last_name","address","dob"]);
        });
    }
}
