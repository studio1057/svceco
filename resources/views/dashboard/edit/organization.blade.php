@extends('app')

@section('content')
    <section class="bannertxt" id="orgAcc">
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
                        <form data-toggle="validator" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/dashboard/edit') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <h2>Organization Account</h2>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <label>Image</label>

                                    <input type="file" placeholder="Image" class="file" data-show-upload="false" name="image" id="image" accept="image/*"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb15 col-md-6 col-sm-6"><input type="text" placeholder="Name / Title" name="org_name" id="org_name" value="{{ $org->name }}" required/> </div>
                                <div class="col-md-6 col-sm-6 wid100"><div class="select-style"><select class="form-control select select-primary" data-toggle="select" name="org_cat" id="org_cat">
                                            @foreach($OrgTypes as $org_type)
                                                <option value="{{$org_type->id}}">{{$org_type->type}}</option>
                                            @endforeach
                                        </select></div></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12"><input type="text" placeholder="URL" name="url" id="url" value="{{ $org->url }}"/> </div>
                            </div>
                            <div class="row">
                                <div class="mb15 col-md-6 col-sm-6"><input type="text" placeholder="Email" name="org_email" id="org_email" value="{{ $org->email }}" required /> </div>

                                <div class="col-md-6 col-sm-6"><input type="text" placeholder="Phone" name="org_phone_number" id="org_phone_number" value="{{ $org->phone }}" required/> </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="select-style">
                                        <select class="form-control select select-primary" data-toggle="select" name="state" id="state" value="{{ $org->state }}">
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
                                <div class="mb15 col-md-6 col-sm-6"><input type="text" placeholder="City" name="org_city" id="org_city" value="{{ $org->city }}" required /> </div>

                                <div class="col-md-6 col-sm-6"><input type="text" placeholder="Zipcode" name="org_zipcode" id="org_zipcode" value="{{ $org->zipcode }}" required/> </div>
                            </div>



                            <div class="row">
                                <div class="col-md-12 col-sm-12"><input type="text" placeholder="Address" name="org_address" id="org_address" value="{{ $org->address }}" required /> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12"><textarea placeholder="Description" name="org_desc" id="org_desc" value="{{ $org->description }}"></textarea> </div>
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

@endsection

@section('script')
    <script type="text/javascript">
        $(function () {

            $(document).ready(function() {


                setSelected('org_cat', '{{ $org->category }}');
                setSelected('state', '{{ $org->state }}');

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

            $("#image").fileinput({
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                allowedFileExtensions: ['jpg','png','jpeg']
            });

        });
    </script>
@endsection
