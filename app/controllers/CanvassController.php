<?php

class CanvassController extends BaseController {

	public function showIndex()
	{
		// Project Details
		$project = DB::table('tbl_project')
		->where('project_id', '=', 1)
		->first();

		// Setup Details
		$setup = DB::table('tbl_setup')
		->where('project_id', '=', 1)
		->get();
		
		return View::make('canvass.index')
			->with('project', $project)
			->with('setup', $setup);
	}

	public function getMoodId($id)
	{
		$result = DB::table('tbl_mood_settings')
		->where('tbl_mood_settings.project_id', '=', 1)
		->where('tbl_mood_settings.mood_type', '=', $id)
		->orderBy('tbl_mood_settings.start_time_order', 'ASC')
		->get();

		return Response::json($result);
	}

	public function getSingleMoodId($id)
	{
		$result = DB::table('tbl_mood_settings')
		->where('tbl_mood_settings.project_id', '=', 1)
		->where('tbl_mood_settings.mood_id', '=', $id)
		->first();

		return Response::json($result);
	}
}
