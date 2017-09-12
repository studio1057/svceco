@extends('app')

@section('title')
{{ $event->name }} - {{ $event->organization->name }} - svceco.com
@endsection

@section('meta')
    <meta name="category" content="{{ $event->getEventType() }}">
    <meta property="og:title" content="{{ $event->name }} - {{ $event->organization->name }}" />
    <meta property="og:site_name" content="svceco.com"/>
    <meta property="og:description" content="{{ $event->description }}" />
    <meta property="og:image" content="{{ asset('images/events/'. $event->id . '.jpg') }}" />
@endsection

@section('content')
    @section('style')
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.css') }}">


        <style>
            .profile > p{
                color: #fff;
                font-size: 11px;
                line-height: 18px;
                margin-bottom: 0;
                text-align: center;
            }
        </style>


    @endsection
<section class="title-bg">
    <div class="container">
        <div class="row">
            <h4>{{ $event->organization->name }} / {{ $event->getEventType() }}</h4>
            <h1>{{ $event->name }}</h1>

        </div>
    </div>
</section>
<section id="event-page">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-9 large-box">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 event-sidebar">
                        <div class="date">
                            <h3>{{ $event->getMonth($event->start_time) }}</h3>
                            <h2>{{ $event->start_time->day }}</h2>
                            <h5>{{ $event->start_time->year }}</h5>
                        </div>
                        <div class="join-event">
                            @if(Auth::check())
                                @if($user->CheckedIn($event->id) == true)
                                    @if($user->role == "volunteer")
                                        @if($event->screening_required == true && $user->IsVerified() == false)

                                            <a href="{{ url('/events/screen/' . $event->organization_id ) }}">Apply</a>
                                        @else
                                            @if($event->age_requirement)

                                                @if( $user->volunteer->ageCheck(18) == true)
                                                    <form data-toggle="validator" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/' .$event->organization->slug . '/events/'. $event->slug . '/join') }}">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <div class="row">
                                                            <div class="col-md-12 col-sm-12"><input type="submit" value="Join Opportunity" /></div>
                                                        </div>
                                                    </form>
                                                @else
                                                    {{ "Age requirement of" }} {{ 18 }}
                                                @endif
                                            @else
                                                <form data-toggle="validator" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/' .$event->organization->slug . '/events/'. $event->slug . '/join') }}">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12"><input type="submit" value="Join Opportunity" /></div>
                                                    </div>
                                                </form>
                                             @endif
                                        @endif
                                    @endif
                                @elseif (in_array($event->status, ['pending', 'started']))
                                    <form data-toggle="validator" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/' .$event->organization->slug . '/events/'. $event->slug . '/cancelAttendance') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12"><input type="submit" value="Cancel attendance" /></div>
                                        </div>
                                    </form>
                                @endif
                             @else
                                <a href="{{ url('/register/volunteer' ) }}">Join</a>
                             @endif
                        </div>
                        <span class="divder"></span>
                        <div class="clear"></div>
                        <h4>Details</h4>
                        <ul>
                            <li><span>Start</span>{{ $event->FriendlyDate($event->start_time) }}</li>
                            <li><span>End</span>{{$event->FriendlyDate($event->end_time) }}</li>
                            <li><span>Timing</span>{{ $event->getStartTime() }} - {{ $event->getEndTime() }}</li>
                            <li><span>Opportunity Category</span>{{ $event->getEventType() }}</li>
                            <li><span>Profile</span><a href="{{ url('/profile/' . $event->organization->slug ) }}">{{ $event->organization->name }}</a></li>
                            <li><span>Website</span><a href="{{ $event->organization->url }}" target="_blank">{{ $event->organization->url }}</a></li>
                            @if ($event->attendances_limit > 0)
                                <li><span>Volunteers</span> {{ sprintf('%s/%s', $currentVolunteers, $event->attendances_limit) }}</li>
                            @endif
                        </ul>
                        @if(Auth::check())
                            @if($user->role == "organization" && $event->organization_id == $user->organization->id)
                                @if($event->status == "ended")
                                    <a class="edit-event" href="{{ url(Request::url() . '/complete') }}" >Complete Opportunity</a>
                                    <a class="edit-event" href="{{ url( Request::url() . '/edit') }}">Edit Opportunity</a>
                                @elseif($event->status == "pending" || $event->status == "started")
                                    <a class="edit-event" href="{{ url( Request::url() . '/edit') }}">Edit Opportunity</a>
                                    <a class="edit-event" href="{{ url(Request::url() . '/roster') }}" >Opportunity Roster</a>
                                    <a class="edit-event" href="{{ url(Request::url() . '/cancel') }}" >Cancel Opportunity</a>
                                @endif
                            @endif

                            @if($user->role == "admin" )
                                @if($event->featured == false)
                                        <a class="edit-event" href="{{ url(Request::url() . '/featured') }}" >Make Featured Opportunity</a>
                                @else
                                        <a class="edit-event" href="{{ url(Request::url() . '/featured') }}" >Remove Featured Opportunity</a>
                                @endif
                            @endif
                        @endif

                        <span class="divder"></span>
                        <div class="clear"></div>
                        <h4>View</h4>
                        <span class="map-pin">{{ $event->city }}</span>
                        <span class="medical">{{ $event->address }}, {{$event->state }} {{$event->zipcode }} </span>
                        <span class="gp">+Google Map</span>


                        <iframe src=" {{ $event->getGoogleMapURL() }}" width="300" height="250" frameborder="0" style="border:0"></iframe>
                    </div>
                    <div class="col-xs-12 col-sm-8 family">
                        <img src="{{ asset('images/events/'. $event->id . '.jpg') }}" height="219" width="326" alt="logo">
                        <ul>
                            <li><img src="{{ asset('images/icons/organization/' . $event->org_category . '.png') }}"></li>
                            <li><img src="{{ asset('images/icons/events/' . $event->category . '.png') }}"></li>
                            <li class="hours">{{ $event->getHours() }}</li>
                        </ul>
                        <p>{!! nl2br(e($event->description)) !!}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-3 my-profile">

                @if(Auth::check())
                    @if($user->role == "volunteer")
                        <div class="profile">
                            <h3> My Profile</h3>
                            <!--<img src="{{ asset('images/man-profile.png') }} " alt="">-->
                            <p>{{$user->first_name}} {{$user->last_name}}</p>

                            @if($user->IsMember())
                                <p style="margin-bottom:20px;">Member of {{$user->group->name}}</p>
                            @endif
                            <a href="{{ url('/dashboard') }}">My Dashboard</a>
                        </div>
                        <div class="clear"></div>
                        <div class="bar-area">
                            <p>Hour Earned / Completion</p>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="{{ $user->TotalCompleted() }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $user->TotalCompleted() }}%">

                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    @endif
                @endif

                <div class="up-events">
                    <h2>Sign up for our Opportunities</h2>
                    <div id="carousel-example-generic" class="carousel slide single-slider" data-ride="carousel">

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">

                                <ul class="event-list">
                                    @foreach($upcoming as $nextEvent)
                                    <li>
                                        <span>
                                            <img src="{{ asset('images/events/' . $nextEvent->id. '.jpg')  }} " width="53" >
                                        </span>
                                        <p><a href="{{ url('/' . $event->organization->slug . '/events/' . $nextEvent->slug) }} ">{{ $nextEvent->name }}</a><span>{{ $nextEvent->getFullStartTime() }}</span></p>
                                     </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

    @section('script')
        <script type="text/javascript">
            jQuery("#myModal .modal-body").mCustomScrollbar({
                setHeight:340,
                theme:"minimal-dark"
            });

            jQuery("#myModal3 .modal-body").mCustomScrollbar({
                setHeight:340,
                theme:"minimal-dark"
            });

            jQuery("#myModal5 .chkboxlist").mCustomScrollbar({
                setHeight:340,
                theme:"minimal-dark"
            });
        </script>
    @endsection
@endsection
