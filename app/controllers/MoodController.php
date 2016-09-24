<?php

class MoodController extends BaseController {

	public function getThingsMoodId($id)
	{
		$result = DB::table('tbl_mood_status')
		->where('tbl_mood_status.mood_type', '=', $id)
		->join('tbl_setup', 'tbl_mood_status.setup_id', '=', 'tbl_setup.setup_id')
		->get();
		return Response::json($result);
	}
	
	public function getSwitchByMoods($id)
	{
		$result = DB::table('tbl_mood_status')
		->where('tbl_mood_status.mood_type', '=', $id)
		->join('tbl_setup', 'tbl_mood_status.setup_id', '=', 'tbl_setup.setup_id')
		->get();
		return Response::json($result);
	}

	public function putMood()
	{
		$messages = array();

		$rules = array(
			'id'	=> 'required',
	        'moodType'	=> 'required',
	        'mood_mon'	=> 'required',
	        'mood_tue'	=> 'required',
	        'mood_wed'	=> 'required',
	        'mood_thu'	=> 'required',
	        'mood_fri'	=> 'required',
	        'mood_sat'	=> 'required',
	        'mood_sun'	=> 'required',
	        'startTime'	=> 'required',
	        'endTime'	=> 'required',
		);

		$validator = Validator::make(Input::all(), $rules, $messages);

		if($validator->fails()){
			return 'Error occured while Saving Moods';
		}else{	
			$fields = array(
				'mood_type'	=> Input::get('moodType'),
				'mood_mon' => Input::get('mood_mon'),
				'mood_tue' => Input::get('mood_tue'),
				'mood_wed' => Input::get('mood_wed'),
				'mood_thu' => Input::get('mood_thu'),
				'mood_fri' => Input::get('mood_fri'),
				'mood_sat' => Input::get('mood_sat'),
				'mood_sun' => Input::get('mood_sun'),
				'start_time' => Input::get('startTime'),
				'end_time' => Input::get('endTime')
			);

			$updateProcess = Moods::where('mood_id', '=', Input::get('id'))->update($fields);

			if($updateProcess){
				return 'You have successfully updated Mood';
			}else{
				return 'An error occured while updating mood';
			}
		}
	}
	
	public function deleteMood()
	{
		$messages = array();

		$rules = array(
	        'id'	=> 'required',
		);

		$validator = Validator::make(Input::all(), $rules, $messages);

		if($validator->fails()){
			return 'Error occured while Deleting Mood';
		}else{	
			$deleteProcess = Moods::where('mood_id', '=', Input::get('id'))->where('project_id', '=', 1)->delete();

			if($deleteProcess){
				return 'You have successfully Delete Mood';
			}else{
				return 'An error occured while Delete Mood';
			}
		}
	}
///////////////////////////////////
	public function showMoodStatusBySetupId($id){
		$result = DB::table('tbl_mood_status')
		->where('setup_id', '=', $id)
		->orderBy('mood_type', 'ASC')
		->get();

		return Response::json($result);
	}
	
	public function postAddStatusByMood()
	{
		$messages = array();

		$rules = array(
	        'statusValue' => 'required',
	        'moodType1'	=> 'required',
	        'moodType2'	=> 'required',
	        'moodType3'	=> 'required',
	        'moodType4'	=> 'required',
	        'moodType5'	=> 'required',
		);

		$validator = Validator::make(Input::all(), $rules, $messages);

		if($validator->fails()){
			return 'Error occured while Saving Moods';
		}else{	
			//$deleteMoodstatus = Moodstatus::where('setup_id', '=', Input::get('id'))->delete();
			if(Input::get('moodType1') == 1){

				$resultMoodStatus1 = DB::table('tbl_mood_status')
				->where('mood_type', '=', 1)
				->where('setup_id', '=', Input::get('id'))
				->first();

				$resultMoodSettings1 = DB::table('tbl_mood_settings')
				->where('project_id', '=', 1)
				->where('mood_type', '=', 1)
				->get();

				$resultMoodSchedule1 = DB::table('tbl_schedule')
				->where('project_id', '=', 1)
				->where('is_mood', '=', 1)
				->where('mood_type', '=', 1)
				->get();

				if(count($resultMoodSchedule1) == 0){
					foreach ($resultMoodSettings1 as $value) {
						$schedule1 = new Schedule();
						$schedule1->project_id = 1;
						$schedule1->setup_id = Input::get('id');
						$schedule1->is_mood = 1;
						$schedule1->mood_type = 1;
						$schedule1->is_mon = $value->mood_mon;
						$schedule1->is_tue = $value->mood_tue;
						$schedule1->is_wed = $value->mood_wed;
						$schedule1->is_thu = $value->mood_thu;
						$schedule1->is_fri = $value->mood_fri;
						$schedule1->is_sat = $value->mood_sat;
						$schedule1->is_sun = $value->mood_sun;
						$schedule1->switch_status = Input::get('statusValue');
						$schedule1->start_time = $value->start_time;
						$schedule1->start_time_compare = $value->start_time_compare;
						$schedule1->start_time_order = $value->start_time_order;
						$schedule1->end_time = $value->end_time;
						$schedule1->is_autooff = $value->is_autooff;
						$schedule1->created_at = date('Y-m-d H:i:s');
						$schedule1->updated_at = date('Y-m-d H:i:s');
						$schedule1->save();
					}

				}

				if(count($resultMoodStatus1) == 0){
					$mood1 = new Moodstatus();
					$mood1->mood_type = 1;
					$mood1->setup_id = Input::get('id');
					$mood1->switch_status = Input::get('statusValue');
					$mood1->created_at = date('Y-m-d H:i:s');
					$mood1->updated_at = date('Y-m-d H:i:s');
					$mood1->save();	
				}
			}else{
				// $deleteMoodstatus1 = Moodstatus::where('mood_type', '=', 1)->where('setup_id', '=', Input::get('id'))->delete();
				// $deleteSchedule1 = Schedule::where('project_id', '=', 1)->where('setup_id', '=', Input::get('id'))->where('is_mood', '=', 1)->where('mood_type', '=', 1)->delete();
			}

			if(Input::get('moodType2') == 1){

				$resultMoodStatus2 = DB::table('tbl_mood_status')
				->where('mood_type', '=', 2)
				->where('setup_id', '=', Input::get('id'))
				->first();

				var_dump(count($resultMoodStatus2));

				$resultMoodSettings2 = DB::table('tbl_mood_settings')
				->where('project_id', '=', 1)
				->where('mood_type', '=', 2)
				->get();

				$resultMoodSchedule2 = DB::table('tbl_schedule')
				->where('project_id', '=', 1)
				->where('is_mood', '=', 1)
				->where('mood_type', '=', 2)
				->get();

				if(count($resultMoodSchedule2) == 0){
					foreach ($resultMoodSettings2 as $value) {
						$schedule2 = new Schedule();
						$schedule2->project_id = 1;
						$schedule2->setup_id = Input::get('id');
						$schedule2->is_mood = 1;
						$schedule2->mood_type = 2;
						$schedule2->is_mon = $value->mood_mon;
						$schedule2->is_tue = $value->mood_tue;
						$schedule2->is_wed = $value->mood_wed;
						$schedule2->is_thu = $value->mood_thu;
						$schedule2->is_fri = $value->mood_fri;
						$schedule2->is_sat = $value->mood_sat;
						$schedule2->is_sun = $value->mood_sun;
						$schedule2->switch_status = Input::get('statusValue');
						$schedule2->start_time = $value->start_time;
						$schedule2->start_time_compare = $value->start_time_compare;
						$schedule2->start_time_order = $value->start_time_order;
						$schedule2->end_time = $value->end_time;
						$schedule2->is_autooff = $value->is_autooff;
						$schedule2->created_at = date('Y-m-d H:i:s');
						$schedule2->updated_at = date('Y-m-d H:i:s');
						$schedule2->save();
					}
				}

				if(count($resultMoodStatus2) == 0){
					$mood2 = new Moodstatus();
					$mood2->mood_type = 2;
					$mood2->setup_id = Input::get('id');
					$mood2->switch_status = Input::get('statusValue');
					$mood2->created_at = date('Y-m-d H:i:s');
					$mood2->updated_at = date('Y-m-d H:i:s');
					$mood2->save();	
				}			
			}else{
				// $deleteMoodstatus2 = Moodstatus::where('mood_type', '=', 2)->where('setup_id', '=', Input::get('id'))->delete();
				// $deleteSchedule2 = Schedule::where('project_id', '=', 1)->where('setup_id', '=', Input::get('id'))->where('is_mood', '=', 1)->where('mood_type', '=', 2)->delete();
			}

			if(Input::get('moodType3') == 1){
				
				$resultMoodStatus3 = DB::table('tbl_mood_status')
				->where('mood_type', '=', 3)
				->where('setup_id', '=', Input::get('id'))
				->first();

				$resultMoodSettings3 = DB::table('tbl_mood_settings')
				->where('project_id', '=', 1)
				->where('mood_type', '=', 3)
				->get();

				$resultMoodSchedule3 = DB::table('tbl_schedule')
				->where('project_id', '=', 1)
				->where('is_mood', '=', 1)
				->where('mood_type', '=', 3)
				->get();

				if(count($resultMoodSchedule3) == 0){
					foreach ($resultMoodSettings3 as $value) {
						$schedule3 = new Schedule();
						$schedule3->project_id = 1;
						$schedule3->setup_id = Input::get('id');
						$schedule3->is_mood = 1;
						$schedule3->mood_type = 3;
						$schedule3->is_mon = $value->mood_mon;
						$schedule3->is_tue = $value->mood_tue;
						$schedule3->is_wed = $value->mood_wed;
						$schedule3->is_thu = $value->mood_thu;
						$schedule3->is_fri = $value->mood_fri;
						$schedule3->is_sat = $value->mood_sat;
						$schedule3->is_sun = $value->mood_sun;
						$schedule3->switch_status = Input::get('statusValue');
						$schedule3->start_time = $value->start_time;
						$schedule3->start_time_compare = $value->start_time_compare;
						$schedule3->start_time_order = $value->start_time_order;
						$schedule3->end_time = $value->end_time;
						$schedule3->is_autooff = $value->is_autooff;
						$schedule3->created_at = date('Y-m-d H:i:s');
						$schedule3->updated_at = date('Y-m-d H:i:s');
						$schedule3->save();
					}

				}

				if(count($resultMoodStatus3) == 0){
					$mood3 = new Moodstatus();
					$mood3->mood_type = 3;
					$mood3->setup_id = Input::get('id');
					$mood3->switch_status = Input::get('statusValue');
					$mood3->created_at = date('Y-m-d H:i:s');
					$mood3->updated_at = date('Y-m-d H:i:s');
					$mood3->save();				
				}
			}else{
				// $deleteMoodstatus3 = Moodstatus::where('mood_type', '=', 3)->where('setup_id', '=', Input::get('id'))->delete();
				// $deleteSchedule3 = Schedule::where('project_id', '=', 1)->where('setup_id', '=', Input::get('id'))->where('is_mood', '=', 1)->where('mood_type', '=', 3)->delete();
			}

			if(Input::get('moodType4') == 1){

				$resultMoodStatus4 = DB::table('tbl_mood_status')
				->where('mood_type', '=', 4)
				->where('setup_id', '=', Input::get('id'))
				->first();

				$resultMoodSettings4 = DB::table('tbl_mood_settings')
				->where('project_id', '=', 1)
				->where('mood_type', '=', 1)
				->get();

				$resultMoodSchedule4 = DB::table('tbl_schedule')
				->where('project_id', '=', 1)
				->where('is_mood', '=', 1)
				->where('mood_type', '=', 4)
				->get();

				if(count($resultMoodSchedule4) == 0){
					foreach ($resultMoodSettings4 as $value) {
						$schedule4 = new Schedule();
						$schedule4->project_id = 1;
						$schedule4->setup_id = Input::get('id');
						$schedule4->is_mood = 1;
						$schedule4->mood_type = 4;
						$schedule4->is_mon = $value->mood_mon;
						$schedule4->is_tue = $value->mood_tue;
						$schedule4->is_wed = $value->mood_wed;
						$schedule4->is_thu = $value->mood_thu;
						$schedule4->is_fri = $value->mood_fri;
						$schedule4->is_sat = $value->mood_sat;
						$schedule4->is_sun = $value->mood_sun;
						$schedule4->switch_status = Input::get('statusValue');
						$schedule4->start_time = $value->start_time;
						$schedule4->start_time_compare = $value->start_time_compare;
						$schedule4->start_time_order = $value->start_time_order;
						$schedule4->end_time = $value->end_time;
						$schedule4->is_autooff = $value->is_autooff;
						$schedule4->created_at = date('Y-m-d H:i:s');
						$schedule4->updated_at = date('Y-m-d H:i:s');
						$schedule4->save();
					}

				}

				if(count($resultMoodStatus4) == 0){
					$mood4 = new Moodstatus();
					$mood4->mood_type = 4;
					$mood4->setup_id = Input::get('id');
					$mood4->switch_status = Input::get('statusValue');
					$mood4->created_at = date('Y-m-d H:i:s');
					$mood4->updated_at = date('Y-m-d H:i:s');
					$mood4->save();				
				}
			}else{
				// $deleteMoodstatus4 = Moodstatus::where('mood_type', '=', 4)->where('setup_id', '=', Input::get('id'))->delete();
				// $deleteSchedule4 = Schedule::where('project_id', '=', 1)->where('setup_id', '=', Input::get('id'))->where('is_mood', '=', 1)->where('mood_type', '=', 4)->delete();
			}

			if(Input::get('moodType5') == 1){

				$resultMoodStatus5 = DB::table('tbl_mood_status')
				->where('mood_type', '=', 5)
				->where('setup_id', '=', Input::get('id'))
				->first();

				$resultMoodSettings5 = DB::table('tbl_mood_settings')
				->where('project_id', '=', 1)
				->where('mood_type', '=', 5)
				->get();

				$resultMoodSchedule5 = DB::table('tbl_schedule')
				->where('project_id', '=', 1)
				->where('is_mood', '=', 1)
				->where('mood_type', '=', 5)
				->get();

				if(count($resultMoodSchedule5) == 0){
					foreach ($resultMoodSettings5 as $value) {
						$schedule5 = new Schedule();
						$schedule5->project_id = 1;
						$schedule5->setup_id = Input::get('id');
						$schedule5->is_mood = 1;
						$schedule5->mood_type = 5;
						$schedule5->is_mon = $value->mood_mon;
						$schedule5->is_tue = $value->mood_tue;
						$schedule5->is_wed = $value->mood_wed;
						$schedule5->is_thu = $value->mood_thu;
						$schedule5->is_fri = $value->mood_fri;
						$schedule5->is_sat = $value->mood_sat;
						$schedule5->is_sun = $value->mood_sun;
						$schedule5->switch_status = Input::get('statusValue');
						$schedule5->start_time = $value->start_time;
						$schedule5->start_time_compare = $value->start_time_compare;
						$schedule5->start_time_order = $value->start_time_order;
						$schedule5->end_time = $value->end_time;
						$schedule5->is_autooff = $value->is_autooff;
						$schedule5->created_at = date('Y-m-d H:i:s');
						$schedule5->updated_at = date('Y-m-d H:i:s');
						$schedule5->save();
					}

				}

				if(count($resultMoodStatus5) == 0){
					$mood5 = new Moodstatus();
					$mood5->mood_type = 5;
					$mood5->setup_id = Input::get('id');
					$mood5->switch_status = Input::get('statusValue');
					$mood5->created_at = date('Y-m-d H:i:s');
					$mood5->updated_at = date('Y-m-d H:i:s');
					$mood5->save();
				}				
			}else{
				// $deleteMoodstatus5 = Moodstatus::where('mood_type', '=', 5)->where('setup_id', '=', Input::get('id'))->delete();
				// $deleteSchedule5 = Schedule::where('project_id', '=', 1)->where('setup_id', '=', Input::get('id'))->where('is_mood', '=', 1)->where('mood_type', '=', 5)->delete();
			}
		}
	}

	public function postMood()
	{
		$messages = array();

		$rules = array(
	        'moodType'	=> 'required',
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
	        'autooffset' => 'required',
	        'timeAHr' => 'required',
	        'timeAMn' => 'required',
	        'timeABc' => 'required',
		);

		$validator = Validator::make(Input::all(), $rules, $messages);

		if($validator->fails()){
			return 'Error occured while Saving Moods';
		}else{

			$resultMoodSettings = DB::table('tbl_mood_settings')
			->where('project_id', '=', 1)
			->where('mood_type', '=', Input::get('moodType'))
			->get();

			if(count($resultMoodSettings) < 3){
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

				$resultMoodSettingsStartTime = DB::table('tbl_mood_settings')
				->where('project_id', '=', 1)
				->where('mood_type', '=', Input::get('moodType'))
				->where('mood_mon', '=', Input::get('is_mon'))
				->where('mood_tue', '=', Input::get('is_tue'))
				->where('mood_wed', '=', Input::get('is_wed'))
				->where('mood_thu', '=', Input::get('is_thu'))
				->where('mood_fri', '=', Input::get('is_fri'))
				->where('mood_sat', '=', Input::get('is_sat'))
				->where('mood_sun', '=', Input::get('is_sun'))
				->where('start_time', '=', $formatSTime)
				->get();

				if(count($resultMoodSettingsStartTime) == 0){
					$mood = new Moods();
					$mood->project_id = 1;
					$mood->mood_type = Input::get('moodType');
					$mood->mood_mon = Input::get('is_mon');
					$mood->mood_tue = Input::get('is_tue');
					$mood->mood_wed = Input::get('is_wed');
					$mood->mood_thu = Input::get('is_thu');
					$mood->mood_fri = Input::get('is_fri');
					$mood->mood_sat = Input::get('is_sat');
					$mood->mood_sun = Input::get('is_sun');
					$mood->start_time = $formatSTime;
					$mood->start_time_compare = $formatTimeCampare;
					$mood->start_time_order = $formatTimeOrder;
					$mood->end_time = $formatETime;
					$mood->created_at = date('Y-m-d H:i:s');
					$mood->updated_at = date('Y-m-d H:i:s');

					$autooffset = Input::get('autooffset');

					if($autooffset == 1){
						$timeAHR = Input::get('timeAHr');
						$timeAMN = Input::get('timeAMn');
						$timeABC = Input::get('timeABc');
						if($timeAMN == 00){
							$timeAEMN = '01';
						}else{
							$timeAEMN = $timeAMN + 1;
						}

						$formatASTime = $timeAHR.':'.$timeAMN.''.$timeABC;
						$formatAETime = $timeAHR.':'.$timeAEMN.''.$timeABC;
						$formatA12Time = $timeAHR.':'.$timeAMN.' '.strtolower($timeABC);
						$formatATimeCampare = date('H:i:s', strtotime($formatA12Time));
						$formatATimeOrder = $timeABC.'-'.$timeAHR.':'.$timeAMN;	

						$mooda = new Moods();
						$mooda->project_id = 1;
						$mooda->mood_type = Input::get('moodType');
						$mooda->mood_mon = Input::get('is_mon');
						$mooda->mood_tue = Input::get('is_tue');
						$mooda->mood_wed = Input::get('is_wed');
						$mooda->mood_thu = Input::get('is_thu');
						$mooda->mood_fri = Input::get('is_fri');
						$mooda->mood_sat = Input::get('is_sat');
						$mooda->mood_sun = Input::get('is_sun');
						$mooda->start_time = $formatASTime;
						$mooda->start_time_compare = $formatATimeCampare;
						$mooda->start_time_order = $formatATimeOrder;
						$mooda->end_time = $formatAETime;
						$mooda->is_autooff = $autooffset;
						$mooda->created_at = date('Y-m-d H:i:s');
						$mooda->updated_at = date('Y-m-d H:i:s');
						$mooda->save();		
					}

					if($mood->save()){
						return 'You have successfully set Mood';
					}else{
						return 'An error occured while inserting mood';
					}
				}else{
					return 1;	
				}
			}else{
				return 0;
			}
		}
	}
}
