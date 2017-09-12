<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>@yield('title')</title>
        @yield('meta')
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon"
              type="image/png"
              href="{{ asset('images/favicon.png') }}">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

        <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">

        <link rel='stylesheet' href=" {{ asset('css/settings.css') }} " type='text/css' media='all' />
        <link rel='stylesheet'  href=" {{ asset('css/captions.css') }} " type='text/css' media='all' />
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/media.css') }}">
        <link rel="stylesheet" href="{{ asset('css/flat-ui.css') }}">
        <link rel="stylesheet" href="{{ asset('css/fileinput.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.mCustomScrollbar.css') }}">
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet" type="text/css" media="all" />
		<link href='//fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
        <script src="{{ asset('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
        @yield('style')

    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <h1><a href="{{ url("/") }}"><img class="logo" src="{{ asset('images/logo.jpg') }}" alt="Pleasent"></a></h1>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <nav class="navbar navbar-inverse" role="navigation">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul>
                                    @if(Auth::check())
                                        @if(Auth::user()->role == "volunteer")
                                            <li><a class="w-nav-link menu-li" href="{{ url('/events') }}">Search for Opportunities</a></li>
                                        @elseif(Auth::user()->role == "group")
                                        @elseif(Auth::user()->role == "organization")
                                        @endif
                                    @else
                                    @endif
              		@if (Auth::guest())

                        <li class="signup"><a class="signupbtn" href="{{ url('/register') }}">Sign up</a><a class="loginbtn" href="{{ url('/') }}">Log in</a></li>


					@else
                            <li class="signup"><a class="signupbtn" href="{{ url('/dashboard') }}">{{ Auth::user()->first_name }}</a><a class="loginbtn" href="{{ url('/logout') }}">Logout</a></li>


					@endif
                	 </ul>
                </div><!--/.navbar-collapse -->
    			</nav>
            </div>
    	</div>
    </div>
</header>
        <section class="bannertxt" id="Toast">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
        @if(Session::has('toasts'))
            @foreach(Session::get('toasts') as $toast)
                <div class="alert alert-{{ $toast['level'] }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                    {{ $toast['message'] }}
                </div>
            @endforeach
        @endif
</section>
        </div>
        </div>
        </div>
@yield('content')



<footer>
	<div class="container">
       	<div class="row copyright">
        	<div class="col-md-7 col-sm-7">
            	<ul>
                <li><img src="{{ asset('images/phone_icon.png') }}" alt="" />(800)-555-1212</li><li>|</li>
                    <li><img src="{{ asset('images/chart_icon.png') }}" alt="" />hello@svceco.com</li>
                </ul>
            </div>
            <div class="col-md-5 col-sm-5 text-right">
            	<p>Copyright&copy; 2015. All rights resrved.</p>
            </div>
       	</div>
   </div>
</footer>
<div class="container footerwrap">
    	<div class="row">
        	<div class="col-md-12 col-sm-12">
				<p>Copyright&copy; 2015. All rights resrved.</p>
                <a id="top" href="#">Top</a>
            </div>
       </div>
</div>

 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="{{ asset('js/flat-ui.min.js') }}"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="{{ asset('slick/slick.min.js') }}"></script>
        <script src="{{ asset('js/Moment.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
		<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/fileinput.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/animate.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        @yield('script')

    </body>
</html>
