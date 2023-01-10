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
				<h1>Are you searching for Medical  instruments?</h1><br/>
				<p>Then InstrumentFinder is the right place. Our experienced technical staff will help you find the right product for your need</p>
				<?php
			}
			else{
			?>
			<h1>Are you searching for Industrial Laboratory instruments?</h1><br/>
			<p>Then InstrumentFinder is the right place. Our experienced technical staff will help you find the right product for your need</p>
			<?php }?>
		</div>
		<div class="col-md-6 col-sm-6 homeimg">
			&nbsp;
		</div>
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
