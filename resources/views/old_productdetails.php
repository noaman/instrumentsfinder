@extends('layout.theme.mainlayout')

@section('content')




@if(isset($productData))

<!--<pre>
{{print_r($productData)}}
</pre>-->
<div class="container">

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
			@if(isset($category_array) && count($category_array)>0)
				@foreach($category_array as $category_data)
					
					<li class="breadcrumb-item" aria-current="page"><a href="/category/{{$category_data['slug']}}">{{$category_data["name"]}}</a></li>
				@endforeach
			@endif
			<li class="breadcrumb-item active" aria-current="page">{{$productData->name}}</li>
		</ol>
	</nav>



	  <div class="d-none">
        <span class="baseproductname">{{$productData->name}}</span>
        <span class="baseproductid">{{$productData->prod_id}}</span>
        <span class="baseproductcode">{{$productData->codevalue}}</span>
     </div> 
	
	
	

	<div class="container" style="padding:40px;margin:10px;">
    <div class="row">

        <div class="col-8" >
            <h1>{{$productData->name}}</h1>
            <div class="row">
              <div class="col-4">
                <img src="{{$productData->img}}" width="90%"/>
              </div>
              <div class="col-8" style="padding:50px;">
                <p>{{$productData->short_desc}}</p>
              </div>  

            </div>
            @if(isset($options) && is_array($options) && count($options)>0)
                
                <div class="optionslist" style="padding:20px;background-color:#F8F8F8;height:800px;overflow-y: scroll;"> 
                 <b>Choose your configurations options </b> <hr/>
                @foreach($options as $option) 
                  
                  <div class="option" optionid="{{$option['option_id']}}">
                    <div class="label small" style="padding-top:10px;"><b>{{$option['options_desc']}}</b></div>

                     @if(isset($option["variants"]))
                        <?php $ctr=0; ?>
                        <div class="radio_options">
                        @foreach($option["variants"] as $variant)
                        <!--{{print_r($variant)}}-->
                            
                            <div class="input-group" >
                            <div class="input-group-prepend" style="margin-top:5px;">
                            <div class="input-group-text">
                            <?php
                            if($ctr==0)
                             $checked = "checked";
                            else
                            $checked = "";
                            ?> 
                            <input class="radiochoice" type="radio" name="{{$option['option_id']}}" {{$checked}} label="{{$variant['variant_desc']}}" code="{{$variant['code']}}" variant_id="{{$variant['variant_id']}}">

                            </div>
                            <label style="padding-left:10px;" class="small"> {{$variant['variant_desc']}}</label>
                            </div>

                            </div>


                              
                            <?php $ctr++; ?>
                        @endforeach
                        </div><!--end of rasdio options div -->
                     @endif
                    
                </div><!--end of div option-->    
                @endforeach
               </div><!--end of scrolling div--> 
            @endif

              


         </div>
         <div class="col-4" style="background:#EFEFEF;border:1px dotted;padding:5px;">
            <div class="card" style="margin-bottom:20px;">

              <div class="card-body">
              
              <p class="card-text small">Build your cart for the products you need and once you are done, request for a quote.</p>
              <a href="#" data-toggle="collapse" data-target="#quoteform" >Request a quote</a>
             



            <!--LEAD FORM-->
            <div class="collapse" id="quoteform">
            
                    <form action="/submitlead" method="post">
                      @csrf

                      <div id="cartdetails_form" style="display:none"></div>
                    
                      <hr class="mb-6">
                    <div class="form-group small">
                    <label for="email small"><b>Email address(Required)</b></label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                    <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <div class="form-group small">
                    <label for="country">Country to ship the product to:</label>
                    
                    <select name="CountryProductShipsTo" class="form-control"><option value="">---</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Brazil">Brazil</option><option value="British Virgin Islands">British Virgin Islands</option><option value="Brunei">Brunei</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="Christmas Island">Christmas Island</option><option value="Cocos(Keeling) Islands">Cocos(Keeling) Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Cote d'Ivoire">Cote d'Ivoire</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Falkland Islands">Falkland Islands</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="French Polynesia">French Polynesia</option><option value="Gabon">Gabon</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guernsey">Guernsey</option><option value="Guinea">Guinea</option><option value="Guinea - Bissau">Guinea - Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Isle of Man">Isle of Man</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jersey">Jersey</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Kosovo">Kosovo</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macau">Macau</option><option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option><option value="Moldova">Moldova</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montenegro">Montenegro</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Nagorno - Karabakh">Nagorno - Karabakh</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="North Korea">North Korea</option><option value="Northern Mariana">Northern Mariana</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Palestine">Palestine</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="People 's Republic of China">People 's Republic of China</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn Islands">Pitcairn Islands</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Republic of China">Republic of China</option><option value="Romania">Romania</option><option value="Russia">Russia</option><option value="Rwanda">Rwanda</option><option value="Saint Barthelemy">Saint Barthelemy</option><option value="Saint Helena">Saint Helena</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Martin">Saint Martin</option><option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option><option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia">Serbia</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="Somaliland">Somaliland</option><option value="South Africa">South Africa</option><option value="South Korea">South Korea</option><option value="South Ossetia">South Ossetia</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard">Svalbard</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syria">Syria</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="The Bahamas">The Bahamas</option><option value="The Gambia">The Gambia</option><option value="Timor - Leste">Timor - Leste</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Transnistria Pridnestrovie">Transnistria Pridnestrovie</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="Tristan da Cunha">Tristan da Cunha</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkish Republic of Northern Cyprus">Turkish Republic of Northern Cyprus</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="United States">United States</option><option value="Uruguay">Uruguay</option><option value="US Virgin Islands">US Virgin Islands</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Vatican City">Vatican City</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option></select>

                    </div>

                    <div class="form-group small">
                    <label for="inquiryDescription"><b>Enquiry description</b></label>
                    <textarea type="desc" class="form-control" id="inquiryDescription" name="inquiryDescription" ></textarea>
                    
                    </div>


                    <div class="form-check form-check-inline small">
                    <input type="checkbox" class="form-check-input" id="resllerbox" name="resellerpricing">
                    <label class="form-check-label" for="exampleCheck1">I need reseller pricing</label>
                    </div>

                    <div class="form-check form-check-inline small">
                    <input type="checkbox" class="form-check-input" id="bulkbox" name="bulkpricing">
                    <label class="form-check-label" for="exampleCheck1">I need bulk pricing</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Get a Price Quote</button>
                    </form>

                    

            
                  
              
            </div> 
          </div>
            <!--END OF LEADFORM-->
          </div><!--end of card-->

            <div class="cart_data">

            </div>  

             
         </div>  
    </div> 

    


  </div>  <!--end of comnatinaer-->


  <br/>


	<div class="container" style="padding:40px;margin:10px;border:1px dotted;">

	<div class="row">
  <div class="col-3">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

    	@if($productData->features!="")
      <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Overview</a>
      @endif

      @if($productData->long_desc!="")
      <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Description</a>
      @endif

      @if(isset($docs) && $docs!=null && is_array($docs))
      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Documents</a>
      @endif

      @if(isset($accessories) && $accessories!=null && is_array($accessories))
      <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Accessories</a>
      @endif

    </div>
  </div>
  <div class="col-9">
    <div class="tab-content" id="v-pills-tabContent" style="height:100%;background:#ffffff">
    	@if($productData->features!="")
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" style="padding:40px;">{!!html_entity_decode($productData->features)!!}</div>
      	@endif

      	@if($productData->long_desc!="")
      <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" style="padding:40px;text-align:justify">{!!html_entity_decode($productData->long_desc)!!}</div>
      @endif

      @if(isset($docs) && $docs!=null && is_array($docs))
      	<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" style="padding:40px;">
      		
      		@foreach($docs as $doc)
      			
      			<h4>{{$doc['doc_group_title']}}</h4><br/>
      				<ul>
      				@foreach($doc["files"] as $file)
      					<?php
      						
      						$filenamearray= explode("/",$file["filepath"]);
      						
      						$filename = $filenamearray[count($filenamearray)-1];
      					?>
      					<li><a href="#">{{$productData->name}} : {{$filename}}</a></li>
      				@endforeach
      				</ul>
      			
      		@endforeach

      	</div>
      @endif

      @if(isset($accessories) && $accessories!=null && is_array($accessories))
      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" style="padding:40px;">
          @foreach($accessories as $accessory)
            
            <h4>{{$accessory['type']}}</h4><br/>
              @foreach($accessory['accessories'] as $accessory_data)

                <p>{{print_r($accessory_data)}}</p><br/>
              @endforeach
          @endforeach  

      </div>

      @endif
      		
    </div>
  </div>
</div>

</div>

</div>	<!--end of container-->

</div>	
</div>

@endif


<script type="text/javascript">

$(document).ready(function() {

  var cartname_local="instrumentfinder_cart323";

  //localStorage.clear();
  function saveCartToLocal(cartdata)
  {
    localStorage.setItem(cartname_local,JSON.stringify(cartdata));
  }

  function getCartFromLocal()
  {
      cartdata=JSON.parse(localStorage.getItem(cartname_local));
      return (cartdata);
  }

  var cart=[];

  if(getCartFromLocal() != null)
    cart = getCartFromLocal();

  $("input[type='radio']").on("change", function(){   

        createBaseCartOnPage();
    });


  
  function addProduct(pid,pname,pcode)
  { 
      var prod_data={};
      var option_data=[];

      var pdata=[pid,pname,pcode,1];

      
      prod_data["pid"]=pid;
      prod_data["baseproduct"]=pdata;

      
      baseproductexists=false;

      for(var i=0;i<cart.length;i++)
      {
          var baseproduct=cart[i].product["baseproduct"];
          var prodid = baseproduct[0];
          if(pid==prodid)
          {
            baseproductexists=true;
            break;
          }
      }
      
      if(!baseproductexists)
      {    
        cart.push({"product":prod_data});
       
        saveCartToLocal(cart);
      }  
  }

  
  function createBaseCartOnPage()
  {
      var pid = $('.baseproductid').text();
      var pname=$('.baseproductname').text();
      var pcode=$('.baseproductcode').text();

      addProduct(pid,pname,pcode);
      $('.option').each(function(i, obj) {
          
          var optid=$(obj).attr("optionid");
         // console.log("optionid"+optid);
          var optname=$(obj).find('.label').text();
          

          var options_values =$(obj).find('.radio_options');
          options_values.each(function (i,obj){

              var radio_option =$(obj).find('.radiochoice');
              radio_option.each(function(i,obj){
                  if(obj.checked)
                  {
                      //alert($(obj).attr("label"));
                      var variantname=$(obj).attr("label");
                      var code=$(obj).attr("code");
                      var variant_id=$(obj).attr("variant_id");
                      addOption(pid,optid,variant_id,optname,variantname,code);
                  }    
              });
              
          });

      });

      readCart();
  }



  function addOption(prod_id,optid,variant_id,optname,var_name,varcode)
  {
      for(var i=0;i<cart.length;i++)
      {
          var baseproduct=cart[i].product["baseproduct"];
          var pid = baseproduct[0];
          var options=[];

          if(pid==prod_id)
          {
            
              if(cart[i].product["options"]!=null && cart[i].product["options"].length>0)
              {
                
                  isoptionadded=false;
                  isItemreplaced=false;
                  itemIDReplace=0;
                  for(var j=0;j<cart[i].product["options"].length;j++)
                  {
                      optionarray=cart[i].product["options"][j].option;
                     // console.log(optionarray);

                      opt_id = optionarray[1];
                      varid = optionarray[2];
                      //console.log(opt_id+" - "+optid);
                      //console.log(varid+" - "+variant_id);
                      if(opt_id == optid)//same option id exists
                      {
                          isoptionadded=true; 
                          if(varid == variant_id)//same variant also exsits so do nothing
                          {
                        //    console.log("found same options and variant");
                            
                          }
                          else//replace the option
                          {
                                isItemreplaced=true;
                                itemIDReplace=j;
                          }

                      }

                  }

                  if(isItemreplaced)
                  {
                    options_new=[];
                    for(var j=0;j<cart[i].product["options"].length;j++)
                    {
                        if(j==itemIDReplace)
                        {
                          var option_data=[prod_id,optid,variant_id,optname,var_name,varcode];
                            optionarray=cart[i].product["options"][j].option=option_data;
                        }
                        
                    }
                  } 


                  if(!isoptionadded)
                  {
                      
                    var option_data=[prod_id,optid,variant_id,optname,var_name,varcode];

                     options = cart[i].product["options"];
                     options.push({'option':option_data});

                  }
              } 
              else
              {
                  var option_data=[prod_id,optid,variant_id,optname,var_name,varcode];
                    options.push({'option':option_data});
                   cart[i].product["options"]=options;
              } 

              break; 
          }
      }

      saveCartToLocal(cart);
  }

  var form_data='';
  function readCart()
  {
      //console.log(cart.length);
      cart=getCartFromLocal();

      var cartdata='<div id="cardatadiv" class="list-group-item" style="background:#333;color:#fff;">Your chosen products</div><ul class="list-group">';
      //for ( var i = 0; i < cart.length; i++ ) {
      for ( var i = cart.length-1;i>=0; i-- ) {  
            showremove=true;
            if(i==cart.length-1)
              showremove=false;
            cartdata+=getProductHTML(cart[i].product,showremove);
      }
       cartdata+="</ul>";

       $('#cartdetails_form').html(form_data);
       $('.cart_data').html(cartdata);
  }


  function getProductHTML(product,showremove=true)
  {

      var htmlData="";
      var baseproduct=product["baseproduct"];

      var pid = baseproduct[0];
      var pname = baseproduct[1];
      var pcode = baseproduct[2];
      var qty = baseproduct[3];

      

      //htmlData+='<li class="list-group-item" style="margin-bottom:0px;padding:6px;"><small><b>'+pname+'</b></small><i class="fa fa-remove fa-2x pull-right" style="color: red;">a</i></li>';


      
      
     

      
      if(showremove)
      {
        htmlData+='<li id="item1" href="#" class="list-group-item list-group-item-action flex-column align-items-start"><div class="d-flex w-100 justify-content-between"><p class="mb-1 small"><b>'+pname+'</b></p><a pid="'+pid+'" href="#" class="closebutton"><i class="fa fa-remove fa-0.5x pull-right" style="color: red;"></i></a></div><h6><span class="flex-column"><i class="addqty fa fa-plus-circle fa-0.5x" pid="'+pid+'"></i>&nbsp;<b>'+qty+'&nbsp;</b><i class="fa fa-minus-circle fa-0.5x subqty" pid="'+pid+'"v></i></span></h6>';

  
      }
      else
      {
        htmlData+='<li id="item1" href="#" class="list-group-item list-group-item-action flex-column align-items-start"><div class="d-flex w-100 justify-content-between"><p class="mb-1 small"><b>'+pname+'</b></p></div><h6><span class="flex-column"><i class="addqty fa fa-plus-circle fa-0.5x" pid="'+pid+'"></i>&nbsp;<b>'+qty+'&nbsp;</b><i class="fa fa-minus-circle fa-0.5x subqty" pid="'+pid+'"v></i></span></h6> ';

      }
      
      form_data+="<input type='hidden' name='product["+pid+"]' value='"+pid+"'/>";

      form_data+="<input type='hidden' name='qty["+pid+"]' value='"+qty+"'/>";

    
      htmlData+='<div class="card">';
      if(product["options"]!=null && product["options"].length>0)
      {
        var inclass="";

        if(!showremove)
          inclass="show";

        htmlData+='<ul class="list-group small" ><li class="list-group-item " data-toggle="collapse" data-target="#acc'+pid+'" style="padding:5px;background:#C3E9F3;"><i class="fa fa-chevron-down fa-0.5x" style="color:#333;"></i>  View product options <span class="pull-right">['+(product["options"].length)+']</span></li></ul>';


        htmlData+='<div id="acc'+pid+'" class="collapse '+inclass+'">';
        htmlData+='<ul class="list-group">';
        
          //console.log("got options "+(product["options"].length));
          for (var i=0;i<product["options"].length;i++)
          { 
              optionarray=product["options"][i].option;
              opt_id = optionarray[1];
              var_id = optionarray[2];
              optname = optionarray[3];
              varname = optionarray[4];


              form_data+="<input type='hidden' name='option_id["+pid+"]["+i+"]' value='"+opt_id+"'/>";

              form_data+="<input type='hidden' name='variant["+opt_id+"]' value='"+var_id+"'/>";


               htmlData+='<li class="list-group-item small" style="background:#D8F7FF;padding:5px;"><!--<i class="fa fa-chevron-right fa-1x" style="margin-right:5px;"></i>--></small><b>'+optname+'</b><br/><p class="text-muted" style="margin-left:10px;">'+varname+'</p></li>';
          }

        htmlData+='</ul">';        
        }

        htmlData+='</div>';
        htmlData+='</li>';

        htmlData+='</div>';

      

      return htmlData;
  }

  createBaseCartOnPage()
  //console.log(cart);
  //readCart();

  $('.closebutton').click(function(obj,i){

    console.log("clicked"+$(this).attr('pid'));
    var pid_del = $(this).attr('pid');
    removeProductFromCart(pid_del);

  });


  $('.addqty').click(function(obj,i){

    console.log("add "+$(this).attr('pid'));
    var pid = $(this).attr('pid');

    increaseProdQty(pid);
    

  });


  $('.subqty').click(function(obj,i){

    console.log("sub "+$(this).attr('pid'));
    var pid = $(this).attr('pid');
    decreaseProdQty(pid);

  });


  function increaseProdQty(pid_add)
  {
    cart=getCartFromLocal();

      cart_new=[];

      for(var i=0;i<cart.length;i++)
      {
          
          
        var baseproduct=cart[i].product["baseproduct"];
          var pid = baseproduct[0];
          if(pid == pid_add)
          {
            cart[i].product["baseproduct"][3]++;
            break;
          }

          
      }
      localStorage.clear();
            saveCartToLocal(cart);
            readCart();
            location.reload();
            
      
  }


  function decreaseProdQty(pid_sub)
  {
    cart=getCartFromLocal();

      cart_new=[];

      for(var i=0;i<cart.length;i++)
      {
          
          
        var baseproduct=cart[i].product["baseproduct"];
          var pid = baseproduct[0];
          if(pid == pid_sub)
          {
            if(cart[i].product["baseproduct"][3]>1)
              cart[i].product["baseproduct"][3]--;
            break;
          }

          
      }
      localStorage.clear();
            saveCartToLocal(cart);
            readCart();
            location.reload();
            
      
  }


  function removeProductFromCart(pid_del)
  {
      cart=getCartFromLocal();

      cart_new=[];

      for(var i=0;i<cart.length;i++)
      {
          var baseproduct=cart[i].product["baseproduct"];
          var pid = baseproduct[0];
          var options=[];
          if(pid != pid_del)
          cart_new.push({"product":cart[i].product});
      }
      localStorage.clear();
      saveCartToLocal(cart_new);
      readCart();
      location.reload();

      //$("#cardatadiv").load(location.href+" #cardatadiv>*","");

  }//end of function removeProductFromCart


  

  $('.leadformbutton').click(function(){
      //$('.leadform').show();
  });

});
</script>


@endsection


<!--
function getProductHTML(product)
  {

      var htmlData="";
      var baseproduct=product["baseproduct"];

      var pid = baseproduct[0];
      var pname = baseproduct[1];
      var pcode = baseproduct[2];

      htmlData+='<div class="accordion" id="accordion'+pid+'">';
      htmlData+='<div class="card">';
      htmlData+='<div class="card-header" id="headingOne">';
      htmlData+='<h2 class="mb-0">';
      htmlData+='<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse'+pid+'" aria-expanded="true" aria-controls="collapseOne">';
      htmlData+='<div class="small">'+pname+'</div>'  ;
      htmlData+='</button>';
      htmlData+='</h2>';
      htmlData+='</div>';

      if(product["options"]!=null && product["options"].length>0)
      {
        htmlData+='<div id="collapse'+pid+'" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion'+pid+'">';
        htmlData+='<div class="card-body">';
        
          htmlData+='<ul class="list-group">';
        
          //console.log("got options "+(product["options"].length));
          for (var i=0;i<product["options"].length;i++)
          { 
              optionarray=product["options"][i].option;
              optname = optionarray[3];
              varname = optionarray[4];

               htmlData+='<li class="list-group-item" style="margin-bottom:0px;padding:2px;padding-left:20px;"><small><b>'+optname+'</b></small><br/><small class="text-muted">'+varname+'</small></li>';
          }

        htmlData+='</ul">'; 

       htmlData+='</div>';
        htmlData+='</div>';

      }

      htmlData+='</div>';
      htmlData+='</div>';
      
      return htmlData;

      htmlData+='<li class="list-group-item" style="margin-bottom:0px;padding:6px;"><small><b>'+pname+'</b></small><br/><small class="text-muted">Base product</small></li>';

      if(product["options"]!=null && product["options"].length>0)
      {


        htmlData+='<ul class="list-group">';
        
          //console.log("got options "+(product["options"].length));
          for (var i=0;i<product["options"].length;i++)
          { 
              optionarray=product["options"][i].option;
              optname = optionarray[3];
              varname = optionarray[4];

               htmlData+='<li class="list-group-item" style="margin-bottom:0px;padding:2px;padding-left:20px;"><small><b>'+optname+'</b></small><br/><small class="text-muted">'+varname+'</small></li>';
          }

        htmlData+='</ul">';        
      }

      return htmlData;
  }
  -->
