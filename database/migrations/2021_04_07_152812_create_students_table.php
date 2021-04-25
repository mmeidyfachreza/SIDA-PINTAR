<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nis',20)->unique();
            $table->string('name',50);
            $table->text('address');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('religion');
            $table->enum("gender",["Laki-laki","Perempuan"]);
            $table->enum("level",["sd","smp"]);
            $table->string('father_name');
            $table->string('father_phone');
            $table->string('mother_name');
            $table->string('mother_phone');
            $table->string('guardian_name')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->string('school');
            $table->string('entry_year');
            $table->string('graduated_year');
            $table->string('certificate')->nullable();
            $table->string('statement_letter')->nullable();
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
        Schema::dropIfExists('students');
    }
}
