<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class accessory_master extends Model
{
    protected $fillable=['prod_id','accessory_id','accessory_type'];

    public function getAccessoriesByProductID($prod_id)
    {
        $accessory_types = $this->select("accessory_type")->where("prod_id",$prod_id)->distinct()->get();
        $accessory_final=[];

        $i=0;
        foreach($accessory_types as $acctype)
        {
            $accessory_final[$i]["type"]=$acctype->accessory_type;

    	   $accessory_masterdata=$this->where("prod_id",$prod_id)->where("accessory_type",$acctype->accessory_type)->pluck("accessory_id")->toArray();

           $accessory_final[$i]["accessories"]=$accessory_masterdata;

           $i++;
        }   

        //print_r($accessory_final);

        return $accessory_final;
        
    	/*
    	if(!$accessory_masterdata->isEmpty())
    	{
    		$accessories_array = $accessory_masterdata->toArray();
    		
    		//get accessory data here

    		$accessory_array_final=[];
    		$i=0;
    		foreach($accessories_array as $accessoriesarray_data)
    		{

    			$accessory_array_final[$i]['doc_group_title']=$docarray_data['doc_group_title'];	
    			$files=$documentsfiles->getFilesByFileGroupID($docarray_data['filegroup_id']);
    			$docs_array_final[$i]['files']=$files;

    			$i++;
    		}	
    		return $accessory_array_final;
    	}	
    	*/
    	//else
    		return null;

    }          
}
