<!doctype html>
<html>
@include('layouts.head')
@yield('styles')
<body>

@include('layouts.header')

<div class="top-strip">
	<div class="container">
    	<p>Find and Compare 2023 Plans & Benefits</span></p>
    </div>
</div>

<div class="quiz-sec">
        @yield('content')
</div>



@include('layouts.footer')

<script type="text/javascript" src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.maskedinput.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/iziToast.min.js') }}"></script>

<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/additional-methods.js"></script>
@yield('scripts')


</body>
</html>
