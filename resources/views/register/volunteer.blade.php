@extends('app')

@section('title')
    Register Volunteer - svceco.com
@endsection

@section('script')
    <script type="text/javascript" charset="utf-8">
        $("a#account_default").click(function(e){

            $("#group_type").val("0");

            document.getElementById('groupid').style.display = 'none';
            document.getElementById("credits").readOnly = true;
            document.getElementById('group_idHidden').disabled = false;
            document.getElementById('group_id').disabled = true;
            $("#account_student").removeClass('selected');
            $("#account_default").removeClass('selected');
            $("#account_court").removeClass('selected');
            $("#account_default").addClass('selected');

            e.preventDefault();
        });


        $("a#account_student").click(function(e){


            $.getJSON("{{ url('/api/v1/group/1') }}", function(result){

                if(result.success) {
                    var options = '';
                    console.debug(result.data);
                    options += '<option >Select School</option>';
                    $.each( result.data.data, function(index, value ) {
                        console.log(value.id);
                        options += '<option value="' + value.id + '">' + value.name + '</option>';
                    });

                    $("select#group_id").html(options);
                    document.getElementById('groupid').style.display = 'block';
                    $("#group_type").val("1");
                    document.getElementById("credits").value = "0";
                    document.getElementById("credits").readOnly = true;

                    document.getElementById('group_idHidden').disabled = true;
                    document.getElementById('group_id').disabled = false;

                    $("#account_student").removeClass('selected');
                    $("#account_default").removeClass('selected');
                    $("#account_court").removeClass('selected');
                    $("#account_student").addClass('selected');
                }
            });

            e.preventDefault();
        });


        $("a#account_court").click(function(e){


            $.getJSON("{{ url('/api/v1/group/2') }}", function(result){

                if(result.success) {
                    var options = '';
                    console.debug(result.data);
                    options += '<option >Select Group</option>';
                    $.each( result.data.data, function(index, value ) {
                        console.log(value.id);
                        options += '<option value="' + value.id + '">' + value.name + '</option>';
                    });

                    $("select#group_id").html(options);
                    document.getElementById('groupid').style.display = 'block';

                }
            });

            $("#group_type").val("1");

            document.getElementById("credits").readOnly = false;

            document.getElementById('group_idHidden').disabled = true;
            document.getElementById('group_id').disabled = false;
            $("#account_student").removeClass('selected');
            $("#account_default").removeClass('selected');
            $("#account_court").removeClass('selected');
            $("#account_court").addClass('selected');

            e.preventDefault();
        });
      </script>
@endsection
@section('content')

<section class="bannertxt" id="VolunteerAcc">
	<div class="container">
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
    	<div class="row">
        	<div class="col-md-12 col-sm-12"> 
        	<h1>Start Finding Community Service Opportunities Near You</h1>
            <h3>Create Your Account</h3>
            </div>
        </div>
    </div>
    
    <div class="container">
    	<div class="row">
        	<div class="col-md-12 col-sm-12"> 
        		<form class="form-horizontal" role="form" method="POST" action="{{ url('/register/volunteer') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
            	<div id="formwrap">
                	<h2>Volunteer Account</h2>
                		<div class="row">
        					<div class="col-md-6 col-sm-6"><input class="mb15" type="text" placeholder="First Name" name="first_name" value="{{ old('first_name') }}"/> </div>
                            <div class="col-md-6 col-sm-6"><input type="text" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}"/> </div>
                        </div>
                        <div class="row">
        					<div class="col-md-12 col-sm-12"><input type="text" placeholder="Email Address" name="email" value="{{ old('email') }}"/> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12"><input type="text" placeholder="Phone" name="phone_number" value="{{ old('phone_number') }}"/> </div>
                        </div>
                        <div class="row">
        					<div class="col-md-12 col-sm-12"><input type="password" placeholder="Password" name="password"/> </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12"><input type="password" placeholder="Confirm Password" name="password_confirmation"/> </div>
                        </div>
                        <div class="row">
        					<div class="col-md-4 col-sm-4">
        						<div class="mb15 select-style wid100">
        							{!! Form::selectMonth('month', ['class' => 'form-control select select-primary']) !!}
        						</div>
        					</div>
                            <div class="col-md-4 col-sm-4">
                            	<div class="mb15 select-style wid100">
                            		{!! Form::selectRange('day', 1, 31, ['class' => 'form-control select select-primary']) !!}
                            	</div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                            	<div class="mb15 select-style wid100">
                            		{!! Form::selectYear('year', 2015, 1930, ['class' => 'form-control select select-primary']) !!}
                            	</div>
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col-md-12 col-sm-12">
                                    <h4 class="text-center">Gender</h4>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="col-md-12 col-sm-12 green-btn-outer">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="select-style">
                                        <select class="form-control select select-primary" data-toggle="select" id="gender" name="gender" value="{{ old('gender') }}"/>
                                            <option value="3">Select Gender</option>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        	<div class="col-md-12 col-sm-12">
                                <h4 class="text-center">Account Type</h4>
                            </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="col-md-12 col-sm-12 green-btn-outer">
                                       <div class="col-md-4 col-sm-4">
                                            <a href="#" id="account_default" class="green-btns selected">Default</a>
                                       </div>
                                       <div class="col-md-4 col-sm-4">
                                            <a href="#" id="account_student" class="green-btns">Student</a>
                                       </div>
                                       <div class="col-md-4 col-sm-4">
                                            <a href="#" id="account_court" class="green-btns">Court Mandated</a>
                                       </div>
                                    </div>
                                </div>
                        </div>
                        <input type="hidden" id="group_type" name="group_type" value="0">
                        <div class="row">
                            <div id="groupid" style="display:none;">
                                <div class="col-md-12 col-sm-12">
                                    <h4 class="text-center">Group</h4>
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="col-md-12 col-sm-12 green-btn-outer">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="select-style">
                                            <input id="group_idHidden"  type="hidden" value="1" name="group_id">
                                            <select class="form-control" id="group_id" name="group_id"/>

                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                     
                       
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="" class="target-hours">Target Hours</label>
                                <input type="text" id="credits" name="credits" placeholder="Hours" value="{{ old('credits') }}"/>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="" class="target-hours">Grade</label>
                                <div class="mb15 select-style">
                                    <select name="grade" id="" class="">
                                        <option value="">Select your grade</option>
                                        <option value="9">9th grade</option>
                                        <option value="10">10th grade</option>
                                        <option value="11">11th grade</option>
                                        <option value="12">12th grade</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12"><input type="submit" value="Create Account" /></div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
