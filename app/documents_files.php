<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class documents_files extends Model
{
    protected $fillable=['filegroup_id','filetype','filepath'];


     public function getFilesByFileGroupID($fileGroupID)
     {
     	
     	return $this->where("filegroup_id",$fileGroupID)->get()->toArray();
     }
}
