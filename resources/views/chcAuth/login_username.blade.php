@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">CHC Login</div>

                <div class="panel-body">
                    @if ($errors->has('timeout'))
                        <div class="alert alert-info col-sm-12">
                            <strong>Session timeout. Kindly start again.</strong>
                        </div>
                    @endif
                    @if ($errors->has('wrongPassword'))
                        <div class="alert alert-danger col-sm-12">
                            <strong>Incorrect Password!</strong>
                        </div>
                    @endif
                    {!! Form::open(array('url'=>'login','method'=>'POST', 'class'=>'form-horizontal', 'id'=>'loginForm')) !!}
                        <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-sm-4 control-label">Username: </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="username" name="username" value="{!! session('username') !!}" autofocus>

                                @if ($errors->has('username'))
                                    <span>
                                        <strong>Username Doesn't Exist</strong>
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
                            $('#loginForm').submit(function (evt) {
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
