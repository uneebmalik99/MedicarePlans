@extends('layouts.app')
@section('content')
<style>
    .card {
        width: 100%;
        margin: 0 auto;
        margin-top: 19px;

    }
    .active{
        
        background: #518FCF!important;
        box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        color: #F2F2F2;
    }
    header {
        width: 100%;
        height: 50px;
        background: #2E75BF;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 0 auto 16;
    }

    .btn {
        background: #F2F2F2;
        box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        border: none;
        outline: none;
        padding: 12px 40px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn span {
        margin-left: 6px;
    }
    .btn:hover{
        border: 2px solid #2E75BF ;
    }

    .question_text_f1 {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 500;
        font-size: 20px;
        margin-left: 6px;
        /* identical to box height */

        color: #000000;
    }

    .question_text_f2 {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 500;
        font-size: 15px;


        /* identical to box height */

        color: #000000;
    }

    .input_label {
        font-family: 'Inter';
        font-style: normal;
        font-weight: 500;
        font-size: 22px;
        /* identical to box height */

        color: #2E75BF;
    }

    form input[type="text"] {

        box-sizing: border-box;

        background: rgba(241, 241, 241, 0.29);
        box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        width: 75% !important;
        height: 45px !important;
    }
    form input[type="radio"] {

        
        background: transparent;
        box-shadow: none !important;
        border: none!important;
        outline:none!important;
        z-index: 1
        }
    
    ::placeholder{
        font-family: 'Inter';
        font-style: normal;
        font-weight: 500;

        /* identical to box height */

        color: #B7B7B7;
    }
    .result_btn {

        width: 384px;
        height: 59px;
        display: flex;
        justify-content: center;
        align-items: center;

        background: #518FCF;
        box-shadow: 2px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 10px;
        border: none;
        outline: none;
        padding: 0 15px;
        margin: 42px 0;
        color: white;
    }

    .form_text {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
</style>
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
                <h2>Seniors are eligible for Medicare Flex Card assistance for groceries, dentures, eyeglasses, and hearing aids based on zip code!</h2>
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
                <form action="{{ route('v1_store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="s1_id" value="{{ @$s_1 }}" id="">
                    <input type="hidden" name="s2_id" value="{{ @$s_2 }}" id="">
                    <input type="hidden" name="s3_id" value="{{ @$s_3 }}" id="">
                    <input type="hidden" name="s4_id" value="{{ @$s_4 }}" id="">
                    <input type="hidden" name="s5_id" value="{{ @$s_5 }}" id="">
                    <input type="hidden" name="transaction_id" value="{{ @$transaction_id }}" id="">
                    <input type="hidden" name="aff_id" value="{{ @$aff_id }}" id="">
                    <input type="hidden" name="off_id" value="{{@$off_id}}" id="">
                    {{-- @method('post') --}}
                    <div class="question-Box" data-wdth="5" style="">
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
                                <div class="" style="display:flex;margin-left:-28px!important;">
                                    <label class="btn bd_class_1 option-col" onclick="selectAge()">
                                    
                                        <svg width="20" height="20" viewBox="0 0 38 38" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <rect width="38" height="38" fill="url(#pattern0)" />
                                            <defs>
                                                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1"
                                                    height="1">
                                                    <use xlink:href="#image0_79_56" transform="scale(0.015625)" />
                                                </pattern>
                                                <image id="image0_79_56" width="64" height="64"
                                                    xlink:href="data:image/png;base64,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" />
                                            </defs>
                                        </svg>
                                        <input type="radio" class="birthday1" style="border:none;outline:none"  name="bd_class" value="64-70"/>
                                        <span>64-70</span>
                                    </label>
    
                                    <label class ="btn bd_class_2 option-col" onclick="selectAge()">   
                                        <svg width="20" height="20" viewBox="0 0 38 38" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <rect width="38" height="38" fill="url(#pattern0)" />
                                            <defs>
                                                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1"
                                                    height="1">
                                                    <use xlink:href="#image0_79_56" transform="scale(0.015625)" />
                                                </pattern>
                                                <image id="image0_79_56" width="64" height="64"
                                                    xlink:href="data:image/png;base64,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" />
                                            </defs>
                                        </svg> 
                                        <input type="radio" class="birthday1" name="bd_class" value="71-75">
                                        <span>71-75</span>
                                        
                                    </label>
                                        
                                    <div class="btn bd_class_3 option-col" onclick="selectAge()">
                                        <svg width="20" height="20" viewBox="0 0 38 38" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <rect width="38" height="38" fill="url(#pattern0)" />
                                            <defs>
                                                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1"
                                                    height="1">
                                                    <use xlink:href="#image0_79_56" transform="scale(0.015625)" />
                                                </pattern>
                                                <image id="image0_79_56" width="64" height="64"
                                                    xlink:href="data:image/png;base64,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" />
                                            </defs>
                                        </svg>
                                        <input type="radio" class="birthday1" name="bd_class" value="76+" />
                                        <span>76+</span>
                                    </div>
                                </div>
                                <div class="clearall"></div>
                                <a href="javascript:void(0);" class="continue-btn next-btn birth"
                                    style="margin-top:28px!important;" id="bd_div">Continue</a>
                            </div>
                            {{-- <p class="skip-text"><span class="next-btn">Skip</span></p> --}}
                            <p class="call-text">Or Call: <a href="tel:18445331058">(844) 533 - 1058</a></p>
                            <div class="clearall"></div>
                            <p class="btn-back"><img src="{{ asset('images/back-arw.png') }}"><span>Previous</span></p>
                        </div>
                    </div>

                    {{-- <div class="question-Box" style="display:none;" data-wdth="35">
                        <div class="step-inrBox">
                            <p class="step-hdng">What is your zip code?</p>
                            <p class="step-sub-text">Medicare plans vary by county - this let us know what plans <br
                                    class="hide-mob">may be available to you.</p>
                            <div class="fld-box">

                                <div class="frmfield fl">
                                    <input type="tel" id="autocomplete" name="address" class="input-fld"
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
                                    <div style="margin-top:66px !important;">
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
                    </div> --}}

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

                    {{-- <div class="question-Box step6" style="display:none;" data-wdth="75">
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
                    </div> --}}
                    {{-- <div class="question-Box" style="display:none;" data-wdth="85">
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
                            <p class="call-text">Or Call: <a href="tel:18445331058">(844) 533 - 1058</a></p>
                            <div class="clearall"></div>
                            <p class="btn-back"><img src="{{ asset('images/back-arw.png') }}"><span>Previous</span></p>
                        </div>
                    </div> --}}

                    <div class="question-Box" style="display:none;" data-wdth="95">
                        <div class="step-inrBox">
                            <p class="step-hdng">Last step!<br class="hide-mob">Please Enter Your Name Email and Phone Number, Your results are ready.</p>

                            <div class="fld-box">
                                <div class="frmfield f1">
                                    <input class="input-fld" placeholder="First Name" value="{{ old('First_Name') }}"
                                    name="name" type="tel" id="name" onkeyup="name_validate(this.value)"
                                    required>
                                    <div style="margin-top:60px !important;">
                                        <p class="style_phone" id="valid_name">Enter Valid Name</p>
                                        <br>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="frmfield f1">

                                    <input class="input-fld" placeholder="Email" value="{{ old('email') }}"
                                    name="email" type="email" id="email" onkeyup="email_validate(this.value)"  required>
                                    <div style="margin-top:60px !important;">
                                        <p class="style_phone" id="valid_email">Enter Valid Email</p>
                                        <br>
                                        <p></p>
                                    </div>
                                </div>
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

                            <p class="btm-terms" style="margin-top:30px!important"><strong>Consent to Be Contacted</strong>. I agree to be contacted by
                                select insurance carriers and financial institutions listed <a href="#">here</a>,
                                their agents, individual insurance agents, and/or Assurance for marketing purposes
                                concerning insurance and/or other financial products by phone/text at my number provided
                                above (including by autodialer, prerecorded message and/or artificial voice), even if my
                                number is on a do not call list, or by email at the email address I have provided. Texts
                                about these offers may be sent from Assurance’s Shopper Alerts number, 71953 (message & data
                                rates may apply). Consent is not required to make a purchase and I can opt out any time.</p>

                                <p class="clk-terms" style="margin-top:20px!important;display:flex;">By clicking the View My Results
                                    Button, I agree to the consents below
                                    the button.</p>


                            <p class="btm-terms"><strong>Consent to Share Information.</strong> I agree to Assurance
                                sharing my information with Prudential companies and affiliates so that they can market
                                their products and services to me, and to Assurance sharing my information with third-party
                                partners so that select insurers and financial institutions, and their agents, may make
                                insurance, credit and other financial offers to me. I agree to Assurance’s <a
                                    href="#">Privacy Policy</a> and <a href="#">Terms of Service</a>.</p>

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
    <script>
        $(function() {
            
       
            $('.btn').click(function(){
                if($(this).hasClass('med_care_yes')){
                    $('.med_care_no').removeClass('active');
                    $('.med_care_yes').addClass('active');
                    $('.med_care_yes').find( "button" ).val("yes");
                    $('.med_care_yes').val("64-70");
                }
                if($(this).hasClass('med_care_no')){
                    $('.med_care_yes').removeClass('active');
                    $('.med_care_no').addClass('active');
                    $('.med_care_no').find( "button" ).val("no");

                    
                }
                if($(this).hasClass('bd_class_1')){
                    $('.bd_class_2').removeClass('active');
                    $('.bd_class_3').removeClass('active');

                    $('.bd_class_1').addClass('active');
                    $('.bd_class_1').find('button').val('71-75');
                    
                    
                }
                if($(this).hasClass('bd_class_2')){
                    $('.bd_class_1').removeClass('active');
                    $('.bd_class_3').removeClass('active');

                    $('.bd_class_2').addClass('active');
                    $('.bd_class_2').val(1);
                }
                if($(this).hasClass('bd_class_3')){
                    $('.bd_class_2').removeClass('active');
                    $('.bd_class_1').removeClass('active');

                    $('.bd_class_3').addClass('active');
                    $('.bd_class_3').val(1);
                }
                
            });
           
    });
    
    function selectAge(){
        $('.birth').addClass('next-btn');
        $('.birthday1').addClass('select_age');
        $('.birth').css('background-color', 'green');
    }

    function name_validate(val){
        if(val.length >= 2){
            $('#valid_name').css('display', 'none');
                $('#name').css('border', '1px solid grey');
        }
    }

    function email_validate(val){
        if (/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/.test(val)) {
                $('#valid_email').css('display', 'none');
                $('#email').css('border', '1px solid grey');
        }
        else{
            $('#valid_email').css('display', 'block');
                $('#email').css('border', '1px solid red');
        }
    }
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
                // alert('kashif');
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
                        } else if ($(item).hasClass('address_zip')) {
                            if (val != '' && zip != '') {
                                $(item).closest('.question-Box').hide();
                                $(item).closest('.question-Box').next('.question-Box').show();
                            } else {
                                alert('Please Enter Zip Code');
                            }
                        }  else if ($(item).hasClass('phone')) {
                            // alert('phone');
                            if (val == '') {
                                alert('Please Enter Valid Phone Number');
                            }

                        } 
                        else if ($(item).hasClass('birth')){
                           select_age =  $('.birthday1').hasClass('select_age');
                            if(select_age){
                                $(item).closest('.question-Box').hide();
                                $(item).closest('.question-Box').next('.question-Box').show();
                            }
                            else{

                            }
                        }
                        
                        
                        else {
                            $(item).closest('.question-Box').hide();
                            $(item).closest('.question-Box').next('.question-Box').show();
                        }
                    } else {
                        if ($(item).hasClass('address_zip')) {

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
            $("#phone").inputmask({"mask": "(999) 999-9999"});
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
            email = $('#email').val();
            name = $('#name').val();

            if(/^\([0-9]{3}\) [0-9]{3}\-[0-9]{4}$/.test(val)){
            
                $('#valid_phone').css('display', 'none');
                $('#phone').css('border', '1px solid grey');
            }
            else{
                $('#valid_phone').css('display', 'block');
                $('#phone').css('border', '1px solid red');
            }


            if (/^\([0-9]{3}\) [0-9]{3}\-[0-9]{4}$/.test(val) && /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/.test(email) && name.length >=2) {
                $('#results').css('background-color', 'green');
                $('#results').attr('type', 'submit');

                $('#valid_phone').css('display', 'none');
                $('#phone').css('border', '1px solid grey');

            } else {
                $('#results').attr('type', 'button');
                $('#results').css('background-color', 'grey');
                // $('#valid_phone').css('display', 'block');
                // $('#phone').css('border', '1px solid red');
            }


        }

        function validate_phone() {
            // val = $('#phone').val();
            type = $('#results').attr('type');
            // alert(type);
            if (type == 'button') {
                phone = $('#phone').val();
                email = $('#email').val();
                name = $('#name').val(); 

                if (/^\([0-9]{3}\) [0-9]{3}\-[0-9]{4}$/.test(phone))  {

                }else{
                    $('#valid_phone').css('display', 'block');
                    $('#phone').css('border', '1px solid red');

                }

                if (/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/.test(email)) {
                    $('#valid_email').css('display', 'none');
                    $('#email').css('border', '1px solid grey');
                }else{
                    $('#valid_email').css('display', 'block');
                    $('#email').css('border', '1px solid red');
                }
           
                
                if(name.length >=2){
                    $('#valid_name').css('display', 'none');
                    $('#name').css('border', '1px solid grey');
                }
                else{
                    $('#valid_name').css('display', 'block');
                    $('#name').css('border', '1px solid red');
                }
               
               


                    
            




                

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
@endsection
