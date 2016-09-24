<?php

class SetupController extends BaseController {

	public function switchstatus()
	{
		/* UPDATE SWITCH STATUS */
		$fields = array('is_on'	=> Input::get('status'));
		$updateProcess = Setup::where('setup_id', '=', Input::get('id'))->update($fields);
	
		/* INSERT SWITCH STATUS */
		$swstatus = new Switchstatus();
		$swstatus->setup_id = Input::get('id');
		$swstatus->switch_status = Input::get('status');
		$swstatus->save();
	}
	
}