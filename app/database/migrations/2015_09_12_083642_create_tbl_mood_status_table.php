<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblMoodStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tbl_mood_status', function (Blueprint $table) {
        	$table->bigInteger('mood_status_id');
            $table->bigInteger('mood_id');
            $table->bigInteger('setup_id');
            $table->index('setup_id');   
            $table->integer('switch_status');
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
		Schema::drop('tbl_mood_status');
	}

}
