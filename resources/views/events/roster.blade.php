@extends('app')

@section('title')
    Opportunity Roster - svceco.com
@endsection

@section('content')
    <section id="listofgroup">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 pull-right">
                    <div class="boxradwrap">
                        <div class="orghead">
                            <img src="{{ asset('images/bag_icon.png') }}" alt="" /> Opportunity Roster
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Update</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Users as $User)

                                        <tr>
                                            <td> {{ $User->user->first_name }} {{ $User->user->last_name }}</td>
                                           <td>
                                                <form data-toggle="validator" role="form" method="POST" enctype="multipart/form-data" action="{{ url(Request::url()) }}">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="event_id" value="{{ $User->event_id }}">
                                                    <input type="hidden" name="user_id" value="{{ $User->user_id }}">

                                                    <input type="submit" value="Check In" />
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach


                                    </tbody>

                                </table>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="pagination">
                                    {!! $Users->render() !!}
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
