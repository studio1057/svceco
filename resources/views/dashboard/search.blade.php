@extends('app')
@section('title')
    Dashboard - svceco.com
@endsection
@section('content')
    <section id="listofgroup">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-8 pull-right">
                    <div class="boxradwrap">
                        <div class="orghead">
                            <img src="{{ asset('images/bag_icon.png') }}" alt="" /> List of Volunteer in the Group
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <!--<div class="groupsearch">
                                    <input type="text"><input type="submit" value="Filter" />
                                </div>-->
                                <a class="uniEdit" href="{{ url('/dashboard/blacklist') }}">Blacklist</a>
                            </div>
                        </div>
                        <div class="row">
                            <form action="/dashboard/search" class="form-horizontal">
                                <div class="col-md-12">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label" for="name">Name</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" name="name" id="keywords" placeholder="Filter by name" value="{{ $name }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label" for="dialogAct">Grade</label>
                                            <div class="col-sm-7">
                                                <select name="grade" id="" class="form-control">
                                                    <option value=""></option>
                                                    <option {{ $grade === '9' ? 'selected' : '' }} value="9">9th grade</option>
                                                    <option {{ $grade === '10' ? 'selected' : '' }} value="10">10th grade</option>
                                                    <option {{ $grade === '11' ? 'selected' : '' }} value="11">11th grade</option>
                                                    <option {{ $grade === '12' ? 'selected' : '' }} value="12">12th grade</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <form action="/dashboard/hours" method="POST">
                                {{ csrf_field() }}
                                <div class="col-md-12 col-sm-12">
                                    <div class="pull-left">
                                        <button class="btn btn-primary" type="button" id="update-hours" style="margin: 20px 0 20px 20px;">Update hours / credits</button>
                                        <button class="btn btn-success" type="submit" style="display: none;" id="save-hours">Save</button>
                                    </div>
                                    <table class="table student-hours">
                                        <thead>
                                        <tr>
                                            <th>Name <a href="?grade={{$grade}}&name={{$name}}&page={{$page}}&sort={{ $sort === 'asc' ? 'desc' : 'asc' }}"><i class="fa fa-sort"></i></a></th>
                                            <th>Age</th>
                                            <th>Grade</th>
                                            <th>Credits</th>
                                            <th>Hours Earned</th>
                                            <th>Target</th>
                                            <th>Completion %</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($Members as $member)
                                            <tr class="hours-row" data-student-id="{{ $member->user_id }}">
                                                <td data-toggle="collapse" data-target="#events-{{$member->id}}" style="cursor: pointer; text-align: left; padding-left: 10px;"><i class="fa fa-plus-circle" style="padding-right: 5px;"></i> {{ $member->user->first_name }} {{ $member->user->last_name }}</td>
                                                <td>{{ $member->getAge() }}</td>
                                                <td>{{ $member->grade ? $member->getGradeOrdinal() : '-' }}</td>
                                                <td class="credits">{{ $member->credits }}</td>
                                                <td class="current-credits">{{ $member->current_credits }}</td>
                                                <td class="target-credits">{{ $member->user->Credits()  }}</td>
                                                <td>{{ $member->user->TotalCompleted() }}%</td>
                                            </tr>
                                            <tr id="events-{{$member->id}}" class="collapse">
                                                <td colspan="5">
                                                    <ul>
                                                        @forelse ($member->user->getCompletedAttendances() as $attendance)
                                                            <li class="pull-left">{{ $attendance->event->name }}</li>
                                                        @empty
                                                            <p class="text-left pull-left">No completed events.</p>
                                                        @endforelse
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="pagination">
                                    {!! $Members->appends([
                                        'name' => $name,
                                        'grade' => $grade,
                                        'sort' => $sort
                                    ])->render() !!}
                                </div>
                            </div>
                            <!--<div class="col-md-6 col-sm-6">
                                <ul class="pagenationList">
                                    <li> View <select><option>09</option></select></li>
                                    <li>FOUND TOTAL 20 RECORDS</li>
                                </ul>

                            </div>-->
                        </div>
                    </div>

                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="boxradwrap">
                        <div class="univerBox">
                            <h2>{{ $user->group->name  }}</h2>
                            <ul class="uniList">
                                <li><img src="images/univer_bag_icon.jpg" alt="" />{{ $user->group->address }} , {{ $user->group->city }} , {{$user->group->state}}</li>
                                <li><img src="images/univer_phone_icon.jpg" alt="" />{{ $user->group->phone }}</li>
                                <li><img src="images/univer_chart_icon.jpg" alt="" />{{ $user->group->email }}</li>
                            </ul>
                            <a class="uniEdit" href="{{ url("/dashboard/edit") }}">EDIT</a>
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


                    <!-- Modal -->
                    <div class="modal fade listingpopup" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel"><img alt="" src="{{ asset('images/org_notifaction_icon.jpg') }} ">Notification</h4>
                                </div>
                                <div class="modal-body">
                                    <div role="tabpanel" id="poptabs">

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#upcoming" aria-controls="home" role="tab" data-toggle="tab">Organization types</a></li>
                                            <li role="presentation"><a href="#compcoming" aria-controls="profile" role="tab" data-toggle="tab">Opportunity types</a></li>
                                        </ul>

                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="upcomingEvents">
                                                <ul class="chkboxlist">
                                                    <li><img src="{{ asset('images/animal01.jpg') }} " alt="" /><span>Animals</span><div class="chq-box"><input id="Option1" type="checkbox"><label class="checkbox" for="Option1">&nbsp;</label></div></li>
                                                    <li><img src="{{ asset('images/heat02.jpg') }} " alt="" /><span>Arts,Culture,Humanities</span><div class="chq-box"><input id="option2" type="checkbox" ><label class="checkbox" for="option2">&nbsp;</label></div></li>
                                                    <li><img src="{{ asset('images/heat03.jpg') }} " alt="" /><span>Community Development</span><div class="chq-box"><input id="option3" type="checkbox" ><label class="checkbox" for="option3">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat04.jpg') }} " alt="" /><span>Education</span><div class="chq-box"><input id="option4" type="checkbox" ><label class="checkbox" for="option4">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat05.jpg') }} " alt="" /><span>Environment</span><div class="chq-box"><input id="option5" type="checkbox" ><label class="checkbox" for="option5">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat06.jpg') }} " alt="" /><span>Health</span><div class="chq-box"><input id="option6" type="checkbox" ><label class="checkbox" for="option6">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat07.jpg') }} " alt="" /><span>Human+Civil Rights</span><div class="chq-box"><input id="option7" type="checkbox" ><label class="checkbox" for="option7">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat08.jpg') }} " alt="" /><span>Humans Services</span><div class="chq-box"><input id="option8" type="checkbox" ><label class="checkbox" for="option8">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/animal01.jpg') }} " alt="" /><span>Animals</span><div class="chq-box"><input id="option9" type="checkbox" ><label class="checkbox" for="option9">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat02.jpg') }} " alt="" /><span>Arts,Culture,Humanities</span><div class="chq-box"><input id="option10" type="checkbox" ><label class="checkbox" for="option10">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat03.jpg') }} " alt="" /><span>Community Development</span><div class="chq-box"><input id="option11" type="checkbox" ><label class="checkbox" for="option11">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat04.jpg') }} " alt="" /><span>Education</span><div class="chq-box"><input id="option12" type="checkbox" ><label class="checkbox" for="option12">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat05.jpg') }} " alt="" /><span>Environment</span><div class="chq-box"><input id="option13" type="checkbox" ><label class="checkbox" for="option13">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat06.jpg') }} " alt="" /><span>Health</span><div class="chq-box"><input id="option14" type="checkbox" ><label class="checkbox" for="option14">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat07.jpg') }} " alt="" /><span>Human+Civil Rights</span><div class="chq-box"><input id="option15" type="checkbox" ><label class="checkbox" for="option15">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/heat08.jpg') }} " alt="" /><span>Humans Services</span><div class="chq-box"><input id="option16" type="checkbox" ><label class="checkbox" for="option16">&nbsp;</label></li>

                                                </ul>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="compcoming">
                                                <ul class="chkboxlist">
                                                    <li><img src="{{ asset('images/icon09.jpg') }} " alt="" /><span>Food drive</span><input id="option17" type="checkbox" ><label class="checkbox" for="option17">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/icon10.jpg') }} " alt="" /><span>Clothing</span><input id="option18" type="checkbox" ><label class="checkbox" for="option18">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/icon11.jpg') }} " alt="" /><span>walk/run</span><input id="option19" type="checkbox" ><label class="checkbox" for="option19">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/icon12.jpg') }} " alt="" /><span>Set up for an event</span><input id="option20" type="checkbox" ><label class="checkbox" for="option20">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/icon13.jpg') }} " alt="" /><span>Supply drive</span><input id="option21" type="checkbox" ><label class="checkbox" for="option21">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/icon14.jpg') }} " alt="" /><span>Blood drive</span><input id="option22" type="checkbox" ><label class="checkbox" for="option22">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/icon15.jpg') }} " alt="" /><span>Hospital</span><input id="option23" type="checkbox" ><label class="checkbox" for="option23">&nbsp;</label></li>
                                                    <li><img src="{{ asset('images/icon16.jpg') }} " alt="" /><span>Soup Kitcken</span><input id="option24" type="checkbox" ><label class="checkbox" for="option24">&nbsp;</label></li>

                                                </ul>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
