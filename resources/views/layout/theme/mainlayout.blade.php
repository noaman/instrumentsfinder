<!doctype html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">

  <head>

     @php
    $url_array = resolve('url_array');

    //print_r($url_array);

    $subdomain = resolve('subdomain');
    @endphp




    <?php

    $category_string="";
        $brandstring="";
        $prodName="";
        $currency="AED";
    switch($subdomain)
        {
            case "ae":
                $country = "UAE";
                $cities = array("Dubai","Abu dhabi","Sharjah");
                $currency="AED";
            break;

            case "sa":
                $country = "Saudi arabia";
                $cities = array("Riyadh","Dammam","Jeddah");
                $currency="SAR";
            break;

            case "az"://Azerbaijan
                $country = "Azerbaijan";
                $cities = array("Baku");
                $currency="USD";
            break;

            case "kz"://Kazakhastan
                $country = "Kazakhastan";
                $cities = array("Astana");
                $currency="USD";
            break;

            case "ng"://Nigera
                $country = "Nigeria";
                $cities = array("Lagos");
                $currency="USD";
            break;

            default:
                $country = "Global";
                $cities = array("Dubai","Abu dhabi","Sharjah");
                $currency="USD";
            break;
        }


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


    if(count($url_array)==1)//INDEXPAGE
    {

        $title="Test &amp; measurment Instruments | $country | ".implode(", ",$cities);
        $metadescription="Shop InstrumentsFinder for the best in test & measurement instruments in $country. InstrumentsFinder carries over 100 brands of industrial instruments and supports customers with free lifetime technical support from its staff of Applications Engineers.";
    }
   elseif(count($url_array)==2 && isset($url_array[1]) && $url_array[1]=="categories")//Catgeories Listing
    {
        $title="Product portfolio | InstrumentsFinder.com | $country | ".implode(", ",$cities);

         $metadescription="Shop InstrumentsFinder for the a wide range of categories in test & measurement instruments in $country ".implode(", ",$cities);
    }
    elseif(count($url_array)==2 && isset($url_array[1]) && $url_array[1]=="brands")//Brands Listing
    {
        $title="Shop our brands | InstrumentsFinder.com | $country | ".implode(", ",$cities);

         $metadescription="Shop InstrumentsFinder for the a wide range of brands in test & measurement instruments in $country ".implode(", ",$cities);
    }
    elseif(count($url_array)==2 && isset($url_array[1]) && $url_array[1]=="applications")//Applications Listing
    {
        $title="Shop for a range of Applications | InstrumentsFinder.com | $country | ".implode(", ",$cities);

         $metadescription="Shop InstrumentsFinder for the a wide range of applications in test & measurement instruments in $country ".implode(", ",$cities);
    }
    elseif(count($url_array)==3 && $url_array[1]=="category")//Category Product Listing
    {
        $cat_name="";
        if(isset($prod_listing_header))
        {
            $cat_name=$prod_listing_header;
        }
        $title="$cat_name supplier $country | ".implode(", ",$cities)." | InstrumentsFinder.com";

         $metadescription="We are the trusted suppliers for $cat_name across $country ".implode(", ",$cities);
    }
    elseif(count($url_array)==3 && $url_array[1]=="brand")//Brand product Listing
    {
        $brand_name="";
        if(isset($prod_listing_header))
        {
            $brand_name=$prod_listing_header;
        }
        $title="$brand_name supplier $country | ".implode(", ",$cities)." | InstrumentsFinder.com";

         $metadescription="We are the trusted suppliers for $brand_name across $country ".implode(", ",$cities);
    }
    elseif(count($url_array)==4 && trim($url_array[1])=="product")// product details page
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

    <!--Remove these tages when site goes live-->
   <!-- <meta name="robots" content="noindex">

    <meta name="googlebot" content="noindex">-->
    <!--Remove these tages when site goes live -->

    <?php
        //$domain=$_SERVER['SERVER_NAME'];
        $url_str=implode($url_array,"/");


        if (strpos($url_str, 'www') == false)
            $canonical_url = "https://".implode($url_array,"/");
        else
            $canonical_url = "https://www.".implode($url_array,"/");


        if(count($url_array)<=2)
            $canonical_url = "https://www.".$url_array[0]."/";
    ?>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="profile" href="http://gmpg.org/xfn/11">


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

    <link rel="canonical" href="{{$canonical_url}}"/>


    <!-- Bootstrap CSS -->



     <meta name="description" content="{{$metadescription}}" />

     <meta property="og:locale" content="en_US" />

     @if(count($url_array)==3 && $url_array[1]=="product")
    <meta property="og:type" content="article" />
    @endif
    <meta property="og:title" content="{{$title}}" />
    <meta property="og:description" content="{{$metadescription}} />
    <meta property="og:url" content="{{$canonical_url}}" />
    <meta property="og:site_name" content="InstrumentsFinder {{$country}} - Medical, Instrumentation & Test & measurement instruments" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{$metadescription}}" />
    <meta name="twitter:title" content="{{$title}}" />

    <?php
    $validity_date=date("Y-m-d", strtotime("+1 years", strtotime('2019-01-01')));
    ?>

@if(count($url_array)==4 && trim($url_array[1])=="product")
    <script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Product",
  "name": "{{$prodName}} {{$country}} {{implode(", ",$cities)}}",
  "image": "https://{{$url_array[0]."/assets/".$productData->img}}",
  "description": "Authorised supplier {{$country}} - {{$productData->short_desc}}",
  "sku": "{{$productData->prod_id}}",
  "brand": {
    "@type": "Thing",
    "name": "{{$brand}} {{$country}}"
  },

  "offers": {
    "@type": "Offer",
    "priceCurrency": "{{$currency}}",
    "price": "000",
    "priceValidUntil": "{{$validity_date}}",
    "itemCondition": "http://schema.org/NewCondition",
    "availability": "http://schema.org/InStock",
    "seller": {
      "@type": "Organization",
      "name": "InstrumentsFinder.com {{$country}}"
    }
  }
}
</script>
@endif

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




  <link rel="stylesheet" href="/v2/bootstrap.min.css">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

<link rel="stylesheet" href="/v2/style.css">

 <script  src="https://code.jquery.com/jquery-latest.min.js"></script>


    <script  src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>


    <script  src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>


    <script type="text/javascript">
         var cart=[];

  var cartname_local="instrumentfinder_cart_88";


  $(document).ready(function() {


            $(".searchbutton").on("click",function(obj,i){
                console.log($("#search_text").val());
            });


            var searchterm = $('.typeahead').val();

            var url_search = "{{ route('autocomplete.ajax') }}";



            var bloodhound = new Bloodhound({

                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,

                remote: {
                    url: '/autocomplete-ajax?query=%QUERY',
                    wildcard: '%QUERY'
                }

            });




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
                    return '<a style="color:#fdd700;text-decoration:none;"href="/product/'+data.prod_id+'/'+data.slug+'"><div style="font-weight:normal; margin-top:-10px ! important;" class="searchresults list-group-item">' + data.name + '</div></a></div>'
                    }
                }
            });

            $(this).click(function () {
                $('.typeahead').typeahead('val', '');

               // console.log("done");
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
            window.location.href='/checkout';

        });

        $(".cart").on("click",function(){
            if(cart.length>0)
            {
                window.location.href='/checkout';
            }
        });

        $(".cart1").on("click",function(){
            if(cart.length>0)
            {
                window.location.href='/checkout';
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

                if(options.length>0)
                {
                    cart_checkout_html+='<td><img src="'+img+'"></td><td>'+pname+'<br/><a href="#collapse'+pid+'" data-toggle="collapse">view configuration</a></td>';
                }
                else
                {
                    cart_checkout_html+='<td><img src="'+img+'"></td><td>'+pname+'</td>';
                }


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
