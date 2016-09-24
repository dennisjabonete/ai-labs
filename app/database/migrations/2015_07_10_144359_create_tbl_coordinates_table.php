<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCoordinatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tbl_coordinates', function (Blueprint $table) {
            $table->bigInteger('coordinate_id');
            $table->primary('coordinate_id');
            $table->bigInteger('project_id');
            $table->index('project_id');
            $table->bigInteger('setup_id');
            $table->index('setup_id');            
            $table->integer('coordinates_x');
            $table->integer('coordinates_y');
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
		Schema::drop('tbl_coordinates');
	}

}
