<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblProjectDevicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tbl_project_devices', function (Blueprint $table) {
            $table->bigInteger('device_id');
            $table->primary('device_id');
            $table->bigInteger('project_id');
            $table->index('project_id');
            $table->longText('device_description');
            $table->string('ip_address');
            $table->string('mac_address');
            $table->integer('is_server');
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
        Schema::drop('tbl_project_devices');
	}

}
