<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\products_master;

use App\lead_options;
use App\products_options;

class lead_products extends Model
{
    protected $fillable=['order_id','product_id','source_product_id','quantity','product_base_price','product_discount'];


    public function generatePartNumber($orderid,$productId)
    {
        $leadoptions= new lead_options;
        $prodoptions= new products_options;

        $leadoptions_data=$leadoptions->getOptionsByOrderAndProduct($orderid,$productId);
        $prod_options_data=$prodoptions->getProductOptionsByProductID($productId);


       // echo("<pre>");
        //print_r($leadoptions_data);
        //echo("</pre>");


        $partnumberindex=0;
        $leadoptarray_index=0;
        $partnumber="";
        foreach($prod_options_data as $prod_opt_data)
        {


            $isOptionInLead = false;
            foreach($leadoptions_data as $lead_opt_data)
            {

                if($lead_opt_data[0]["option_id"] == $prod_opt_data["option_id"])
                {




                    if($lead_opt_data[0]["is_code_fixed"]==1)
                        $partnumber.=$lead_opt_data[0]["code_value"];





                    if(isset($lead_opt_data["variant"]))
                       // echo("Got variant".strlen(trim($lead_opt_data["variant"][0]["code"])));
                        if(strlen(trim($lead_opt_data["variant"][0]["code"]))==0)
                        {
                            if($partnumberindex>0 && $partnumberindex<count($leadoptions_data)-1)
                                $partnumber.="NA";
                        }
                        else
                           $partnumber.="".$lead_opt_data["variant"][0]["code"];






                    $isOptionInLead=true;
                }
                $leadoptarray_index++;
                $partnumberindex++;
            }

            if(!$isOptionInLead )
                if($prod_opt_data["is_code_fixed"]==1)
                    $partnumber.=$prod_opt_data["code_value"];

        }



        return $partnumber;
    }

    public function getOptionsByProduct($orderid)
    {
    	$prodmaster = new products_master;
    	$leadoptions= new lead_options;

    	$arr= $this->where("order_id",$orderid)->get()->toArray();

    	$prod_arr=array();
    	foreach($arr as $prod)
    	{
    		$prodmasterdata=$prodmaster->getProductByID($prod["product_id"]);



    		$options=$leadoptions->getOptionsByOrderAndProduct($prod["order_id"],$prod["product_id"]);

            $partnumber = $this->generatePartNumber($prod["order_id"],$prod["product_id"]);

    		$prod_final_data=array(
    			"order_id"=>$prod["order_id"],
    			"product_id"=>$prod["product_id"],
                "source_prod_id"=>$prodmasterdata["source_prod_id"],
    			"name"=>$prodmasterdata["name"],
                "brand"=>$prodmasterdata["brand"],
                "brand_id"=>$prodmasterdata["brand_id"],
    			"url"=>$prodmasterdata["url"],
    			"img"=>$prodmasterdata["img_new_path"],
    			"options_count"=>$prodmasterdata["options_count"],
    			"showcode"=>$prodmasterdata["showcode"],
    			"is_code_fixed"=>$prodmasterdata["is_code_fixed"],
    			"codevalue"=>$prodmasterdata["codevalue"],
    			"quantity"=>$prod["quantity"],
                "product_base_price"=>$prod["product_base_price"],
                "product_discount"=>$prod["product_discount"],
                "product_description"=>$prodmasterdata["long_desc"],
                "prod_segment"=>$prodmasterdata["prod_segment"],
    			"options"=>$options,
                "partnumber"=>$partnumber,
    		);



    		array_push($prod_arr, $prod_final_data);
    	}

    	return $prod_arr;
    }
}
