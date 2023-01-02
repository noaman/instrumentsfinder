@extends('layout.v2.mainlayout')

@section('content')

@inject('data','App\DataManager')

<?php
$url_array = resolve('url_array');
$subdomain = resolve('subdomain');
$data_values = $data->getData($subdomain);
$country = $data_values["country"];
$cities = $data_values["cities"];
$ga = $data_values["ga"];
$currency = $data_values["currency"];

$link_prefix="";
  $homeLink="/";
  $segment=resolve("segment");
  
  if($segment=="medical")
  {
    $link_prefix="/".$subdomain;
    $homeLink="/".$subdomain;
  }

?>




<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-sm-6">
			<div class="header" style="display:block;padding:10px;margin: 10px;">
				<h5>Your selected products</h5>
			</div>
			<div class="cart_checkout_data">
			</div>	
		</div>

  

 
		<div class="col-md-5 col-sm-6">
			<div style="margin:10px;display:block;padding:30px;border:dotted 1px;">
			<h5>Get Quick Quotations & Stock Status. for all In-stock Items you should received a Response within 1-2 hours.</h5>
			<form action="{{$link_prefix}}/submitlead" method="post" id="leadform" role="form" onsubmit="return submitUserForm();">
                      @csrf

                      <div id="cartdetails_form" style="display:none"></div>
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

                    <div class="form-group small">
                    <label for="inquiryDescription"><b>Enquiry Description</b></label>
                    <textarea type="desc" class="form-control" id="inquiryDescription" placeholder="Kindly describe your requirement here or provide any addadditional information "name="inquiryDescription" rows="4"></textarea>
                    
                    </div>
                    
					<!--
                    <div class="form-check form-check-inline small">
                    <input type="checkbox" class="form-check-input" id="resllerbox" name="resellerpricing">
                    <label class="form-check-label" for="exampleCheck1">Need Reseller Pricing</label>
                    </div>

                    <div class="form-check form-check-inline small">

                    <input type="checkbox" class="form-check-input" id="bulkbox" name="bulkpricing">
                    <label class="form-check-label" for="exampleCheck1">Need Bulk Pricing</label>
                    </div>
					-->
                   

                   <!-- <input type="submit" class="btn btn-brand" value="Check Price Now"/>-->

                   {{-- <button
class="g-recaptcha btn btn-brand"
data-sitekey="6LeYtMwUAAAAAI-r0duEMYKNLZ2XB-jlAV8JFfDD"
data-callback="onSubmit"> --}}

{{-- Removed captvcha as it was overrdiign submit condition check --}}
{{-- <input type="submit" class="g-recaptcha btn btn-brand"
data-sitekey="6LeYtMwUAAAAAI-r0duEMYKNLZ2XB-jlAV8JFfDD"
data-callback="onSubmit"> --}}
{{-- <div class="g-recaptcha" data-sitekey="6LeYtMwUAAAAAI-r0duEMYKNLZ2XB-jlAV8JFfDD" data-callback="onSubmit" data-expired-callback="onSubmit"></div>
<input class="form-control d-none" data-recaptcha="true" required data-error="Please complete the Captcha">
<div class="help-block with-errors"></div>

<input type="submit" class="g-recaptcha btn btn-brand" > --}}

<!-- 
<div class="g-recaptcha" data-sitekey="6LeYtMwUAAAAAI-r0duEMYKNLZ2XB-jlAV8JFfDD" data-callback="verifyCaptcha"></div>
    <div id="g-recaptcha-error"></div> -->
    <input type="submit" name="submit" value="Submit" />

{{-- Check Price Now
</button> --}}

                    </form>
		</div>

	</div>	
</div>
</div>
@endsection

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
