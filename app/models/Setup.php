<?php

use Illuminate\Auth\UserInterface;

class Setup extends Eloquent {

	protected $primaryKey = 'setup_id';

	protected $table = 'tbl_setup';

	public function project() 
	{
        return $this->belongsTo('Project', 'project_id');
    }

	public function coordinates() 
	{
        return $this->hasMany('Coordinates', 'setup_id');
    }
}
