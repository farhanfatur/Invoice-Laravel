<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->enum("name", ["admin", "user"])->default("user");
            $table->integer("user_id")->unsigned();
            $table->integer("admin_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("admin_id")->references("id")->on("admins")->onDelete("cascade");
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
        Schema::dropIfExists('statuses');
    }
}
