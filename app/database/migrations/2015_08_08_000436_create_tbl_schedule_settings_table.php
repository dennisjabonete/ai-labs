<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblScheduleSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tbl_schedule_settings', function (Blueprint $table) {
            $table->bigInteger('schedule_id');
            $table->bigInteger('project_id');
            $table->index('project_id');
            $table->bigInteger('setup_id');
            $table->index('setup_id');            
            $table->date('start_date');
            $table->index('start_date');
            $table->string('start_time');
            $table->index('start_time');
            $table->date('end_date');
            $table->index('end_date');
            $table->string('end_time');
            $table->index('end_time');
            $table->integer('is_type');
            $table->index('is_type');
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
		Schema::drop('tbl_schedule_settings');
	}

}
