<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('results');
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('test_id');
            $table->string('title');
            $table->text('value');
            $table->timestamps();
            $table->index('test_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
