<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category_master;
use App\products_master;
use App\applications_master;
use App\documents_master;
use App\accessory_master;
use App\products_options;

use App\leads;
use App\lead_products;
use App\lead_options;

use Mail;
use App\Mail\SendMailable;
use App\Mail\SendMailResponse;
use \SimpleXMLElement;
use \DomDocument;
use \Response;



/*
1. Mobile UI
2. SEO
3. Completion of the RFQ
P2----
4. Accessories
5. Upsell & recommendation
6. Recently viewed products


----

og:types : https://stackoverflow.com/questions/8263493/ogtype-and-valid-values-constantly-being-parsed-as-ogtype-website


Post live
1. CMS for other products - data entry





wget -p -k -e robots=off -U 'Mozilla/5.0 (X11; U; Linux i686; en-US;rv:1.8.1.6) Gecko/20070802 SeaMonkey/1.1.4' http://demo.devitems.com/subas-preview/subas/elements-sidebar-right.html


GEO IP
https://ipstack.com/
API KEY : 3cf453a7e01668f433270f0f51956f1b

Delete from accessory_masters;
Delete from applications_masters;
Delete from category_masters;
Delete from documents_files;
Delete from documents_masters;
Delete from migrations;
Delete from options_variants;
Delete from password_resets;
Delete from products_master;
Delete from products_options;
Delete from users;
Delete from lead_options;
Delete from lead_products;
Delete from leads;


 Drop table accessory_masters;
 Drop table applications_masters;
 Drop table category_masters;
 Drop table documents_files;
 Drop table documents_masters;
 Drop table migrations;
 Drop table options_variants;
 Drop table password_resets;
 Drop table products_master;
 Drop table products_options;
 Drop table users;
 Drop table leads;
 Drop table lead_options;
 Drop table lead_products;


//VIANT

//ADELSIC. (DSP focussed on people based targetting)

DSP shoukld talk beyond digital to also outdoor where we can measure and perform the same as on digital. Mainly outdoor and Jawwy TV.




*/





class MainController extends Controller
{
    protected $segment = 'instrumentation' ;

	public function generateSEOLinks(Request $request)
	{
		$domain = "https://".$request->getHost();
		$productmaster = new products_master;
		//$products_data = $productmaster->whereIn($productmaster->distinct("brands")->get())->get();


		//$products_data=$productmaster->select("name","brand")->distinct("brand")->limit(500)->paginate(500,['*'],'page',$index);

		//$data= $products_data-["data"];


		$products_data=$productmaster->select("brand","prod_id","name")->get()->unique('brand')->toArray();

		$domain = "https://".$request->getHost();

		return view("v2.seo_sitemap",compact("domain","products_data"));


	}

public function siteMapGenerate(Request $request,$param1,$param2,$param3=null,$param4=null)
{
	if($param3==null)
	{
		$id=$param1;
		$index=$param2;
	}
	else
	{
		$id=$param2;
		$index=$param3;
	}

	$keyword='';
	if($param4!=null)
	{
		$keyword=$param4;
	}
	
	$productmaster = new products_master;
	$categorymaster = new category_master;
	$applicationmaster = new applications_master;
	$segment=  resolve("segment");
	$domain = "https://".$request->getHost();
	if($id=="brands")
		$data_array=$productmaster->getBrandsbyNameCount($segment);
	elseif($id=="categories"){
			$data_array=$categorymaster->getCategorybyNameCount($segment);
		}
	elseif($id=="applications"){
		$data_array=$applicationmaster->getApplicationsbyNameCount($segment);
	}
	elseif($id=="products"){
		$data_array=$productmaster->getProductsForSitemap($index,$segment,$keyword);
	}
	elseif($id=="brands_products")
	{

	}


	return response()->view("v2.sitemap",compact("data_array","domain","id"))->header('Content-Type', 'text/xml');
}



	public function getSitemapBlock($url,$ts=null)
	{
		if($ts==null)
			$ts = date('c',time());

		$xmlblock='<url>
      		<loc>'.$url.'</loc>
      		<lastmod>'.$ts.'</lastmod>
   		</url>';

   		return $xmlblock;
	}


    public function index()
	{
	//$locale = Config::get('app.locale');
	//print($locale);
		$segment = resolve('segment');
		//echo($segment);
		$productmaster = new products_master;
		$productData=$productmaster->getRandomProducts($segment);
		$brands_array=$productmaster->getRandomBrands($segment);

		return view("v2.index",compact("productData","brands_array"));
	}


	public function emailcron()
	{

		$leadmodel = new leads;
		$leads_to_email  = $leadmodel->where("status","NEW")->get()->toArray();


		foreach($leads_to_email as $lead_to_email)
		{
			$lead_id = $lead_to_email["order_id"];
			$res = $this->sendmail($lead_id);
			echo("sending email to ".$lead_id." -- ".$res );
			$leadmodel->where("order_id",$lead_id)->update(['status' => "LEAD_EMAIL_SENT"]);
		}


	}

	public function sendmail($leadid)
	    {

        $leadmodel = new leads;
        $lead_data=$leadmodel->getLead($leadid);



        Mail::to('enquiry@agisafety.com')->send(new SendMailable($lead_data));
       // Mail::to('kapadiayusuf@gmail.com')->send(new SendMailable($lead_data));
        //Mail::to('noamankazi79@gmail.com')->send(new SendMailable($lead_data));


        if (Mail::failures()) {
           return response()->Fail('sorry, email not sent');
         }else{
           return response()->json('success');
         }
    }

	public function getSearchResults(Request $request)
	{
		$segment = resolve('segment');
        $query = $request->get('query','');
        $productmaster = new products_master;
        $posts=$productmaster->getSearchResults($query,$segment);
        return response()->json($posts);
	}

	public function getProductPriceFromInstrumart($leadId)
	{
		$leadmodel = new leads;
		$productmaster = new products_master;

        $lead_data=$leadmodel->getLead($leadId);
        $url="https://www.instrumart.com/products/configuratorjson/";
        $total_leadprice=0;
		echo("<pre>");
		print_r($lead_data);
		try{
		foreach($lead_data["products"] as $lead_product)
		{
			$prod_data = $productmaster->getProductByID($lead_product["product_id"]);

			$source_prod_id = $prod_data->source_prod_id;

			$finalurl = $url.$source_prod_id;

			$data = json_decode(file_get_contents($finalurl), true);
			print($source_prod_id);
			print("<br/>");
			$listing_price = $data["listPrice"];
			$total_price = $listing_price;
			$startingPrice = $data["startingPrice"];
			$discount = $data["discount"];

			foreach($lead_product["options"] as $lead_product_options)
			{
				//print_r($lead_product_options);
				$option_id = $lead_product_options[0]["option_id"];
				$variant_id = $lead_product_options["variant"][0]["variant_id"];

				foreach($data["options"] as $data_options)
				{
					if($data_options["id"]==$option_id)
					{
						$options_variants = $data_options["values"];
						foreach($options_variants as $options_variants_data)
						{
							if($options_variants_data["id"]==$variant_id)
							{

								$lead_product_options["variant"][0]["instrumart_listprice"]=$options_variants_data["listPrice"];
								$lead_product_options["variant"][0]["instrumart_cost"]=$options_variants_data["cost"];

								$total_price+=$options_variants_data["listPrice"];
							}
						}
					}
				}


				//print_r($lead_product_options);
			}
			$total_leadprice+=$total_price;

			print("base _ price ".$listing_price);
			echo("<hr/>");
			print("total _ price ".$total_price);
			echo("<hr/>");



			echo("<hr/>");
		}
		
		print("total_leade _ price ".$total_leadprice);
		echo("</pre>");
		}catch (Exception $e)
		{

		}
	}


	public function submitEmail(Request $request)
	{


		$subdomain = resolve('subdomain');
		$segment = resolve('segment');
		$productmaster = new products_master;
		$inquiry_description="";
		$email="";
		$shipping_country="";
		$resellerpricing='N';
		$bulkpricing='N';

		if($request->input("inquiryDescription")!=null)
			$inquiry_description= $request->input("inquiryDescription");

		if($request->input("email")!=null)
			$email= $request->input("email");

		if($request->input("resellerpricing")!=null)
			$resellerpricing= 'Y';

		if($request->input("bulkpricing")!=null)
			$bulkpricing= 'Y';

		if($request->input("CountryProductShipsTo")!=null)
			$shipping_country= $request->input("CountryProductShipsTo");



	}



	public function submitLead(Request $request)
	{


		$subdomain = resolve('subdomain');
		$segment = resolve('segment');
		
		$lead_model = new leads;
		$lead_prod_model = new lead_products;
		$lead_opt_model = new lead_options;

		// $ip_addres = $request->ip();

		//$ip_addres="83.110.239.78";

		//$ip_addres = $this->getIp();
		$productmaster = new products_master;

		//for testing

		//$ip_addres="http://api.ipstack.com/94.200.28.38?access_key=3cf453a7e01668f433270f0f51956f1b";


		// $json_url="https://www.instrumart.com/products/configuratorjson/";

		// $locapiurl='http://api.ipstack.com/'.$ip_addres.'?access_key=3cf453a7e01668f433270f0f51956f1b';


		// $context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));




		// $locdata = json_decode(file_get_contents($locapiurl,false,$context),true);

		//print_r($locdata);

		//$loc = geoip('232.223.11.11');
		$inquiry_description="";
		$email="";
		$shipping_country="";
		$resellerpricing='N';
		$bulkpricing='N';

		/*foreach($request->input() as $k=>$v)
		{
			echo("key ".$k);
			echo("<br/>");
		}
		*/
		/* if($request->input("CountryProductShipsTo")!=null)
			$email= $request->input("CountryProductShipsTo");
 		*/
		if($request->input("inquiryDescription")!=null)
			$inquiry_description= $request->input("inquiryDescription");

		if($request->input("email")!=null)
			$email= $request->input("email");

		if($request->input("resellerpricing")!=null)
			$resellerpricing= 'Y';

		if($request->input("bulkpricing")!=null)
			$bulkpricing= 'Y';

		if($request->input("CountryProductShipsTo")!=null)
			$shipping_country= $request->input("CountryProductShipsTo");

		$country="";
		// if(isset($locdata) &&  is_array($locdata) && $locdata["country_name"]!=null)
		// 	$country=$locdata["country_name"];

		$countrycode="";
		// if(isset($locdata) &&  is_array($locdata) && $locdata["country_code"]!=null)
		// 	$country=$locdata["country_code"];

		$countryflag="";
		// if(isset($locdata) &&  is_array($locdata["location"]) && $locdata["location"]["country_flag"]!=null)
		// 	$countryflag=$locdata["location"]["country_flag"];

		$countryemoji="";
		// if(isset($locdata) && is_array($locdata["location"]) && $locdata["location"]["country_flag_emoji"]!=null)
		// 	$countryemoji=$locdata["location"]["country_flag_emoji"];

		$city="";
		// if(isset($locdata) && is_array($locdata) && $locdata["city"]!=null)
		// 	$city=$locdata["city"];

		$lat="";
		// if(isset($locdata) &&  is_array($locdata) && $locdata["latitude"]!=null)
		// 	$lat=$locdata["latitude"];

		$lon="";
		// if(isset($locdata) &&  is_array($locdata) && $locdata["longitude"]!=null)
		// 	$lon=$locdata["longitude"];




		$pref = rand(200,9999);

		//if( is_array($request->input("product") && $request->input("product")[0]!=null))
		//	$pref = $request["product"][0];

		$product_arr = $request->input("product");
		$qty_arr = $request->input("qty");

		$option_arr = array();

		if($request->input("option_id")!=null)
			$option_arr = $request->input("option_id");



		$variant_arr = array();
		if($request->input("variant")!=null)
			$variant_arr = $request->input("variant");



        $uniquid = 100786+$lead_model->max('id')+1;

		$order_id  ="INSTRF-".$uniquid;

		/*echo("<pre>");
		print_r($product_arr);
		print_r($option_arr);
		print_r($variant_arr);
		echo("</pre>");
	*/
		$name='';


		$lead_data_to_add = ["order_id"=>$order_id,"domain"=>$subdomain,"name"=>$name,"email"=>$email,"enquiry_desc"=>$inquiry_description,"reseller_price"=>$resellerpricing,"bulk_price"=>$bulkpricing,"country_shipping"=>$shipping_country,"country"=>$country,"country_code"=>$countrycode,"country_flag"=>$countryflag,"country_emoji"=>$countryemoji,"city"=>$city,"lat"=>$lat,"lon"=>$lon,"segment"=>$segment];

		//return $lead_data_to_add;



		$products_data_to_add=array();
		$data=array();

		$array_index=0;
		foreach ($product_arr as $key => $value) {
			//print("key ".$key." v = ".$value);
			if(isset($qty_arr[$key]))
				$qty=$qty_arr[$key];
			else
				$qty = 0;
			//print("<hr/>".$qty);
			array_push($products_data_to_add, ["order_id"=>$order_id,"product_id"=>$key,"quantity"=>$qty]);


			$prod_data = $productmaster->getProductByID($key);

			$source_prod_id = $prod_data->source_prod_id;

			$finalurl = $json_url.$source_prod_id;


			if($segment=="instrumentation"){
			$data[$key] = json_decode(file_get_contents($finalurl,false,$context),true);
			}
			else	
				$data[$key] = array();

			$listing_price = 0;
			if(is_array($data) && isset($data[$key]["listPrice"]))
				$listing_price = $data[$key]["listPrice"];

			$discount = 0;
			if(is_array($data) && isset($data[$key]["discount"]))
				$discount = $data[$key]["discount"];


			$products_data_to_add[$array_index]["product_base_price"]=$listing_price;
			$products_data_to_add[$array_index]["product_discount"]=$discount;
			$array_index++;


		}//emd of for loop



		$options_data_to_add=array();

		foreach ($option_arr as $pid => $opt_arr) {

			foreach($opt_arr as $opt_id)
			{
				$varid=0;
				if(isset($variant_arr[$opt_id]))
					$varid=$variant_arr[$opt_id];

				$variant_price=0;
				$variant_cost=0;

				if(is_array($data) && isset($data[$pid]) && isset($data[$key]["options"]))
					foreach($data[$key]["options"] as $data_prod_options)
					{
						if($data_prod_options["id"]==$opt_id)
						{
							foreach($data_prod_options["values"] as $data_prod_options_variants)
							{
								if($data_prod_options_variants["id"] == $varid)
								{

									$variant_price=$data_prod_options_variants["listPrice"];
									$variant_cost=$data_prod_options_variants["cost"];
									break;
								}
							}
						}


					}


						array_push($options_data_to_add, ["order_id"=>$order_id,"product_id"=>$pid,"option_id"=>$opt_id,"variant_id"=>$varid,"variant_price"=>$variant_price,"variant_cost"=>$variant_cost]);

			}
		}




		$res = $lead_model->create($lead_data_to_add);
		foreach($products_data_to_add as $prod_data_to_add)
		$lead_prod_model->create($prod_data_to_add);

		foreach($options_data_to_add as $option_data_to_add)
		$res1 = $lead_opt_model->create($option_data_to_add);
		//$this->sendmail($order_id);
		return view("v2.thankyou");


	}

	public function showProductsBypID($productid,$productslug)
	{
		if(!is_numeric($productid))
		{
			$p_slug = $productid;
			$p_id = $productslug;


			$productid=$p_id;
			$productslug=$p_slug;
		}

		$productmaster = new products_master;
		$categorymaster = new category_master;
		$productData=$productmaster->getProductByID($productid);
		$documentsmasters=new documents_master;
		$accessorymaster=new accessory_master;
		$productoptions=new products_options;
		if($productData!=NULL)
		{
		$cat_array=array();
		if($productData->cat1!="")
			$cat_array[]=$productData->cat1;
		if($productData->cat2!="")
			$cat_array[]=$productData->cat2;
		if($productData->cat3!="")
			$cat_array[]=$productData->cat3;
		if($productData->cat4!="")
			$cat_array[]=$productData->cat4;

		//print_r($cat_array);

		$category_array=[];
		foreach($cat_array as $catidval)
			
			$res=$categorymaster->getCategoryByProuctID($catidval);
			if($res!=null)
				$category_array[]=$res->toArray();


		$docs = $documentsmasters->getDocumentsByProductID($productid);

		$accessories = $accessorymaster->getAccessoriesByProductID($productid);

		$options=$productoptions->getProductOptionsByProductID($productid);


			return view('v2.productdetails',compact('productData','category_array','docs','accessories','options'));
		}
		else
		{
			return redirect()->action('MainController@index');

		}


    }

	public function getConfigurator($param1,$param2=null)
	{
		if($param2==null)
			$productid=$param1;
		else
			$productid=$param2;


		$productmaster = new products_master;

		$productoptions=new products_options;
		$productData=$productmaster->getProductByID($productid);

		$options=$productoptions->getProductOptionsByProductID($productid);

		//return view('v2.configurator',compact('productData','options'));
		return view('v2.index',compact('productData','options'));
	}


    public function showCategoryListing()
    {
		$segment=resolve("segment");
    	//$applicationmaster = new applications_master;
    	//$applications = $applicationmaster->getApplicationsbyNameCount();
    	$categorymaster = new category_master;
    	$toplisting = $categorymaster->getCategorybyNameCount($segment);
    	$type="categories";
    	//return view('v2.categorylist', compact('categories','applications'));
    	return view('v2.toplisting', compact('toplisting','type'));
    }

    // public function showCategoryListingSegment($segment)
    // {
    // 	//$applicationmaster = new applications_master;
    // 	//$applications = $applicationmaster->getApplicationsbyNameCount();
    // 	$categorymaster = new category_master;
    // 	$toplisting = $categorymaster->getCategorybyNameCountSegment($segment);
    //     $type="categories";
    //     // print $segment;
    //     //return view('v2.categorylist', compact('categories','applications'));
    // 	return view('v2.toplisting', compact('toplisting','type'));
    // }

    public function showApplicationsListing()
    {
		$segment = resolve("segment");
    	$applicationmaster = new applications_master;
    	$toplisting = $applicationmaster->getApplicationsbyNameCount($segment);
    	$type="applications";
    	//return view('applicationslist', compact('applications'));
    	return view('v2.toplisting', compact('toplisting','type'));
    }

    


    public function showBrandsListing()
    {
		$segment = resolve("segment");
    	$productmaster = new products_master;
    	$toplisting=$productmaster->getBrandsbyNameCount($segment);
    	$type="brands";
    	//$applicationmaster = new applications_master;
    	//$applications = $applicationmaster->getApplicationsbyNameCount();
    	//return view('brandslist',compact('brands','applications'));
    	return view('v2.toplisting', compact('toplisting','type'));
    }



    public function redirectBrandURL($param1,$param2=null,$category_slug=null)
    {
    	return redirect()->route('productsets', ['brandname' => $brandname, 'category_slug' => $category_slug]);

    }

    public function create_slug($var)
    {
        return str_replace(" ", "-", trim(htmlentities($var)));
    }

    public function showProductsByBrand($param1,$param2=null,$category_slug=null)
    {


		if($param2==null)
			$brandname=$param1;
		else
			$brandname=$param2;	

    	if ( preg_match('/\s/',$brandname) )
    	{
    		$brandname = $this->create_slug($brandname);
    		return redirect()->route('brand', ['brandname' => $brandname]);
    	}

    	$brandname = str_replace("-", " ", html_entity_decode($brandname));
    	$brandname = str_replace("~", "/", html_entity_decode($brandname));

    	$categorymaster = new category_master;
    		$applicationsmaster= new applications_master;


    		$productmaster = new products_master;
    		$productlistings = $productmaster->getProductsByBrandName($brandname,$category_slug);

    		$prod_id_array=array();
    		foreach($productlistings  as $productlisting)
    		{
    			$prod_id_array[]=$productlisting->prod_id;
    		}

    		$applicationsblock=$applicationsmaster->getAllApplicationsByProdIDArray($prod_id_array);

    		$type="brands";

    		$header=$brandname;

    		$catlisting =$productmaster->getCatIDsByBrand($brandname);
    		//print_r($catlist);

    		return view('v2.productlisting',compact('productlistings','applicationsblock','catlisting','brandname','type','header'));
    }

    public function showProductsByApplication($param1,$param2=null)
    {
		if($param2==null)
			$application_slug=$param1;
		else
			$application_slug=$param2;	


    	$categorymaster = new category_master;
    		$applicationsmaster= new applications_master;

    	$productmaster = new products_master;
    		$productlistings = $productmaster->getProductsByAppSlug($application_slug);

    	$prod_id_array=array();
    		foreach($productlistings  as $productlisting)
    		{
    			$prod_id_array[]=$productlisting->prod_id;
    		}

    		$applicationsblock=$applicationsmaster->getAllApplicationsByProdIDArray($prod_id_array);


    		$type="applications";

    		$applicationnamearray=$applicationsmaster->getApplicationBySlug($application_slug);

    		$header=$applicationnamearray["name"];
    		$catlisting =$productmaster->getCatIDsByAppSlug($application_slug);

    		return view('v2.productlisting',compact('productlistings','catlisting','type','header'));

    }

    public function showProductsByCategory(Request $request,$param1,$param2=null)
    {
			if($param2==null)
				$category_slug=$param1;
			else
				$category_slug=$param2;		
		
    		$categorymaster = new category_master;
    		$applicationsmaster= new applications_master;

			

    		$productmaster = new products_master;
    		$productlistings = $productmaster->getProductsByCatSlug($category_slug);

    		$prod_id_array=array();

    		foreach($productlistings  as $productlisting)
    		{
    			$prod_id_array[]=$productlisting->prod_id;
    		}



    		$categoriesblock=$categorymaster->getAllCategoriesByCatSlug($category_slug);
    		$applicationsblock=$applicationsmaster->getAllApplicationsByProdIDArray($prod_id_array);

    		$type="categories";
    		$catnamearray=$categorymaster->getCategoryBySlug($category_slug);
    		$brands_list=$productmaster->getBrandsByCatSlug($category_slug);


    		$header=$catnamearray["name"];

    		return view('v2.productlisting',compact('productlistings','brands_list','type','header'));
    }//enf of funtion

}
