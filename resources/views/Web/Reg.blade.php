@extends('Layout.infoView')
@section('content')
    <br>
    <div class="mui-panel">
    {!! Form::open(['url'=>asset('/regFunction'),'class'=>'mui-form']) !!}
        <div class="mui-textfield mui-textfield--float-label">
            {!! Form::text('account',null) !!}
            <label>请输入账号</label>
        </div>
        <div class="mui-textfield mui-textfield--float-label">
            {!! Form::password('passwd',null) !!}
            <label>请输入密码</label>
        </div>
        <div class="mui-textfield mui-textfield--float-label">
            {!! Form::password('passwd_confirmation',null) !!}
            <label>请确认密码</label>
        </div>
        <div class="mui-textfield mui-textfield--float-label">
            {!! Form::email('email',null) !!}
            <label>请输入邮箱</label>
        </div>
        <div class="mui-textfield mui-textfield--float-label">
            {!! Form::email('code',null) !!}
            <label>请输入验证码</label>
        </div>
        <div class="mui-textfield mui-textfield--float-label">

        </div>
        @foreach($errors -> all() as $error)
            <div class="mui-panel">
                <span class="mui--text-danger"><i class="fa fa-exclamation-triangle"></i>{{ $error }}</span>
            </div>
        @endforeach
        <div class="mui--text-button mui--text-center">
            {!! Form::submit('立即注册',['class'=>'mui-btn mui-btn--raised mui-btn--primary']) !!}
        </div>
        <div class="mui-divider"></div>
        <div class="mui--text-button mui--text-center">
            <span class="mui--text-button">已经有账号了?</span><a href="{{ URL::asset('login.html') }}"> 立即登录 </a>
        </div>

    {!! Form::close() !!}
    </div>

@endsection