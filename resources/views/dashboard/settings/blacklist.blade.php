@extends('app')
@section('title')
    Blacklist - svceco.com
@endsection
@section('content')
    <section id="listofgroup">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 pull-right">
                    <div class="boxradwrap">
                        <div class="orghead">
                            <img src="{{ asset('images/bag_icon.png') }}" alt="" /> BlackList
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

                                        <th>Banned</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orgs as $org)

                                        <tr>
                                            <td> <a href="{{url('/profile/' . $org->slug )}}" target="_blank"> {{ $org->name }}  </a></td>

                                            <td>
                                                <input id="{{ $org->id }}" name="{{ $org->id }}" type="checkbox" value="{{ $org->id }}" onclick='handleClick(this);'>
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
                                    {!! $orgs->render() !!}
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

        $(document).ready(function(){
            $.getJSON("{{ url('/dashboard/blacklist/list') }}", function(data){
                var response = JSON.parse(data.data);

                $.each( response, function( key, val ) {

                    var input = $("input[name=" + ''+ val + '' + "]");
                    if(input.is(':checkbox') ) {

                        input.prop("checked", true);

                    }

                });
            });

        });

        function handleClick(cb) {
            var url = "{{ url('/dashboard/blacklist/')  }}";
            if(cb.checked)
                url = url + "/add/";
            else
                url = url + "/delete/";

            url = url +  cb.value;

            $.getJSON( url, function(data){
                var response = JSON.parse(data.data);
            });

        }

    </script>
@endsection
@endsection
