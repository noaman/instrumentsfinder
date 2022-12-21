
@extends('layout.theme.mainlayout')

@section('content')

<?php
$cat_name="";

?>

@if(isset($categoriesblock))
<?php
	$cat_name=$categoriesblock[0]["name"];
?>	
@endif

<div class="container">

	<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a>

    </li>

    <li class="breadcrumb-item active" aria-current="page">{{$cat_name}}</li>


  </ol>
</nav>

  <div class="row">

  </div>	
  <div class="row">

  <div class="col-6 col-md-3">
  		
  		<!--
  		@if(isset($categoriesblock))
  		<div class="card">
  			<div class="card-body">
  				<p class="card-title"><b>Categories</b></p>


  			@foreach ($categoriesblock as $category)
  				<p><small>{{$category['name']}}({{$category['total']}})</small></p>
  			@endforeach
  			</div>
  		</div>	
  		@endif
  		<br/>
		-->

  		@if(isset($applicationsblock) && count($applicationsblock)>0)
  		<div class="card">
  			<div class="card-body">
  				
				<p class="card-title"><b>Applications</b></p>

  				@foreach ($applicationsblock as $k=>$v)
  				<small>{{$k}}({{$v}})</small><br/>
  				@endforeach
  			</div>
  		</div>	
  		@endif
  		
  </div>	
  <div class="col-12 col-md-9">

	@if(isset($productlistings))

	@foreach($productlistings as $productlisting)

	<?php
	$prodslug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $productlisting->name)));

	?>
		<div class="card">
			<div class="card-body">
				 <h5 class="card-title"><a href="/product/{{$productlisting->prod_id}}/{{$prodslug}}">{{$productlisting->name}}</a></h5>
				
			<p class="card-text">{{$productlisting->short_desc}}</p>
				
    		</div><!--end of card body-->	
    		<!--<div class="card-footer">
      				<small class="text-muted">
      			
      				@if($productlisting->options_count>0)
						<a href="#">Add options</a>
					@else
						<a href="#">Add to cart</a>
					@endif
					</small>
    		</div>--><!--end of footer-->
		</div><!--end of card-->
		<br/>

	@endforeach

@endif
</div>
</div>
</div>
@endsection
