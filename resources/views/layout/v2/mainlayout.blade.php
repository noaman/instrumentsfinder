<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    ?>
    <!doctype html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
  <head>
<meta name="google-site-verification" content="omHqJAAMCxy8mUBibcZSN7CIfsiVwFi_bB1oKcfEIVo" />
<meta name="yandex-verification" content="a0367cdacd50107b" />
<link rel="stylesheet" href="/v2/bootstrap.min.css">
<?php
    $stylesheetFile="style.css";
    $segment = resolve('segment');
    $faviconPath="";
    if($segment=="medical")
    {
        $faviconPath="medical/";
        $stylesheetFile ="style_med.css";
    }
?>

<link rel="stylesheet" href="/v2/<?=$stylesheetFile?>">
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<link  rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
@php
$url_array = resolve('url_array');
@endphp
@inject('data','App\DataManager')
<?php
// href lang
//<link rel="alternate" href="https://med.instrumentsfinder.test/sa/" hreflang="en-sa" />
//instrumentsfinder@gmail.com
//instru@00786
    $category_string="";
    $brandstring="";
    $prodName="";
    $currency="AED";
    $ga="";

    $page="index";

$url_array = resolve('url_array');
$subdomain = resolve('subdomain');
$url_full = resolve('url_full');
$data_values = $data->getData($subdomain);
$country = $data_values["country"];
$cities = $data_values["cities"];
$ga = $data_values["ga"];
$currency = $data_values["currency"];
$link_prefix="";
$homeLink="/";

//print_r($url_full);
$isProductPage=in_array("product",$url_array,TRUE);

  $segment=resolve("segment");
  $schema_org_url="https://".$subdomain.".instrumentsfinder.com/";
  if($segment=="medical")
  {
    $link_prefix="/".$subdomain;
    $homeLink="/".$subdomain;

    $schema_org_url="https://med.instrumentsfinder.com/".$subdomain."/";

  }

  $subdomains_array=$data->getSubdomainArray();


    if(isset($category_array))
    {
        $cat_seo_array=array();
        foreach($category_array as $cat_element)
            $cat_seo_array[]=$cat_element["name"];
              //$cat_seo_string.=$cat_element['name']." | ";


        //print_r($cat_seo_array);
    }

    $title="";
    $metadescription="";

    if(in_array("categories",$url_array,TRUE))
        $page="categories";
    else
    if(in_array("brands",$url_array,TRUE))
        $page="brands";
    else
    if(in_array("applications",$url_array,TRUE))
        $page="applications";
    else
    if(in_array("category",$url_array,TRUE))
    $page="category";
    else
    if(in_array("brand",$url_array,TRUE))
    $page="brand";
    else
    if(in_array("application",$url_array,TRUE))
        $page="application";
    else
    if(in_array("product",$url_array,TRUE))
        $page="product";

    //if(count($url_array)==1)//INDEXPAGE
    if($page=="index")
    {
        if($segment=="medicla")
        {
            $title="Medical Instruments | $country | ".implode(", ",$cities);
            $metadescription="Shop InstrumentsFinder for the best in test & measurement instruments in $country. InstrumentsFinder carries over 100 brands of industrial instruments and supports customers with free lifetime technical support from its staff of Applications Engineers.";
        }
        else
        {
            $title="Test & measurment Instruments | $country | ".implode(", ",$cities);
            $metadescription="Shop InstrumentsFinder for the best in test & measurement instruments in $country. InstrumentsFinder carries over 100 brands of industrial instruments and supports customers with free lifetime technical support from its staff of Applications Engineers.";
        }
    }
    elseif($page=="categories")
   //elseif(count($url_array)==2 && isset($url_array[1]) && $url_array[1]=="categories")//Catgeories Listing
    {
        $title="Product portfolio | InstrumentsFinder.com | $country | ".implode(", ",$cities);

         $metadescription="Shop InstrumentsFinder for the a wide range of categories in test & measurement instruments in $country ".implode(", ",$cities);
    }
    elseif($page=="brands")
    //elseif(count($url_array)==2 && isset($url_array[1]) && $url_array[1]=="brands")//Brands Listing
    {
        $title="Shop our brands | InstrumentsFinder.com | $country | ".implode(", ",$cities);

         $metadescription="Shop InstrumentsFinder for the a wide range of brands in test & measurement instruments in $country ".implode(", ",$cities);
    }
    elseif($page=="applications")
    //elseif(count($url_array)==2 && isset($url_array[1]) && $url_array[1]=="applications")//Applications Listing
    {
        $title="Shop for a range of Applications | InstrumentsFinder.com | $country | ".implode(", ",$cities);

         $metadescription="Shop InstrumentsFinder for the a wide range of applications in test & measurement instruments in $country ".implode(", ",$cities);
    }
    elseif($page=="category")
    //elseif(count($url_array)==3 && $url_array[1]=="category")//Category Product Listing
    {
        $cat_name="";
        if(isset($prod_listing_header))
        {
            $cat_name=$prod_listing_header;
        }
        $title="$cat_name supplier $country | ".implode(", ",$cities)." | InstrumentsFinder.com";

         $metadescription="We are the trusted suppliers for $cat_name across $country ".implode(", ",$cities);
    }
    elseif($page=="brand")
    //elseif(count($url_array)==3 && $url_array[1]=="brand")//Brand product Listing
    {
        $brand_name="";
        if(isset($prod_listing_header))
        {
            $brand_name=$prod_listing_header;
        }
        $title="$brand_name supplier $country | ".implode(", ",$cities)." | InstrumentsFinder.com";

         $metadescription="We are the trusted suppliers for $brand_name across $country ".implode(", ",$cities);
    }
    elseif($page=="application")
     //elseif(count($url_array)==3 && $url_array[1]=="application")//Application Listing
    {

        $title=$url_array[2]." supplier $country | ".implode(", ",$cities)." | InstrumentsFinder.com";

         $metadescription="We are the trusted suppliers for ".$url_array[2]." across $country ".implode(", ",$cities);
    }
    elseif($page=="product")
   //elseif(count($url_array)==4 && trim($url_array[1])=="product")// product details page
    {


        if(isset($brand))
            $brandstring=$brand;


        if(isset($category_array))
        {
            foreach($category_array as $category)
                $category_string .= $brand."-".$category["name"].",";
        }

        if(isset($productData) && isset($productData->name))
            $prodName=$productData->name;


            $title="$prodName Supplier ".$country." ".implode(", ",$cities)." | ". $category_string.
            " | InstrumentsFinder.com";

            //| $category_string  ".implode(", ",$cities)." | InstrumentFinder.com";




         $metadescription="We are the trusted suppliers for ".$prodName." across $country ".implode(", ",$cities);
    }


    ?>

    <title>{{$title}}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



    <!--Remove these tages when site goes live-->
   <!-- <meta name="robots" content="noindex">

    <meta name="googlebot" content="noindex">-->
    <!--Remove these tages when site goes live -->

    <?php
        //$domain=$_SERVER['SERVER_NAME'];


        $url_str=implode("/",$url_array);


        if (strpos($url_str, 'www') == false)
            $canonical_url = "https://".implode("/",$url_array);
        else
            $canonical_url = "https://www.".implode("/",$url_array);


        if(count($url_array)<=2)
            $canonical_url = "https://www.".$url_array[0]."/";
    ?>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="profile" href="http://gmpg.org/xfn/11">


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

    <link rel="canonical" href="{{$canonical_url}}"/>

<?php
  if($segment=="medical")
  {
    //   print($url_full);
    //   print($subdomain);
    $globalURLFull=str_replace("/".$subdomain, "/"."en", $url_full);
    echo('<link rel="alternate" href="https://'.$globalURLFull.'" hreflang="en">');

    foreach($subdomains_array as $subdomain_value)
    {
        //if($subdomain_value!==$subdomain){
        $newURLFull=str_replace("/".$subdomain, "/".$subdomain_value, $url_full);
        //print($newURLFull."<br>");
        echo('<link rel="alternate" href="https://'.$newURLFull.'" hreflang="en-'.$subdomain_value.'">');
       // }
    }
  }
?>

<link rel="apple-touch-icon" sizes="180x180" href="/favicon/{{$faviconPath}}apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon/{{$faviconPath}}favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon/{{$faviconPath}}favicon-16x16.png">
<link rel="manifest" href="/favicon/{{$faviconPath}}site.webmanifest">




    <!-- Bootstrap CSS -->



     <meta name="description" content="{{$metadescription}}" />

     <meta property="og:locale" content="en_US" />

     @if(count($url_array)==3 && $url_array[1]=="product")
    <meta property="og:type" content="article" />
    @endif
    <meta property="og:title" content="{{$title}}" />
    <meta property="og:description" content="{{$metadescription}} />
    <meta property="og:url" content="{{$canonical_url}}" />
    <meta property="og:site_name" content="InstrumentsFinder.com {{$country}} - Medical, Instrumentation & Test & measurement instruments" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{$metadescription}}" />
    <meta name="twitter:title" content="{{$title}}" />

    <?php
    $validity_date=date("Y-m-d", strtotime("+2 years", strtotime('2019-01-01')));

    $rating = 3.7;
    $reviewrating=3.9;

    $count = 35;
    if(isset($productData))
        if(isset($productData->toArray()[0]['prod_id']))
        {
            $rating = round(fmod($productData->toArray()[0]['prod_id'],4.9),2);
            $count = round(fmod($productData->toArray()[0]['prod_id'],100),2);
        }
        else
        if(isset($productData->toArray()['prod_id']))
        {
            $rating = round(fmod($productData->toArray()['prod_id'],4.9),2);
            $reviewrating = round(fmod($productData->toArray()['prod_id'],4.9),2);
            $count = round(fmod($productData->toArray()['prod_id'],100),2);

        }

        if($count < 5)
            $count = 23;

        if($rating<1)
            $rating+=3;
        else
        if($rating<2)
            $rating+=2;
        else
         if($rating<2.9)
            $rating+=1;



        if($reviewrating<=2.9)
            $reviewrating+=1;
        else
        if($reviewrating<=2)
            $reviewrating+=2;

    //$rating = $productData['prod_id'];

    function randomName() {
    $firstname = array(
        'Johnathon',
        'Anthony',
        'Erasmo',
        'Raleigh',
        'Nancie',
        'Tama',
        'Camellia',
        'Augustine',
        'Christeen',
        'Luz',
        'Diego',
        'Lyndia',
        'Thomas',
        'Georgianna',
        'Leigha',
        'Alejandro',
        'Marquis',
        'Joan',
        'Stephania',
        'Elroy',
        'Zonia',
        'Buffy',
        'Sharie',
        'Blythe',
        'Gaylene',
        'Elida',
        'Randy',
        'Margarete',
        'Margarett',
        'Dion',
        'Tomi',
        'Arden',
        'Clora',
        'Laine',
        'Becki',
        'Margherita',
        'Bong',
        'Jeanice',
        'Qiana',
        'Lawanda',
        'Rebecka',
        'Maribel',
        'Tami',
        'Yuri',
        'Michele',
        'Rubi',
        'Larisa',
        'Lloyd',
        'Tyisha',
        'Samatha',
    );

    $lastname = array(
        'Mischke',
        'Serna',
        'Pingree',
        'Mcnaught',
        'Pepper',
        'Schildgen',
        'Mongold',
        'Wrona',
        'Geddes',
        'Lanz',
        'Fetzer',
        'Schroeder',
        'Block',
        'Mayoral',
        'Fleishman',
        'Roberie',
        'Latson',
        'Lupo',
        'Motsinger',
        'Drews',
        'Coby',
        'Redner',
        'Culton',
        'Howe',
        'Stoval',
        'Michaud',
        'Mote',
        'Menjivar',
        'Wiers',
        'Paris',
        'Grisby',
        'Noren',
        'Damron',
        'Kazmierczak',
        'Haslett',
        'Guillemette',
        'Buresh',
        'Center',
        'Kucera',
        'Catt',
        'Badon',
        'Grumbles',
        'Antes',
        'Byron',
        'Volkman',
        'Klemp',
        'Pekar',
        'Pecora',
        'Schewe',
        'Ramage',
    );

    $name = $firstname[rand ( 0 , count($firstname) -1)];
    $name .= ' ';
    $name .= $lastname[rand ( 0 , count($lastname) -1)];

    return $name;
}


$reviewername=randomName();
    ?>



@if($isProductPage==true)
    <script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Product",
  "name": "{{$prodName}} {{$country}} {{implode(", ",$cities)}}",
  "image": "https://{{$url_array[0]."/assets/".$productData->img_new_path}}",
  "description": "Trusted Supplier {{$country}} - {{$productData->short_desc}}",
  "sku": "{{$productData->prod_id}}",
  "mpn": "{{$productData->prod_id}}",
  "brand": {
    "@type": "Thing",
    "name": "{{$brand}} {{$country}}"
  },
  "review": {
    "@type": "Review",
    "reviewRating": {
      "@type": "Rating",
      "ratingValue": "{{$reviewrating}}",
      "bestRating": "5"
    },
    "author": {
      "@type": "Person",
      "name": "{{$reviewername}}"
    }
  },

  "aggregateRating":{
  "@type": "aggregateRating",
    "ratingValue":"{{$rating}}",
     "ratingCount":"{{$count}}"

  },

  "offers": {
    "@type": "Offer",
    "url": "{{$canonical_url}}",
    "priceCurrency": "{{$currency}}",
    "price": "000",
    "priceValidUntil": "{{$validity_date}}",
    "itemCondition": "http://schema.org/NewCondition",
    "availability": "http://schema.org/InStock",
    "seller": {
      "@type": "Organization",
      "name": "InstrumentsFinder.com {{$country}}",
      "url":"{{$schema_org_url}}"

    }




  }
}
</script>
@endif

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?=$ga?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?=$ga?>');
</script>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5e1068e57e39ea1242a30129/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');

s0.parentNode.insertBefore(s1,s0);
})();
</script>


<!--End of Tawk.to Script-->


<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
function onSubmit(token) {


return new Promise(function (resolve, reject) {

        if (grecaptcha.getResponse() !== "") {
            $('#leadform').submit();

        }
        grecaptcha.reset();

    });
}



</script>


  </head>



  <body>
    <div class="container-fullwidth">
    @include('layout.v2.nav')
    <div class="container-fluid" style="margin-bottom:15px;">
    @yield("content")
    </div>


  @include('layout.v2.footer')
  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
<?php
    $random_int = mt_rand();
?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js?<?=$random_int?>"></script>


    <script type="text/javascript">
         var cart=[];

  var cartname_local="instrumentfinder_cart_90";


  $(document).ready(function() {

            var bloodhound = new Bloodhound({

                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,

                remote: {
                    url: '/autocomplete-ajax?query=%QUERY',
                    wildcard: '%QUERY'
                }

            });


            $(".searchbutton").on("click",function(obj,i){
                console.log($("#search_text").val());
            });


            var searchterm = $('.typeahead').val();

            var url_search = "{{ route('autocomplete.ajax') }}";


            console.log(url_search+"?query="+$('.typeahead').val());
            $('.typeahead').typeahead({


                hint: true,

                highlight: true,
                minLength: 2,

            }, {
                name: 'users',
                source: bloodhound,
                display: function(data) {
                    return data.name  //Input value to be set when you select a suggestion.
                },
                limit:15,

                templates: {
                    empty: [
                        '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                    ],
                    header: [

                    ],
                    suggestion: function(data) {
                    return '<a style="color:#333;text-decoration:none;"href="/<?=$subdomain?>/product/'+data.prod_id+'/'+data.slug+'"><div style="font-weight:normal; margin-top:-10px ! important;" class="searchresults list-group-item">' + data.name + '</div></a></div>'
                    }
                }
            });

            $(this).click(function () {
                $('.typeahead').typeahead('val', '');

                console.log("done ssds");
            });



            //config cart script for confiugrator page


    var config_cart=[];
    var old_options=[];
    function createCurrentProductConfigCart(changed_variant)
    {
        config_cart=[];
        var base_qty=1;
        var pid = $('.baseproductid').text();
        var pname=$('.baseproductname').text();
        var pcode=$('.baseproductcode').text();
        var img=$('.baseproductimg').text();

        //addProduct(pid,pname,pcode);
        var prod_data={};
        var option_data=[];
        var pdata=[pid,pname,pcode,base_qty,img];
        //config_cart["pid"]=pid;
        //config_cart["baseproduct"]=pdata;
        config_cart.push({"product":pdata});

        var options=[];

        $('.option').each(function(i, obj) {

          var optid=$(obj).attr("optionid");

          var optname=$(obj).find('.option_name').text();

          var options_values =$(obj).find('.radio_options');

          var j=0;
          options_values.each(function (i,obj){

              var radio_option =$(obj).find('.radiochoice');


              radio_option.each(function(i,obj){
                  if(obj.checked)
                  {
                    //alert($(obj).attr("label"));
                      var variantname=$(obj).attr("label");
                      var code=$(obj).attr("code");
                      var variant_id=$(obj).attr("variant_id");
                      //console.log("reachedd");
                      var optarray=[optname,optid,variantname,variant_id,code];

                      options.push({optarray});



                  }
              });

          });

      });

        config_cart.push({"options":options});


        htmlData="<div style='padding:10px;margin-top:5px;'>";
        //console.log(config_cart);
        var pname=config_cart[0].product[1];

        //htmlData+="<b style='font-size:16px;font-weight:700'>"+pname+"</b><br/><br/>";
        old_options=[];
        //console.log(config_cart);
        for(var j=0;j<config_cart[1]["options"].length;j++)
        {
            var option_name = config_cart[1]["options"][j]["optarray"][0];
            var variant_name = config_cart[1]["options"][j]["optarray"][2];
            var variant_id = config_cart[1]["options"][j]["optarray"][3];
            old_options.push(variant_id);

            htmlData+="<div style='font-size:13px;color:#0569AD;font-weight:800;'>"+option_name+"</div>";

            if(variant_id==changed_variant)
            {
                htmlData+="<div class='anim' style='margin-bottom:5px;width:90%;font-size:12px;'>"+variant_name+"</div>";
            }
            else
            {
                htmlData+="<div style='margin-bottom:5px;width:90%;font-size:12px;'>"+variant_name+"</div>";
            }


        }
       // console.log(old_options.length);
        htmlData+="</div>";
        return htmlData;
       // console.log(config_cart);

    }//end of function createCart




    var htmlData = createCurrentProductConfigCart();
    $(".configcartdiv").html(htmlData);



    var $radios = $('input[type="radio"]');


    $radios.on("change", function(obj,x){

        var sel_options=[];
        var $checked = $radios.filter(function() {

            //console.log($(this).prop('checked'));
            if($(this).prop('checked')==true)
            {
                //console.log($(this).attr("variant_id"));
                sel_options.push($(this).attr("variant_id"))
            }
        });

       // console.log($(x).attr("variant_id"));
        var changed_variant=0;
        //console.log($(obj).attr("variant_id"));
       // console.log(old_options.length+" : "+sel_options.length);
        if(sel_options.length == old_options.length)
        {
            for(var i=0;i<sel_options.length;i++)
            {
                if(sel_options[i]!=old_options[i])
                {
                    changed_variant = sel_options[i];
                    break;
                }
            }
        }


        //sconsole.log("changed varfoiant "+changed_variant);
         var htmlData = createCurrentProductConfigCart(changed_variant);
        $(".configcartdiv").html(htmlData);

        //console.log(sel_options);

        //$(".anim").slideUp(10).slideDown(200);
        //$(".anim").css("color", "green");
        //$(".anim").css("font-weight", "bold");
        $(".anim").css("color", "red");
           $(".anim").fadeOut(50);

          $(".anim").fadeIn(700);
          //$(".anim").css("color", "black");

        //.slideUp(20).slideDown(300);


    });//end of radio check



    //MAIN CART FUNCTIONS

        function loadcart()
        {
            //console.log("loade to cart");
            cart=getCartFromLocal();
            //console.log(cart);

          if(cart!=null && cart.length>0)
          {
            $("#itemCount").html(cart.length);
            $("#itemCount_mobile").html(cart.length);

            return false;
          }
          else
          {
            $("#itemCount").css("display","none");
            $("#itemCount_mobile").css("display","none");
            //$('cart_checkout_data').html("<b>No products in cart, redirecting..</a>");
            console.log(window.location.pathname);
            if(window.location.pathname=="<?=$link_prefix?>/checkout" || window.location.pathname=="<?=$link_prefix?>/checkout#")
                window.location.href="<?=$homeLink?>";

           }

        }


        function getCartFromLocal()
        {
            cartdata=JSON.parse(localStorage.getItem(cartname_local));
            return (cartdata);
        }

        //slocalStorage.clear();
        function saveCartToLocal(cartdata)
        {
            console.log("json data");
            //console.log(JSON.stringify(cartdata));

            localStorage.setItem(cartname_local,JSON.stringify(cartdata));

        }

        $('.cart_checkout_data').delegate(".closebutton","click",function(obj,i){

            console.log("close click");
             var pid_remove =  $(this).attr('pid');

             removeItemFromCart(pid_remove);
             loadcheckoutpage();


        });


        $('.cart_checkout_data').delegate(".editconf","click",function(obj,i){


             var pid_remove =  $(this).attr('pid');
                console.log("edits click"+pid_remove);
             removeItemFromCart(pid_remove);

             //configurator/786091554

             //$(location).attr('href', '/configurator/'+pid_remove);
             window.location.href = '<?=$link_prefix?>/configurator/'+pid_remove;


             //loadcheckoutpage();


        });



    $('.cart_checkout_data').delegate(".addqty","click",function(obj,i){
    console.log("add "+$(this).attr('pid'));
    var pid = $(this).attr('pid');

    changeQTY(pid,+1);


  });


   $('.cart_checkout_data').delegate(".subqty","click",function(obj,i){

    console.log("sub "+$(this).attr('pid'));
    var pid = $(this).attr('pid');
    changeQTY(pid,-1);

  });


        function changeQTY(prodid,qty_change)
        {

            var cart_new_data=[];

             for(var i=0;i<cart.length;i++)
             {
                var pidtocheck=cart[i]["item"][0].product[0];

                //console.log("checking to remove "+pidtocheck+" with "+pid_remove);
                //var pidtocheck=0;
                if(prodid == pidtocheck)
                {
                    console.log("chaning. "+prodid);
                    var item_change =cart[i].item;
                    var qty=cart[i]["item"][0].product[3];
                    if(qty+qty_change>0)
                        item_change[0].product[3]=qty+qty_change;

                    cart_new_data.push({"item":item_change});
                }
                else
                    cart_new_data.push({"item":cart[i].item});
             }

                    localStorage.clear();
                    saveCartToLocal(cart_new_data);
                    loadcheckoutpage();

                    loadcart();

        }//end of changeQTY

        function removeItemFromCart(pid_remove)
        {
            console.log("removing "+pid_remove);
            var cart_new_data=[];

             for(var i=0;i<cart.length;i++)
             {
                var pidtocheck=cart[i]["item"][0].product[0];
                console.log("checking to remove "+pidtocheck+" with "+pid_remove);
                //var pidtocheck=0;
                if(pid_remove != pidtocheck)
                {
                    cart_new_data.push({"item":cart[i].item});
                }
             }


                if(cart.length>1)
                {

                    //console.log("json data old");
                    //console.log(JSON.stringify(cart));
                    //console.log("json data new");
                    localStorage.clear();
                    saveCartToLocal(cart_new_data);

                   console.log("json data old");
                    console.log(cart);
                    console.log("json data new");
                    console.log(cart_new_data);


                    loadcheckoutpage();
                }
                else
                {
                    localStorage.clear();
                    $(".cart_checkout_data").html("");
                }

                loadcart();
        }
        //localStorage.clear();

        function addtocart()
        {
            cart = getCartFromLocal();
            var cart_to_add=[];
            if(cart==null)
            {

                cart_to_add.push({"item":config_cart});
            }
            else
            {
               cart_to_add=cart;
               var itemexists=false;
               var pid=config_cart[0].product[0];
               for(var i=0;i<cart.length;i++)
               {
                    var pidtocheck=cart[i]["item"][0].product[0];
                    if(pid == pidtocheck)
                        itemexists=true;
               }
               if(!itemexists)
                    cart_to_add.push({"item":config_cart});
            }
            localStorage.clear();

            saveCartToLocal(cart_to_add);

        }

        $(".btn_cartload").on("click",function(){

            addtocart();
            loadcart();
            window.location.href='<?=$link_prefix?>/checkout';

        });

        $(".cart").on("click",function(){
            if(cart.length>0)
            {
                window.location.href='<?=$link_prefix?>/checkout';
            }
        });

        $(".cart1").on("click",function(){
            if(cart.length>0)
            {
                window.location.href='<?=$link_prefix?>/checkout';
            }
        });

        loadcart();


    //MAIN CART FUNCTIONS


    //checkpout page function


//form_data+="<input type='hidden' name='product["+pid+"]' value='"+pid+"'/>";
//form_data+="<input type='hidden' name='qty["+pid+"]' value='"+qty+"'/>";


//form_data+="<input type='hidden' name='option_id["+pid+"]["+i+"]' value='"+opt_id+"'/>";

//form_data+="<input type='hidden' name='variant["+opt_id+"]' value='"+var_id+"'/>";



    function loadcheckoutpage()
    {
        console.log(cart);
        var cart_checkout_html="";
        cart_checkout_html+="<table class='checkout_table'>";
            cart_checkout_html+='<tr><th colspan=2>Product</th><th>Quantity</th><th>Remove</th></tr>';

        var form_data="";
        if(cart!=null)
        {
            for(var i=0;i<cart.length;i++)
            {
                var pid = cart[i]["item"][0]["product"][0];
                var pname = cart[i]["item"][0]["product"][1];
                var qty = cart[i]["item"][0]["product"][3];
                var img = cart[i]["item"][0]["product"][4];
                form_data+="<input type='hidden' name='product["+pid+"]' value='"+pid+"'/>";
                form_data+="<input type='hidden' name='qty["+pid+"]' value='"+qty+"'/>";
                var options = cart[i]["item"][1]["options"];


                cart_checkout_html+='<tr>';
                //Edied by Yusuf -  removal of configurator
                //if(options.length>0)
                //{
                //    cart_checkout_html+='<td><img src="'+img+'"></td><td>'+pname+'<br/><a href="#collapse'+pid+'" data-toggle="collapse">view configuration</a> &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href="#" class="editconf" pid="'+pid+'">edit configuration</a> </td>';
                //}
                //else
                //{
                    cart_checkout_html+='<td><img src="'+img+'"></td><td>'+pname+'</td>';
                //}



                //cart_checkout_html+='<td>Options dropdwn</td>';
                cart_checkout_html+='<td style="text-align:center"><i class="subqty fa fa-minus-square fa-1sx" pid="'+pid+'" style="color:#777;"> </i>&nbsp;&nbsp;&nbsp;<b>'+qty+'</b>&nbsp;&nbsp;&nbsp;<i class="fa fa-plus-square fa-1x addqty" pid="'+pid+'" style="color:#777;"></i></td>';
                cart_checkout_html+='<td style="text-align:center;margin:auto;vertical-align:middle;"><a pid="'+pid+'" href="#" class="closebutton" style="margin:auto"><i style="padding-left:5px;" class="fa fa-remove" style="color: red;"></i></a></td>';

                cart_checkout_html+='</tr>';

                cart_checkout_html+='<tr><td colspan="4" style="border:0px;"><div class="collapse" id="collapse'+pid+'">';
                cart_checkout_html+='<div class="card card-body" style="padding:8px;">';
                if(options.length>0)
                {
                    for(var j=0;j<options.length;j++)
                    {

                        var var_id=options[j]["optarray"][3];

                        var opt_id=options[j]["optarray"][1];

                        form_data+="<input type='hidden' name='option_id["+pid+"]["+j+"]' value='"+opt_id+"'/>";

                        form_data+="<input type='hidden' name='variant["+opt_id+"]' value='"+var_id+"'/>";

                        cart_checkout_html+="<div style='font-size:13px;color:#0569AD;font-weight:800;padding:3px;'>";
                        cart_checkout_html+="<h6>"+options[j]["optarray"][0]+"</h6>";
                        cart_checkout_html+="<p style='padding-left:10px;font-size:12px;color:#222;'>"+options[j]["optarray"][2]+"</p>";
                        cart_checkout_html+="</div>";
                    }
                }

                cart_checkout_html+='</div>';
                cart_checkout_html+='</div></td></tr>';
            }
            cart_checkout_html+='</table>';

             $('#cartdetails_form').html(form_data);

            $(".cart_checkout_data").html(cart_checkout_html);
         }

    }


    loadcheckoutpage();

});//end of body load








    </script>

  </body>
</html>
