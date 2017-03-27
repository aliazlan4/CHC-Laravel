@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="text-center">
            <h1>CHC Schemes</h1>
            <h4>Which scheme do you want to use as your authentication method?</h4>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading text-center"><h4 class="panel-title"><strong>CHC</strong></h4></div>
                <div class="panel-body">
                    <img src='https://speckycdn-sdm.netdna-ssl.com/wp-content/uploads/2014/06/new_icon_set_14.jpg' width='100%'>
                    <h4>You only have to click in the imaginary convex hull formed by your pass icons.</h4>
                    <ul><h4>Usability <span class="badge">High</span></h4></ul>
                    <ul><h4>Security <span class="badge">Low</span></h4></ul>
                </div>
                <div class="panel-footer text-center">
                    <button type="button" class="btn btn-success btn-lg">Select</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading text-center"><h4 class="panel-title"><strong>Co-CHC</strong></h4></div>
                <div class="panel-body">
                    <img src='https://speckycdn-sdm.netdna-ssl.com/wp-content/uploads/2014/06/new_icon_set_14.jpg' width='100%'>
                    <h4>You have to click near the center of the imaginary convex hull formed by your pass icons.</h4>
                    <ul><h4>Usability <span class="badge">Medium</span></h4></ul>
                    <ul><h4>Security <span class="badge">Medium</span></h4></ul>
                </div>
                <div class="panel-footer text-center">
                    <button type="button" class="btn btn-success btn-lg">Select</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading text-center"><h4 class="panel-title"><strong>Rogue-CHC</strong></h4></div>
                <div class="panel-body">
                    <img src='https://speckycdn-sdm.netdna-ssl.com/wp-content/uploads/2014/06/new_icon_set_14.jpg' width='100%'>
                    <h4>You have to click near any one of the 4 points where X-axix and Y-axis intersects the imaginary convex hull formed by your pass icons. Click should be outside the convex hull.</h4>
                    <ul><h4>Usability <span class="badge">Low</span></h4></ul>
                    <ul><h4>Security <span class="badge">High</span></h4></ul>
                </div>
                <div class="panel-footer text-center">
                    <button type="button" class="btn btn-success btn-lg">Select</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
