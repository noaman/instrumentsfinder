<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
</head>

<body>

@if(isset($lead_data))


@php
$time_disp=new DateTime($lead_data["lead"]["created_at"]);
$lat= $lead_data["lead"]["lat"];
$lon= $lead_data["lead"]["lon"];
@endphp

<h3 style="margin:0; mso-line-height-rule:exactly;">Original Lead Details</h3><br>
<p style="margin:0;">ID : {{$lead_data["lead"]["order_id"]}}</p>
<p style="margin:0;">Shipping to : {{$lead_data["lead"]["country_shipping"]}}</p>
<p style="margin:0;">lead created from : {{$lead_data["lead"]["country_emoji"]}} b,{{$lead_data["lead"]["country"]}}</p>
<p style="margin:0;">lead date : {{$time_disp->format('d-M-Y [H:i:s]')}} </p>


<!-- <p style="margin:0;">Reseller: {{$lead_data["lead"]["reseller_price"]}}</p>
<p style="margin:0;">Bulk: {{$lead_data["lead"]["bulk_price"]}}</p> -->
<p style="margin:0;">Email : <a href="mailto:{{$lead_data["lead"]["email"]}}">{{$lead_data["lead"]["email"]}}</a></a></p>

<p style="margin:0;background: #ccc;">
enquiry desc : {{$lead_data["lead"]["enquiry_desc"]}}
</p>
<hr>
<h3><a href="https://instrumentsfinder.com/lead/{{$lead_data["lead"]["order_id"]}}">Lead</a></h3>
<h3><a href="https://instrumentsfinder.com/sendemail/{{$lead_data["lead"]["order_id"]}}?askmoreinfo=on">RFI</a></h3>
<hr>

<h3 style="margin:0; mso-line-height-rule:exactly;">RFQ Product details</h3><br>

@foreach($lead_data["products"] as $product)
            	@php
            		$prodcode="";
            	@endphp

            	<p style="background:#000;color:#fff;padding:5px;">
                        	Product Name  : {{$product["name"]}}
                        </p>

            	 <img src="https://instrumentsfinder.com{{$product['img']}}" width="60" alt="prewiew">
            	 <p><span class="text-muted"> Quantity : </span><strong>{{$product["quantity"]}}</strong> </p>



                 @php $prodcode.=$product["codevalue"] @endphp



            	 <hr>
            	  @if(isset($product["options"]) && is_array($product["options"]) && count($product["options"])>0)
            	  	<b>OPTIONS</b><br>
            	  	<table>
                	@foreach($product["options"] as $option)
                		<tr>
                		<td>
                		{{$option[0]["options_desc"]}}</td>

                    		@php $prodcode.=$option[0]["code_value"] @endphp

                    	@if(isset($option["variant"]))
                    		<td>{{$option["variant"][0]["variant_desc"]}}</td>
                    		@php $prodcode.=$option["variant"][0]["code"] @endphp
                    	@endif



                     </tr>
                	@endforeach
                	</table>
<!--
                	<p style="background:#ccc;color:#000;">
                        	Product code : {{$prodcode}} <a href="{{$product['url']}}" target="_new">view</a>
                        </p>	-->

                  @endif

@endforeach
<hr>
<h3><a href="https://instrumentsfinder.com/lead/{{$lead_data["lead"]["order_id"]}}">Lead</a></h3>
<h3><a href="https://instrumentsfinder.com/sendemail/{{$lead_data["lead"]["order_id"]}}?askmoreinfo=on">RFI</a></h3>
<hr>
</body>


</html>



@endif
