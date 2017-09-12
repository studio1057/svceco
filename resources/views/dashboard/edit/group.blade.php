@extends('app')

@section('title')
    Register Group - svceco.com
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
                    <h3>Create Your Account</h3>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div id="formwrap">
                        <form data-toggle="validator" role="form" method="POST" action="{{ url('/dashboard/edit') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <h2>Group</h2>

                            <div class="row">
                                <div class="mb15 col-md-6 col-sm-6"><input type="text" placeholder="Name / Title"  name="group_name" value="{{ $user->group->name }}" required/> </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="select-style">
                                        <select id="group_type" name="group_type" value="{{ $user->group->type }}" required>
                                            <option>Select Group Type</option>
                                            @foreach($group_types as $group)
                                                <option value="{{$group->id}}">{{$group->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="select-style">
                                        <select data-toggle="select" name="state" id="state" value="{{ $user->group->state }}">
                                            <option value="Select State">Select State</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DC">District of Columbia</option>
                                            <option value="DE">Delaware</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="IA">Iowa</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MD">Maryland</option>
                                            <option value="ME">Maine</option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MT">Montana</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NY">New York</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VA">Virginia</option>
                                            <option value="VT">Vermont</option>
                                            <option value="WA">Washington</option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WV">West Virginia</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="mb15 col-md-6 col-sm-6"><input type="text" placeholder="City" name="group_city" id="group_city" value="{{ $user->group->city }}" required /> </div>

                                <div class="col-md-6 col-sm-6"><input type="text" placeholder="Zipcode" name="group_zipcode" id="group_zipcode" value="{{ $user->group->zipcode }}" required/> </div>
                            </div>



                            <div class="row">
                                <div class="col-md-12 col-sm-12"><input type="text" placeholder="Address" name="group_address" id="group_address" value="{{ $user->group->address }}" required /> </div>
                            </div>

                            <div class="row">
                                <div class="mb15 col-md-6 col-sm-6"><input type="text" placeholder="Email" id="group_email" name="group_email" value="{{ $user->group->email }}" required/> </div>
                                <div class="col-md-6 col-sm-6"><input type="text" placeholder="Phone" name="group_phone_number" id="group_phone_number" value="{{ $user->group->phone }}"required /> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12"><input type="text" placeholder="Target Hours" name="group_credits" value="{{ $user->group->target_credits }}" required/> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12"><input type="submit" value="Edit Account" /></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@section('script')
    <script type="text/javascript">
        $(function () {

            $(document).ready(function() {


                setSelected('group_type', '{{ $user->group->type }}');
                setSelected('state', '{{ $user->group->state }}');

            });

            function setSelected(elm, val) {
                var dl = document.getElementById(elm);

                var index =0;
                for (var i=0; i<dl.options.length; i++){
                    if (dl.options[i].value == val){
                        index=i;
                        break;
                    }
                }
                dl.selectedIndex = index;

            }


        });
    </script>
@endsection
@endsection