@extends('app')
@section('title')
    {{ $org->name }} Profile - svceco.com
@endsection
@section('content')
    <section id="listofgroup">
        <div class="container">

            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="boxradwrap bg-none">
                        <div class="orgProfile arts">
                            <div class="orgProfileImg"><img src="{{ asset('images/organization/' . $org->id . '.jpg') }}" alt="" /></div>


                            <h2>{{ $org->name }}</h2>
                        </div>
                        <div class="boxradwrap orgProfile  extra-box">
                            <ul class="uniList">
                                <li><img src="{{ asset('images/org_location_icon.jpg') }}" alt="" />{{ $org->address }} , {{ $org->city }} , {{ $org->address }}</li>
                                <li><img src="{{ asset('images/univer_phone_icon.jpg') }}" alt="" />{{ $org->phone }}</li>
                                <li><img src="{{ asset('images/univer_chart_icon.jpg') }}" alt="" />{{ $org->email  }}</li>
                            </ul>

                        </div>

                    </div>
                </div>
                <div class="col-md-8 col-sm-8">
                    <div class="boxradwrap mission-box" style="padding:15px;">
                        <h1>Our Mission</h1>
                        <p>{!! nl2br(e($org->description)) !!}</p>
                     </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="boxradwrap extra">
                        <div role="tabpanel" id="upcomingEvents">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs extra" role="tablist">
                                <li role="presentation" class="active"><a href="#upcoming" aria-controls="upcoming" role="tab" data-toggle="tab">Upcoming Opportunities</a></li>
                                <li role="presentation"><a href="#completed" aria-controls="completed" role="tab" data-toggle="tab">Completed Opportunities</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="upcoming">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            @if($UpcomingEvents)
                                                @foreach($UpcomingEvents as $NextEvent)

                                                    <div class="item active">
                                                        <div class="col-md-6 col-sm-6">
                                                            <img src="{{ asset('images/events/' . $NextEvent->id. '.jpg') }}" alt="" />
                                                            <div class="portfoliotxt">
                                                                <h3>{{ $NextEvent->name }}</h3>
                                                                <p>{{ $NextEvent->description }} </p>
                                                                <ul>
                                                                    <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />{{ $NextEvent->getEventType() }}</li>
                                                                    <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> {{ $NextEvent->getAttending() }} persons going</li>
                                                                    <li><img src="{{ asset('images/location_icon.jpg') }}" />{{ $NextEvent->address  }}, {{ $NextEvent->city }}, {{ $NextEvent->state }}</li>
                                                                    <li><img src="{{ asset('images/calc_cion.jpg') }}" />{{ $NextEvent->FriendlyDate($NextEvent->start_time) }}</li>
                                                                    <li><a href="{{ url( $NextEvent->organization->slug . '/events/' . $NextEvent->slug) }}">Read More</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>

                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="completed">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            @if( $CompletedEvents )
                                                @foreach($CompletedEvents as $CNextEvent)

                                                    <div class="item active">
                                                        <div class="col-md-6 col-sm-6">
                                                            <img src="{{ asset('images/events/' . $CNextEvent->id. '.jpg') }}" alt="" />
                                                            <div class="portfoliotxt">
                                                                <h3>{{ $CNextEvent->name }}</h3>
                                                                <p>{{ $CNextEvent->description }} </p>
                                                                <ul>
                                                                    <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />{{ $CNextEvent->getEventType() }}</li>
                                                                    <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> {{ $CNextEvent->getAttending() }} persons going</li>
                                                                    <li><img src="{{ asset('images/location_icon.jpg') }}" />{{ $CNextEvent->address  }}, {{ $CNextEvent->city }}, {{ $CNextEvent->state }}</li>
                                                                    <li><img src="{{ asset('images/calc_cion.jpg') }}" />{{ $CNextEvent->FriendlyDate($CNextEvent->start_time) }}</li>
                                                                    <li><a href="{{ url( $CNextEvent->organization->slug . '/events/' . $CNextEvent->slug) }}">Read More</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        <!-- Controls -->
                                        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
