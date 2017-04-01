@extends('Layout.infoView')
@section('content')
    <br>
    <div class="mui-panel">
        {!! Form::open(['url'=>asset('/loginFunction'),'class'=>'mui-form']) !!}
        <div class="mui-textfield mui-textfield--float-label">
            {!! Form::text('username',null) !!}
            <label>请输入账号</label>
        </div>
        <div class="mui-textfield mui-textfield--float-label">
            {!! Form::password('passwd',null) !!}
            <label>请输入密码</label>
        </div>

            @foreach($errors -> all() as $error)
                <div class="mui-panel">
                    <span class="mui--text-danger"><i class="fa fa-exclamation-triangle"></i>{{ $error }}</span>
                </div>
            @endforeach

        {!! Form::submit('立即登录',['class'=>'mui-btn mui-btn--raised mui-btn--primary']) !!}
        <a href="{{ URL::asset('/reg.html') }}" class="mui-btn mui-btn--raised mui-btn--primary">注册账号</a>
        {!! Form::close() !!}
    </div>

@endsection