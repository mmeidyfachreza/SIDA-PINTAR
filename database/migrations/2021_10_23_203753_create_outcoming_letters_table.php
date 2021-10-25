<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutcomingLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outcoming_letters', function (Blueprint $table) {
            $table->id();
            $table->string("ref_number");
            $table->date("date");
            $table->string("purpose");
            $table->text("content");
            $table->string("type",50);
            $table->string("validator",50);
            $table->text("description");
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
        Schema::dropIfExists('outcoming_letters');
    }
}
