<?php

use Illuminate\Auth\UserInterface;

class Coordinates extends Eloquent {

	protected $primaryKey = 'coordinate_id';

	protected $table = 'tbl_coordinates';

	public function project() 
	{
        return $this->belongsTo('Project', 'project_id');
    }

	public function setup() 
	{
        return $this->belongsTo('Setup', 'setup_id');
    }
}
