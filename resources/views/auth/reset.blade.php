@extends('app')
@section('title')
    Reset Password - svceco.com
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
                        <h2>Forgot Password?</h2>
                        <form class="form-horizontal" role="form" method="POST" action="{{ URL::to('/password/reset') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="token" value="{{ $token }}">

                            <ul>
                                <li><input type="text" class="username" name="email" placeholder="E-Mail Address" value="{{ old('email') }}"/></li>
                                <li><input type="password" class="userpass" placeholder="password" name="password"></li>
                                <li><input type="password" class="userpass" placeholder="password" name="password_confirmation"></li>
                                <li><input type="submit" value="Reset Password" /></li>
                            </ul>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
