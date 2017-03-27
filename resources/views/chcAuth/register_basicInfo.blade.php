@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">CHC Register</div>

                <div class="panel-body">
                    {!! Form::open(array('url'=>'register','method'=>'POST', 'class'=>'form-horizontal', 'id'=>'registerForm')) !!}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                            <label for="username" class="col-sm-4 control-label">Username: </label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="username" name="username" value="{!! old('username') !!}" required>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <input type="hidden" id="screenWidth" name="screenWidth">
                        <input type="hidden" id="screenHeight" name="screenHeight">
                        <div class="col-sm-offset-4 col-sm-6">
                            <button type="submit" class="btn btn-primary">Next</button>
                        </div>
                    {!! Form::close() !!}

                    <script>
                        var w  = window,
                        d  = w.document,
                        de = d.documentElement,
                        db = d.body || d.getElementsByTagName('body')[0],
                        x  = w.innerWidth || de.clientWidth || db.clientWidth,
                        y  = w.innerHeight|| de.clientHeight|| db.clientHeight;

                        jQuery(document).ready(function(){
                            $('#registerForm').submit(function (evt) {
                                $("#screenWidth").val(x);
                                $("#screenHeight").val(y);
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
