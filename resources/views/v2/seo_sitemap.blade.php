

<?php




 $url_array = resolve('url_array');

    

 $subdomain = resolve('subdomain');

 
 $link_prefix="";
 $homeLink="/";
 $segment=resolve("segment");
 $assetlink_suffix="";
 if($segment=="medical")
 {
   $link_prefix="/".$subdomain;
   $homeLink="/".$subdomain;
   $assetlink_suffix="medical/";
 }
   
?>
@inject('data','App\DataManager')

@if(isset($products_data))





@foreach($products_data as $prod_data)

<?php
	
	
	$brand_url = $domain.$link_prefix."/brand/".htmlentities($data->create_slug($prod_data["brand"]));

	$prodslug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $prod_data["name"])));

	$product_url=$domain.$link_prefix."/product/".$prod_data["prod_id"]."/".$prodslug;
?>

<a href="{{$brand_url}}">{{$brand_url}}</a><br/>
<a href="{{$product_url}}">{{$product_url}}</a><br/>



@endforeach

@endif