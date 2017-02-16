@extends('Layout.infoView')
@section('content')
    <br>
    <div class="mui-panel">
        {{$configData['game_intro']}}
    </div>
    <div class="mui-panel">
        <div class="mui-divider"></div>
        <div class="mui-row">
            <div class="mui-col-xs-12 mui-col-md-8">
                <span class="mui--text-display1">请选择大区:</span>
            </div>

            @foreach($serverGroup as $serverList)
                <div class="mui-col-xs-12 mui-col-md-8">
                    <a href="{{ URL::asset('/joinGame/'.$serverList -> id) }}" class="mui-btn mui-btn--danger mui-btn--raised">{{ $serverList -> name }}</a>
                </div>
                <br>
            @endforeach

        </div>
        <div class="mui-divider"></div>
        <div class="mui-col-xs-12 mui-col-md-8">
            <span class="mui--text-button"><i class="fa fa-square mui--text-danger"></i>为火爆,<i
                        class="fa fa-square mui--text-accent"></i>为繁忙,<i class="fa fa-square" style="color: #2a88bd"></i>为正常</span>
        </div>

    </div>
@endsection