<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\products_master;

class AutoCompleteController extends Controller
{
    //
    public function index()
    {

    	return view('autocomplete');

    }


    public function ajaxData(Request $request){

		$segment=resolve("segment");
    	$posts=array();
    	$productmaster = new products_master;
        $query = $request->get('query','');

        if(strlen($query)>2)
        {
        	$posts = $productmaster->select("name","prod_id")->where("prod_segment",$segment)->where('name','LIKE','%'.$query.'%')->get()->toArray();

        	$i=0;
	        foreach ($posts as $post) {
	        	# code...
	        	$prodslug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $post["name"])));
	        	$posts[$i]["slug"]=$prodslug;
	        	$i++;

	        }

        }

        return response()->json($posts);

	}

}
