<?php

class UnitController extends BaseController {

	public function index()
	{
		$project = new Project;

		$data['project'] = $project->where('project_id', '=', 1)->first();
		return View::make('index')->with('data', $data);
	}

	public function switchsetup()
	{
		$project = new Project;

		$data['project'] = $project->where('project_id', '=', 1)->first();
		return View::make('api.switch_setup')->with('data', $data);
	}

	public function canvasssetup()
	{
		$project = new Project;

		$data['project'] = $project->where('project_id', '=', 1)->first();
		return View::make('api.canvass_switch_setup')->with('data', $data);
	}
}
