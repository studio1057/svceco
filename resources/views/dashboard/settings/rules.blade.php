@extends('app')

@section('content')
    <section id="listofgroup">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 pull-right">
                    <div class="boxradwrap">
                        <div class="orghead">
                            <img src="{{ asset('images/bag_icon.png') }}" alt="" /> Opportunity Blocking
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div role="tabpanel" id="poptabs">

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="active"><a href="#org" aria-controls="org" role="tab" data-toggle="tab">Organization types</a></li>
                                        <li role="presentation"><a href="#event" aria-controls="event" role="tab" data-toggle="tab">Opportunity types</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="org">
                                            <ul class="chkboxlist">
                                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/filter/organization') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                @foreach($OrgTypes as $OType)
                                                <li>
                                                    <img src="{{ asset('images/icons/organization/' . $OType->id . '.jpg') }}" alt="" />
                                                    <span>{{ $OType->type }}</span>
                                                    <input id="{{ $OType->id }}" name="{{ $OType->id }}" type="checkbox" value="{{ $OType->id }}"
                                                            @if($OType->checked)
                                                           checked
                                                            @endif
                                                            >
                                                    <label class="checkbox" for="{{ $OType->type }}">&nbsp;</label>
                                                </li>

                                                @endforeach
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                            </ul>

                                            </form>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="event">
                                            <ul class="chkboxlist">
                                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/filter/events') }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                @foreach($EventTypes as $EType)
                                                <li>
                                                    <img src="{{ asset('images/icons/events/' . $EType->id . '.jpg') }}" alt="" />
                                                    <span>{{ $EType->type }}</span>
                                                    <input id="{{ $EType->id }}" name="{{ $EType->id }}" type="checkbox" value="{{ $EType->id }}"
                                                    @if($EType->checked)
                                                           checked
                                                            @endif
                                                            >
                                                    <label class="checkbox" for="{{ $EType->type }}">&nbsp;</label>
                                                </li>
                                                @endforeach
                                                    <button type="submit" class="btn btn-primary">Save</button>

                                            </ul>
                                            </form>
                                        </div>
                                    </div>

                                </div>



                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="boxradwrap">
                        <div class="univerBox">
                            <h2>{{ $user->group->name  }}</h2>
                            <ul class="uniList">
                                <li><img src="{{ asset('images/univer_bag_icon.jpg') }}" alt="" />{{ $user->group->address }} , {{ $user->group->city }} , {{$user->group->state}}</li>
                                <li><img src="{{ asset('images/univer_phone_icon.jpg') }}" alt="" />{{ $user->group->phone }}</li>
                                <li><img src="{{ asset('images/univer_chart_icon.jpg') }}" alt="" />{{ $user->group->email }}</li>
                                <li><img src="{{ asset('images/univer_lock_icon.jpg') }}" alt="" />U.S Permitted University</li>
                            </ul>
                            <a class="uniEdit" href="#">EDIT</a>
                        </div>
                    </div>

                    <div class="boxradwrap">
                        <div class="createSubuser">
                            <h2>Create Sub Users</h2>
                            <ul>
                                <form id="adduser" data-toggle="validator" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/dashboard/adduser') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <li><input type="text" placeholder="First Name" name="first_name"/></li>
                                    <li><input type="text" placeholder="Last Name" name="last_name"/></li>
                                    <li><input type="text" placeholder="Email Address" name="email"/></li>

                            </ul>
                            <a class="uniEdit" href="javascript:document.forms['adduser'].submit();">Add User</a>
                            </form>

                        </div>
                    </div>


                    <!-- Button trigger modal -->



                </div>
            </div>
        </div>
    </section>


@endsection

