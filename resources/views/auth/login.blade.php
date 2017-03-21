@include('layouts.header')


<body class="login-page">
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);">Appleholidays</a>
        <small>Sales Tracking System</small>
    </div>
    <div class="card">
        <div class="body">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <div class="msg">Log In</div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                    <div class="form-line">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <small style="color: red;">{{ $errors->first('email') }}</small>
                                    </span>
                        @endif


                    </div>
                </div>

                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input id="password" type="password" class="form-control" name="password" required>


                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <Small style="color:red;">{{ $errors->first('password') }}</Small>
                                    </span>
                        @endif

                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="remember" id="rememberme" class="filled-in chk-col-pink">
                        <label for="rememberme">Remember Me</label>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">

                    <div class="col-xs-6 align-right">
                        <a href="{{ url('/password/reset') }}">Forgot Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>