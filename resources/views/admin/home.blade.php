@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    Other Icons Settings
                </div>
                <div class="panel-body">
                    {!! Form::open(array('url'=>'icons/otherSettings','method'=>'POST', 'class'=>'form-horizontal')) !!}
                        <div class="form-group">
                            <label for="maxIconsonScreen" class="col-sm-4 control-label">Max Icons on Screen: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="maxIconsonScreen" name="maxIconsonScreen" value="{!! Cache::get('maxIconsOnScreen', 80) !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="chcRounds" class="col-sm-4 control-label">Rounds: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="chcRounds" name="chcRounds" value="{!! Cache::get('chcRounds', 5) !!}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="loginSessionTimeout" class="col-sm-4 control-label">Login Session Timout (min): </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="loginSessionTimeout" name="loginSessionTimeout" value="{!! Cache::get('loginSessionTimeout', 1) !!}">
                            </div>
                        </div>
                        <div class="col-sm-offset-4 col-sm-6">
                            <button type="submit" class="btn btn-default">Save</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
