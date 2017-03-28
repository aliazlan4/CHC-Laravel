@extends('layouts.app')

@section('content')
<?php $count = 0; ?>
<div class="container">
    <div class="row">
        <div class="text-center">
            <h1>Icon Groups</h1>
            <h4>Which icon group do you want to use?</h4>
            <hr>
        </div>
    </div>
    <div class="row text-center">
        @foreach($iconGroups as $iconGroup)
            <?php $count1 = 1; ?>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center"><h4 class="panel-title"><strong>{{ $iconGroup->name }}</strong></h4></div>
                    <div class="panel-body">
                        <table class="table table-bordered table-condensed text-center">
                            <tr>
                                @foreach($icons[$count++] as $icon)
                                    <td><img width="{{ $width }}" src="/icons/get/{{ $icon['id'] }}/{{ $width }}"></td>
                                    @if($count1++ % 3 == 0)
                                        </tr><tr>
                                    @endif
                                @endforeach
                            </tr>
                        </table>
                    </div>
                    <div class="panel-footer text-center">
                        <button type="button" class="btn btn-success btn-lg" onclick="setIcongroup({{ $iconGroup->id }})">Select</button>
                    </div>
                </div>
            </div>
            @if($count % 3 == 0)
                </div><div class="row">
            @endif
        @endforeach
    </div>
    {!! Form::open(array('method'=>'POST', 'id'=>'selectIcongroup')) !!}
        <input type="hidden" id="icongroup" name="icongroup">
    {!! Form::close() !!}

    <script>
        function setIcongroup(icongroup){
            jQuery(document).ready(function(){
                $("#icongroup").val(icongroup);
                $('#selectIcongroup').submit();
            });
        }
    </script>
</div>
@endsection
