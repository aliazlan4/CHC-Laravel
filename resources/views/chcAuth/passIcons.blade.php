<html>
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" type="text/css" href="/css/chc/normalize.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    </head>
    <body background="/login/passwordImage" onclick="showCoords(event)">
        <div id="large-header" class="large-header">
            <!-- <div style="color:white;">
                <h1>Round Number: {!! session('chcRound') !!} / {!! Cache::get('chcRounds', 5) !!}</h1>
                <h1>Wrong Trys: {!! session('chcWrongTrys') !!} / {!! Cache::get('chcWrongTrys', 3) !!}</h1>
            </div> -->
            <canvas id="canvas"></canvas>
            {!! Form::open(array('url'=>'login/authenticate','method'=>'POST','id'=>'clickForm')) !!}
                <input type="hidden" id="x_val" name="x_val">
                <input type="hidden" id="y_val" name="y_val">
            {!! Form::close() !!}

		</div>

        <script>
            document.addEventListener('contextmenu', event => event.preventDefault());
            function showCoords(event) {
                var x = event.clientX;
                var y = event.clientY;
                jQuery(document).ready(function(){
                    $("#x_val").val(x);
                    $("#y_val").val(y);
                    $('#clickForm').submit();
                });
            }
        </script>
        <script src="/js/chc/TweenLite.min.js"></script>
		<script src="/js/chc/EasePack.min.js"></script>
		<script src="/js/chc/annimate.js"></script>
    </body>
</html>
