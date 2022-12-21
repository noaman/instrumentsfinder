
<?php
header ("Content-Type:text/xml");



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
<?php
$data_values = $data->getData($subdomain);
$country = $data_values["country"];
$cities = $data_values["cities"];
$ga = $data_values["ga"];
$currency = $data_values["currency"];
$imagelocation_str = "ff";//$country;//.", ".implode(", ", $cities);
$subdomains_array=$data->getSubdomainArray();
?>

<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">

@if($data_array)

@php



function getSitemapBlock($url,$imxml,$subdomains_array,$ts=null)
	{
		if($ts==null)
			$ts = date('c',time());

		$segment=resolve("segment");
		$subdomain=resolve("subdomain");
		
		if($segment=="medical")
		{
			$xmlblock='<url><loc>'.($url).'</loc><lastmod>'.$ts.'</lastmod>'.$imxml;

			$globalURLFull=str_replace("/".$subdomain, "/"."en", $url);
    		
			$xmlblock.='<xhtml:link rel="alternate" href="https://'.$globalURLFull.'" hreflang="en"/>';


			foreach($subdomains_array as $subdomain_value)
			{
				$newURLFull=str_replace("/".$subdomain, "/".$subdomain_value, $url); 
				$xmlblock.='<xhtml:link rel="alternate" href="https://'.$newURLFull.'" hreflang="en-'.$subdomain_value.'"/>';
				
				
			}
			$xmlblock.='</url>';
			

		}
		else
		{
			$xmlblock='<url><loc>'.($url).'</loc><lastmod>'.$ts.'</lastmod>'.$imxml.'</url>';
		}		

   		return $xmlblock;
	}


	function getImageBlock($imgurl,$img_title,$img_caption,$country)
	{
      
      $imagelocation_str = $country;
        
		$img_xmlblock='<image:image><image:loc>'.$imgurl.'</image:loc><image:title><![CDATA['.htmlentities($img_title).']]></image:title><image:caption><![CDATA['.htmlentities($img_caption).']]></image:caption><image:geo_location>'.$imagelocation_str.'</image:geo_location>
</image:image>';
		

		return trim($img_xmlblock);
	}

		foreach($data_array as $arraydata)
		{



			//echo($brands_arraydata["brand"]);
			$url="";
			$imxml="";
			if($id=="brands")
				$url = $domain.$link_prefix."/brand/".htmlentities($data->create_slug($arraydata["brand"]));
			elseif($id=="categories")
				$url = $domain.$link_prefix."/category/".$arraydata["slug"];	
			elseif($id=="applications")
				$url = $domain.$link_prefix."/application/".$arraydata["slug"];	
			elseif($id=="products")
			{
				$prodslug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $arraydata["name"])));

				$url=$domain.$link_prefix."/product/".$arraydata["prod_id"]."/".$prodslug;
                
                $img_country = $country.", ".implode(",", $cities);
				$imxml=getImageBlock($domain."/assets/".$assetlink_suffix.htmlentities($arraydata["thumb_img_new_path"]),$arraydata["name"]."|
					".$country,$arraydata["seo_title"]."|".implode( ", ", $cities ),$img_country);
				

			}


			$sitemap=getSitemapBlock($url,$imxml,$subdomains_array);
			echo(trim($sitemap));

			
		}
	

@endphp
@endif

</urlset>