@extends('app')
@section('title')
    Register an Account - svceco.com
@endsection
@section('content')
    <section class="bannertxt" id="signup01">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h1>Volunteer & Serve Your Community.</h1>
                    <h3>Create Your Account</h3>
                </div>
            </div>
        </div>

    </section>
    <section id="signup01Steps">
        <div class="container">
            <div class="row">
                <div class="mb15 col-md-4 col-sm-4">
                    <div class="signuptype one">
                        <div class="imgthumb"><img src="{{ asset('images/signuptype_01hover.png') }}" alt="" /><img class="top"  src="{{ asset('images/signuptype_01.jpg') }}" alt="" /></div>
                        <p>Volunteer</p>
                        <a href="{{ url('/register/volunteer') }}">Create Account</a>
                    </div>
                </div>
                <div class="mb15 col-md-4 col-sm-4">
                    <div class="signuptype two">
                        <div class="imgthumb "><img src="{{ asset('images/signuptype_02hover.png') }}" alt="" /><img class="top" src="{{ asset('images/signuptype_02.jpg') }}" alt="" /></div>
                        <p>Organization</p>
                        <a href="{{ url('/register/organization') }}">Create Account</a>
                    </div>
                </div>
                <div class="mb15 col-md-4 col-sm-4">
                    <div class="signuptype three">
                        <div class="imgthumb"><img src="{{ asset('images/signuptype_03hover.png') }}" alt="" /><img class="top" src="{{ asset('images/signuptype_03.jpg') }}" alt="" /></div>
                        <p>Institution</p>
                        <a href="{{ url('/register/group') }}">Create Account</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
