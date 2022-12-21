<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\options_variants;

class products_options extends Model
{
    protected $fillable=['prod_id','option_id','options_desc','is_code_fixed','code_value'];



    public function getProductOptionsByProductID($prod_id)
    {
    	$optionsvariants=new options_variants;

    	$options= $this->where("prod_id",$prod_id)->orderby("option_id","asc")->get()->toArray();

    	$options_final=[];

    	$i=0;
    	foreach($options as $option)
    	{
    		$option_id = $option["option_id"];
    		$optionsvariantsarray=$optionsvariants->getVariantsByOptionID($option_id);
    		$options_final[$i]=$option;
    		$options_final[$i]["variants"]=$optionsvariantsarray;
    		$i++;

    	}


    	/*
    	$options_final=[];

    	foreach($options as $option)
    	{
    		echo("<pre>");
    		print_r($option);
    		$options_final[]=array([$option['options_desc']=>$option]);
    		echo("</pre>");
    		//$options_final[$option['options_desc']]=1;
    	}
    	*/

    	return $options_final;
    }
}
