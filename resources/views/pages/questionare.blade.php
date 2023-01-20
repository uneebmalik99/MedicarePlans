@extends('layouts.app')
@section('content')
{{-- {{ dd($s_1,$s_2,$s_3,$s_4,$s_5,$transaction_id) }} --}}

<div class="container">
    <div class="quiz-inr-box" >
        <div class="box-header">
            <h2>Compare & Find Medicare Plan <br>That's Right For You!</h2>
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
        <form  action="{{ route('questionare.save') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <input type="hidden" name="s1_id" value="{{ @$s_1 }}" id="">
            <input type="hidden" name="s2_id" value="{{ @$s_2 }}" id="">
            <input type="hidden" name="s3_id" value="{{ @$s_3 }}" id="">
            <input type="hidden" name="s4_id" value="{{ @$s_4 }}" id="">
            <input type="hidden" name="s5_id" value="{{ @$s_5 }}" id="">
            <input type="hidden" name="transaction_id" value="{{ @$transaction_id }}" id="">
            {{-- @method('post') --}}
            <div class="question-Box" data-wdth="5" style="display:;">
                <div class="step-inrBox">
                    <p class="step-hdng">Are you currently enrolled in both Medicare Parts A & B?</p>
                    <p class="step-sub-text">Part A covers hospital care. Part B covers medical care.</p>
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
                    <p class="call-text">Or Call: <a href="tel:(844) 123-4567">(844) 123-4567</a></p>
                </div>
            </div>
            
            <div class="question-Box" style="display:none;" data-wdth="20">
                <div class="step-inrBox">
                    <p class="step-hdng">What is your date of birth?</p>
                    <p class="tool-tips">Why we need your birthdate <i class="fa fa-info-circle"></i>
                        <span class="tooltiptext">Your age can change how you become eligible to enroll in certain Medicare plans. Letting us know your birth date lets us find your options.  <i class="fa fa-lock"></i></span>
                    </p>
                    <div class="clearall"></div>
                    <div class="fld-box">
                        <div class="frmfield fl mm-fld">
                            <input type="tel" class="input-fld" name="bd_month" value="{{ old('bd_month') }}" placeholder="MM" maxlength="2" onkeyup="monthSelect(this.value)">
                        </div>
                        <div class="frmfield fl day-fld">
                            <input type="tel" class="input-fld" name="bd_day" value="{{ old('bd_day') }}" placeholder="DD" maxlength="2" onkeyup="daySelect(this.value)">
                        </div>
                        <div class="frmfield fl yr-fld">
                            <input type="tel" class="input-fld" name="bd_year"  value="{{ old('bd_year') }}"  placeholder="YYYY" maxlength="4" onkeyup="yearSelect(this.value)">
                        </div>
                        <div class="clearall"></div>
                        <a href="javascript:void(0);" class="continue-btn next-btn">Continue</a>
                    </div>
                    {{-- <p class="skip-text"><span class="next-btn">Skip</span></p> --}}
                    <p class="call-text">Or Call: <a href="tel:(844) 123-4567">(844) 123-4567</a></p>
                    <div class="clearall"></div>
                    <p class="btn-back"><img src="{{ asset('images/back-arw.png') }}"><span>Previous</span></p>
                </div>
            </div>
        
            <div class="question-Box" style="display:none;" data-wdth="35">
                <div class="step-inrBox">
                    <p class="step-hdng">What is your zip code?</p>
                    <p class="step-sub-text">Medicare plans vary by county - this let us know what plans <br class="hide-mob">may be available to you.</p>
                    <div class="fld-box">
                        
                        <div class="frmfield fl">
                            <input type="tel" id="autocomplete" name="address" class="input-fld" value = "{{ old('address') }}"placeholder="Enter Address" autocomplete="off">
                        </div>
                        <div class="step-inrBox" id="map"></div>
                        <div class="frmfield fl">
                            <input type="tel" name="zip_code" id="zip_code" class="input-fld" value = "{{ old('zip_code') }}"placeholder="Enter Zip">
                        </div>
                        <div class="clearall"></div>
                        <a href="javascript:void(0);" class="continue-btn next-btn">Continue</a>
                    </div>
                    <p class="call-text">Or Call: <a href="tel:(844) 123-4567">(844) 123-4567</a></p>
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
                            <input type="text" class="input-fld" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="First Name" onkeyup="spaceCheck(this.value)"    required>
                        </div>
                        <div class="frmfield fl">
                            <input type="tel" class="input-fld" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required>
                        </div>
                        <div class="clearall"></div>
                        <a href="javascript:void(0);" class="continue-btn next-btn">Continue</a>
                    </div>
                    <p class="call-text">Or Call: <a href="tel:(844) 123-4567">(844) 123-4567</a></p>
                    <div class="clearall"></div>
                    <p class="btn-back"><img src="{{ asset('images/back-arw.png') }}"><span>Previous</span></p>
                </div>
            </div>
            
            <div class="question-Box" style="display:none;" data-wdth="85">
                <div class="step-inrBox">
                    <p class="step-hdng">What is your email?</p>
                    
                    <div class="fld-box">
                        <div class="frmfield fl">
                            <input type="email" class="input-fld" name="email"  pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}" value="{{ old('email') }}" id="email" placeholder="Email" required>
                        </div>
                        <div class="clearall"></div>
                        <a href="javascript:void(0);" class="continue-btn next-btn email_div">Continue</a>
                    </div>
                    {{-- <p class="skip-text"><span class="next-btn">Skip</span></p> --}}
                    <p class="call-text">Or Call: <a href="tel:(844) 123-4567">(844) 123-4567</a></p>
                    <div class="clearall"></div>
                    <p class="btn-back"><img src="{{ asset('images/back-arw.png') }}"><span>Previous</span></p>
                </div>
            </div>
            
            <div class="question-Box" style="display:none;" data-wdth="95">
                <div class="step-inrBox">
                    <p class="step-hdng">Last step! Your results are ready. <br class="hide-mob">Mobile or home phone number.</p>
                    
                    <div class="fld-box">
                        <div class="frmfield fl">
                            <input class="input-fld" placeholder="Phone" value="{{ old('phone') }}" name="phone" type="tel" value="" id="phone">
                        </div>
                        
                        <p class="clk-terms">By clicking the View My Results Button, I agree to the consents below the button.</p>
                        
           
                        <div class="clearall"></div>
                        <button class="continue-btn" type='submit' style="border: none!important;
                        outline: none!important;">
                        <a href="javascript:void(0);" >View My Results</a>
                        </button>
                    </div>
                    
                    <p class="btm-terms"><strong>Consent to Be Contacted</strong>. I agree to be contacted by select insurance carriers and financial institutions listed <a href="#">here</a>, their agents, individual insurance agents, and/or Assurance for marketing purposes concerning insurance and/or other financial products by phone/text at my number provided above (including by autodialer, prerecorded message and/or artificial voice), even if my number is on a do not call list, or by email at the email address I have provided. Texts about these offers may be sent from Assurance’s Shopper Alerts number, 71953 (message & data rates may apply). Consent is not required to make a purchase and I can opt out any time.</p>
                    
                    <p class="btm-terms"><strong>Consent to Share Information.</strong> I agree to Assurance sharing my information with Prudential companies and affiliates so that they can market their products and services to me, and to Assurance sharing my information with third-party partners so that select insurers and financial institutions, and their agents, may make insurance, credit and other financial offers to me. I agree to Assurance’s <a href="#">Privacy Policy</a> and <a href="#">Terms of Service</a>.</p>
                    
                    <p class="btm-terms"><strong>Medicare.</strong> If I am Medicare-eligible, I am requesting to speak with a licensed agent who is certified to discuss Medicare Advantage and Prescription Drug insurance plans. This will NOT obligate me to enroll in a plan, affect my current enrollment, or enroll me in a Medicare plan.

                    </p>
                </div>
            </div>
        </form>    
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    // Initialize and add the map
function initMap() {
// The location of Uluru
const uluru = { lat: -25.344, lng: 131.031 };
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
<script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyAH0hKto_ytpHs2vLnVnngnSbAPWtbumCE&libraries=places&callback=initMap"></script>
<script>
    google.maps.event.addDomListener(window, 'load', initialize);

    function initialize() {
        var input = document.getElementById('autocomplete');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            console.log(place);
            $('#latitude').val(place.geometry['location'].lat());
            $('#longitude').val(place.geometry['location'].lng());
            var latlng = new google.maps.LatLng(place.geometry['location'].lat(), place.geometry['location'].lng());
            geocoder = new google.maps.Geocoder();

        geocoder.geocode({'latLng': latlng}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    // var address = results[0].address_components;
                    // var zipcode = address[address.length - 1].long_name;
                    // console.log(JSON.stringify(address));
                    for (j = 0; j < results[0].address_components.length; j++) {
                        if (results[0].address_components[j].types[0] == 'postal_code')
                            
                            $('#zip_code').val(results[0].address_components[j].short_name);
                           // alert("Zip Code: " + results[0].address_components[j].short_name);
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
    
    $(document).ready(function(){
        
        
        $('.next-btn').click(function(e) {		
            var item = $(this);	
            setTimeout(function(){
                
                var val=$(item).closest('.question-Box').find(":input").val();
                
                // if ($(item).hasClass('go-step6')){
                //     $(item).closest('.question-Box').hide();
                //     $('.step6').show();
                //     $('.step6').find('.btn-back').addClass('goStep1');
                //  }else if ($(item).hasClass('go-next')){
                //     if(val!=""){
                        
                //         $(item).closest('.question-Box').hide();
                //         $(item).closest('.question-Box').next('.question-Box').show();
                //         $('.step6').find('.btn-back').removeClass('goStep1');
                //     }
                //     else{
                //         alert("fill the field");
                //     }
                    
                // }
                // else{
                if(val!=""){
                        if($(item).hasClass('email_div')){
                            if(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/.test(val)){
                                $(item).closest('.question-Box').hide();

                                $(item).closest('.question-Box').next('.question-Box').show();
                            }
                            else{
                                alert("Fill the field with correct Email");
                            }
                            }
                        else{
                            $(item).closest('.question-Box').hide();

                            $(item).closest('.question-Box').next('.question-Box').show();
                        }
                        
                        }

                     else{
                        alert("fill the field");
                     }
                    
                // }
                
                progress();
            }, 300);
        });
        
        
    
        $('.btn-back').click(function(e) {		
            var item = $(this);	
            setTimeout(function(){
                if ($(item).hasClass('goStep1')){
                    $(item).closest('.question-Box').hide();
                    $('.step4').show();
                }else{
                    $(item).closest('.question-Box').hide();
                    $(item).closest('.question-Box').prev('.question-Box').show();
                }
                
                progress();
            }, 300);
        });
        
        
    
    
        $("#phone").mask("(999) 999-9999");
        
    });
    
    
    function progress(){
        
        var progressVal = $('.question-Box:visible').attr('data-wdth');
        $(".prgress-1").css("width", progressVal + "%");
                
        
    }
    
    function spaceCheck(val){
        if(hasWhiteSpace(val)){
            $( "#last_name" ).focus();
        }
    }
    function hasWhiteSpace(s) {
            return /\s/g.test(s);
    }
    function monthSelect(val){
        
        let month = val;
        if(month > 12){
            alert("Select Valid Month for Birth Date");
        }
    }
    function daySelect(val){
        let day = val;
        if(day > 31 ){
            alert("Select Valid Day for Birth Date");
        }
    }
    function yearSelect(val){
        let year = val;
        if(year < 1900)
        {
            alert("Select Valid Year for Birth Date");
        }
    }
    </script>

    
@endsection