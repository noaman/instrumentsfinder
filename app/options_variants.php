<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class options_variants extends Model
{
    protected $fillable=['option_id','variant_id','code','variant_desc','listprice','cost'];



    public function getVariantsByOptionID($option_id)
    {
    	$variant_array = $this->where("option_id",$option_id)->get()->toArray();
    	return $variant_array;
    }


    public function getVariantsByOptionID_VariantID($option_id,$var_id)
    {
    	$variant_array = $this->where("option_id",$option_id)->where("variant_id",$var_id)->get()->toArray();
    	return $variant_array;
    }
}
