<?php

class ActionController extends BaseController {

	public function postAction()
	{
		/* UPDATE SWITCH STATUS */
		$fields = array(
			'is_on'	=> Input::get('value')
		);

		$updateProcess = Setup::where('setup_id', '=', Input::get('id'))->update($fields);
	
		/* INSERT SWITCH STATUS */
		$swstatus = new Switchstatus();
		$swstatus->setup_id = Input::get('id');
		$swstatus->switch_status = Input::get('value');
		$swstatus->save();
	}

	public function postAction()
	{
		/* UPDATE SWITCH STATUS */
		$fields = array(
			'is_on'	=> Input::get('value')
		);

		$updateProcess = Setup::where('setup_id', '=', Input::get('id'))->update($fields);
	
		/* INSERT SWITCH STATUS */
		$swstatus = new Switchstatus();
		$swstatus->setup_id = Input::get('id');
		$swstatus->switch_status = Input::get('value');
		$swstatus->save();
	}

}
