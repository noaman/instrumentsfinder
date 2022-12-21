<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\category_master;
use App\applications_master;

class products_master extends Model
{
	protected $table = 'products_master';
    //
    protected $fillable=[
	'name',
    'brand',
    'brand_id',
	'prod_id',
	'source_prod_id',
	'seo_title',
	'seo_desc',
	'cat1',
	'cat2',
	'cat3',
	'cat4',
	'cat5',
	'listprice',
	'startingprice',
	'img',
	'thumbnail',
	'short_desc',
	'long_desc',
	'features',
	'stock',
	'prod_url',
	'options_count',
	'showcodes'.
	'is_code_fixed'.
    'codevalue',
    'prod_segment'
	];

	public function getBrandsbyNameCount($segment)
	{
		$array = $this->select("brand")->selectraw("count('name') as total")->groupBy("brand")->orderBy("brand")->get();
         return $array->toArray();
	}



	public function getAllProducts()
	{
		$array = $this->get();

		return $array->toArray();
	}


	public function getProductsForSitemap($index,$keyword)
	{
		if($keyword=='')
			$array = $this->where('id','>',0)->paginate(500,['*'],'page',$index);
		else
		$array = $this->where('id','>',0)->where("name","like","%".$keyword."%")->paginate(500,['*'],'page',$index);	

		return $array->toArray()["data"];
	}


	public function getRandomProducts($segment="instrumentation")
	{
		return $this->inRandomOrder()->take(6)->get();


	}


	public function getRandomBrands($segment="instrumentation")
	{
		$array = $this->select("brand")->selectraw("count('name') as total")->groupBy("brand")->inRandomOrder()->take(12)->get();
         return $array->toArray();
	}

	public function getSearchResults($query,$segment)
	{
		$query= $this->where('name','LIKE','%'.$query.'%')->get();
	}

	public function getProductsByCat($cat)
	{
		$catmaster = new category_master;
		$pids=$catmaster->getProdIdbyCat($cat);

		return $this->wherein('prod_id',$pids)->get();
	}


	public function getProductsByCatSlug($cat_slug)
	{
		$catmaster = new category_master;
		$pids=$catmaster->getProdIdbyCatSlug($cat_slug);

		return $this->wherein('prod_id',$pids)->paginate(30);
	}

	public function getBrandsByCatSlug($cat_slug)
	{
		$catmaster = new category_master;
		$pids=$catmaster->getProdIdbyCatSlug($cat_slug);

		return $this->select("brand")->wherein('prod_id',$pids)->distinct()->get();
	}

	public function getProductsByBrandName($brandname,$category_slug=null)
	{
		if($category_slug!=null)
		{
			$catmaster = new category_master;
			$pids=$catmaster->getProdIdbyCatSlug($category_slug);

			return $this->where("brand",$brandname)->wherein('prod_id',$pids)->paginate(12);
		}
		else
			return $this->where("brand",$brandname)->paginate(30);
	}

	public function getCatIDsByBrand($brandname)
	{
		$cids=$this->select('cat1','cat2','cat3')->where("brand",$brandname)->get()->toArray();
		$catmaster = new category_master;
		return [];
		#return $catmaster->select('name','slug')->wherein('cat_id',$cids)->distinct()->get();
	}


	public function getProductsByAppSlug($app_slug)
	{
		$appmaster = new applications_master;
		$pids=$appmaster->getProdIdbyAppSlug($app_slug);

		return $this->wherein('prod_id',$pids)->paginate(30);
	}

	public function getCatIDsByAppSlug($app_slug)
	{
		$appmaster = new applications_master;
		$pids=$appmaster->getProdIdbyAppSlug($app_slug);

		$cids=$this->select('cat1','cat2','cat3')->wherein('prod_id',$pids)->get()->toArray();
		$catmaster = new category_master;

		return $catmaster->select('name','slug')->wherein('cat_id',$cids)->distinct()->get();
	}

	public function getProductByID($prodID)
	{

       // if($segment != null)
	    //	 {
          //   return $this->where('prod_id',$prodID)->where('prod_segment', $segment)->first();
         //}
         //else
         {
             // for lead products
            return $this->where('prod_id',$prodID)->first();
         }
	}

}
