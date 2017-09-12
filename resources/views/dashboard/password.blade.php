@extends('app')

@section('title')
    Change Password
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

                    <h1>Volunteer & Serve Your Community.</h1>
                    <h3>Change your password</h3>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div id="formwrap">
                        <form data-toggle="validator" role="form" method="POST" action="{{ url('/dashboard/password') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <h2>Change password</h2>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label for="">Current password</label>
                                    <input type="password" name="password" required />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <label for="">New password</label>
                                    <input type="password" name="new_password" required />
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <label for="">Confirm new password</label>
                                    <input type="password" name="confirm_password" required />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12"><input type="submit" value="Save" /></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
