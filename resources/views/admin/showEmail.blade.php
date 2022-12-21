@extends('layout.adminlayout')

@inject('data','App\DataManager')

@if(isset($lead_data))

@php
$time_disp=new DateTime($lead_data["lead"]["created_at"]);
$lat= $lead_data["lead"]["lat"];
$lon= $lead_data["lead"]["lon"];

$currency_chosen ="AED";
$exworks="Dubai";
$partnumber="";
$deliveryleadtime="7 to 10 days";
$price_multiplier = 1.2;
$total_price=0;
$placeholder_price=0;
$placeholder_total_price=0;
$product_price=0;
$descr =0;
$askmoreinfo =0;
$lateresponse =0;


$hiddenvar="";

$price_var=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);

for($i=0;$i<count($price_var);$i++)
{
    $var = "price".$i;

    if(isset(app('request')->$var))
        $price_var[$i]= app('request')->$var;
}

$prodindex=0;
if(isset(app('request')->currency))
    $currency_chosen=app('request')->currency;

if(isset(app('request')->price_multiplier))
    $price_multiplier=app('request')->price_multiplier;


if(isset(app('request')->hiddenvar))
    $hiddenvar=app('request')->hiddenvar;



if(isset(app('request')->exworks))
    $exworks=app('request')->exworks;

if(isset(app('request')->deliveryleadtime))
    $deliveryleadtime=app('request')->deliveryleadtime;


if(isset(app('request')->descr))
    $descr=app('request')->descr;


if(isset(app('request')->askmoreinfo))
$askmoreinfo=app('request')->askmoreinfo;

if(isset(app('request')->lateresponse))
$lateresponse=app('request')->lateresponse;




$currencies_data = array(
    "AED"=>3.75,
    "SAR"=>3.75,
    "USD"=>1,
    "INR"=>72,
    "PKR"=>155,
);


$exworks_array=array(
"Dubai",
"Saudi",
"Bahrain",
"Oman",
"Pakistan",
"india",
"Afghanistan",
"Qatar",
"Nigeria",
"Azerbaijan"
);


$leadtime_array=array(
"7 to 10 working days",
"Exstock",
"15 working days"

);
@endphp


@section('content')

<div class="container-fluid">


    <div class="card">
        <div class="card-header bg-dark text-light">
            <div class="row">
                <div class="col-xs-4 col-md-4">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                ID : {{$lead_data["lead"]["order_id"]}}
                </div>
                <div class="col-xs-4 col-md-4">
                lead date : {{$time_disp->format('d-M-Y [H:i:s]')}}
                </div>
                <div class="col-xs-4 col-md-4">
                lead created from : {{$lead_data["lead"]["country_emoji"]}} | {{$lead_data["lead"]["city"]}},{{$lead_data["lead"]["country"]}}s
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-md-4">
                    Shipping to : {{$lead_data["lead"]["country_shipping"]}}
                </div>
                <div class="col-xs-4 col-md-4">
                    Reseller: {{$lead_data["lead"]["reseller_price"]}}
                    Bulk: {{$lead_data["lead"]["bulk_price"]}}
                </div>
                <div class="col-xs-4 col-md-4">
                    <a href="" class="btn btn-outline-info btn-sm pull-right">Email : {{$lead_data["lead"]["email"]}}</a>
                </div>
            </div>

            <div class="row">
                <div class="col" style="padding:2px;background-color: #cecece;color:blue;">
                    {{$lead_data["lead"]["enquiry_desc"]}}

                </div>
             </div>
        </div>

  </div>

<div class="form-group" style="padding:20px;background-color: #ccc;">

<form>
    <input type="hidden" name="hiddenvar" value="1">
<div class="form-row">

    <div class="row">
        <div class="col" >
            <?php
            $checked_ask="checked";
                if($askmoreinfo=="0")
                    $checked_ask="";
            ?>
            <h3 style="background-color:Tomato;">Request Company Info ? <input type="checkbox" class="largecheckbox" name="askmoreinfo" {{$checked_ask}}><br></h3>


        </div>
     </div>
     <hr>
     <div class="row">
        <div class="col" >
            <?php
            $checked_lateresponse="checked";
                if($lateresponse=="0")
                    $checked_lateresponse="";
            ?>
            <h3 style="background-color:Yellow;">Send Late Response ? <input type="checkbox" class="largecheckbox" name="lateresponse" {{$checked_lateresponse}}><br></h3>


        </div>
     </div>

     <div class="row">
    <div class="col-3">
    <label for="currency">Currency </label>
    <select class="form-control" id="currency" name="currency" onchange="this.form.submit();">
        <?php
            foreach($currencies_data as $currencyid=>$multiplier)
            {
                $sell="";
                if($currency_chosen == $currencyid)
                    $sel="selected";
                else
                    $sel="";
            ?>
                <option value = "{{$currencyid}}" {{$sel}}>{{$currencyid}} (conv. rate:{{$multiplier}} )</option>
            <?php

            }
        ?>

        </select>
    </div>
    <div class="col-3">

        <label for="price_multiplier">Markup <small>(Multiplier)</small></label>
        <input type="Number" class="form-control"  name="price_multiplier" value="{{$price_multiplier}}" step="0.1" onchange="this.form.submit();">

    </div>

    <div class="col-3">

        <label for="exworks">ExWorks</label>
        <select class="form-control" name="exworks" onchange="this.form.submit();">
            <?php

                foreach ($exworks_array as $exworks_value) {
                    $sel="";
                    if($exworks == $exworks_value)
                        $sel="selected";
                    ?>
                    <option value="{{$exworks_value}}" {{$sel}}>{{$exworks_value}}</option>
                    <?php
                }
            ?>

        </select>
    </div>

    <div class="col-3">

        <label for="deliveryleadtime">Lead Time</label>
        <select class="form-control" name="deliveryleadtime" onchange="this.form.submit();">
            <?php

                foreach ($leadtime_array as $leadtime_value) {
                    $sel="";
                    if($deliveryleadtime == $leadtime_value)
                        $sel="selected";
                    ?>
                    <option value="{{$leadtime_value}}" {{$sel}}>{{$leadtime_value}}</option>
                    <?php
                }
            ?>

        </select>
    </div>
    </div>




    </div>
    <hr>
    <b>Product details</b>
    <?php

    $prodindex=0;
    ?>
    @foreach($lead_data["products"] as $product)

    <?php
            $product_price+=($product["product_base_price"]*$product["quantity"]);
            $partnumber =  $product["partnumber"];
        ?>



@if(isset($product["options"]) && is_array($product["options"]) && count($product["options"])>0)
    @foreach($product["options"] as $option)

        @php
            $product_price+=($option["variant"][0]["variant_price"]*$product["quantity"]);
        @endphp


    @endforeach





@endif


    <div class="row">
        <div class="col">
                {{$product["name"]}}

                <?php

                    $placeholder_price = round(($product_price*$currencies_data[$currency_chosen]*$price_multiplier),0) ;


        $total_price+=$product_price;
        $placeholder_total_price+=$placeholder_price;
    ?>

     <div class="input_required">
    <b>Price: {{$currency_chosen}}<input id="validationCustom{{$prodindex}}" type="text" value="{{$placeholder_price}}" name="price{{$prodindex}}"  required></b><small>[actual price USD{{$product_price}}]</small>
    </div><div class="invalid-feedback">
          Please update the sell a price.
        </div>


        </div>

        @if($partnumber!="")
        <div class="col">
        Partnumber : <input type="text" size="40" style="font-size:10px;" name="partnumber{{$prodindex}}" value="{{$partnumber}}">
        | <a target="_new" href="https://www.instrumart.com/products/allpartnumbers/{{$product['source_prod_id']}}">View Prod.</a>
        </div>

        @endif




    </div>
<hr>
<?php
$prodindex++;
?>
    @endforeach

    <div class="row">
        <div class="col">
            <?php
            $checked="checked";
                if($descr=="0")
                    $checked="";
            ?>
            Add description? <input type="checkbox" name="descr" {{$checked}}><br>
          </div>
     </div>
    <div class="row">
        <div class="col">
      <button type="submit" class="btn btn-primary mb-2">Update</button>
        </div>
    </div>

</div>  <!--end of form div-->


</form>


<form action='/sendemailresponse/{{$lead_data["lead"]["order_id"]}}' method="Post">

    @csrf



<textarea id="textarea_email" name="textarea_email" class="editor">


@if($askmoreinfo!="0")
    @if($lateresponse!="0")
    {{$data->getHeader_lateresponse()}}
    @else
    {{$data->getHeader_moreinfo()}}
    @endif

    <br><b>Original Request for Quotation : </b><br>
    <p style="margin:0;">Shipping to : {{$lead_data["lead"]["country_shipping"]}}</p>
    <p style="margin:0;">ID : {{$lead_data["lead"]["order_id"]}}</p>
    <p style="margin:0;">lead date : {{$time_disp->format('d-M-Y [H:i:s]')}} </p>
    <p style="margin:0;">Email : <a href="mailto:{{$lead_data["lead"]["email"]}}">{{$lead_data["lead"]["email"]}}</a></a></p>
    <p style="margin:0;">Enquiry desc : {{$lead_data["lead"]["enquiry_desc"]}}</p>

<?php
$prodindex=0;
?>
<hr>
@foreach($lead_data["products"] as $product)
    <br>
    <span style="background-color: #ffe37c;"><b>Product : {{$product["name"]}}</b></span><br>

    <span class="small" style="background-color: #ebfbb9;"><i>
        Quantity : {{$product["quantity"]}}</i></span>
    <br>



@if(isset($product["options"]) && is_array($product["options"]) && count($product["options"])>0)
    @foreach($product["options"] as $option)

        <span style="margin-left:10px;background-color: #ebfbb9;"><small> ⁍ {{$option[0]["options_desc"]}}

            @if(isset($option["variant"]))

                <i>:{{$option["variant"][0]["variant_desc"]}}</i>

            @endif
            </small></span>
            <br>



    @endforeach
@endif

@endforeach
<hr>

{{$data->getFooter_moreinfo()}}

@endif


@if($askmoreinfo=="0")

{{$data->getHeader()}}


<?php
$prodindex=0;
?>
<hr>
@foreach($lead_data["products"] as $product)
<br>
<span style="background-color: #ffe37c;"><b>Product : {{$product["name"]}}</b></span><br>

<span class="small" style="background-color: #ebfbb9;"><i>
        Quantity : {{$product["quantity"]}}</i></span>
<br>



@if(isset($product["options"]) && is_array($product["options"]) && count($product["options"])>0)
    @foreach($product["options"] as $option)

        <span style="margin-left:10px;background-color: #ebfbb9;"><small> ⁍ {{$option[0]["options_desc"]}}

            @if(isset($option["variant"]))

                <i>:{{$option["variant"][0]["variant_desc"]}}</i>

            @endif
            </small></span>
            <br>



    @endforeach
@endif

<?php

?>
<b>Price: <span style="margin-left:10px;background-color: #ebfbb9;">{{$currency_chosen}}  {{$price_var[$prodindex]}} EA</span></b>

     <?php $prodindex++; ?>
<hr>


@if($descr!="0")
<span style="background-color: #ffe37c;"><b>Product description: </b></span><br>
{!!$product["product_description"]!!}
 @endif
@endforeach





{!!$data->getEmailFooter($currency_chosen,$deliveryleadtime,$exworks)!!}
@endif

    </textarea>


@if($hiddenvar=="1")

to : <input type="text" size="40" name="to_email" value={{$lead_data["lead"]["email"]}}>

<button type="submit" class="btn btn-danger col">SEND EMAIL</button>


@endif
</form>

</div>

</div><!--End of container-->
<!--
<script type="text/javascript">
    CKEDITOR.editorConfig = function( config ) {
    config.language = 'en';
    config.uiColor = '#FF0000';
    config.height = 300;
    config.toolbarCanCollapse = true;
};

        CKEDITOR.replace( 'textarea_email' , {
      width: '100%',
      height: 500,

    });
</script>

-->


<script src="/build/ckeditor.js"></script>
	<script>ClassicEditor
			.create( document.querySelector( '.editor' ), {

				toolbar: {
					items: [
						'heading',
						'|',
						'bold',
						'italic',
						'link',
						'bulletedList',
						'numberedList',
						'|',
						'indent',
						'outdent',
						'|',
						'blockQuote',
						'undo',
						'redo',
						'fontBackgroundColor',
						'fontColor',
						'fontSize',
						'highlight',
						'fontFamily',
						'horizontalLine'
					]
				},
				language: 'en',
				licenseKey: '',

			} )
			.then( editor => {
				window.editor = editor;




			} )
			.catch( error => {
				console.error( error );
			} );
	</script>

@endsection

@endif

