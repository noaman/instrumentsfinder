<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\lead_products;
use App\lead_options;


class leads extends Model
{
    protected $fillable=['order_id','name','domain','email','enquiry_desc','reseller_price','bulk_price','country_shipping','country','country_code','country_flag','country_emoji','city','lat','lon','status','product_availability','segment'];

    public function getLead($order_id)
    {
    	$leadproductsmodel = new lead_products;
    	$lead = $this->where("order_id",$order_id)->first()->toArray();
    	$leadproducts = $leadproductsmodel->getOptionsByProduct($lead["order_id"]);
    	$lead_data=array("lead"=>$lead,
    						"products"=>$leadproducts);

    	return $lead_data;
    }
}
