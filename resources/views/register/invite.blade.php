@extends('app')

@section('title')
    Register  - svceco.com
@endsection

@section('content')
    <section class="bannertxt" id="GroupAcc">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h1>Create a Profile for your Institution Now!</h1>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div id="formwrap">
                        <form data-toggle="validator" role="form" method="POST" action="{{ url('/invite/' . $invite->invite_code ) }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <h2>Account</h2>
                            <div class="row">
                                <div class="col-md-6 col-sm-6"><input class="mb15" type="text" placeholder="First Name" name="first_name" value="{{ $invite->first_name }}" required/> </div>
                                <div class="col-md-6 col-sm-6"><input type="text" placeholder="Last Name" name="last_name" value="{{ $invite->last_name }}" required/> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12"><input type="text" placeholder="Email Address" name="email" value="{{ $invite->email }}" required/> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12"><input type="text" placeholder="Phone" name="phone_number" value="{{ old('phone_number') }}" required/> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12"><input type="password" placeholder="Password" name="password" required/> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12"><input type="password" placeholder="Confirm Password" name="password_confirmation" required/> </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12 col-sm-12"><input type="submit" value="Create Account" /></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
