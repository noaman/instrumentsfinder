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


<div class="container">

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





							@if(isset($options) && is_array($options) && count($options)>0)
						<a href="{{$link_prefix}}/configurator/{{$productData->prod_id}}"><img src="{{$assetslink.$img}}" style="width:80%" alt="{{$productData->name}}|{{$productData->brand}}|{{$country}}" title="{{$productData->name}}" data-caption="{{$productData->name}}|{{$productData->brand}}|{{$country}}"></a>
					@else

					<button type="button" class="btn_cartload btn">
						<img src="{{$assetslink.$img}}" style="width:80%" alt="{{$productData->name}}|{{$productData->brand}}|{{$country}}" title="{{$productData->name}}" data-caption="{{$productData->name}}|{{$productData->brand}}|{{$country}}">

					</button>


					@endif




						</div>
						<div class="col-md-7 col-sm-6" style="padding:40px;">
							<h2 style="font-size:1.15em;"><p>
								We are the trusted suppliers for {{$productData->brand}} in {{$country}} across {{implode(", ",$cities)}}
								<br/><br/>
								{!!$productData->short_desc!!}</h2>
							</p>
							<div>{!!$productData->features!!}</div>
						</div>
					</div>

				</div>
				<div class="col-md-4 col-sm-6">


					<ul class="list-group">
						<li class="list-group-item">Resellers of <div class="brand"><a href="/brand/{{$data->create_slug($productData->brand)}}" style="color:#Adc900;">{{$productData->brand}} in {{$country}}</a></div></li>

						<li class="list-group-item" style="padding-top: 2px;padding-bottom: 2px;">Availability <p style="color:#aaa;padding-top: 2px;padding-bottom:2px;">Please Click "Check Price Now" to get the latest Stock Status for {{$productData->name}} for {{$country}}</p></li>
					</ul>
					<hr/>
					@if(isset($options) && is_array($options) && count($options)>0)
						<a href="{{$link_prefix}}/configurator/{{$productData->prod_id}}"><button type="button" class="btn btn-brand"><span class="small">Configure Product Options &<br/></span> CHECK PRICE NOW</button></a>
					@else

					<button type="button" class="btn_cartload btn btn-brand">CHECK PRICE NOW</button>


					@endif


					@if(isset($options) && is_array($options) && count($options)>0)

					<div style="margin-top:20px;width:100%;border-top:solid #fdd700 1px;padding:10px;padding-top: 2px;padding-bottom: 2px;">
					<b >The product has following configurable options</b><br/>
					<ul class="list-group list-group-flush" style="margin-top:15px;">
					@foreach($options as $option)

                    @if($option['options_desc']!="block")
                    <li class="list-group-item" style="padding-top: 2px;padding-bottom: 2px;font-size:12px;">{{$option['options_desc']}}</li>
                    @endif

                    @endforeach
                	</ul>
                	</div>
                	@endif
				</div>
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

			  	@if(isset($docs) && $docs!=null && is_array($docs))
			  <li class="nav-item">
			    <a class="nav-link active tabheader" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="true">Documents</a>
			  </li>
			  @endif
			  <li class="nav-item">
			    <a class="nav-link tabheader" id="diferentiators-tab" data-toggle="tab" href="#diferentiators" role="tab" aria-controls="diferentiators" aria-selected="false">Our Differentiators</a>
			  </li>


			</ul>
			<div class="tab-content" id="myTabContent">
			  @if($productData->long_desc!="")
			  <div class="tab-pane fade" id="features" role="tabpanel" aria-labelledby="home-tab" style="padding:30px;background-color:#fafafa;"><!--{!!$productData->long_desc!!}-->
				@if(count($category_array)>0)
			  	<h3>Why buy {{$brand}} {{$category_array[0]["name"]}} in {{$country}} from us? </h3>
				  @endif
			  	<h4>
			  		Especially the {{$productData->name}} in {{$country}}- {{implode(", ",$cities)}}
			  	</h4>
			  	<ul style="font-size:16px;line-height: 20px;">

				  @if(count($category_array)>0)
			  	<li class="list-group-item1"> Preferred Vendor &amp; and premium reseller for the world?s best and most reputed brands including {{$brand}} for <strong>{{$category_array[0]["name"]}}</strong> in {{$country}} </li>

			  	<li class="list-group-item1"> Best prices for <strong>{{$productData->name}} </strong>and all {{$category_array[0]["name"]}} in {{$country}} and its accessories with 100% guarantee.</li>
					@endif
			  	<li class="list-group-item1">24 x 7 Service and support with periodic maintenance.</li>

			  	<li class="list-group-item1">Same day delivery at your doorstep throughout {{$country}} along with door-to-door service across {{implode(", ",$cities)}}</li>

			  	<li class="list-group-item1">Large stocks locally available with fresh manufacturing date and full manufacturers warranty.</li>
			  </ul>

			  </div>
			  @endif

			  @if(isset($docs) && $docs!=null && is_array($docs))
			  <div class="tab-pane fade show active" id="documents" role="tabpanel"
			  aria-labelledby="profile-tab" style="padding:30px;background-color:#fafafa;">
					@foreach($docs as $doc)

					<h6>{{$doc['doc_group_title']}}</h6><br/>
					<ul class="list-group">
					@foreach($doc["files"] as $file)

					<?php
					//echo("<pre>");
					//print_r($docs);
					//echo("</pre>");

					$filenamearray= explode("/",$file["filepath"]);

					$filename = $filenamearray[count($filenamearray)-1];
					?>
					<li class="list-group-item"><a href="#">{{$productData->name}} : {{$filename}}</a></li>
					@endforeach
					</ul>
					<br/>

					@endforeach

			  </div>
			  @endif

			   <div class="tab-pane fade" id="diferentiators" role="tabpanel" aria-labelledby="diferentiators-tab" style="padding:30px;background-color:#fafafa;font-size:16px;line-height:24px;">
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
