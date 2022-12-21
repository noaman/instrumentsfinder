
@extends('layout.adminlayout')

@section('content')

<!--protected $fillable=['order_id','name','email','enquiry_desc','reseller_price','bulk_price','country','country_code','country_flag','country_emoji','city','lat','lon'];-->


@if(isset($lead_data))
@php
$time_disp=new DateTime($lead_data["lead"]["created_at"]);
$lat= $lead_data["lead"]["lat"];
$lon= $lead_data["lead"]["lon"];

$lead_price=0;
@endphp


<div class="container">

            <div class="card ">
                <div class="card-header bg-dark text-light">
                    <div class="row small">
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
                    <div class="row ">
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
                </div>
            </div>
            <div class="card-body " style="padding:10px;border:dotted 1px;">
                <p class="card-title" style="background-color: #ccc;">
                    enquiry desc : {{$lead_data["lead"]["enquiry_desc"]}}
                </p>
                <a href="/sendemail/{{$lead_data["lead"]["order_id"]}}"><input type="button" value="Send Quotation Email"></a>

                <!-- <a href="#"><input type="button" value="Request company Info Email"></a> -->
            </div>
            @php
                    $prodcode="";
            @endphp

            @foreach($lead_data["products"] as $product)
                <?php
                    $partnumber = "";

                    if(isset($product["partnumber"]))
                         $partnumber =  $product["partnumber"];
                ?>
                <pre>

            </pre>

                <?php $product_price=0;

                $product_discount_price=0;


                ?>

                <img src="/assets/{{$product['img']}}" width="60" alt="prewiew"><br/>
                <div class="table-responsive">
                <table class="table small">
                @php $prodcode.=$product["codevalue"] @endphp

                    <thead class="thead-dark">
                    <tr>

                    <th scope="col">NAME</th>


                    <th scope="col">DISCOUNT</th>
                    <th scope="col">UNIT LIST PRICE</th>

                    <th scope="col">UNIT DISCOUNTED PRICE</th>
                    <th scope="col">TOTAL PRICE</th>
                    <th scope="col">TOTAL DISCOUNTED PRICE</th>
                    </tr>
                    </thead>



                    <tbody>
                    <tr>


                      <th>{{$product['name']}} x (QTY) {{$product["quantity"]}}</th>

                        <th>{{$product["product_discount"]}}%</th>
                      <th>$ {{$product["product_base_price"]}}</th>
                      <th>$ {{$product["product_base_price"]*(1-$product["product_discount"]/100)}}</th>
                      <th>$ {{($product["product_base_price"]*$product["quantity"])}}

                    <?php    $product_price+=($product["product_base_price"]*$product["quantity"])?>
                  </th>

                  <th>$ {{($product["product_base_price"]*$product["quantity"])*(1-$product["product_discount"]/100)}}

                    <?php    $product_discount_price+=($product["product_base_price"]*$product["quantity"])*(1-$product["product_discount"]/100)?>
                  </th>


                    </tr>



                    @if(isset($product["options"]) && is_array($product["options"]) && count($product["options"])>0)
                    @foreach($product["options"] as $option)
                    @php $prodcode.=$option[0]["code_value"] @endphp
                    <tr>
                        <td>{{$option[0]["options_desc"]}}

                            @if(isset($option["variant"]))
                            @php $prodcode.=$option["variant"][0]["code"] @endphp
                            <small>: {{$option["variant"][0]["variant_desc"]}}</small>
                            @endif


                        </td>



                        @if(isset($option["variant"]))


                            <th>{{$product["product_discount"]}}%</th>
                            <td>$ {{$option["variant"][0]["variant_price"]}}</td>
                            <th>$ {{($option["variant"][0]["variant_price"]*(1-$product["product_discount"]/100))}}</th>
                            <td>$ {{($option["variant"][0]["variant_price"]*$product["quantity"])}}

                            <?php

                            $product_price+=($option["variant"][0]["variant_price"]*$product["quantity"]);

                            ?>


                            </td>
                            <td>$ {{($option["variant"][0]["variant_price"]*$product["quantity"])*(1-$product["product_discount"]/100)}}

                            <?php


                            $product_discount_price+= ($option["variant"][0]["variant_price"]*$product["quantity"])*(1-$product["product_discount"]/100);
                            ?>


                            </td>
                        @endif
                    </tr>
                    @endforeach

                    @endif

                    <tr style="background: #ccc;">
                        <td><a href="https://www.instrumart.com/products/allpartnumbers/{{$product['source_prod_id']}}" target="_new">Check all part numbers</a> &nbsp;&nbsp;| &nbsp;&nbsp;

                            <a href="https://www.instrumart.com/products/configure/{{$product['source_prod_id']}}" target="_new">Configure product</a>
                        </td>

                        <td colspan="3">Part number : {{$partnumber}}</td>

                        <td>${{$product_price}}</td>
                        <td>${{$product_discount_price}}</td>
                    </tr>
                    </tbody>


                    </table>
                    </div>

            @endforeach


</div>

@endif






@endsection



<script language="javascript">
var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map-canvas'), {
          center: {lat: {!!$lat!!}, lng: {!!$lon!!}},
          zoom: 10
                  });
      }

function loadScript() {

  var script = document.createElement("script");
  script.type = "text/javascript";
  script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyCQLN_CavkirwoBUUefx4Oaj7kEQaZlQ1Y&callback=initMap";
  document.body.appendChild(script);
}

window.onload = loadScript;

</script>

