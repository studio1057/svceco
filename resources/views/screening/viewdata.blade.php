@extends('app')
@section('title')
@endsection
@section('content')
    <section class="bannertxt" id="jointEvent">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h1>Volunteer & Serve Your Community.</h1>
                    <h3>Join event</h3>
                </div>
            </div>
        </div>


        {!! $html !!}
        <form data-toggle="validator" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/screening/verify/' . $form->id) }}">
           <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->



           <!-- <div class="row">
                <div class="col-md-12 col-sm-12"><input type="submit" value="Submit" /></div>
            </div>-->
        </form>
        @section('script')
            <script type="text/javascript">
                $(document).ready(function(){
                    $.getJSON("{{ url('/screening/data/' .  $form->id) }}", function(data){
                        var response = JSON.parse(data.data);
                        $.each( response, function( key, val ) {
                            var input = $("input[name=" + ''+ key + '' + "]");
                            if(input.is(':checkbox') ) {

                                if (val == "1")
                                    input.prop("checked", true);
                            }
                            else
                                input.val(val);
                        });
                    });

                });
            </script>
            @endsection
@endsection