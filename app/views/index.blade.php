@extends('layouts.master')

@section('header')
	@parent
	<title>AI Homes: : {{ $data['project']->project_name }}</title>
@stop

@section('content')

	<div class="container-fluid">
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <div class="panel-group" id="accordion">
                <div class="panel">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <span class="glyphicon glyphicon-record" aria-hidden="true"></span> MOODS
                        </a>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                    	<div class="row">
                            <div class="col-md-1"><a href="#"><span class="badge">1</span></a></div>
                            <div class="col-md-1"><a href="#"><span class="badge">2</span></a></div>
                            <div class="col-md-1"><a href="#"><span class="badge">3</span></a></div>
                            <div class="col-md-1"><a href="#"><span class="badge">4</span></a></div>
                            <div class="col-md-1"><a href="#"><span class="badge">5</span></a></div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        <div class="col-md-10 text-muted">Living Room Pin Lights</div>
                                        <div class="col-md-2"><span class="badge on">&nbsp;</span></div>
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <p>
                                        <div class="col-md-10 text-muted">Cove Panel</div>
                                        <div class="col-md-2"><span class="badge on">&nbsp;</span></div>
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <p>
                                        <div class="col-md-10 text-muted">Panel Lights</div>
                                        <div class="col-md-2"><span class="badge off">&nbsp;</span></div>
                                    </p>
                                </div>
                                <div class="col-md-12">
                                    <p> 
                                        <div class="col-md-10 text-muted">Bedroom Main Lights</div>
                                        <div class="col-md-2"><span class="badge on">&nbsp;</span></div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            <span class="glyphicon glyphicon-stats" aria-hidden="true"></span> STATUS
                        </a>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                            	<div id="setup_result"></div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-heading">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> SCHEDULE
                        </a>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>
                                        <div class="col-md-9 text-muted"><span class="badge on">&nbsp;</span> Bedroom Pin Lights</div>
                                        <div class="col-md-3 text-muted">02:00AM</div>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel">
                    <div class="panel-heading">
                        <a href="javascript;" data-toggle="modal" data-target=".bd-example-modal-lg">
                            <span class="glyphicon glyphicon-modal-window" aria-hidden="true"></span> CUSTOMIZE
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bgimg">
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; {{ $data['project']->project_name }}</span> 
            <div id="canvass_setup_result"></div> 
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header"><h4 class="modal-title">CUSTOMIZE</h4></div>
                <div class="modal-body">
                    <div class="row with-padding">
                        <div class="col-md-8">
                            <select class="form-control">
                                <option>Select Control</option>
                                @foreach($data['project']->setup as $setup)
                                	<option value="{{ $setup->setup_id }}">{{ $setup->description }}</option>
                                @endforeach 
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control">
                                <option>ON</option>
                                <option>OFF</option>
                            </select>
                        </div>
                    </div>
                    <div class="row with-padding">
                        <div class="col-md-12">
                            <div class="panel panel-default bottom-zero">
                                <div class="panel-body white-bg">
                                    <div class="col-md-12">Moods</div>
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> 1
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> 2
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> 3
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> 4
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> 5
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row with-padding">
                        <div class="col-md-12">
                            <div class="panel panel-default bottom-zero">
                                <div class="panel-body white-bg">
                                    <div class="col-md-12">Schedule</div>
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> M
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> T
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> W
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> T
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> F
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> S
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="checkbox">
                                            <label style="color: red;">
                                                <input type="checkbox"> S
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">Time</div>
                                    <div class="col-md-4">
                                        <select class="form-control">
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            <option>05</option>
                                            <option>06</option>
                                            <option>07</option>
                                            <option>08</option>
                                            <option>09</option>
                                            <option>10</option>
                                            <option>11</option>
                                            <option>12</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control">
                                            <option>00</option>
                                            <option>15</option>
                                            <option>30</option>
                                            <option>45</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control">
                                            <option>AM</option>
                                            <option>PM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary fullwidth">SAVE</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
<script>
function openNav() {
	document.getElementById("mySidenav").style.width = "250px";
}
function closeNav() {
	document.getElementById("mySidenav").style.width = "0";
}
</script>
<script src="{{ URL::asset('js/switch.js') }}"></script>
@stop