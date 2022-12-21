<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class applications_master extends Model
{
     protected $fillable =['prod_id','name','app_segment'];

     public function getDistinctApplicationNames()
    {
    	 return $this->select('name')->distinct()->get();
    }

    public function getApplicationsbyNameCount($segment)
    {
         //$array = $this->select("name","slug")->selectraw("count('name') as total")->groupBy("slug")->where('app_segment', $segment)->groupBy("name")->orderBy("name","asc")->orderBy("total","desc")->get();
         $array = $this->select("name","slug")->selectraw("count('name') as total")->groupBy("slug")->groupBy("name")->orderBy("name","asc")->orderBy("total","desc")->get();
         return $array->toArray();
    }



    public function getProdIdbyAppSlug($app_slug)
    {
        return $this->select('prod_id')->where('slug',$app_slug)->get()->toArray();
    }



    public function getApplicationBySlug($slug)
    {
        return $this->where("slug",$slug)->first()->toarray();
    }

    public function getAllApplicationsByProdIDArray($prodids)
    {

    	$array= ($this->select("name","slug")->wherein('prod_id',$prodids)->distinct()->get()->toarray());

    	 return ($array);

    }

}
