<?php

use Illuminate\Auth\UserInterface;

class Project extends Eloquent {

	protected $primaryKey = 'project_id';

	public $incrementing = false;

	protected $table = 'tbl_project';

	public function setup() 
	{
        return $this->hasMany('Setup', 'project_id');
    }

    public function coordinates() 
	{
        return $this->hasMany('Coordinates', 'project_id');
    }

}
