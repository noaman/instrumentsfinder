<?php
	if(isset($productData))
	{
		$brand=$productData->brand;
	}

	

?>

@inject('data','App\DataManager')
 @php
    $url_array = resolve('url_array');

  //  print_r($url_array);

    $subdomain = resolve('subdomain');
    $data_values = $data->getData($subdomain);
	$country = $data_values["country"];
	$cities = $data_values["cities"];
	$ga = $data_values["ga"];
	$currency = $data_values["currency"];

	$link_prefix="";
  
  $segment=resolve("segment");
  $homeLink="/";
  $assetslink="/assets/";
  if($segment=="medical")
  {
    $link_prefix="/".$subdomain;
	$homeLink="/".$subdomain;
    $assetslink="/assets/medical/";
  }
@endphp



@extends('layout.v2.mainlayout')

@section('content')


<div class="container-fluid">

		<nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb_brand">

		<li class="breadcrumb-item"><a href="{{$homeLink}}">Home</a></li>
		@if(isset($productData))

		<li class="breadcrumb-item"><a href="{{$link_prefix}}/brand/{{$productData->brand}}">{{$productData->brand}}</a></li>
		@foreach($category_array as $cat)
		<li class="breadcrumb-item"><a href="{{$link_prefix}}/category/{{$cat['slug']}}">{{$cat['name']}}</a></li>
		@endforeach

		@if(strlen($productData->cat2)>1)
		<li class="breadcrumb-item"><a href="#">{{$productData->cat2}} </a></li>
		@endif

		<li class="breadcrumb-item active"> {{$country}} </a></li>

		@endif

		</ol>
		</nav>
		<div style="padding:10px;">
		@if(isset($productData))

		<?php


										$img = $productData->img_new_path;


								?>

		<div class="d-none" style="display:none;">
  <span class="baseproductname">{{$productData->name}}</span>
  <span class="baseproductid">{{$productData->prod_id}}</span>
  <span class="baseproductcode">{{$productData->codevalue}}</span>
  <span class="baseproductimg">{{$assetslink.$productData->thumb_img_new_path}}</span>
</div>


			<div class="row">
				<div class="col-md-12 col-sm-6">
					<h1 style="font-size:1.5em;">{{$productData->name}} - {{$country}}</h1>

				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-sm-6">
					<div class="row" style="border-right:dotted 1px;">
						<div class="col-md-5 col-sm-6" style="display:block;margin-left:auto;margin-right:auto;margin-top:50px;">


					<button type="button" class="btn_cartload btn">
						<!--<img src="{{$assetslink.$img}}" style="width:80%" alt="{{$productData->name}}|{{$productData->brand}}|{{$country}}" title="{{$productData->name}}" data-caption="{{$productData->name}}|{{$productData->brand}}|{{$country}}"> -->
						<img src="/assets/placeholder.jpg" style="width:80%" alt="{{$productData->name}}|{{$productData->brand}}|{{$country}}" title="{{$productData->name}}" data-caption="{{$productData->name}}|{{$productData->brand}}|{{$country}}">

					</button>



						</div>
						<div class="col-md-7 col-sm-6" style="padding:40px;">
							
								<p>We are the trusted suppliers for {{$productData->brand}} in {{$country}} across {{implode(", ",$cities)}}
								<br/><br/>
								{!!$productData->short_desc!!}</p>
							</p>
							<div>{!!$productData->features!!}</div>
						</div>
					</div>

				</div>
  				<!-- New form added for direct email submit -->
		<div class="col-md-4 col-sm-6">
			<div style="margin:10px;display:block;padding:30px;">
			<h5><strong>Get Quick Quotations & Stock Status. </strong><br><i>For all In-stock Items you should receive a Response within 1-2 hours.</i></h5>
			<form action="{{$link_prefix}}/submitlead" method="post" id="leadform" role="form" onsubmit="return submitUserForm();">
                      @csrf

                    <div id="cartdetails_form" style="display:none"></div>

                    <div class="form-group small">
                    <label for="inquiryDescription"><b>Enquiry Description</b></label>
                    <textarea type="desc" class="form-control" id="inquiryDescription" placeholder="Kindly describe your enquiry or provide any additional information "name="inquiryDescription" rows="4"></textarea>
                    
                    </div>

					<div class="form-group small">
                    <label for="email small"><b>Your Email *</b></label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email (Required)" name="email" required="true">
                    <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <div class="form-group small">
                    <label for="country">Country product ships to?</label>
                    
                    <?php
                    $countries_old = array("UAE","Saudi Arabia","Azerbaijan","Kazakhstan","Kazakhstan","Nigeria","Russsia","Mongolia","Afghanistan","Pakistan","Kyrgyzstan","Uzbekistan","Turkmenistan","Tajikistan");

                    $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino","Saudi Arabia","Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

                    ?>

                   
                    <select name="CountryProductShipsTo" class="form-control">
                         @foreach($countries as $country_val)

                         @php
                              $sel="";
                              if(strtolower($country) == strtolower($country_val))
                              {
                                   $sel="selected";

                              }
                         @endphp
                         <option value="{{$country_val}}" {{$sel}}>{{$country_val}}</option>
                         @endforeach
                    </select>     

                    </div>

                    
					
                    <div class="form-check form-check-inline small">
                    <input type="checkbox" class="form-check-input" id="resllerbox" name="resellerpricing">
                    <label class="form-check-label" for="exampleCheck1">Need Reseller Pricing</label>
                    </div>

                   <!-- <div class="form-check form-check-inline small">

                    <input type="checkbox" class="form-check-input" id="bulkbox" name="bulkpricing">
                    <label class="form-check-label" for="exampleCheck1">Need Bulk Pricing</label>
                    </div>
					-->
                   

                   <!-- <input type="submit" class="btn btn-brand" value="Check Price Now"/>-->

                 
    				<input type="submit" class="btn btn-brand" name="submit" value="Check Price Now" />

                    </form>
			</div>

		</div>	


					<script>
					function submitUserForm() {

						
						var response = grecaptcha.getResponse();
						if(response.length == 0) {
							document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">This field is required.</span>';
							return false;
						}
						return true;
					}
					
					function verifyCaptcha() {
						document.getElementById('g-recaptcha-error').innerHTML = '';
					}
					</script>




		<!-- endof New form added for direct Email Submit without lead -->


				<!-- <div class="col-md-4 col-sm-6">


					<ul class="list-group">
						<li class="list-group-item">Resellers of <div class="brand"><a href="/brand/{{$data->create_slug($productData->brand)}}" >{{$productData->brand}} supplier {{$country}}</a></div></li>

						<li class="list-group-item" style="padding-top: 2px;padding-bottom: 2px;">Availability <p>Please Click "Check Price Now" to get the latest Stock Status for {{$productData->name}} for {{$country}}</p></li>
					</ul>
					<hr/>
					
					<button type="button" class="btn_cartload btn btn-brand">CHECK PRICE NOW</button>

  					
				</div> -->
			</div>



		@endif
		</div>

		<div class="row tabmodule">
				<div class="col-md-12 col-sm-6">
			  <ul class="nav nav-tabs" id="myTab" role="tablist">
			  	@if($productData->long_desc!="")
			  <li class="nav-item">
			    <a class="nav-link tabheader" id="features-tab" data-toggle="tab" href="#features" role="tab" aria-controls="features" aria-selected="false">Description</a>
			  </li>
			  	@endif
  			  <li class="nav-item">
			    <a class="nav-link tabheader" id="diferentiators-tab" data-toggle="tab" href="#diferentiators" role="tab" aria-controls="diferentiators" aria-selected="false">Our Differentiators</a>
			  </li>


			</ul>
			<div class="tab-content" id="myTabContent">
			  @if($productData->long_desc!="")
			  <div class="tab-pane fade show active" id="features" role="tabpanel" aria-labelledby="home-tab" style="padding:30px;border:dotted #fed700 2px;"><!--{!!$productData->long_desc!!}-->
				@if(count($category_array)>0)
			  	<h3>Why buy {{$brand}} {{$category_array[0]["name"]}} in {{$country}} from us? </h3>
				  @endif
			  	<p>
			  		Especially the {{$productData->name}} in {{$country}}- {{implode(", ",$cities)}}
				</p>
			  	<ul style="font-size:20px;line-height: 1.5em font-weight:300;">

				  @if(count($category_array)>0)
			  	<li class="list-group-item1"> <p>Preferred Vendor &amp; and premium reseller for the world?s best and most reputed brands including {{$brand}} for <strong>{{$category_array[0]["name"]}}</strong> in {{$country}} </p></li>

			  	<li class="list-group-item1"> <p>Best prices for <strong>{{$productData->name}} </strong>and all {{$category_array[0]["name"]}} in {{$country}} and its accessories with 100% guarantee.</p></li>
					@endif
			  	<li class="list-group-item1"><p>24 x 7 Service and support with periodic maintenance.</p></li>

			  	<li class="list-group-item1"><p>Same day delivery at your doorstep throughout {{$country}} along with door-to-door service across {{implode(", ",$cities)}}</p></li>

			  	<li class="list-group-item1"><p>Large stocks locally available with fresh manufacturing date and full manufacturers warranty.</p></li>
			  </ul>

			  </div>
			  @endif
			   <div class="tab-pane fade" id="diferentiators" role="tabpanel" aria-labelledby="diferentiators-tab" style="padding:30px;border:dotted #fed700 2px;">
			   		<h3 >How can we help ease your purchasing Stress in {{$country}}?</h3>

			   		<p class="text-justify">We at <strong>InstrumentsFinder.com </strong>,{{$country}} are a leading suppliers for Oilfield Safety and Fire Protection Equipment, Workplace Safety &amp; Personal Protection Equipment (PPE), Process Instrumentation, Electrical and Mechanical machinery equipments &amp; spare parts, Laboratory Measurement Tools &amp; Equipments &amp; Surgical / Medical Emergency Products for all Industries in {{$country}} across {{implode(", ",$cities)}}</p>

			   		<p>Our main aim is to provide our customers with high standard of service and top quality products at competitive price. We offer “All In One” solution: electrical, mechanical, tools, test, IT, health, medical and safety equipments, soldering, welding and many more products to fulfill your requisition.<br>
					</p>
					<hr/>
					<h3>We Are Dedicated to Making Your Working Life Easier</h3>

					<ul>
						<li>No minimum order value for {{$country}}</li>
						<li>Vendor reduction – our one-stop-shop service for {{$country}} is designed to meet all your needs whether you are in big cities like {{implode(", ",$cities)}} and all other cities for {{$country}}</li>
						<li>We maximize your order efficiency through our multiple order channels;</li>
						<li>We offer you special customized offers and promotions;</li>
						<li>We lower your purchasing costs with quantity breaks and volume discounts for our customers in {{$country}} for all brands including {{$brand}} and especially for {{$productData->name}} for supplies in {{implode(", ",$cities)}}</li>
						<li>We can convert most of our competitor’s part numbers to our product codes and get you the exact match or direct replacement.</li>
					</ul>
						<hr/>
						<h3>Save time – allow us to help your work more efficiently</h3>
					<ul>
						<li>Convenient single source saves your time searching for products;</li>
						<li>We reduce your process down-time with immediate ex-stock availability in {{$country}} for various brands including {{$brand}} and best resller prices for {{$productData->name}} in {{$country}} - {{implode(", ",$cities)}}</li>
						<li>We deliver what you need faster by using the world’s leading express carriers and are able to provide door to door services across {{$country}}</li>
						<li>Reduced administration and paperwork;</li>
						<li>We help you to plan your inventory requirements with scheduled ordering;</li>
						<li>We offer convenience and simplicity in a complex world.</li>
					</ul>

			   </div>

			  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
			</div>
				</div>
			</div>

</div>
@endsection
