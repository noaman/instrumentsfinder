
@php
$seo_data='<link rel="profile" href="http://gmpg.org/xfn/11">';
$seo_data.='<link rel="pingback" href="http://global.agisafety.com/xmlrpc.php">';

$seo_data.='<title>Aalborg 110V Battery Kit | Aalborg Supplier Saudi Arabia</title>';

$seo_data.='<meta name="description" content="Aalborg Supplier Saudi Arabia | Aalborg 110V Battery Kit | Aalborg"/>';
$seo_data.='<link rel="canonical" href="http://global.agisafety.com/supplier/aalborg-110v-battery-kit-supplier" />';
$seo_data.='<meta property="og:locale" content="en_US" />';
$seo_data.='<meta property="og:type" content="article" />';
$seo_data.='<meta property="og:title" content="Aalborg 110V Battery Kit | Aalborg Supplier Saudi Arabia" />';
$seo_data.='<meta property="og:description" content="Aalborg Supplier Saudi Arabia | Aalborg 110V Battery Kit | Aalborg" />';
$seo_data.='<meta property="og:url" content="http://global.agisafety.com/supplier/aalborg-110v-battery-kit-supplier" />';
$seo_data.='<meta property="og:site_name" content="AGISafety.com Saudi Arabia - Medical, Instrumentation &amp; Safety Supply Services" />';
$seo_data.='<meta property="og:image" content="http://global.agisafety.com/wp-content/uploads/2017/07/786520009.jpg" />';
$seo_data.='<meta property="og:image:width" content="250" />';
$seo_data.='<meta property="og:image:height" content="360" />';
$seo_data.='<meta name="twitter:card" content="summary" />';
$seo_data.='<meta name="twitter:description" content="Aalborg Supplier Saudi Arabia | Aalborg 110V Battery Kit | Aalborg" />';
$seo_data.='<meta name="twitter:title" content="Aalborg 110V Battery Kit | Aalborg Supplier Saudi Arabia" />';
$seo_data.='<meta name="twitter:image" content="http://global.agisafety.com/wp-content/uploads/2017/07/786520009.jpg" />';



$seo_data.='<link rel="dns-prefetch" href="//s.w.org" />';
$seo_data.='<link rel="alternate" type="application/rss+xml" title="AGISafety.com Saudi Arabia - Medical, Instrumentation &amp; Safety Supply Services &raquo; Feed" href="http://global.agisafety.com/feed" />';
$seo_data.='<link rel="alternate" type="application/rss+xml" title="AGISafety.com Saudi Arabia - Medical, Instrumentation &amp; Safety Supply Services &raquo; Comments Feed" href="http://global.agisafety.com/comments/feed" />';
$seo_data.='<link rel="alternate" type="application/rss+xml" title="AGISafety.com Saudi Arabia - Medical, Instrumentation &amp; Safety Supply Services &raquo; Aalborg 110V Battery Kit | Aalborg Comments Feed" href="http://global.agisafety.com/supplier/aalborg-110v-battery-kit-supplier/feed" />';

@endphp


@extends('layout.theme.mainlayout')

@section('content')



<div id="page-content" class="page-wrapper">
@if(isset($productData))

<div class="d-none" style="display:none;">
  <span class="baseproductname">{{$productData->name}}</span>
  <span class="baseproductid">{{$productData->prod_id}}</span>
  <span class="baseproductcode">{{$productData->codevalue}}</span>
</div> 

<div class="shop-section mb-80">
  <div class="container">

    <div class="row"><!--main row-->
      
      <div class="col-md-8">

         @if(isset($options) && is_array($options) && count($options)>0)
    <div class="row">
      <div class="single-product-info" style="margin-bottom:20px;border-bottom:dotted 0.5px #ccc;">
                  <h2 class="uppercase" style="font-weight:600">{{$productData->name}} </h2>
                  <h3 class="brand-name-2">{{$productData->brand}} <span class="small">[as reseller]</span></h3>
                  <h5 class="mt-30">{{$productData->short_desc}}</h5>
      </div>
    </div>
    @endif
    


        <div class="row">
      <div class="col-md-5"><!--col-7-->
        <div class="single-product-area mb-80"><!--single product area-->
          <div class="row"><!--row 2-->
            <!-- imgs-zoom-area start -->
                <div class="imgs-zoom-area">
                  <img id="zoom_03" src="{{$productData->img}}" data-zoom-image="{{$productData->img}}" style="max-width:200px;height:auto;" alt="">
                </div>
                <hr/>

           </div><!--end of row 2-->
           
          
         </div> <!--end ofsingle product area--> 
       </div>  <!--end col-7-->
       <div class="col-md-7">

        <!--row 3-->
           @if(isset($options) && is_array($options) && count($options)>0)
           <h3 style="font-weight:600;">Choose your configurations options </h3>
           <div class="row" style='padding:10px;margin:10px;background:#F8F8F8;overflow: scroll;max-height:600px;overflow-y: scroll !important;'>
           @else
           <div class="row" style='padding:10px;margin:10px;'>
          <div class="single-product-info">
                  <h2 class="uppercase">{{$productData->name}} </h2>
                  <h3 class="brand-name-2">{{$productData->brand}}</h3>
                  <hr/>
                  
                  <h5 class="mt-30">{{$productData->short_desc}}</h5>
                </div>
                @endif
        @if(isset($options) && is_array($options) && count($options)>0)
       
               
                 
                  @foreach($options as $option) 
                    
                    <div class="option" optionid="{{$option['option_id']}}" style="margin-left:10px;">
                    <h6 class="option_name widget-title border-left" style="margin-top:8px;">{{$option['options_desc']}}</h6>
                    
                    @if(isset($option["variants"]))
                    <?php $ctr=0; ?>
                    <div class="radio_options">
                      <table><tbody>
                      @foreach($option["variants"] as $variant)
                      
                      <tr><td style="width:25px;">
                          <?php
                            if($ctr==0)
                            $checked = "checked";
                            else
                            $checked = "";
                            ?> 
                        <input class="radiochoice" type="radio" name="{{$option['option_id']}}" {{$checked}} label="{{$variant['variant_desc']}}" code="{{$variant['code']}}" variant_id="{{$variant['variant_id']}}">

                      </td><td style="text-align: left;"><p style="text-align:left;margin;color:#333;">{{$variant['variant_desc']}}</p></td></tr>
                      <?php $ctr++; ?>
                      
                      @endforeach
                      </tbody></table>
                      </div>

                    @endif
                  </div>
                  @endforeach
                  
             
              <hr/>

              <!--<a class="addtoquote button extra-small mb-20" href="#"><span>Add product to quote </span> </a>-->
                  <hr/>

                  @endif
           </div><!--end of row 3-->

       </div> 
        </div><!--end of row-->
        </div> <!--end of col-9-->        

        <div class="col-md-4">
          
          <div class="alert alert-success" id="success-alert">
    <!--<button type="button" class="close" data-dismiss="alert">x</button>-->
    <strong>Product added to quote ! </strong>
    
</div>

          <aside class="widget widget-categories box-shadow sticky-top cartwidget" style="background:#fff;color:#ff0000;border:solid 1px;padding:0px;">

            


              <div class="cart_data" >

              </div>  

            


            <!--LEAD FORM-->
            <div class="collapse" id="quoteform" style="padding:20px;">
                    <div id="finalcart"></div>
                    <!--<b>Send us your request and we will get back in 2 hours</b>-->
                    <form action="/submitlead" method="post">
                      @csrf

                      <div id="cartdetails_form" style="display:none"></div>
                    <div class="form-group small">
                    <label for="email small"><b>Your Email(Required)</b></label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                    <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <div class="form-group small">
                    <label for="country">Country product ships to?</label>
                    
                    <select name="CountryProductShipsTo" class="form-control"><option value="">---</option><option value="Afghanistan">Afghanistan</option><option value="UAE">UAE</option><option value="Saudi">Saudi Arabia</option><option value="Kazakhastan">Kazakhastan</option></select>

                    </div>

                    <div class="form-group small">
                    <label for="inquiryDescription"><b>Enquiry description</b></label>
                    <textarea type="desc" class="form-control" id="inquiryDescription" name="inquiryDescription" placeholder="To get Quotations & Product details Kindly describe your requirement here" rows="4"></textarea>
                    
                    </div>


                    <div class="form-check form-check-inline small">
                    <input type="checkbox" class="form-check-input" id="resllerbox" name="resellerpricing">
                    <label class="form-check-label" for="exampleCheck1">Need Reseller Pricing</label>
                    </div>

                    <div class="form-check form-check-inline small">
                    <input type="checkbox" class="form-check-input" id="bulkbox" name="bulkpricing">
                    <label class="form-check-label" for="exampleCheck1">Need Bulk Pricing</label>
                    </div>

                   

                    <input type="submit" class="button" style="width:100%;padding:8px;background-color:#ff1744;color:#ffFFFF;font-weight:800;font-size:1.1em;" value="Check Price Now"/>

                    <br/><br/>OR <br/><br/><a href="/">Find more products</a>
                    </form>

                    

            
                  
              
            </div> 
          </div>
            <!--END OF LEADFORM-->

          </aside>

        </div><!--col-4 right side bar-->


    </div><!--end of main row-->  

    <!--tabs-->

    <div class="row">
                  <div class="col-md-8">
                    <!-- hr -->
                    <hr>
                    <div class="single-product-tab">
                      <ul class="reviews-tab mb-20">
                        @if($productData->features!="")
                        <li class="active"><a href="#features" data-toggle="tab">Features</a></li>
                        @endif
                        
                        

                        @if($productData->long_desc1ss!="")
      <li><a href="#description" data-toggle="tab">Description</a></li>
      @endif

      @if(isset($docs) && $docs!=null && is_array($docs))
      <li><a href="#documents" data-toggle="tab">Documents</a></li>
      @endif

      @if(isset($accessories) && $accessories!=null && is_array($accessories))
      <li><a href="#accessories" data-toggle="tab">Accessories</a></li>
      @endif


                      </ul>
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane list-group active" id="features" style="background:#f9f9f9;padding:40px;">
                         {!!$productData->features!!}s
                        </div>
                        
                        @if($productData->long_desc!="")
                        <div role="tabpanel" class="tab-pane " style="background:#f9f9f9;padding:40px;" id="description">
                            <div> {!!$productData->long_desc!!}</div>
                        </div>  
                        @endif

                        @if(isset($docs) && $docs!=null && is_array($docs))
                        <div role="tabpanel" class="tab-pane " style="background:#f9f9f9;padding:40px;" id="documents">
                            @foreach($docs as $doc)
            
            <h4>{{$doc['doc_group_title']}}</h4><br/>
              <ul class="list-group">
              @foreach($doc["files"] as $file)
                <?php
                  
                  $filenamearray= explode("/",$file["filepath"]);
                  
                  $filename = $filenamearray[count($filenamearray)-1];
                ?>
                <li class="list-group-item"><a href="#">{{$productData->name}} : {{$filename}}</a></li>
              @endforeach
              </ul>
            
          @endforeach

                        </div>  
                        @endif
                        

                         @if(isset($accessories) && $accessories!=null && is_array($accessories))
                        <div role="tabpanel" class="tab-pane " style="background:#f9f9f9;padding:40px;" id="accessories">
                             @foreach($accessories as $accessory)
            
            <h4>{{$accessory['type']}}</h4><br/>
              @foreach($accessory['accessories'] as $accessory_data)

                <p>{{print_r($accessory_data)}}</p><br/>
              @endforeach
          @endforeach  
                        </div>  
                        @endif


                      </div>
                    </div>
                    <!--  hr -->
                    <hr>
                  </div>
                </div>

    <!--tabs-->
  </div> <!--container-->
</div><!--shop section-->

<!--********-->    

           




@endif


<script type="text/javascript">

  var config_cart=[];
  var base_qty=1;

  var cart=[];
  var form_data="";

  $(document).ready(function() {

    var cartname_local="instrumentfinder_cart003";
    $("#success-alert").hide();

    //localStorage.clear();
    function saveCartToLocal(cartdata)
    {
      localStorage.setItem(cartname_local,JSON.stringify(cartdata));
    }

    function getCartFromLocal()
    {
        cartdata=JSON.parse(localStorage.getItem(cartname_local));
        return (cartdata);
    }



    function createCurrentProductConfigCart()
    {
        config_cart=[];
        var pid = $('.baseproductid').text();
        var pname=$('.baseproductname').text();
        var pcode=$('.baseproductcode').text();
        //addProduct(pid,pname,pcode);
        var prod_data={};
        var option_data=[];
        var pdata=[pid,pname,pcode,base_qty];
        prod_data["pid"]=pid;
        prod_data["baseproduct"]=pdata;
        config_cart.push({"product":prod_data});

        $('.option').each(function(i, obj) {
          
          var optid=$(obj).attr("optionid");
          var optname=$(obj).find('.option_name').text();
          var options_values =$(obj).find('.radio_options');
          options_values.each(function (i,obj){
              var radio_option =$(obj).find('.radiochoice');
              radio_option.each(function(i,obj){
                  if(obj.checked)
                  {
                      //alert($(obj).attr("label"));
                      var variantname=$(obj).attr("label");
                      var code=$(obj).attr("code");
                      var variant_id=$(obj).attr("variant_id");
                      addBaseConfigOption(pid,optid,variant_id,optname,variantname,code);
                  }    
              });
              
          });

      });

    
        console.log("in here");
      var cartdata='<div id="cardatadiv" class="list-group-item" ><ul class="list-group">';

      //cartdata+='<a class="addtoquote" style="width:100%;padding:8px;background-color:#ff1744;color:#ffFFFF;font-weight:800;font-size:1.1em;" id="#addtocart" href="#addtocart" data-target="#addtocart"><span >Check price now</span> </a>';


      cartdata+='<input type="submit" class="button addtoquote" style="width:100%;padding:8px;background-color:#ff1744;color:#ffFFFF;font-weight:800;font-size:1.1em;" value="Check Price Now">';
      cartdata+='<div class="panel-group" style="margin-top:10px;"><h3>Your selected configuration</h3></div>';
    
      //for ( var i = 0; i < cart.length; i++ ) {

      if(config_cart!=null)
      {  
      //for ( var i = cart.length-1;i>=0; i-- ) 
        var i = config_cart.length-1;
        {  
            showremove=true;
            if(i==config_cart.length-1)
              showremove=false;
            cartdata+=getProductHTML(config_cart[i].product,showremove);
        }
    }
       cartdata+="</ul></div>";

       //$('#cartdetails_form').html(form_data);
       //$('.cart_data').html("");
       $('.cart_data').html(cartdata);


    }//function createConfigCart


  function addBaseConfigOption(prod_id,optid,variant_id,optname,var_name,varcode)
  {
      for(var i=0;i<config_cart.length;i++)
      {
          var baseproduct=config_cart[i].product["baseproduct"];
          var pid = baseproduct[0];
          var options=[];

          if(pid==prod_id)
          {
            
              if(config_cart[i].product["options"]!=null && config_cart[i].product["options"].length>0)
              {
                
                  isoptionadded=false;
                  isItemreplaced=false;
                  itemIDReplace=0;
                  for(var j=0;j<config_cart[i].product["options"].length;j++)
                  {
                      optionarray=config_cart[i].product["options"][j].option;
                     // console.log(optionarray);

                      opt_id = optionarray[1];
                      varid = optionarray[2];
                      //console.log(opt_id+" - "+optid);
                      //console.log(varid+" - "+variant_id);
                      if(opt_id == optid)//same option id exists
                      {
                          isoptionadded=true; 
                          if(varid == variant_id)//same variant also exsits so do nothing
                          {
                        //    console.log("found same options and variant");
                            
                          }
                          else//replace the option
                          {
                                isItemreplaced=true;
                                itemIDReplace=j;
                          }

                      }

                  }

                  if(isItemreplaced)
                  {
                    options_new=[];
                    for(var j=0;j<config_cart[i].product["options"].length;j++)
                    {
                        if(j==itemIDReplace)
                        {
                          var option_data=[prod_id,optid,variant_id,optname,var_name,varcode];
                            optionarray=config_cart[i].product["options"][j].option=option_data;
                        }
                        
                    }
                  } 


                  if(!isoptionadded)
                  {
                      
                    var option_data=[prod_id,optid,variant_id,optname,var_name,varcode];

                     options = config_cart[i].product["options"];
                     options.push({'option':option_data});

                  }
              } 
              else
              {
                  var option_data=[prod_id,optid,variant_id,optname,var_name,varcode];
                    options.push({'option':option_data});
                   config_cart[i].product["options"]=options;
              } 

              break; 
          }
      }//end of for
      


  }//end of function


  function getProductHTML(product,showremove=true)
  {
    var htmlData="";
    

    var baseproduct=product["baseproduct"];

      var pid = baseproduct[0];
      var pname = baseproduct[1];
      var pcode = baseproduct[2];
      var qty = baseproduct[3];

    htmlData+='<div class="row" style="margin:20px;">';
    htmlData+='<div class="row">';
    htmlData+='<div class="col-12" style="color:black;"><b>'+pname+'</b></div>';

    htmlData+='</div>';

    htmlData+='<div class="row" style="padding-bottom:10px;">';


   htmlData+='<div class="col-12" style="border-bottom:1px dotted;"><div style="font-size:1.1em;">Qty : <i class="subqty fa fa-minus-circle fa-1sx" pid="'+pid+'"></i>  '+qty+'  <i class="fa fa-plus-circle fa-1x addqty" pid="'+pid+'"v></i></div></div>';

    //htmlData+='<div class="col-12" style="border-bottom:1px dotted;font-size:1.2em;"><small>QTY : </small><i class="subqty fa fa-minus-circle fa-1x" pid="'+pid+'"></i> '+qty+' <i class="subqty fa fa-plus-circle fa-1x" pid="'+pid+'"></i></div>';

    //console.log(product);
     form_data+="<input type='hidden' name='product["+pid+"]' value='"+pid+"'/>";

      form_data+="<input type='hidden' name='qty["+pid+"]' value='"+qty+"'/>";



    htmlData+='</div>';

    if(product["options"]!=null && product["options"].length>0)
    {

      var inclass="";

        if(!showremove)
          inclass="show";


      htmlData+='<div class="rows">';

       htmlData+='<div id="acc'+pid+'" class="collapse '+inclass+'">';

       //showing iptions in a list
        htmlData+='<ul class="list-group" style="background:#eee;">';
        
          //console.log("got options "+(product["options"].length));
          for (var i=0;i<product["options"].length;i++)
          { 
              optionarray=product["options"][i].option;
              opt_id = optionarray[1];
              var_id = optionarray[2];
              optname = optionarray[3];
              varname = optionarray[4];

              form_data+="<input type='hidden' name='option_id["+pid+"]["+i+"]' value='"+opt_id+"'/>";

              form_data+="<input type='hidden' name='variant["+opt_id+"]' value='"+var_id+"'/>";

               htmlData+='<li class="list-group-item small" style="background:#FFFFFF;padding:2px;border:0px;"><!--<i class="fa fa-chevron-right fa-1x" style="margin-right:1px;"></i>--></small><b>'+optname+'</b><br/><div style="margin-left:5px;color:#999;font-size:1.1em;font-weight:600;">'+varname+'</div></li>';
          }

        htmlData+='</ul">'; 

       
       //showing iptions in a list

       htmlData+='</div>';


      htmlData+='</div>';
    }
    // htmlData+='<a class="button addtoquote" style="width:100%;" id="#addtocart" href="#addtocart" data-target="#addtocart"><span style="text-align:center;">Check price now</span> </a>'
    

    htmlData+='</div>';
    return htmlData;
  }

  createCurrentProductConfigCart();



  $("input[type='radio']").on("change", function(){   

        createCurrentProductConfigCart();
    });


  //$('.cart_data').find(".addqty").on("click",(function(){
  $('.cart_data').delegate(".addqty","click",function(obj,i){

     base_qty++;
    
    createCurrentProductConfigCart();

    return false;

  });


  $('.cart_data').delegate(".subqty","click",function(obj,i){

    if(base_qty>1)
      base_qty--;
    createCurrentProductConfigCart();
    return false;

  });


  //$(".addtoquote").on("click",function(obj,i){
   $('.cart_data').delegate(".addtoquote","click",function(obj,i){ 
      console.log("addtocart clicked");
      
       $("#success-alert").fadeTo(500, 500).slideUp(200, function(){
               $("#success-alert").slideUp(200);
        });   


      addtoMainCart();

      loadFinalCart();
      $('#cartdetails_form').html(form_data);

      $('#quoteform').show();
      $('.cart_data').css("display","none");

      return false;
  });

   $('.cartwidget').delegate(".back","click",function(obj,i){ 
    console.log("back clicked");
    var pid = $('.baseproductid').text();
      removeProductFromCart(pid);
      
      $('#quoteform').hide();
      $('.cart_data').css("display","block");
   });

   $('.cartwidget').delegate(".closebutton","click",function(obj,i){ 

      var pid_del = $(this).attr('pid');
      removeProductFromCart(pid_del);
      console.log(cart.length);

      if(cart.length==0)
      {
         $('#quoteform').hide();
        $('.cart_data').css("display","block");
      }

   });
   

  function loadFinalCart()
  {
    var html_final_cart='<a href="#back" class="back pull-right">back</a><br/><div class = "panel-group"><h3>Your chosen products</h3><div class = "panel panel-default">';
    cart = getCartFromLocal();

    console.log("cartt length "+cart.length);
    if(cart!=null)
    {
      for(var i=cart.length-1;i>=0;i--)
      {
          var pid=cart[i].product["baseproduct"][0];
          if(cart[i].product["options"]!=null)
          {
           html_final_cart+='<div class ="panel-heading" style="margin:3px;"><div class="d-flex justify-content-between"><div style="color:red;font-weight:800;">'+cart[i].product["baseproduct"][1]+'</div>'+'<a pid="'+pid+'" href="#" class="closebutton"><i class="fa fa-remove pull-right" style="color: black;"></i></a>'+'</div>QTY:'+cart[i].product["baseproduct"][3]+'<div style="color:blue;"><a style="color:blue;" data-toggle = "collapse" href = "#'+cart[i].product["baseproduct"][0]+'">  Options   ['+(cart[i].product["options"].length)+']   <i class="fa fa-chevron-down fa-0.5x" style="color:#333;"></i></a></div></div>';
        }
        else
        {
             html_final_cart+='<div class ="panel-heading" style="margin:3px;"><div class="d-flex justify-content-between"><a data-toggle = "collapse" href = "#'+cart[i].product["baseproduct"][0]+'">'+cart[i].product["baseproduct"][1]+'</a>'+'<a pid="'+pid+'" href="#" class="closebutton"><i class="fa fa-remove pull-right" style="color: black;"></i></a>'+'</div>QTY:'+cart[i].product["baseproduct"][3]+'</div>';
        }
          console.log("adding li");

        
  

          if(cart[i].product["options"]!=null)
          {
            html_final_cart+='<div id = "'+cart[i].product["baseproduct"][0]+'" class="panel-collapse collapse">';
            html_final_cart+='<ul class = "list-group">';
            for(var j=0;j<cart[i].product["options"].length;j++)
            {
              html_final_cart+='<li class = "list-group-item"><div style="margin-left:20px;color:#666;">'+cart[i].product["options"][j]['option'][3]+'</div><span style="margin-left:30px;color:#aaa;">'+cart[i].product["options"][j]['option'][4 ]+'</span></li>';
            }  
            html_final_cart+='</ul>';
            html_final_cart+='</div>';
          }

      }

          
    }
    html_final_cart+='</div></div>';
    $("#finalcart").html(html_final_cart);



  }

  function addtoMainCart()
  {
    //localStorage.clear();
       var pid = $('.baseproductid').text();
      cart=getCartFromLocal();

      console.log(cart);
        if(cart==null)
        {
          console.log("cart is null");
          saveCartToLocal(config_cart);

        }
        else
        {
          var baseproductexists=false;
          for(var i=0;i<cart.length;i++)
          {

            var baseproduct=cart[i].product["baseproduct"];
            var prodid = baseproduct[0];
            if(pid==prodid)
            {
              baseproductexists=true;
              break;
            }
          }
          if(!baseproductexists)
          {
            //console.log("adding to storage");
             //console.log(cart);
           // console.log(config_cart);
            //cart.push({config_cart[0].product});
            cart.push(config_cart[0]);
              //console.log(cart);
            localStorage.clear();
            saveCartToLocal(cart);
          } 
        }    

        loadcart();
  }

function loadcart()
{
  cart=getCartFromLocal();

  if(cart!=null)
  {
    $(".cart-quantity").html(cart.length);
    //$(".cart-quantity").load("");
    return false;
  }
}
  
  
  


  function removeProductFromCart(pid_del)
  {
      cart=getCartFromLocal();

      cart_new=[];

      for(var i=0;i<cart.length;i++)
      {
          var baseproduct=cart[i].product["baseproduct"];
          var pid = baseproduct[0];
          var options=[];
          if(pid != pid_del)
          cart_new.push({"product":cart[i].product});
      }
      localStorage.clear();
      saveCartToLocal(cart_new);
      loadFinalCart();
      loadcart();

      //$("#cardatadiv").load(location.href+" #cardatadiv>*","");

  }//end of function removeProductFromCart



  loadcart();

  });//end of document ready

/*
$(document).ready(function() {

  var cartname_local="instrumentfinder_cart323";

  //localStorage.clear();
  function saveCartToLocal(cartdata)
  {
    localStorage.setItem(cartname_local,JSON.stringify(cartdata));
  }

  function getCartFromLocal()
  {
      cartdata=JSON.parse(localStorage.getItem(cartname_local));
      return (cartdata);
  }

  var cart=[];

  if(getCartFromLocal() != null)
    cart = getCartFromLocal();

  $("input[type='radio']").on("change", function(){   

        createBaseCartOnPage();
    });


  
  function addProduct(pid,pname,pcode)
  { 
      var prod_data={};
      var option_data=[];

      var pdata=[pid,pname,pcode,1];

      
      prod_data["pid"]=pid;
      prod_data["baseproduct"]=pdata;

      
      baseproductexists=false;
      if(cart!=null)
      {
      for(var i=0;i<cart.length;i++)
      {
          var baseproduct=cart[i].product["baseproduct"];
          var prodid = baseproduct[0];
          if(pid==prodid)
          {
            baseproductexists=true;
            break;
          }
      }
    }
    else
      cart=[];
      
      if(!baseproductexists)
      {    
        cart.push({"product":prod_data});
       
        saveCartToLocal(cart);
      }  
  }

  
  function createBaseCartOnPage()
  {
      var pid = $('.baseproductid').text();
      var pname=$('.baseproductname').text();
      var pcode=$('.baseproductcode').text();

      addProduct(pid,pname,pcode);
      $('.option').each(function(i, obj) {
          
          var optid=$(obj).attr("optionid");
         // console.log("optionid"+optid);
          var optname=$(obj).find('.option_name').text();
          
         // alert("add "+optname);

          var options_values =$(obj).find('.radio_options');
          options_values.each(function (i,obj){

              var radio_option =$(obj).find('.radiochoice');
              radio_option.each(function(i,obj){
                  if(obj.checked)
                  {
                      //alert($(obj).attr("label"));
                      var variantname=$(obj).attr("label");
                      var code=$(obj).attr("code");
                      var variant_id=$(obj).attr("variant_id");
                      addOption(pid,optid,variant_id,optname,variantname,code);
                  }    
              });
              
          });

      });

      readCart();

      //location.reload();
  }



  function addOption(prod_id,optid,variant_id,optname,var_name,varcode)
  {
      for(var i=0;i<cart.length;i++)
      {
          var baseproduct=cart[i].product["baseproduct"];
          var pid = baseproduct[0];
          var options=[];

          if(pid==prod_id)
          {
            
              if(cart[i].product["options"]!=null && cart[i].product["options"].length>0)
              {
                
                  isoptionadded=false;
                  isItemreplaced=false;
                  itemIDReplace=0;
                  for(var j=0;j<cart[i].product["options"].length;j++)
                  {
                      optionarray=cart[i].product["options"][j].option;
                     // console.log(optionarray);

                      opt_id = optionarray[1];
                      varid = optionarray[2];
                      //console.log(opt_id+" - "+optid);
                      //console.log(varid+" - "+variant_id);
                      if(opt_id == optid)//same option id exists
                      {
                          isoptionadded=true; 
                          if(varid == variant_id)//same variant also exsits so do nothing
                          {
                        //    console.log("found same options and variant");
                            
                          }
                          else//replace the option
                          {
                                isItemreplaced=true;
                                itemIDReplace=j;
                          }

                      }

                  }

                  if(isItemreplaced)
                  {
                    options_new=[];
                    for(var j=0;j<cart[i].product["options"].length;j++)
                    {
                        if(j==itemIDReplace)
                        {
                          var option_data=[prod_id,optid,variant_id,optname,var_name,varcode];
                            optionarray=cart[i].product["options"][j].option=option_data;
                        }
                        
                    }
                  } 


                  if(!isoptionadded)
                  {
                      
                    var option_data=[prod_id,optid,variant_id,optname,var_name,varcode];

                     options = cart[i].product["options"];
                     options.push({'option':option_data});

                  }
              } 
              else
              {
                  var option_data=[prod_id,optid,variant_id,optname,var_name,varcode];
                    options.push({'option':option_data});
                   cart[i].product["options"]=options;
              } 

              break; 
          }
      }

      saveCartToLocal(cart);
  }

  var form_data='';
  function readCart()
  {
      //console.log(cart.length);
      cart=getCartFromLocal();

      var cartdata='<div id="cardatadiv" class="list-group-item" style="background:#fff;color:#ff0000;border:solid 1px;"><h3 style="color:#ff0000;">Your selected configuration</h3><ul class="list-group">';
      //for ( var i = 0; i < cart.length; i++ ) {

      if(cart!=null)
      {  
      //for ( var i = cart.length-1;i>=0; i-- ) 
      var i = cart.length-1;
      {  
            showremove=true;
            if(i==cart.length-1)
              showremove=false;
            cartdata+=getProductHTML(cart[i].product,showremove);
      }
    }
       cartdata+="</ul></div>";

       $('#cartdetails_form').html(form_data);
       $('.cart_data').html(cartdata);
  }


  function getProductHTML(product,showremove=true)
  {
    var htmlData="";

    var baseproduct=product["baseproduct"];

      var pid = baseproduct[0];
      var pname = baseproduct[1];
      var pcode = baseproduct[2];
      var qty = baseproduct[3];

    htmlData+='<div class="row" style="margin:20px;border-bottom:1px dotted;">';
    htmlData+='<div class="row">';
    htmlData+='<div class="col-9"><p class="product-title">'+pname+'</p></div>';


      form_data+="<input type='hidden' name='product["+pid+"]' value='"+pid+"'/>";

      form_data+="<input type='hidden' name='qty["+pid+"]' value='"+qty+"'/>";

    

    //if(showremove)
    {
      htmlData+='<div class="col-1 closebutton" pid="'+pid+'"><i style="color:#ff0000;" class="zmdi zmdi-close"></i></div>';
    }

    htmlData+='</div>';

    htmlData+='<div class="row" style="padding-bottom:10px;">';

    htmlData+='<div class="col-12" style="border-bottom:1px dotted;"><span class="flex-row">Qty : <i class="addqty fa fa-plus-circle fa-1sx" pid="'+pid+'"></i>&nbsp;<b>'+qty+'&nbsp;</b><i class="fa fa-minus-circle fa-1x subqty" pid="'+pid+'"v></i></span></div>';

    //console.log(product);
    if(product["options"]!=null && product["options"].length>0)
    {
     // console.log("got options");
        htmlData+='<div class="col-4">';

        if(showremove)
        {
        htmlData+='<span class="pull-right"><a data-toggle="collapse" data-target="#acc'+pid+'">   Options   ['+(product["options"].length)+']   <i class="fa fa-chevron-down fa-0.5x" style="color:#333;"></i></a></span>';
        }
        htmlData+='</div>';
    }

    htmlData+='</div>';

    if(product["options"]!=null && product["options"].length>0)
    {

      var inclass="";

        if(!showremove)
          inclass="show";


      htmlData+='<div class="rows">';

       htmlData+='<div id="acc'+pid+'" class="collapse '+inclass+'">';

       //showing iptions in a list
        htmlData+='<ul class="list-group" style="background:#eee;">';
        
          //console.log("got options "+(product["options"].length));
          for (var i=0;i<product["options"].length;i++)
          { 
              optionarray=product["options"][i].option;
              opt_id = optionarray[1];
              var_id = optionarray[2];
              optname = optionarray[3];
              varname = optionarray[4];


              form_data+="<input type='hidden' name='option_id["+pid+"]["+i+"]' value='"+opt_id+"'/>";

              form_data+="<input type='hidden' name='variant["+opt_id+"]' value='"+var_id+"'/>";


               htmlData+='<li class="list-group-item small" style="background:#FFFFFF;padding:2px;border:0px;"><!--<i class="fa fa-chevron-right fa-1x" style="margin-right:1px;"></i>--></small><b>'+optname+'</b><br/><div class="text-muted" style="margin-left:5px;">'+varname+'</div></li>';
          }

        htmlData+='</ul">'; 


       //showing iptions in a list

       htmlData+='</div>';


      htmlData+='</div>';
    }

    

    htmlData+='</div>';
    return htmlData;
  }

createBaseCartOnPage();
readCart();
  $('.addtoquote').click(function(obj,i){
  createBaseCartOnPage();
  });
  //console.log(cart);
  

  $('.closebutton').click(function(obj,i){

    console.log("clicked"+$(this).attr('pid'));
    var pid_del = $(this).attr('pid');
    removeProductFromCart(pid_del);

  });


  $('.addqty').click(function(obj,i){

    console.log("add "+$(this).attr('pid'));
    var pid = $(this).attr('pid');

    increaseProdQty(pid);
    

  });


  $('.subqty').click(function(obj,i){

    console.log("sub "+$(this).attr('pid'));
    var pid = $(this).attr('pid');
    decreaseProdQty(pid);

  });


  function increaseProdQty(pid_add)
  {
    cart=getCartFromLocal();

      cart_new=[];

      for(var i=0;i<cart.length;i++)
      {
          
          
        var baseproduct=cart[i].product["baseproduct"];
          var pid = baseproduct[0];
          if(pid == pid_add)
          {
            cart[i].product["baseproduct"][3]++;
            break;
          }

          
      }
      localStorage.clear();
            saveCartToLocal(cart);
            readCart();
            location.reload();
            
      
  }


  function decreaseProdQty(pid_sub)
  {
    cart=getCartFromLocal();

      cart_new=[];

      for(var i=0;i<cart.length;i++)
      {
          
          
        var baseproduct=cart[i].product["baseproduct"];
          var pid = baseproduct[0];
          if(pid == pid_sub)
          {
            if(cart[i].product["baseproduct"][3]>1)
              cart[i].product["baseproduct"][3]--;
            break;
          }

          
      }
      localStorage.clear();
            saveCartToLocal(cart);
            readCart();
            location.reload();
            
      
  }


  function removeProductFromCart(pid_del)
  {
      cart=getCartFromLocal();

      cart_new=[];

      for(var i=0;i<cart.length;i++)
      {
          var baseproduct=cart[i].product["baseproduct"];
          var pid = baseproduct[0];
          var options=[];
          if(pid != pid_del)
          cart_new.push({"product":cart[i].product});
      }
      localStorage.clear();
      saveCartToLocal(cart_new);
      readCart();
      location.reload();

      //$("#cardatadiv").load(location.href+" #cardatadiv>*","");

  }//end of function removeProductFromCart


  

  $('.leadformbutton').click(function(){
      //$('.leadform').show();
  });

});

*/

</script>



@endsection

