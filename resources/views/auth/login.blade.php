@extends('app')
@section('title')
    Login - svceco.com
@endsection
@section('content')
    <section id="LoginWrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    @if (count($errors) > 0)
                            <div class="alert alert-danger" style="margin-top:5px">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <div class="LgonBox">
                        <h2>Welcome To svceco</h2>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <ul>
                            <li><input type="text" class="username" name="email" placeholder="E-Mail Address" value="{{ old('email') }}"/></li>
                            <li><input type="password" class="userpass" name="password" placeholder="password" /></li>
                            <li><input type="checkbox" name="remember">Remember Me <a href="{{ url('/password/email') }}">Forget your Password?</a></li>
                            <li><input type="submit" value="Login" /></li>
                        </ul>
                        </form>
                        <div class="LgonBoxFotter">
                            Not a member ? <a href="/register">Sign up now!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
