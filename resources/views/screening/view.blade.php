@extends('app')

@section('title')
    Screening Form - svceco.com
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
        <form data-toggle="validator" role="form" method="POST" enctype="multipart/form-data" action="{{ url('/events/screen/' . $form->id) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            {!! $html !!}

        </form>
    </section>
@endsection