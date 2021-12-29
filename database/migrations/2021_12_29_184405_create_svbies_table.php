<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSvbiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('svbies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sv_id');
            $table->foreign('sv_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');                
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
        Schema::dropIfExists('svbies');
    }
}
