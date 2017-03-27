@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Other Icons Settings
                </div>
                <div class="panel-body">
                    {!! Form::open(array('url'=>'icons/otherSettings','method'=>'POST', 'class'=>'form-horizontal')) !!}
                        <div class="form-group">
                            <label for="IconsonScreen" class="col-sm-4 control-label">Icons on Screen (Rows*Columns): </label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="numberOfRows" name="numberOfRows" value="{!! Cache::get('numberOfRows', 8) !!}">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" id="numberOfColumns" name="numberOfColumns" value="{!! Cache::get('numberOfColumns', 10) !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="chcRounds" class="col-sm-4 control-label">Rounds: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="chcRounds" name="chcRounds" value="{!! Cache::get('chcRounds', 5) !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="chcWrongTrys" class="col-sm-4 control-label">Wrong Trys: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="chcWrongTrys" name="chcWrongTrys" value="{!! Cache::get('chcWrongTrys', 3) !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="loginSessionTimeout" class="col-sm-4 control-label">Login Session Timout (sec): </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="loginSessionTimeout" name="loginSessionTimeout" value="{!! Cache::get('loginSessionTimeout', 60) !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="chcCentroidThreshold" class="col-sm-4 control-label">Centroid Threshold (Diameter): </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="chcCentroidThreshold" name="chcCentroidThreshold" value="{!! Cache::get('chcCentroidThreshold', 100) !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="chcBackground" class="col-sm-4 control-label">CHC Background Color: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="chcBackground" name="chcBackground" value="{!! Cache::get('chcBackground', '333333') !!}">
                            </div>
                        </div>
                        <div class="col-sm-offset-4 col-sm-6">
                            <button type="submit" class="btn btn-default">Save</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New Icon Group
                </div>
                <div class="panel-body">
                    {!! Form::open(array('url'=>'icons/addIconGroup','method'=>'POST', 'class'=>'form-horizontal')) !!}
                        <div class="form-group">
                            <label for="groupName" class="col-sm-4 control-label">Group Name: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="groupName" name="groupName">
                            </div>
                        </div>
                        <div class="col-sm-offset-4 col-sm-6">
                            <button type="submit" class="btn btn-default">Add Group</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add New Icons
                </div>
                <div class="panel-body">
                    {!! Form::open(array('url'=>'icons/addIcons','method'=>'POST', 'class'=>'form-horizontal', 'files'=>true)) !!}
                        <div class="form-group">
                            <label for="iconGroup" class="col-sm-4 control-label">Group Name:</label>
                            <div class="col-sm-6">
                                {{ Form::select('iconGroup', $iconGroups, null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="icons" class="col-sm-4 control-label">Select Icons: </label>
                            <div class="col-sm-6">
                                {!! Form::file('icons[]', ['multiple'=>true, 'class' => 'form-control', 'accept' => 'image/png']) !!}
                            </div>
                        </div>
                        <div class="col-sm-offset-4 col-sm-6">
                            <button type="submit" class="btn btn-default">Add Icons</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
