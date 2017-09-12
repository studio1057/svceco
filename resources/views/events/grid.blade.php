@extends('app')

@section('title')
    Opportunities - svceco.com
@endsection

@section('content')
    <section id="eventsBanner">
        <div class="container">
            <div class="row">
                <h1>Here’s How You Can <strong>Help</strong>…</h1>
                <div class="eventFilter">
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                            Filter
                            <span aria-hidden="true" class="glyphicon glyphicon-chevron-down"></span>
                        </button>
                        <form id="adduser" data-toggle="validator" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/events') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <ul class="dropdown-menu container" role="menu" aria-labelledby="dropdownMenu1">
                            <li>
                                <label>Amount of Hours</label>
                                <div class="select-style">
                                    <select data-toggle="select" id="credits" name="credits">
                                        <option>Hours</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="5">6</option>
                                        <option value="5">7</option>
                                        <option value="5">8</option>
                                        <option value="5">9</option>
                                        <option value="5">10</option>
                                    </select> </div>
                            </li>
                            <li>
                                <label>Opportunity Type</label><div class="select-style">
                                    <select data-toggle="select" id="event" name="event">
                                        <option>Opportunity</option>
                                        @foreach($EventTypes as $event_type)
                                            <option value="{{$event_type->id}}">{{$event_type->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li>
                                <label>Organization Type</label><div class="select-style">
                                    <select  data-toggle="select" id="org" name="org">
                                        <option>Org</option>
                                        @foreach($OrgTypes as $org_type)
                                            <option value="{{$org_type->id}}">{{$org_type->type}}</option>
                                        @endforeach
                                    </select></div>
                            </li>

                            <li><input type="submit" value="Filter" /></li>
                        </ul>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section id="eventpage">
        <div class="container">
            @if(count($Featured) > 0 )
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h2>Featured Opportunities</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div id="featuredEvent">
                            <div class="eventImg"><img src="{{ asset('images/events/' . $Featured->id. '.jpg')  }}" alt="" /></div>
                            <div class="portfoliotxt">
                                <h3>{{ $Featured->name }}</h3>
                                <p>{{ $Featured->description }} </p>
                                <ul>
                                    <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />{{ $Featured->getEventType() }}</li>
                                    <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" />  {{ $Featured->getAttending() }} persons going</li>
                                    <li><img src="{{ asset('images/location_icon.jpg') }}" />{{ $Featured->address  }}, {{ $Featured->city }}, {{ $Featured->state }}</li>
                                    <li><img src="{{ asset('images/calc_cion.jpg') }}" />{{ $Featured->FriendlyDate($Featured->start_time) }}</li>
                                    <li><a href="{{ url( $Featured->organization->slug . '/events/' . $Featured->slug) }}">Read More</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h2>Explore <span>{{ count($Events) }}</span> Opportunities</h2>
                </div>
            </div>

            <?php $index = 0; ?>
            @if($Events)
                @foreach (array_chunk($Events->all(), 3) as $TEvents)
                    @if($index == 0)
                        <div class="row first">
                    @else
                        <div class="row">
                    @endif
                     <?php $index++; ?>
                    @foreach($TEvents as $event)
                    <div class="col-md-4 col-sm-4"   data-appear-top-offset="-100" data-animated="fadeInLeft">
                        <img src="{{ asset('images/events/' . $event->id. '.jpg') }}" alt="" />
                        <div class="portfoliotxt">
                            <h3>{{ $event->name }}</h3>
                            <p>{{ $event->description }} </p>
                            <ul>
                                <li class="sm"><img src="{{ asset('images/tag_icon.jpg') }}" alt="" />{{ $event->getEventType() }}</li>
                                <li class="sm"><img src="{{ asset('images/user_icon.jpg') }}" /> {{ $event->getAttending() }} persons going</li>
                                <li><img src="{{ asset('images/location_icon.jpg') }}" />{{ $event->address  }}, {{ $event->city }}, {{ $event->state }}</li>
                                <li><img src="{{ asset('images/calc_cion.jpg') }}" />{{ $event->FriendlyDate($event->start_time) }}</li>
                                <li><a href="{{ url( $event->organization->slug . '/events/' . $event->slug) }}">Read More</a></li>
                            </ul>
                        </div>

                    </div>
                            @endforeach
                        </div>
                    @endforeach

            @endif

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="pagination">
                        @if($Events)
                            {!! $Events->render() !!}
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
