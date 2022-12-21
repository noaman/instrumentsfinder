
<?php
use App\Http\Controllers\MainController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AutoCompleteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/prodconfig/{leadId}',"App\Http\Controllers\MainController@getProductPriceFromInstrumart");

Route::get('autocomplete-ajax',array('as'=>'autocomplete.ajax','uses'=>'App\Http\Controllers\MainController@getSearchResults'));

Route::get('/autocomplete-search',array('as'=>'autocomplete.search','uses'=>'App\Http\Controllers\AutoCompleteController@index'));

Route::get('/autocomplete-ajax',array('as'=>'autocomplete.ajax','uses'=>'App\Http\Controllers\AutoCompleteController@ajaxData'));





Auth::routes();

// Route::get("/emailauth",function (){

// 	Auth::loginUsingId("noaman.kazi@gmail.com");
// 	return redirect('/admin');

// });

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/admin', 'App\Http\Controllers\HomeController@index')->name('adminhome');

Route::get('/mail', 'App\Http\Controllers\MainController@emailcron')->name('sendmail');




Route::get('{subdomain}/categories','App\Http\Controllers\MainController@showCategoryListing');
Route::get('/categories','App\Http\Controllers\MainController@showCategoryListing');

Route::get("/backend",'App\Http\Controllers\AdminController@index');

Route::get('{subdomain}/category/{category_slug}','App\Http\Controllers\MainController@showProductsByCategory');
Route::get('/category/{category_slug}','App\Http\Controllers\MainController@showProductsByCategory');

Route::get('{subdomain}/brands','App\Http\Controllers\MainController@showBrandsListing');
Route::get('/brands','App\Http\Controllers\MainController@showBrandsListing');

Route::get('{subdomain}/brand/{brandname}','App\Http\Controllers\MainController@showProductsByBrand')->name("brand_subdomain");
Route::get('/brand/{brandname}','App\Http\Controllers\MainController@showProductsByBrand')->name("brand");


Route::get('/applications','App\Http\Controllers\MainController@showApplicationsListing');
Route::get('{subdomain}/applications','App\Http\Controllers\MainController@showApplicationsListing');

Route::get('/application/{application_slug}','App\Http\Controllers\MainController@showProductsByApplication');
Route::get('{subdomain}/application/{application_slug}','App\Http\Controllers\MainController@showProductsByApplication');


Route::get('{subdomain}/product/{productid}/{productslug}','App\Http\Controllers\MainController@showProductsBypID');
Route::get('/product/{productid}/{productslug}','App\Http\Controllers\MainController@showProductsBypID');

Route::get('/product/{productid}/{productslug}','App\Http\Controllers\MainController@showProductsBypID');
Route::get('{subdomain}/product/{productid}/{productslug}','App\Http\Controllers\MainController@showProductsBypID');

Route::get('/configurator/{productid}','App\Http\Controllers\MainController@getConfigurator');
Route::get('{subdomain}/configurator/{productid}','App\Http\Controllers\MainController@getConfigurator');

Route::view('/checkout','v2.checkout');
Route::view('{subdomain}/checkout','v2.checkout');

Route::post("/submitlead",'App\Http\Controllers\MainController@submitLead');
Route::post("{subdomain}/submitlead",'App\Http\Controllers\MainController@submitLead');

Route::get('/sitemap/{id}/{index}/{keyword?}','App\Http\Controllers\MainController@siteMapGenerate');
Route::get('{subdomain}/sitemap/{id}/{index}/{keyword?}','App\Http\Controllers\MainController@siteMapGenerate');


//Route::get('/sitemap/{id}/','MainController@siteMapGenerate');
//Route::get('{subdomain}/sitemap/{id}/','MainController@siteMapGenerate');

Route::get('/seo','App\Http\Controllers\MainController@generateSEOLinks');
Route::get('{subdomain}/seo','App\Http\Controllers\MainController@generateSEOLinks');


//To be fixed
Route::get('/productsets/{brandname}/{category_slug}','App\Http\Controllers\MainController@showProductsByBrand')->name('productsets');;
Route::get('{subdomain}/productsets/{brandname}/{category_slug}','App\Http\Controllers\MainController@showProductsByBrand')->name('productsets_subdomain');;


Route::get('{subdomain}/brand/{brandname}/{category_slug}', 'App\Http\Controllers\MainController@redirectBrandURL');
Route::get('/brand/{brandname}/{category_slug}', 'App\Http\Controllers\MainController@redirectBrandURL');
//To be fixed


Route::get('/{subdomain?}','App\Http\Controllers\MainController@index');

Route::get("/admin",'App\Http\Controllers\AdminController@index')->middleware('auth');;
Route::get("/admin/sent",'App\Http\Controllers\AdminController@sent')->middleware('auth');

Route::get("/lead/{leadid}",'App\Http\Controllers\AdminController@displayLead')->middleware('auth');;
Route::get("/sendemail/{leadid}",'App\Http\Controllers\AdminController@displayLeadEmail')->middleware('auth');;
Route::Post("/sendemailresponse/{leadid}",'App\Http\Controllers\AdminController@sendEmailReponse')->middleware('auth');;

Route::get("/previewemail/{leadid}",'App\Http\Controllers\AdminController@previewLeadEmail')->middleware('auth');

Route::get("/addProducts",'App\Http\Controllers\AdminController@addProducts')->middleware('auth');;




// Auth::routes();


