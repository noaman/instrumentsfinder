@extends('layout.v2.mainlayout')

@section('content')

@inject('data','App\DataManager')

<?php
$url_array = resolve('url_array');
$subdomain = resolve('subdomain');
$segment = resolve('segment');
$data_values = $data->getData($subdomain);
$country = $data_values["country"];
$cities = $data_values["cities"];
$ga = $data_values["ga"];
$currency = $data_values["currency"];
$link_prefix='';
$assetslink="/assets/";
if($segment=="medical"){
	$link_prefix = "/".$subdomain;
	$assetslink="assets/medical/";
}
?>

<div class="container-fluid">

	<div class="row" style="min-height:450px;">
		<div class="col-md-6 col-sm-6" style="display:block;margin:auto;padding:50px;">
			<?php
			if($segment=="medical")
			{
				?>
				<h1>Are you searching for Industrial / Medical Test & Laboratory instruments?</h1><br/>
				<p>Then InstrumentsFinder.com is the right place. Tell us what you need and where you need it, and we'll deliver it at the best prices!</p>
				<?php
			}
			else{
			?>
			<h1>Are you searching for Industrial / Medical Test & Laboratory instruments?</h1><br/>
			<p>Then InstrumentsFinder.com is the right place. Tell us what you need and where you need it, and we'll deliver it at the best prices!</p>
			<?php }?>
		</div>

		<!-- New form added for direct email submit -->
		<div class="col-md-5 col-sm-6">
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






		<!-- <div class="col-md-6 col-sm-6 homeimg">
			&nbsp;
		</div> -->
	</div>

	@if(isset($productData))

	<div class="row">
		<br/><br/>
	</div>
	<div class="row" style="margin:10px;">
		<div class="col-sm-12" style="padding:10px;">
			<h2>Featured products - {{$country}}</h2><hr>
				<?php
			if($segment=="medical")
			{
				?>
				<p>Leading suppliers for Medical in {{$country}} across {{implode(", ",$cities)}} </p>
				<?php
			}
			else{
			?>
			<p>Leading suppliers for Oilfield Safety and Fire Protection Equipment, Process Instrumentation, Electrical and Mechanical machinery equipments & spare parts, Laboratory Measurement Tools & Equipments & Surgical / Medical Emergency Products for Oil & Gas Industry in {{$country}} across {{implode(", ",$cities)}}</p>
<?php }?>

			
		<hr>

		</div>
	</div>
	<div class="row">

		@foreach($productData as $produclisting)

		<?php
					$prodslug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $produclisting->name)));
					?>
		<div class="col-sm-6">
			<div class="productlist" style="border-bottom: 0px;">
			<div class="row">
							<div class="col-md-2 col-sm-3">


								<?php


										//$thumbnail = $assetslink.$produclisting->thumb_img_new_path;
										$thumbnail="assets/placeholder_64.png";

								?>


								<img src="{{$thumbnail}}" alt="{{$produclisting->name}}|{{$produclisting->brand}}" title="{{$produclisting->name}}" data-caption="{{$produclisting->name}}|{{$produclisting->brand}}">
							</div>
							<div class="col-md-8 col-sm-4">

								<h3 style="font-size:1.5em;"><a href="{{$link_prefix}}/product/{{$produclisting->prod_id}}/{{$prodslug}}">{{$produclisting->name}} </a></h3>
								<div class="brand subtext"><a href="{{$link_prefix}}/brand/{{$data->create_slug($produclisting->brand)}}">
								{{$produclisting->brand}} in {{$country}} (as resellers) </a></div>
								<h5 class="h3_desc">{{$produclisting->short_desc}}</h3>
							</div>
						</div>
			</div>
		</div>
		@endforeach

	</div>

	@endif

	@if(isset($brands_array))
	<div class="row" style="margin:10px;">
		<div class="col-12" style="padding:10px;">
			<h2>Featured brands - {{$country}}</h2>
		</div>
			@foreach($brands_array as $brand)
			<div class="col-md-4 col-sm-12 catblockmaster">
									<a href="{{$link_prefix}}/brand/{{$data->create_slug($brand['brand'])}}">
									<div class="catblock">
										{{$brand["brand"]}} {{$country}}
									</div>
									</a>
			</div>

			@endforeach
			<br/>



	</div>

	<div class="row" style="padding:20px; text-align: center;margin:auto;"><div class="col-12" class="catblockmaster"><div class="catblock"><a href="/brands">View all</a></div> </div></div>


	@endif

</div>

@endsection
