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
  
  $segment=resolve("segment");
  $assetslink="/assets/";
  if($segment=="medical")
  {
    $link_prefix="/".$subdomain;
    $assetslink="/assets/medical/";
  }


if(isset($header))
{

	$prod_listing_header=$header;
}
?>

@extends('layout.v2.mainlayout')

@section('content')


@php

if(isset($type))
{
	$pagetemplate=$type;
}

if(isset($header))
{
	$pageHeader=$header;
}


if($pagetemplate=="categories")
{
	$sublink="/categories";
}
else
if($pagetemplate=="brands")
{
	$sublink="/brands";
}
else
if($pagetemplate=="applications")
{
	$sublink="/applications";
}
$sublink=$link_prefix.$sublink;
@endphp




<div class="container">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb breadcrumb_brand">

		<li class="breadcrumb-item"><a href="#">Home</a></li>

		@if(isset($sublink) && strlen($sublink)>1)
			<li class="breadcrumb-item" aria-current="page"><a href="{{$sublink}}">{{$type}}</a></li>
		@endif

		@if(isset($header) && strlen($header)>1)
			<li class="breadcrumb-item active" aria-current="page"><a href="#">{{$header}} - {{$country}}</a></li>
		@endif



		</ol>


		</nav>

	<div class="row">
		<div class="col-md-3 col-sm-6 d-none d-md-block">
			@if($type=="categories")

				@if(isset($brands_list))
				<div class="leftbar" style="margin:5px;padding:5px;border-bottom: 1px solid #eee;background-color:#f8f8f8;">
					<h5 class="brandcolor" style="margin-left:10px;font-size:13px;font-weight:800;text-transform: uppercase;letter-spacing: 1px;">BRANDS</h5>


					@foreach($brands_list as $brand_data)

					<div class="leftblock">
							@if($pagetemplate=="categories")
								<a href="{{$link_prefix}}/productsets/{{$data->create_slug($brand_data->brand)}}/{{$url_array[2]}}">{{$brand_data->brand}}</a>
							@else
							<a href="{{$link_prefix}}/brand/{{$data->create_slug($brand_data->brand)}}">{{$brand_data->brand}}</a>
							@endif
					</div>
					@endforeach
				</div>
				@endif

			@elseif(isset($applicationsblock) && count($applicationsblock)>0)
			<div class="leftbar" style="margin:5px;padding:5px;border-bottom: 1px solid #eee;background-color:#f8f8f8;">
			<h5 class="brandcolor" style="margin-left:10px;font-size:13px;font-weight:800;text-transform: uppercase;letter-spacing: 1px;">Appplications</h5>

				@foreach($applicationsblock as $application)

					 <div class="leftblock">
                          <a href="{{$link_prefix}}/application/{{$application["slug"]}}">{{$application["name"]}}</a>
                     </div>


				@endforeach

			</div>
			@endif
			@if(isset($catlisting) && count($catlisting)>0)
			<br/>
			<div class="leftbar" style="margin:5px;padding:5px;border-bottom: 1px solid #eee;background-color:#f8f8f8;">
			<h5 class="brandcolor" style="margin-left:10px;font-size:13px;font-weight:800;text-transform: uppercase;letter-spacing: 1px;">Categories</h5>

				@foreach($catlisting as $category)
					<div class="leftblock">
						@if($pagetemplate=="brands")
							<a href="{{$link_prefix}}/productsets/{{$data->create_slug($header)}}/{{$category->slug}}">{{$category->name}}</a>
						@else
					 	<a href="{{$link_prefix}}/category/{{$category->slug}}">{{$category->name}}</a>
					 	@endif
					</div>

				@endforeach

			</div>


			@endif
		</div>
		<div class="col-md-9 col-sm-6">
			<div class="row">
				<div class="col-10 text-justify">

					@if($pagetemplate=="brands")
						<?php
						$cat_string="";
						if(isset($catlisting) && count($catlisting)>0)
						{

							foreach ($catlisting as $catlist){
								$cat_string.="<a href='{{$link_prefix}}/category/".$catlist->slug."'>".$catlist->name."</a>, ";

							}
						}
						?>

					<div class="prodlistingblock text-justify">
						<h1 class="h1_productheader">{{$header}} - {{$country}}</h1>
<a href="{{$link_prefix}}/brand/{{$header}}">{{$header}}</a> manufactures {!!$cat_string!!} and many more products. {{$header}} delivers high quality instrumentation products and has a reputation as one of the top manufacturers of test and measurment instruments.<br/>

@php
						 $metadescription="We are the trusted suppliers for {$header} in $country across ".implode(", ",$cities);

						@endphp
						{{$metadescription}}<br/><br/>


						To get the best Reseller priced Offers across {{$country}} for <a href="{{$link_prefix}}/brand/{{$header}}">{{$header}}</a>, {!!$cat_string!!} explore the products you want and send us your request. For all ex-stock Items a formal Quotation will be sent typically in the next few minutes.
					</div>
					@endif

					@if($pagetemplate=="applications")
					<div class="prodlistingblock text-justify">
						<h1 class="h1_productheader">{{$header}} - {{$country}}</h1>

						@php
						 $metadescription="We are the trusted suppliers for $header across $country ".implode(", ",$cities);

						@endphp
						{{$metadescription}}<br/><br/>

						To get the best Reseller priced Offers  across {{$country}} for {{$header}}  use the Quick Pricing Request Form. For all ex-stock Items a formal Quotation will be sent typically in the next few minutes.
					</div>

					@endif

					@if($pagetemplate=="categories")
						<?php
						$cat_string=$header;
						$brand_str="";

						if($pagetemplate=="categories")
						{
							//foreach($brands_list as $brand_data)
							for($x=0;$x<count($brands_list);$x++)
							{
									$brand_data=$brands_list[$x];

									//$brand_str.='<a href="/brand/'.create_slug($brand_data->brand).'/'.$url_array[2].'">'.$brand_data->brand.'</a>';

									$brand_str.='<a href="{{$link_prefix}}/brand/'.$data->create_slug($brand_data->brand).'/">'.$brand_data->brand.'</a>';

									if($x<count($brands_list)-1)
									{
										$brand_str.=", ";
									}


							}
						}

					?>



					<div class="prodlistingblock text-justify">
						<h1 class="h1_productheader">{{$header}} - {{$country}}</h1>

						@php
						 $metadescription="We are the trusted suppliers for ".$cat_string." across $country ".implode(", ",$cities);

						@endphp
						{{$metadescription}}<br/><br/>

						To get the best Reseller priced Offers across {{$country}} for {!!$cat_string!!} incl	uding but not limited to brands like {!!($brand_str)!!}  use the Quick Pricing Request Form. For all ex-stock Items a formal Quotation will be sent typically in the next few minutes.
					</div>
					@endif

					<hr/>
				</div>
			</div>
			<div class="row">
				<div class="col-12" style="padding:4px;text-align:right;color: #999;padding-right:35px;">
					<?php

						if($productlistings->total()<30)
						{
							$end_recs = $productlistings->total();
							$to_products=$productlistings->total();
						}
						else
						{
							$end_recs = $productlistings->total();
							$to_products=(30*$productlistings->currentPage()<$end_recs)?30*$productlistings->currentPage():$end_recs;
						}
					?>


			</div>

			</div>
			@if(isset($productlistings))


				<div class="row">
							<div class="col-md-8 col-sm-6">
								@if($productlistings instanceof \Illuminate\Pagination\LengthAwarePaginator )

								{{ $productlistings->links('vendor.pagination.bootstrap-4')}}
								@endif
							</div>
							<div class="col-md-4 col-sm-6 pull_right brandcolor" style="font-size:0.9em;letter-spacing: 0.3px;">
								Showing {{1+(30*($productlistings->currentPage()-1))}} to {{$to_products}} of {{$end_recs}} products
							</div>
						</div>

				@foreach($productlistings as $productlisting)
					<?php
					$prodslug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $productlisting->name)));







										$thumbnail = $productlisting->thumb_img_new_path;





					?>
					<div class="productlist">

						<div class="row">
							<div class="col-md-2 col-sm-3">
								<img src="{{$assetslink.$thumbnail}}" alt="{{$productlisting->name}}|{{$productlisting->brand}}" title="{{$productlisting->name}}" data-caption="{{$productlisting->name}}|{{$productlisting->brand}}">
							</div>
							<div class="col-md-8 col-sm-4">
								<h2 style="font-size:1.5em;"><a href="{{$link_prefix}}/product/{{$productlisting->prod_id}}/{{$prodslug}}">{{$productlisting->name}} </a></h2>
								<div class="brand"><a href="{{$link_prefix}}/brand/{{$data->create_slug($productlisting->brand)}}" class="subtext">{{$productlisting->brand}} in {{$country}} (as resellers)</a></div>
								<h3 class="h3_desc">{{$productlisting->short_desc}}</h3>
							</div>
						</div>
					</div>

				@endforeach
				<div class="row">
							<div class="col-md-8 col-sm-6">
								@if($productlistings instanceof \Illuminate\Pagination\LengthAwarePaginator )

								{{ $productlistings->links('vendor.pagination.bootstrap-4')}}
								@endif
							</div>
							<div class="col-md-4 col-sm-6 pull_right brandcolor" style="font-size:0.9em;letter-spacing: 0.3px;">
								Showing {{1+(30*($productlistings->currentPage()-1))}} to {{$to_products}} of {{$end_recs}} products
							</div>
						</div>

			@endif

		</div>

	</div>

</div>

@endsection
