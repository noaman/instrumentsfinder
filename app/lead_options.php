<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\products_options;
use App\options_variants;

class lead_options extends Model
{
    //
	protected $fillable =['order_id','product_id','option_id','variant_id','variant_price','variant_cost'];


	public function getOptionsByOrderAndProduct($orderid,$prodid)
	{
		$productoptions_model= new products_options;
		$optionsvariant = new options_variants;
		$optArr= $this->where("order_id",$orderid)->where("product_id",$prodid)->orderby("option_id","asc")->get()->toArray();

		

		$options_array=array();
		foreach($optArr as $opt)
		{
			$opt_arr_data=$productoptions_model->where("prod_id",$opt["product_id"])->where("option_id",$opt["option_id"])->get()->toArray();

			$var = $optionsvariant->getVariantsByOptionID_VariantID($opt["option_id"],$opt["variant_id"]);

			$var[0]["variant_price"]=$opt["variant_price"];
			$var[0]["variant_cost"]=$opt["variant_cost"];
			$opt_arr_data["variant"]=$var;

			array_push($options_array,$opt_arr_data);
		}

		return $options_array;
	}
}    
