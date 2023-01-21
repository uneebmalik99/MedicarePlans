@extends('layouts.app')
@section('content')
<div id="col-full-106-110-124" class="col-md-12 innerContent col_left" data-col="full" data-trigger="none" data-animate="fade" data-delay="500" data-title="full column" style="outline: none;">
    <div class="col-inner bgCover  noBorder borderSolid border3px cornersAll radius0 shadow0 P0-top P0-bottom P0H noTopMargin">
    <div class="de elHeadlineWrapper ui-droppable de-editable" id="tmp_headline1-55907-180-176" data-de-type="headline" data-de-editing="false" data-title="headline" data-ce="true" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 0px; outline: none; cursor: pointer; font-family: &quot;Droid Sans&quot;, Helvetica, sans-serif !important;" aria-disabled="false" data-google-font="Droid+Sans">
    <h1 class="ne elHeadline hsSize3 lh4 elMargin0 elBGStyle0 hsTextShadow0 mfs_21" style="text-align: center; font-size: 28px;" data-bold="inherit" data-gramm="false" contenteditable="false"><b>Seniors 64+ may be entitled to assistance to help pay for groceries, dentures, eyeglasses and hearing aids based on their zip code, thanks to Medicare Flex Cards</b></h1>
    </div>
    <div class="de elImageWrapper de-image-block elAlign_center elMargin0 ui-droppable de-editable" id="tmp_image-21635-157-169" data-de-type="img" data-de-editing="false" data-title="image" data-ce="false" data-trigger="none" data-animate="fade" data-delay="500" style="margin-top: 0px; outline: none; cursor: pointer;" aria-disabled="false" data-imagelink="">
    <img src="//thanks.medicarepronto.com/hosted/images/d9/935c96f24a46f38404d4c77248d20d/6273f25f111fff58f028d987_Flex-Card-pwejevage53eu4h68aatpuqrr8bk779colebt2j0qo.png" class="elIMG ximg" alt="" width="" data-imagelink="" height="300" data-src="//thanks.medicarepronto.com/hosted/images/d9/935c96f24a46f38404d4c77248d20d/6273f25f111fff58f028d987_Flex-Card-pwejevage53eu4h68aatpuqrr8bk779colebt2j0qo.png">
    </div>
    </div>
    </div>
    <div class="container">
        <p id="demo"></p>
    </div>
    <script type="text/javascript">
        // Set the date we're counting down to
var countDownDate = new Date("Jan 5, 2024 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
    
    
    </script>
@endsection
