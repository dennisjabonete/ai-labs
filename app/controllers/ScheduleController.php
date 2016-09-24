<?php

class ScheduleController extends BaseController {
	
	public function showStatusBySetupId($id){
		$result = DB::table('tbl_schedule')
		->where('tbl_schedule.project_id', '=', 1)
		->where('tbl_schedule.setup_id', '=', $id)
		->join('tbl_setup', 'tbl_schedule.setup_id', '=', 'tbl_setup.setup_id')
		->select(array(
			'tbl_schedule.schedule_id',
			'tbl_schedule.project_id',
			'tbl_schedule.setup_id',
			'tbl_schedule.is_mood',
			'tbl_schedule.mood_type',
			'tbl_schedule.is_mon',
			'tbl_schedule.is_tue',
			'tbl_schedule.is_wed',
			'tbl_schedule.is_thu',
			'tbl_schedule.is_fri',
			'tbl_schedule.is_sat',
			'tbl_schedule.is_sun',
			'tbl_schedule.switch_status',
			'tbl_schedule.start_time',
			'tbl_schedule.start_time_compare',
			'tbl_schedule.start_time_order',
			'tbl_schedule.end_time',
			'tbl_schedule.is_autooff',
			'tbl_setup.io_pin',
			'tbl_setup.setup_id',
			'tbl_setup.project_id',
			'tbl_setup.description',
			'tbl_setup.io_type',
			'tbl_setup.is_dimmable'
		))
		->orderBy('tbl_schedule.start_time_order', 'ASC')
		->get();

		return Response::json($result);
	}

	public function showUpcomingSchedule(){
		$dayoftheweek = 'tbl_schedule.is_'.strtolower(date('D')).'';
		$currenTime = date('G:i:s'); 
		$result = DB::table('tbl_schedule')
		->where('tbl_schedule.project_id', '=', 1)
		->where(''.$dayoftheweek.'', '=', 1)
		->where('tbl_schedule.start_time_compare', '>=', ''.$currenTime.'')
		->join('tbl_setup', 'tbl_schedule.setup_id', '=', 'tbl_setup.setup_id')
		->select(array(
			'tbl_schedule.schedule_id',
			'tbl_schedule.project_id',
			'tbl_schedule.setup_id',
			'tbl_schedule.is_mood',
			'tbl_schedule.mood_type',
			'tbl_schedule.is_mon',
			'tbl_schedule.is_tue',
			'tbl_schedule.is_wed',
			'tbl_schedule.is_thu',
			'tbl_schedule.is_fri',
			'tbl_schedule.is_sat',
			'tbl_schedule.is_sun',
			'tbl_schedule.switch_status',
			'tbl_schedule.start_time',
			'tbl_schedule.start_time_compare',
			'tbl_schedule.start_time_order',
			'tbl_schedule.end_time',
			'tbl_schedule.is_autooff',
			'tbl_setup.io_pin',
			'tbl_setup.setup_id',
			'tbl_setup.project_id',
			'tbl_setup.description',
			'tbl_setup.io_type',
			'tbl_setup.is_dimmable'
		))
		->orderBy('tbl_schedule.start_time_order', 'ASC')
		->get();

		return Response::json($result);
	}

	public function postSchedule()
	{
		$messages = array();

		$rules = array( 
	        'id'	 => 'required',
	        'is_mon' => 'required',
	        'is_tue' => 'required',
	        'is_wed' => 'required',
	        'is_thu' => 'required',
	        'is_fri' => 'required',
	        'is_sat' => 'required',
	        'is_sun' => 'required',
	        'timeHr' => 'required',
	        'timeMn' => 'required',
	        'timeBc' => 'required',
	        'statusValue' => 'required',
		);
	
		$validator = Validator::make(Input::all(), $rules, $messages);

		if($validator->fails()){
			return 'Error occured while Saving Schedule';
		}else{	
			
			$resultSchedule = DB::table('tbl_schedule')
			->where('project_id', '=', 1)
			->where('setup_id', '=', Input::get('id'))
			->get();

			if(count($resultSchedule) < 5){
				
				$timeHR = Input::get('timeHr');
				$timeMN = Input::get('timeMn');
				$timeBC = Input::get('timeBc');
				if($timeMN == 00){
					$timeEMN = '01';
				}else{
					$timeEMN = $timeMN + 1;
				}

				$formatSTime = $timeHR.':'.$timeMN.''.$timeBC;
				$formatETime = $timeHR.':'.$timeEMN.''.$timeBC;
				$format12Time = $timeHR.':'.$timeMN.' '.strtolower($timeBC);
				$formatTimeCampare = date('H:i:s', strtotime($format12Time));
				$formatTimeOrder = $timeBC.'-'.$timeHR.':'.$timeMN;	

				$dayoftheweek = 'is_'.strtolower(date('D')).'';
				$resultScheduleStartTime = DB::table('tbl_schedule')
				->where('project_id', '=', 1)
				->where('setup_id', '=', Input::get('id'))
				->where('is_mon', '=', Input::get('is_mon'))
				->where('is_tue', '=', Input::get('is_tue'))
				->where('is_wed', '=', Input::get('is_wed'))
				->where('is_thu', '=', Input::get('is_thu'))
				->where('is_fri', '=', Input::get('is_fri'))
				->where('is_sat', '=', Input::get('is_sat'))
				->where('is_sun', '=', Input::get('is_sun'))
				->where('start_time', '=', $formatSTime)
				->get();

				if(count($resultScheduleStartTime) == 0){
					$schedule = new Schedule();
					$schedule->project_id = 1;
					$schedule->setup_id = Input::get('id');
					$schedule->is_mood = 0;
					$schedule->mood_type = 0;
					$schedule->is_mon = Input::get('is_mon');
					$schedule->is_tue = Input::get('is_tue');
					$schedule->is_wed = Input::get('is_wed');
					$schedule->is_thu = Input::get('is_thu');
					$schedule->is_fri = Input::get('is_fri');
					$schedule->is_sat = Input::get('is_sat');
					$schedule->is_sun = Input::get('is_sun');
					$schedule->switch_status = Input::get('statusValue');
					$schedule->start_time = $formatSTime;
					$schedule->start_time_compare = $formatTimeCampare;
					$schedule->start_time_order = $formatTimeOrder;
					$schedule->end_time = $formatETime;
					$schedule->created_at = date('Y-m-d H:i:s');
					$schedule->updated_at = date('Y-m-d H:i:s');
					if($schedule->save()){
						return 'You have successfully set schedule';
					}else{
						return 'An error occured while inserting schedule';
					}
				}else{
					return 1;	
				}
			}else{
				return 0;
			}
		}

	}

	// public function putSchedule()
	// {
	// 	$messages = array();

	// 	$rules = array( 
	//         'id'	=> 'required',
	//         'scheduletype'	=> 'required',
	//         'startTime'	=> 'required',
	//         'endTime'	=> 'required',
	//         'statusValue' => 'required',
	// 	);
	
	// 	$validator = Validator::make(Input::all(), $rules, $messages);

	// 	if($validator->fails()){
	// 		return 'Error occured while Saving Schedule';
	// 	}else{	
	// 		$fields = array(
	// 			'start_time'	=> Input::get('startTime'),
	// 			'end_time' => Input::get('endTime'),
	// 			'is_schedule' => Input::get('scheduletype'),
	// 			'switch_status' => Input::get('statusValue')
	// 		);

	// 		$updateProcess = Schedule::where('schedule_id', '=', Input::get('id'))->update($fields);

	// 		if($updateProcess){
	// 			return 'You have successfully updated Schedule';
	// 		}else{
	// 			return 'An error occured while updating Schedule';
	// 		}

	// 	}

	// }

	public function deleteScheduleBySetupId($id)
	{
		$messages = array();

		$rules = array('id'	=> 'required',);

		$validator = Validator::make(Input::all(), $rules, $messages);

		if($validator->fails()){
			return 'Error occured while Deleting Schedule';
		}else{	
			$deleteProcess = Schedule::where('schedule_id', '=', Input::get('id'))->where('project_id', '=', 1)->delete();
			if($deleteProcess){
				return 'You have successfully Delete Schedule';
			}else{
				return 'An error occured while Delete Schedule';
			}
		}
	}

}
