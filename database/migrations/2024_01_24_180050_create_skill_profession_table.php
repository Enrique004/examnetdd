<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillProfessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_profession', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('profession_id');
            $table->foreign('profession_id')
                ->references('id')
                ->on('professions');

            $table->unsignedBigInteger('skill_id');
            $table->foreign('skill_id')
                ->references('id')
                ->on('skills');

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
        Schema::dropIfExists('skill_profession');
    }
}
