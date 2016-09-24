<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblProjectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tbl_project', function (Blueprint $table) {
            $table->bigInteger('project_id');
            $table->primary('project_id');
            $table->bigInteger('login_id');
            $table->index('login_id');
            $table->string('project_name');
            $table->string('project_type');
            $table->longText('project_description');
            $table->longText('project_area');
            $table->string('customer_firstname');
            $table->string('customer_lastname');
            $table->string('customer_email');
            $table->string('customer_contact_number');
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
        Schema::drop('tbl_project');
	}

}
