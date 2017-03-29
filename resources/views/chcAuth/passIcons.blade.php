<html>
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" type="text/css" href="/css/chc/normalize.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

        <style>
            .no-js #loader { display: none;  }
            .js #loader { display: block; position: absolute; left: 100px; top: 0; }
            .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url(https://media.giphy.com/media/3oKIPexHObhevCXHYA/giphy.gif) center no-repeat #fff;
            }
        </style>
    </head>
    <body background="/login/passwordImage" onclick="showCoords(event)">
        <div class="se-pre-con"></div>
        <div id="large-header" class="large-header">
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
        <script>
            window.onload = function() {
                $(".se-pre-con").fadeOut("slow");
            };
        </script>
    </body>
</html>
