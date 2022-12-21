
@extends('layout.adminlayout')

@section('content')


<?php
$url_array = resolve('url_array');

$is_sent=false;
$form_sent_path="";
if(isset($url_array[2]) && $url_array[2]=="sent")
{
  $is_sent=true;
  $form_sent_path="/sent";
}

?>
<!--protected $fillable=['order_id','name','email','enquiry_desc','reseller_price','bulk_price','country','country_code','country_flag','country_emoji','city','lat','lon'];-->

<div class="container">
  <div class="row">
@if(isset($leads))
<div class="col-md-10 col-sm-6">
<div class="table-responsive">
<h3>Leads: {{$form_sent_path}}</h3>


{{-- {{ dd(get_defined_vars()['__data']) }} --}}
<b>Total new leads  {{$leads->total()}}</b>
<form action="/admin{{$form_sent_path}}">
  <Label >Select Shipping country</Label>
  <select name="country">
    <option value="" >All countries</option>
    @foreach($countries as $country)
    <?php
        $selected="";
        if(isset($countrysel) && $country["country_shipping"] == $countrysel)
        {
          $selected="selected";
        }

    ?>
    <option value="{{$country["country_shipping"]}}" {{$selected}}>{{$country["country_shipping"]}}</option>
    @endforeach

  </select>
  <input type="submit">
</form>


<table class="table table-sm small">
  <thead class="thead-dark">
    <tr>
    
      <th scope="col">Order ID </th>
      <th scope="col">Segment </th> 
      <th scope="col">Date </th>
      <th scope="col">Domain </th>
      <th scope="col">Email</th>
      <th scope="col">Shipping to</th>
      <th scope="col">Products in Lead</th>
      <th scope="col">Status </th>


    </tr>
  </thead>
  <tbody class="thead-light">
  	@foreach($leads as $lead)

    <?php


    $lead_date = date('d-M',strtotime($lead->created_at));

    $product_in_Lead='';

    //foreach($this->$lead["products"] as $product)
    //{
        //$Product_in_Lead = $this->lead_data["products"]["name"].$Product_in_Lead.", ";
    //$product_in_Lead .= $product["name"].", ";
  //}
//print_r($lead)
    ?>

    <tr>

      <td><a href="/lead/{{$lead->order_id}}">{{$lead->order_id}} </a></td>
      <td>{{$lead->segment}}</td>
      <td>{{$lead_date}}</td>
      <td>{{$lead->domain}}</td>
      <td>{{$lead->email}}</td>
      <td>{{$lead->country_shipping}}</td>
      <td>{{$product_in_Lead}}</td>
      <td>{{$lead->status}}</td>


    </tr>
    @endforeach
    </tbody>
   </table>
 </div>
</div>
</div>
{{$leads->appends(request()->input())->links()}}
@endif



</div>

@endsection
