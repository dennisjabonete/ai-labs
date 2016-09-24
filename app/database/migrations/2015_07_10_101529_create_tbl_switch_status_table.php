<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblSwitchStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tbl_switch_status', function (Blueprint $table) {
            $table->bigInteger('switch_id');
            $table->primary('switch_id');
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
        Schema::drop('tbl_switch_status');
	}

}
