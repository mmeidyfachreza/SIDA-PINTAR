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
            $table->string('father_name');
            $table->string('father_phone');
            $table->string('mother_name');
            $table->string('mother_phone');
            $table->string('guardian_name')->nullable();
            $table->string('guardian_phone')->nullable();
            $table->bigInteger('school_id')->unsigned()->nullable();
            $table->foreign('school_id')->references('id')->on('schools')->nullOnDelete();
            $table->string('entry_year');
            $table->string('graduated_year');
            $table->string('ijazah')->nullable();
            $table->string('ijazah_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
        });
        Schema::dropIfExists('students');
    }
}
