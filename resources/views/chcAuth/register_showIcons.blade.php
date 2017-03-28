@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <div style="font-size:22px"><b>Select Icons</b></div>
                    <small>You should select at least 3 & at max 6 Icons</small>
                </div>
                <div class="panel-body" style="max-height:400px; overflow-y:scroll;">
                    <table class="table table-bordered table-condensed text-center">
                        <tr>
                            @foreach($icons as $icon)
                                <td id="box_{{ $icon->id }}" onclick="clicked({{ $icon->id }})"><img width="{{ $width }}" src="/icons/get/{{ $icon->id }}/{{ $width }}"></td>
                                @if($count++ % 10 == 0)
                                    </tr><tr>
                                @endif
                            @endforeach
                        </tr>
                    </table>
                </div>
                <div class="panel-footer text-center">
                    <div class="row">
                        <div class="text-center col-sm-10">
                            <div style="font-size:22px">Selected Icons: <span id="selectedIconsNumber" class="badge">0</span></div>
                        </div>
                        <div class="text-right col-sm-2">
                            <button id="finishSignup" type="button" class="btn btn-danger btn-lg" onclick="finish()" disabled>Finish Signup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::open(array('method'=>'POST', 'id'=>'selectedIconsForms')) !!}
        <input type="hidden" id="selectedIcons" name="selectedIcons">
    {!! Form::close() !!}
    <script>
        var selectedIcons = new Array();
        function clicked(icon){
            jQuery(document).ready(function(){
                if(jQuery.inArray(icon,selectedIcons) == -1){
                    if(selectedIcons.length == {{ $maxIcons }})
                        return;
                    selectedIcons.push(icon);
                    $("#box_" + icon).attr("class", "success");
                }
                else{
                    selectedIcons.splice($.inArray(icon, selectedIcons),1);
                    $("#box_" + icon).attr("class", "");
                }

                if(selectedIcons.length >= {{ $minIcons }}){
                    $("#finishSignup").attr("class", "btn btn-primary btn-lg");
                    $('#finishSignup').removeAttr('disabled');
                }
                else{
                    $("#finishSignup").attr("class", "btn btn-danger btn-lg");
                    $("#finishSignup").attr('disabled','disabled');
                }

                $('#selectedIconsNumber').text(selectedIcons.length);
            });
        }

        function finish(){
            jQuery(document).ready(function(){
                $("#selectedIcons").val(selectedIcons.join());
                $('#selectedIconsForms').submit();
            });
        }
    </script>
</div>
@endsection
