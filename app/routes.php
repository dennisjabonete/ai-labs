<?php
Route::group(array('before' => 'guest'), function()
{

	Route::get('/unit', array('uses' => 'UnitController@index', 'as' => 'index'));
	Route::get('/api/v1/canvass/setup', array('uses' => 'UnitController@canvasssetup', 'as' => 'canvasssetup'));
	Route::get('/api/v1/switch/setup', array('uses' => 'UnitController@switchsetup', 'as' => 'switchsetup'));
	Route::post('/api/v1/switch', array('uses' => 'SetupController@switchstatus', 'as' => 'switchstatus'));

});