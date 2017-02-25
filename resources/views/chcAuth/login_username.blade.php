@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">CHC Login</div>

                <div class="panel-body">
                    {!! Form::open(array('url'=>'login/checkUsername','method'=>'POST', 'class'=>'form-horizontal')) !!}
                        <div class="form-group {{ $errors->any() ? ' has-error' : '' }}">
                            <label for="username" class="col-sm-4 control-label">Username: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="username" name="username" value="{!! Cache::get('username') !!}" autofocus>
                            </div>
                            @if ($errors->any())
                                <span class="col-sm-offset-4 col-sm-6">
                                    <strong>Username Doesn't Exist</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-sm-offset-4 col-sm-6">
                            <button type="submit" class="btn btn-default">Next</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
