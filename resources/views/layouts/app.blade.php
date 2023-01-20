<!doctype html>
<html>
@include('layouts.head')
@yield('styles')
<body>

@include('layouts.header');

<div class="top-strip">
	<div class="container">
    	<p>Speak with a Licensed Insurance Agent: <span>(844) 123-4567</span></p>
    </div>
</div>

<div class="quiz-sec">
        @yield('content')
</div>

<div class="include-sec">
	<div class="container">
    	<p class="strptxt"><span>Insurance Carriers include</span></p>
        <ul class="strp-list">
        	<li><img src="{{ asset('images/strp-img1.jpg') }}"></li>
            <li><img src="{{ asset('images/strp-img2.jpg') }}"></li>
            <li><img src="{{ asset('images/strp-img3.jpg') }}"></li>
            <li><img src="{{ asset('images/strp-img4.jpg') }}"></li>
        </ul>
    </div>
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
