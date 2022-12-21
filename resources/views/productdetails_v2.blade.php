@extends('layout.theme.mainlayout')

@section('content')



<div id="page-content" class="page-wrapper">
@if(isset($productData))

<div class="d-none" style="display:none;">
  <span class="baseproductname">{{$productData->name}}</span>
  <span class="baseproductid">{{$productData->prod_id}}</span>
  <span class="baseproductcode">{{$productData->codevalue}}</span>
</div> 
<div class="breadcrumbs-section plr-120 mb-20">
    <div class="breadcrumbs overlay-bg">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="breadcrumbs-inner">
                        <h1 class="breadcrumbs-title">{{$productData->name}}</h1>
                        <ul class="breadcrumb-list">
                            <li><a href="/">Home</a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="shop-section mb-80">
  <div class="container">
    <div class="row"><!--main row-->
      <div class="col-md-7"><!--col-7-->
        <div class="single-product-area mb-80"><!--single product area-->
          <div class="row"><!--row 2-->
            <!-- imgs-zoom-area start -->
              <div class="col-md-5 col-sm-5 col-xs-12">
                <div class="imgs-zoom-area">
                  <img id="zoom_03" src="{{$productData->img}}" data-zoom-image="{{$productData->img}}" alt="">
                </div>
              </div><!--end of col-sm-5-->
              <div class="col-md-7 col-sm-7 col-xs-12"> 
                <div class="single-product-info">
                  <h2 class="uppercase">{{$productData->name}} </h2>
                  <h3 class="brand-name-2">{{$productData->brand}}</h3>
                  <hr/>
                  <a class="addtoquote button extra-small mb-20" href="#"><span>Add product to quote </span> </a>
                  <hr/>
                  <h5 class="mt-30">{{$productData->short_desc}}</h5>
                </div>
              </div>  <!--end of col-sm-7-->
              

           </div><!--end of row 2-->
           <div class="row" style='padding:10px;margin:10px;background:#F8F8F8;'><!--row 3-->

              @if(isset($options) && is_array($options) && count($options)>0)
                 <h3>Choose your configurations options </h3> <hr/>
                  @foreach($options as $option) 
                    
                    <div class="option" optionid="{{$option['option_id']}}">
                    <h6 class="option_name widget-title border-left" style="margin-top:10px;">{{$option['options_desc']}}</h6>
                    
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

                      </td><td style="text-align: left;"><p style="text-align:left">{{$variant['variant_desc']}}</p></td></tr>
                      <?php $ctr++; ?>
                      
                      @endforeach
                      </tbody></table>
                      </div>

                    @endif
                  </div>
                  @endforeach
                  
              @endif
              <hr/>


           </div><!--end of row 3-->
           <a class="addtoquote button extra-small mb-20" href="#"><span>Add product to quote </span> </a>
         </div> <!--end ofsingle product area--> 
       </div>  <!--end col-7-->


        <div class="col-md-5">
          

          <aside class="widget widget-categories box-shadow mb-30" style="padding:10px;">
             <div class="cart_data">

            </div>  

            <p class="card-text small">Build your cart for the products you need and once you are done, request for a quote.</p>
            

              <a class="button large mb-20" href="#quoteform" data-toggle="collapse" data-target="#quoteform"><span>Get the price quote</span> </a>


            <!--LEAD FORM-->
            <div class="collapse" id="quoteform">
            
                    <form action="/submitlead" method="post">
                      @csrf

                      <div id="cartdetails_form" style="display:none"></div>
                    
                      <hr class="mb-6">
                    <div class="form-group small">
                    <label for="email small"><b>Email address(Required)</b></label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                    <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <div class="form-group small">
                    <label for="country">Country to ship the product to:</label>
                    
                    <select name="CountryProductShipsTo" class="form-control"><option value="">---</option><option value="Afghanistan">Afghanistan</option><option value="UAE">UAE</option><option value="Saudi">Saudi Arabia</option><option value="Kazakhastan">Kazakhastan</option></select>

                    </div>

                    <div class="form-group small">
                    <label for="inquiryDescription"><b>Enquiry description</b></label>
                    <textarea type="desc" class="form-control" id="inquiryDescription" name="inquiryDescription" ></textarea>
                    
                    </div>


                    <div class="form-check form-check-inline small">
                    <input type="checkbox" class="form-check-input" id="resllerbox" name="resellerpricing">
                    <label class="form-check-label" for="exampleCheck1">I need reseller pricing</label>
                    </div>

                    <div class="form-check form-check-inline small">
                    <input type="checkbox" class="form-check-input" id="bulkbox" name="bulkpricing">
                    <label class="form-check-label" for="exampleCheck1">I need bulk pricing</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Get a Price Quote</button>
                    </form>

                    

            
                  
              
            </div> 
          </div>
            <!--END OF LEADFORM-->

          </aside>

        </div><!--col-4 right side bar-->


    </div><!--end of main row-->  
  </div> <!--container-->
</div><!--shop section-->

<!--********-->    

           




@endif


<script type="text/javascript">

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

      location.reload();
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

      var cartdata='<div id="cardatadiv" class="list-group-item" style="background:#333;color:#fff;">Your chosen products</div><ul class="list-group">';
      //for ( var i = 0; i < cart.length; i++ ) {

      if(cart!=null)
      {  
      for ( var i = cart.length-1;i>=0; i-- ) {  
            showremove=true;
            if(i==cart.length-1)
              showremove=false;
            cartdata+=getProductHTML(cart[i].product,showremove);
      }
    }
       cartdata+="</ul>";

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

    htmlData+='<div class="col-4"><span class="flex-column"><i class="addqty fa fa-plus-circle fa-0.5x" pid="'+pid+'"></i>&nbsp;<b>'+qty+'&nbsp;</b><i class="fa fa-minus-circle fa-0.5x subqty" pid="'+pid+'"v></i></span></div>';

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


      htmlData+='<div class="row">';

       htmlData+='<div id="acc'+pid+'" class="collapse '+inclass+'">';

       //showing iptions in a list
        htmlData+='<ul class="list-group">';
        
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


               htmlData+='<li class="list-group-item small" style="background:#D8F7FF;padding:5px;"><!--<i class="fa fa-chevron-right fa-1x" style="margin-right:5px;"></i>--></small><b>'+optname+'</b><br/><p class="text-muted" style="margin-left:10px;">'+varname+'</p></li>';
          }

        htmlData+='</ul">'; 


       //showing iptions in a list

       htmlData+='</div>';


      htmlData+='</div>';
    }

    

    htmlData+='</div>';
    return htmlData;
  }

readCart();
  $('.addtoquote').click(function(obj,i){
  c();
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
</script>



@endsection

