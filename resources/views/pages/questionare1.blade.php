@extends('layouts.app')
@section('content')
    {{-- {{ dd($s_1,$s_2,$s_3,$s_4,$s_5,$transaction_id) }} --}}
    <style>
        a.disabled {
            pointer-events: none;
            cursor: default;
        }
        .style_date,
        .style_address,
        .style_name,
        .style_email,
        .style_phone {
            margin-top: 3px;
            margin-bottom: 5px;
            color: red;
            font-size: 10px;
            font-weight: 400;
        }
        #valid_month,
        #valid_address,
        #valid_zip_code,
        #valid_name,
        #valid_email,
        #valid_phone {
            display: none;
        }
        #valid_year {
            display: none;
        }
        #valid_day {
            display: none;
        }
    </style>
    <div class="container">
        <div class="quiz-inr-box">
            <div class="box-header">
                <h2>Uncover the Best 2023 Medicare Plan for You with Personalized Comparisons and Benefits</h2>
            </div>

            <div class="steps-box">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="progressbar">
                    <div class="prgress-1" style="width:5%;"><img src="{{ asset('images/medicare-ic.png') }}"></div>
                </div>
                <form action="{{ route('questionare.save') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="s1_id" value="{{ @$s_1 }}" id="">
                    <input type="hidden" name="s2_id" value="{{ @$s_2 }}" id="">
                    <input type="hidden" name="s3_id" value="{{ @$s_3 }}" id="">
                    <input type="hidden" name="s4_id" value="{{ @$s_4 }}" id="">
                    <input type="hidden" name="s5_id" value="{{ @$s_5 }}" id="">
                    <input type="hidden" name="transaction_id" value="{{ @$transaction_id }}" id="">
                    <input type="hidden" name="aff_id" value="{{ @$aff_id }}" id="">
                    <input type="hidden" name="off_id" value="{{ @$off_id }}" id="">

                    {{-- @method('post') --}}
                    <div class="question-Box" data-wdth="5" style="">
                        <div class="step-inrBox">
                            <p class="step-hdng">Are you currently enrolled in Medicare Parts A and B?</p>
                            {{-- <p class="step-sub-text">Part A covers hospital care. Part B covers medical care.</p> --}}
                            <div class="option-box1">
                                <label class="option-col next-btn">
                                    <input type="radio" name="med_care" value="1">
                                    <p class="desc-opt"><img src="{{ asset('images/check.png') }}"> Yes</p>
                                </label>
                                <label class="option-col next-btn">
                                    <input type="radio" name="med_care" value="0">
                                    <p class="desc-opt"><img src="{{ asset('images/cross.png') }}"> No</p>
                                </label>
                            </div>
                            {{-- <p class="skip-text"><span class="next-btn">Skip</span></p> --}}
                            <p class="call-text">Or Call: <a href="tel:18445331058">(844) 533 - 1058</a></p>
                        </div>
                    </div>

                    <div class="question-Box" style="display:none;" data-wdth="20">
                        <div class="step-inrBox">
                            <p class="step-hdng">What is your date of birth?</p>
                            <p class="tool-tips">Why we need your birthdate <i class="fa fa-info-circle"></i>
                                <span class="tooltiptext">Your age can change how you become eligible to enroll in certain
                                    Medicare plans. Letting us know your birth date lets us find your options. <i
                                        class="fa fa-lock"></i></span>
                            </p>
                            <div class="clearall"></div>
                            <div class="fld-box">
                                <div class="frmfield fl mm-fld" id="frmfield_f1">
                                    <input type="tel" min="1" class="input-fld month_bd" id="bd_month" name="bd_month"
                                        value="{{ old('bd_month') }}" placeholder="MM" maxlength="2"
                                        onkeyup="bd_validate()" autofocus>
                                    <div id="valid_month" style="margin-top:66px !important;">
                                        <p class="style_date">Enter Valid Month</p>
                                    </div>
                                </div>
                                <div class="frmfield fl day-fld">
                                    <input type="tel" min="1" class="input-fld" id="bd_day" name="bd_day"
                                        value="{{ old('bd_day') }}" placeholder="DD" maxlength="2"
                                        onkeyup="bd_validate()">
                                    <div id="valid_day" style="margin-top:66px !important;">
                                        <p class="style_date">Enter Valid Day</p>
                                    </div>
                                </div>
                                <div class="frmfield fl yr-fld">
                                    <input type="tel" min="1" class="input-fld" id="bd_year"
                                        name="bd_year" value="{{ old('bd_year') }}" placeholder="YYYY" maxlength="4"
                                        onkeyup="bd_validate()">
                                    <div id="valid_year"style="margin-top:66px !important;">
                                        <p class="style_date">Enter Valid Year</p>
                                    </div>
                                </div>
                                <div class="clearall"></div>
                                <a href="javascript:void(0);" class="continue-btn next-btn birthday"
                                    style="margin-top:28px!important;" id="bd_div">Continue</a>
                            </div>
                            {{-- <p class="skip-text"><span class="next-btn">Skip</span></p> --}}
                            <p class="call-text">Or Call: <a href="tel:18445331058">(844) 533 - 1058</a></p>
                            <div class="clearall"></div>
                            <p class="btn-back"><img src="{{ asset('images/back-arw.png') }}"><span>Previous</span></p>
                        </div>
                    </div>

                    <div class="question-Box" style="display:none;" data-wdth="35">
                        <div class="step-inrBox">
                            <p class="step-hdng">What is your zip code?</p>
                            <p class="step-sub-text">Medicare plans vary by county - this let us know what plans <br
                                    class="hide-mob">may be available to you.</p>
                            <div class="fld-box">
                                <div class="frmfield fl">
                                    <input type="text" id="autocomplete" name="address" class="input-fld"
                                        value="{{ old('address') }}" placeholder="Enter Address" autocomplete="off"
                                        onkeyup="validate_address()">
                                    <div style="margin-top:58px !important;">
                                        <p class="style_address valid" id="valid_address">Enter Valid Address</p>
                                    </div>
                                </div>
                                <div class="step-inrBox" id="map"></div>
                                <div class="frmfield fl">
                                    <input type="tel" name="zip_code" id="zip_code" class="input-fld"
                                        value="{{ old('zip_code') }}" placeholder="Enter Zip"
                                        onkeyup="validate_address()">
                                    <div style="margin-top:58px !important;">
                                        <p class="style_address" id="valid_zip_code">Enter Valid ZipCode</p>
                                    </div>
                                </div>

                                <input type="hidden" name="country" id="country" class="input-fld"
                                    value="{{ old('country') }}" placeholder="Enter country">

                                <input type="hidden" name="state" id="state" class="input-fld"
                                    value="{{ old('state') }}" placeholder="Enter state">

                                <input type="hidden" name="city" id="city" class="input-fld"
                                    value="{{ old('city') }}" placeholder="Enter city">


                                <div class="clearall"></div>
                                <a href="javascript:void(0);" class="continue-btn next-btn address_zip"
                                    id="address_validate" style="margin-top: 25px;">Continue</a>
                            </div>
                            <p class="call-text">Or Call: <a href="tel:18445331058">(844) 533 - 1058</a></p>
                            <div class="clearall"></div>
                            <p class="btn-back"><img src="{{ asset('images/back-arw.png') }}"><span>Previous</span></p>
                        </div>
                    </div>

                    {{-- <div class="question-Box" style="display:none;" data-wdth="60">
                <div class="step-inrBox">
                    <p class="step-hdng">Do any of these apply to you?</p>
                    <div class="option-box1">
                        <label class="option-row next-btn">
                            <input type="radio" name="last_employed" value="1">
                            <p class="desc-opt2"><img src="{{ asset('images/ico-moved.png') }}"> Moved recently or planning to move</p>
                        </label>   
                        <label class="option-row next-btn">
                            <input type="radio" name="last_employed" value="0">
                            <p class="desc-opt2"><img src="{{ asset('images/ico-lost.png') }}"> Lost employment coverage</p>
                        </label>   
                    </div>
                    {{-- <p class="skip-text"><span class="next-btn">Skip</span></p> --}}
                    {{-- <p class="call-text">Or Call: <a href="tel:(844) 123-4567">(844) 123-4567</a></p>
                    <div class="clearall"></div>
                    <p class="btn-back backStep"><img src="{{ asset('images/back-arw.png') }}"><span>Previous</span></p>
                </div> --}}
                    {{--  </div> --}}

                    <div class="question-Box step6" style="display:none;" data-wdth="75">
                        <div class="step-inrBox">
                            <p class="step-hdng">What is your name?</p>

                            <div class="fld-box">
                                <div class="frmfield fl">
                                    <input type="text" class="input-fld" name="first_name" id="first_name"
                                        value="{{ old('first_name') }}" placeholder="First Name"
                                        onkeyup="spaceCheck(this.val)" required>
                                    <div style="margin-top:66px !important;">
                                        <p class="style_name" id="valid_name">Enter Valid Name</p>
                                    </div>
                                </div>
                                <div class="clearall"></div>
                                <a href="javascript:void(0);" style="margin-top: 25px"
                                    class="continue-btn next-btn firstname" id="firstname">Continue</a>
                            </div>
                            <p class="call-text">Or Call: <a href="tel:18445331058">(844) 533 - 1058</a></p>
                            <div class="clearall"></div>
                            <p class="btn-back"><img src="{{ asset('images/back-arw.png') }}"><span>Previous</span></p>
                        </div>
                    </div>
                    <div class="question-Box" style="display:none;" data-wdth="85">
                        <div class="step-inrBox">
                            <p class="step-hdng">What is your email?</p>
                            <div class="fld-box">
                                <div class="frmfield fl">
                                    <input type="email" class="input-fld" name="email"
                                        pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}"
                                        value="{{ old('email') }}" id="email" placeholder="Email" required
                                        onkeyup="validateEmail(this.value)">
                                    <div style="margin-top:66px !important;">
                                        <p class="style_email" id="valid_email">Enter Valid Email</p>
                                    </div>
                                </div>
                                <div class="clearall"></div>
                                <a href="javascript:void(0);" class="continue-btn next-btn email_div"
                                    id="validate_email">Continue</a>
                            </div>
                            {{-- <p class="skip-text"><span class="next-btn">Skip</span></p> --}}
                            {{-- 18445331058 --}}
                            <p class="call-text">Or Call: <a href="tel:18445331058">(844) 533 - 1058</a></p>
                            <div class="clearall"></div>
                            <p class="btn-back"><img src="{{ asset('images/back-arw.png') }}"><span>Previous</span></p>
                        </div>
                    </div>

                    <div class="question-Box" style="display:none;" data-wdth="95">
                        <div class="step-inrBox">
                            <p class="step-hdng">Last step! Your results are ready. <br class="hide-mob">Enter phone
                                number.</p>

                            <div class="fld-box">
                                <div class="frmfield fl">
                                    <input class="input-fld" placeholder="Phone" value="{{ old('phone') }}"
                                        name="phone" type="tel" id="phone" onkeyup="validatePhone(this.value)"
                                        required>
                                    <div style="margin-top:60px !important;">
                                        <p class="style_phone" id="valid_phone">Enter Valid Phone</p>
                                        <br>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="clearall"></div>
                                <input id="leadid_token" name="universal_leadid" type="hidden" value=""/>
                                <a href="javascript:void(0);" class="phone">
                                    <button class="continue-btn" id="results" type='button'
                                        style="border: none!important;
                        outline: none!important;"
                                        onclick="validate_phone()">
                                        View My Results
                                    </button>
                                </a>
                                <p class="btn-back"><img src="{{ asset('images/back-arw.png') }}"><span>Previous</span>
                                </p>
                            </div>
                            <p class="btm-terms" style="margin-top:30px!important"><strong>Consent to Be
                                    Contacted</strong>. I agree to be contacted by
                                select insurance carriers and financial institutions listed <a href="list.php">here</a>,
                                their agents, individual insurance agents, and/or Medicare Pronto for marketing purposes
                                concerning insurance and/or other financial products by phone/text at my number provided
                                above (including by autodialer, prerecorded message and/or artificial voice), even if my
                                number is on a do not call list, or by email at the email address I have provided. Texts
                                about these offers may be sent from Medicare Pronto’s Shopper Alerts number (message & data
                                rates may apply). Consent is not required to make a purchase and I can opt out any time.</p>
                            <p class="clk-terms" style="margin-top:20px!important;display:flex;">By clicking the View My
                                Results
                                Button, I agree to the consents below
                                the button.</p>
                            <p class="btm-terms"><strong>Consent to Share Information.</strong> I agree to Medicare Pronto
                                sharing my information with Prudential companies and affiliates so that they can market
                                their products and services to me, and to Medicare Pronto sharing my information with third-party
                                partners so that select insurers and financial institutions, and their agents, may make
                                insurance, credit and other financial offers to me. I agree to Medicare Pronto’s <a
                                    href="privacy.php">Privacy Policy</a> and <a href="terms.php">Terms of Service</a>.</p>
                            <p class="btm-terms"><strong>Medicare.</strong> If I am Medicare-eligible, I am requesting to
                                speak with a licensed agent who is certified to discuss Medicare Advantage and Prescription
                                Drug insurance plans. This will NOT obligate me to enroll in a plan, affect my current
                                enrollment, or enroll me in a Medicare plan.
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

<!-- Start VWO Async SmartCode -->
<script type='text/javascript' id='vwoCode'>
window._vwo_code=window._vwo_code || (function() {
var account_id=680309,
version=1.4,
settings_tolerance=2000,
library_tolerance=2500,
use_existing_jquery=false,
is_spa=1,
hide_element='body',
/* DO NOT EDIT BELOW THIS LINE */
f=false,d=document,vwoCodeEl=document.querySelector('#vwoCode'),code={use_existing_jquery:function(){return use_existing_jquery},library_tolerance:function(){return library_tolerance},finish:function(){if(!f){f=true;var e=d.getElementById('_vis_opt_path_hides');if(e)e.parentNode.removeChild(e)}},finished:function(){return f},load:function(e){var t=d.createElement('script');t.fetchPriority='high';t.src=e;t.type='text/javascript';t.innerText;t.onerror=function(){_vwo_code.finish()};d.getElementsByTagName('head')[0].appendChild(t)},getVersion:function(){return version},getMatchedCookies:function(e){var t=[];if(document.cookie){t=document.cookie.match(e)||[]}return t},getCombinationCookie:function(){var e=code.getMatchedCookies(/(?:^|;)\s?(_vis_opt_exp_\d+_combi=[^;$]*)/gi);e=e.map(function(e){try{var t=decodeURIComponent(e);if(!/_vis_opt_exp_\d+_combi=(?:\d+,?)+\s*$/.test(t)){return''}return t}catch(e){return''}});var i=[];e.forEach(function(e){var t=e.match(/([\d,]+)/g);t&&i.push(t.join('-'))});return i.join('|')},init:function(){window.settings_timer=setTimeout(function(){_vwo_code.finish()},settings_tolerance);var e=d.createElement('style'),t=hide_element?hide_element+'{opacity:0 !important;filter:alpha(opacity=0) !important;background:none !important;}':'',i=d.getElementsByTagName('head')[0];e.setAttribute('id','_vis_opt_path_hides');vwoCodeEl&&e.setAttribute('nonce',vwoCodeEl.nonce);e.setAttribute('type','text/css');if(e.styleSheet)e.styleSheet.cssText=t;else e.appendChild(d.createTextNode(t));i.appendChild(e);var n=this.getCombinationCookie();this.load('https://dev.visualwebsiteoptimizer.com/j.php?a='+account_id+'&u='+encodeURIComponent(d.URL)+'&f='+ +is_spa+'&vn='+version+(n?'&c='+n:''));return settings_timer}};window._vwo_settings_timer = code.init();return code;}());
</script>
<!-- End VWO Async SmartCode -->
    <script src=//b-js.ringba.com/CAcf73f595e34a4dd68bcd8766fda14a50 async></script>
    <script type="text/javascript">
        // Initialize and add the map
        function initMap() {
            // The location of Uluru
            const uluru = {
                lat: -25.344,
                lng: 131.031
            };
            // The map, centered at Uluru
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: uluru,
            });
            // The marker, positioned at Uluru
            const marker = new google.maps.Marker({
                position: uluru,
                map: map,
            });
        }
        window.initMap = initMap;
    </script>

    {{-- <script type="text/javascript">
    // This sample uses the Places Autocomplete widget to:
// 1. Help the user select a place
// 2. Retrieve the address components associated with that place
// 3. Populate the form fields with those address components.
// This sample requires the Places library, Maps JavaScript API.
// Include the libraries=places parameter when you first load the API.
// For example: <script
// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
let autocomplete;
let address1Field;
let address2Field;
let postalField;

function initAutocomplete() {
    console.log('here');
address1Field = document.querySelector("#address");
address2Field = document.querySelector("#address2");
postalField = document.querySelector("#zip_code");
// Create the autocomplete object, restricting the search predictions to
// addresses in the US and Canada.
autocomplete = new google.maps.places.Autocomplete(address1Field, {
componentRestrictions: { country: ["us", "ca"] },
fields: ["address_components", "geometry"],
types: ["address"],
});
address1Field.focus();
// When the user selects an address from the drop-down, populate the
// address fields in the form.
autocomplete.addListener("place_changed", fillInAddress);
}

function fillInAddress() {
// Get the place details from the autocomplete object.
const place = autocomplete.getPlace();
let address1 = "";
let postcode = "";

// Get each component of the address from the place details,
// and then fill-in the corresponding field on the form.
// place.address_components are google.maps.GeocoderAddressComponent objects
// which are documented at http://goo.gle/3l5i5Mr
for (const component of place.address_components) {
// @ts-ignore remove once typings fixed
const componentType = component.types[0];

switch (componentType) {
  case "street_number": {
    address1 = `${component.long_name} ${address1}`;
    break;
  }

  case "route": {
    address1 += component.short_name;
    break;
  }

  case "postal_code": {
    postcode = `${component.long_name}${postcode}`;
    break;
  }

  case "postal_code_suffix": {
    postcode = `${postcode}-${component.long_name}`;
    break;
  }
  case "locality":
    document.querySelector("#locality").value = component.long_name;
    break;
  case "administrative_area_level_1": {
    document.querySelector("#state").value = component.short_name;
    break;
  }
  case "country":
    document.querySelector("#country").value = component.long_name;
    break;
}
}

address1Field.value = address1;
postalField.value = postcode;
// After filling the form with address components from the Autocomplete
// prediction, set cursor focus on the second address line to encourage
// entry of subpremise information such as apartment, unit, or floor number.
postalField.focus();
}

window.initAutocomplete = initAutocomplete;



</script> --}}
    {{-- <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAH0hKto_ytpHs2vLnVnngnSbAPWtbumCE&libraries=places&callback=initMap">
</script> --}}
    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key=AIzaSyAH0hKto_ytpHs2vLnVnngnSbAPWtbumCE&libraries=places&callback=initMap">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                console.log(place);
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());
                var latlng = new google.maps.LatLng(place.geometry['location'].lat(), place.geometry['location']
                    .lng());
                geocoder = new google.maps.Geocoder();

                geocoder.geocode({
                    'latLng': latlng
                }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {

                            for (j = 0; j < results[0].address_components.length; j++) {
                                if (results[0].address_components[j].types[0] == 'postal_code') {
                                    $('#zip_code').val(results[0].address_components[j].short_name);
                                }
                                if (results[0].address_components[j].types[0] == 'country') {
                                    $('#country').val(results[0].address_components[j].long_name);
                                }

                                if (results[0].address_components[j].types[0] ==
                                    'administrative_area_level_1') {
                                    $('#state').val(results[0].address_components[j].long_name);
                                }

                                if (results[0].address_components[j].types[0] == 'locality') {
                                    $('#city').val(results[0].address_components[j].long_name);
                                }
                                // alert("Zip Code: " + results[0].address_components[j].short_name);
                            }
                            zip = $('#zip_code').val();
                            if (zip != '') {
                                $('#address_validate').css('background-color', 'green');
                                $('#address_validate').addClass('next-btn');

                                $('#valid_zip_code').css('display', 'none');
                                $('#zip_code').css('border', '1px solid grey');

                            } else {
                                $('#valid_zip_code').css('display', 'block');
                                $('#zip_code').css('border', '1px solid red');
                            }
                        }
                    } else {
                        alert("Geocoder failed due to: " + status);
                    }
                });
                $("#latitudeArea").removeClass("d-none");
                $("#longtitudeArea").removeClass("d-none");
            });
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.continue-btn').css('background-color', 'grey');
            // $('.next-btn').click(function(e) {
            //     var item = $(this);
            //     setTimeout(function() {
            //         var val = $(item).closest('.question-Box').find(":input").val();

            //         if (val != "") {
            //                 $(item).closest('.question-Box').hide();
            //                 $(item).closest('.question-Box').next('.question-Box').show();
            //         } else {
            //             $(item).css('background-color', 'grey');
            //             $(item).removeClass('next-btn');
            //             $(item).addClass('disabled');
            //         }
            //         // }
            //         progress();
            //     }, 300);
            // });


            $('.next-btn').click(function(e) {
                
                var item = $(this);
                setTimeout(function() {

                    var val = $(item).closest('.question-Box').find(":input").val();
                    var zip = $('#zip_code').val();
                    var month = $('#bd_month').val();
                    var year = $('#bd_year').val();
                    var day = $('#bd_day').val();
                    if (val != "") {

                        if ($(item).hasClass('email_div')) {
                            if (/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/.test(val)) {
                                $(item).closest('.question-Box').hide();
                                $(item).closest('.question-Box').next('.question-Box').show();
                            } else {
                                alert("Fill the field with correct Email");
                            }
                        }
                        else if($(item).hasClass('option-col')){
                            $(item).closest('.question-Box').hide();
                             let currentdiv = $(item).closest('.question-Box').next('.question-Box');
                             currentdiv.show();
                             currentdiv.find('#bd_month').focus();
                        } else if ($(item).hasClass('address_zip')) {
                            if (val != '' && zip != '') {
                                $(item).closest('.question-Box').hide();
                                $(item).closest('.question-Box').next('.question-Box').show();
                            } else {
                                alert('Please Enter Zip Code');
                            }
                        } else if ($(item).hasClass('birthday')) {
                            
                            if ((month <= 12 && month >= 1) && (year >= 1900 && year < 2006) && (
                                    day <= 31 && day >= 1)) {
                                $(item).closest('.question-Box').hide();
                                $(item).closest('.question-Box').next('.question-Box').show();
                            } else {

                            }
                        } else if ($(item).hasClass('phone')) {
                            // alert('phone');
                            if (val == '') {
                                alert('Please Enter Valid Phone Number');
                            }

                        } else {
                            $(item).closest('.question-Box').hide();
                           
                            $(item).closest('.question-Box').next('.question-Box').show();
                        }
                    } else {
                        if ($(item).hasClass('birthday')) {
                            $('#valid_month').css('display', 'block');
                            $('#valid_day').css('display', 'block');
                            $('#valid_year').css('display', 'block');

                            $('#bd_month').css('border', '1px solid red');
                            $('#bd_day').css('border', '1px solid red');
                            $('#bd_year').css('border', '1px solid red');

                        } else if ($(item).hasClass('address_zip')) {

                            $('#valid_address').css('display', 'block');
                            $('#valid_zip_code').css('display', 'block');
                            $('#zip_code').css('border', '1px solid red');
                            $('#autocomplete').css('border', '1px solid red');

                        } else if ($(item).hasClass('firstname')) {

                            $('#valid_name').css('display', 'block');

                            $('#first_name').css('border', '1px solid red');


                        } else if ($(item).hasClass('email_div')) {

                            $('#valid_email').css('display', 'block');

                            $('#email').css('border', '1px solid red');


                        } else {

                            alert("fill the field");
                        }
                    }
                    // }
                    progress();
                }, 300);
            });
            $('.btn-back').click(function(e) {
                var item = $(this);
                setTimeout(function() {
                    if ($(item).hasClass('goStep1')) {
                        $(item).closest('.question-Box').hide();
                        $('.step4').show();
                    } else {
                        $(item).closest('.question-Box').hide();
                        $(item).closest('.question-Box').prev('.question-Box').show();
                    }
                    progress();
                }, 300);
            });
            // $("#phone").mask("(999) 999-9999");
            $(":input").inputmask();
            $("#phone").inputmask({
                "mask": "(999) 999-9999"
            });
        });

        function progress() {
            var progressVal = $('.question-Box:visible').attr('data-wdth');
            $(".prgress-1").css("width", progressVal + "%");
        }

        function spaceCheck(val) {
            if (val != '') {
                $('#firstname').removeClass('disabled');
                $('#firstname').css('background-color', 'green');
                $('#firstname').addClass('next-btn');
                $('#valid_name').css('display', 'none');

                $('#first_name').css('border', '1px solid grey');
            } else {
                $('#firstname').addClass('disabled');
                $('#firstname').css('background-color', 'grey');
                $('#firstname').removeClass('next-btn');
                $('#valid_name').css('display', 'block');

                $('#first_name').css('border', '1px solid red');
            }
        }

        function validateEmail(val) {
            if (/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/.test(val)) {
                // $('#validate_email').removeClass('disabled');
                $('#valid_email').css('display', 'none');

                $('#email').css('border', '1px solid grey');
                $('#validate_email').css('background-color', 'green');
                $('#validate_email').addClass('next-btn');
            } else {
                // $('#validate_email').addClass('disabled');
                $('#valid_email').css('display', 'block');

                $('#email').css('border', '1px solid red');
                $('#validate_email').css('background-color', 'grey');
                $('#validate_email').removeClass('next-btn');
            }
        }


        function validate_address() {
            address = $('#autocomplete').val();
            zipcode = $('#zip_code').val();
            if (address != '' && zipcode != '') {
                // $('#address_validate').removeClass('disabled');
                $('#address_validate').css('background-color', 'green');
                $('#address_validate').addClass('next-btn');

            } else {
                // $('#address_validate').addClass('disabled');
                $('#address_validate').css('background-color', 'grey');
                $('#address_validate').removeClass('next-btn');
            }
            if (address != '') {
                $('#valid_address').css('display', 'none');
                $('#autocomplete').css('border', '1px solid grey');
            } else {
                $('#valid_address').css('display', 'block');
                $('#autocomplete').css('border', '1px solid red');
            }
            if (zipcode != '') {
                $('#valid_zip_code').css('display', 'none');
                $('#zip_code').css('border', '1px solid grey');
            } else {
                $('#valid_zip_code').css('display', 'block');
                $('#zip_code').css('border', '1px solid red');
            }
        }


        function bd_validate() {

            $month = $('#bd_month').val();
            $year = $('#bd_year').val();
            $day = $('#bd_day').val();
            // if( ($month < 12 || $month > 1) && ($year > 1900  || $year != 1) && ($day < 31 || $day > 1  )){

            if (($month <= 12 && $month >= 1) && ($year >= 1900 && $year < 2006) && ($day <= 31 && $day >= 1)) {

                $('#bd_div').css('background-color', 'green');
                $('#bd_div').addClass('next-btn');
            } else {
                // alert('Please select correct birth date');
                $('#bd_div').css('background-color', 'grey');
                $('#bd_div').removeClass('next-btn');
            }

            if ($month <= 12 && $month >= 1) {

                $('#valid_month').css('display', 'none');
                $('#bd_month').css('border', '1px solid grey');
                if ($month.length == 2) {
                    $('#bd_day').focus();
                }
            } else {
                $('#valid_month').css('display', 'block');
                $('#bd_month').css('border', '1px solid red');
            }
            //Valid Month
            if ($year >= 1900 && $year < 2006) {
                $('#valid_year').css('display', 'none');
                $('#bd_year').css('border', '1px solid grey');
            } else {
                $('#valid_year').css('display', 'block');
                $('#bd_year').css('border', '1px solid red');
            }
            //Valid Day
            if ($day <= 31 && $day >= 1) {
                $('#valid_day').css('display', 'none');
                $('#bd_day').css('border', '1px solid grey');
                if ($day.length == 2) {
                    $('#bd_year').focus();
                }
            } else {
                $('#valid_day').css('display', 'block');
                $('#bd_day').css('border', '1px solid red');
            }

            if ($day == '') {
                $('#valid_day').css('display', 'none');
                $('#bd_day').css('border', '1px solid grey');
            }
            if ($month == '') {
                $('#valid_month').css('display', 'none');
                $('#bd_month').css('border', '1px solid grey');
            }
            if ($year == '') {
                $('#valid_year').css('display', 'none');
                $('#bd_year').css('border', '1px solid grey');
            }

        }

        function validatePhone(val) {
            console.log(val);
            if (/^\([0-9]{3}\) [0-9]{3}\-[0-9]{4}$/.test(val)) {
                $('#results').css('background-color', 'green');
                $('#results').attr('type', 'submit');

                $('#valid_phone').css('display', 'none');
                $('#phone').css('border', '1px solid grey');

            } else {
                $('#results').attr('type', 'button');
                $('#results').css('background-color', 'grey');
                $('#valid_phone').css('display', 'block');
                $('#phone').css('border', '1px solid red');
            }


        }

        function validate_phone() {
            // val = $('#phone').val();
            type = $('#results').attr('type');
            // alert(type);
            if (type == 'button') {
                $('#valid_phone').css('display', 'block');
                $('#phone').css('border', '1px solid red');

            }
        }
        // function monthSelect(val){

        //     let month = val;
        //     if(month > 12){
        //         $('#bd_div').css('background-color', 'grey');
        //         $('#bd_div').removeClass('next-btn');
        //     }
        //     else{
        //         $('#bd_div').css('background-color', 'green');
        //         $('#bd_div').addClass('next-btn');
        //     }
        // }
        // function daySelect(val){
        //     let day = val;
        //     if(day > 31 ){
        //         $('#bd_div').css('background-color', 'grey');
        //         $('#bd_div').removeClass('next-btn');
        //     }
        //     else{
        //         $('#bd_div').css('background-color', 'green');
        //         $('#bd_div').addClass('next-btn');
        //     }
        // }
        // function yearSelect(val){
        //     let year = val;
        //     if(year < 1900)
        //     {
        //         $('#bd_div').css('background-color', 'grey');
        //         $('#bd_div').removeClass('next-btn');
        //     }
        //     else{
        //         $('#bd_div').css('background-color', 'green');
        //         $('#bd_div').addClass('next-btn');
        //     }
        // }
        
    </script>
    <script id="LeadiDscript" type="text/javascript">
        (function() {
        var s = document.createElement('script');
        s.id = 'LeadiDscript_campaign';
        s.type = 'text/javascript';
        s.async = true;
        s.src = '//create.lidstatic.com/campaign/3f941114-920b-939e-73fc-8a8e9bbdfc4b.js?snippet_version=2&f=reset';
        var LeadiDscript = document.getElementById('LeadiDscript');
        LeadiDscript.parentNode.insertBefore(s, LeadiDscript);
        })();
        </script>
        <noscript><img src='//create.leadid.com/noscript.gif?lac=450FD1D4-AEB4-10DE-9332-71AC902F9BE1&lck=3f941114-920b-939e-73fc-8a8e9bbdfc4b&snippet_version=2' /></noscript>
        <!-- TrustedForm -->
<script type="text/javascript">
    (function() {
    var tf = document.createElement('script');
    tf.type = 'text/javascript'; tf.async = true;
    tf.src = ("https:" == document.location.protocol ? 'https' : 'http') + "://api.trustedform.com/trustedform.js?field=xxTrustedFormCertUrl&ping_field=xxTrustedFormPingUrl&l=" + new Date().getTime() + Math.random();
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(tf, s);
    })();
    </script>
    <noscript>
    <img src="https://api.trustedform.com/ns.gif" />
    </noscript>
    <!-- End TrustedForm -->
@endsection
