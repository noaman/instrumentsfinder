<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\documents_files;

class documents_master extends Model
{
    protected $fillable=['prod_id','filegroup_id','doc_group_title'];

               
    public function getDocumentsByProductID($prod_id)
    {
    	$docs_masterdata=$this->where("prod_id",$prod_id)->get();

    	
    	if(!$docs_masterdata->isEmpty())
    	{
    		$docs_array = $docs_masterdata->toArray();
    		$documentsfiles= new documents_files;

    		$docs_array_final=[];
    		$i=0;
    		foreach($docs_array as $docarray_data)
    		{

    			$docs_array_final[$i]['doc_group_title']=$docarray_data['doc_group_title'];	
    			$files=$documentsfiles->getFilesByFileGroupID($docarray_data['filegroup_id']);
    			$docs_array_final[$i]['files']=$files;

    			$i++;
    		}	
    		return $docs_array_final;
    	}	
    	else
    		return null;

    }           
}


