@extends('app')
@section('title')
    Organization Screening - svceco.com
@endsection
@section('content')
    <section id="listofgroup">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 pull-right">
                    <div class="boxradwrap">
                        <div class="orghead">
                            <img src="{{ asset('images/bag_icon.png') }}" alt="" /> Screening List
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
                                        <th>Status</th>
                                        <th>Update</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($screening as $screen)

                                        <tr>
                                            <td> <a href="{{url('/screening/' . $screen->id )}}" target="_blank"> {{ $screen->user->first_name }} {{ $screen->user->last_name }} </a></td>
                                            <td>{{ $screen->status }}</td>
                                            <td>
                                                <form data-toggle="validator" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/dashboard/screening') }}">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="user_id" value="{{ $screen->id }}">
                                                    <select name="approval" id="approval">
                                                        <option value="accepted">Approve</option>
                                                        <option value="denied">Deny</option>
                                                    </select>
                                                    <input type="submit" value="Update" />
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
                                    {!! $screening->render() !!}
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
