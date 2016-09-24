<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblSetupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tbl_setup', function (Blueprint $table) {
            $table->bigInteger('setup_id');
            $table->primary('setup_id');
            $table->bigInteger('device_id');
            $table->index('device_id');            
            $table->bigInteger('project_id');
            $table->index('project_id');
            $table->longText('description');
            $table->integer('control_type_id');
            $table->string('io_type');
            $table->string('io_pin');
            $table->string('image');
            $table->integer('unused');
            $table->bigInteger('location_id');
            $table->bigInteger('room_id');
            $table->integer('is_on');
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
        Schema::drop('tbl_setup');
	}

}
