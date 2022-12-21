<?php
  $link_prefix="";
  $homeLink="/";
  $segment=resolve("segment");
  $subdomain=resolve("subdomain");
  $logo="logo.png";
  if($segment=="medical")
  {
    $link_prefix="/".$subdomain;
    $homeLink="/".$subdomain;
    $logo="logo_med.png";
  }
    
?>


<div class="masthead">


  <div class="row">
    <div class="col-6 col-sm-6">
      <a href="{{$homeLink}}"><img class="logo_place" src="/img/<?=$logo?>" style="width:250px;"></a>
    </div>
    <div class="col-sm-6">
      <p style="background:#ffffe0; padding:3px; padding-left:20px;float:right; width:300;border:1px #cccsolid;">
      <Email class="small">Mobile/<a href="https://wa.me/+971556305217?text=HI%2C%20I%20am%20visiting%20from%20instrumentsfinder.com%2C%20can%20you%20help%20with%20my%20product%20query%0A">Whatsapp</a> : <a href="tel:+971556305217">+971556305217</a>
      <br>Email : <a href="mailto:instrumentsfinder@gmail.com">instrumentsfinder@gmail.com</a></p>
    </div>

    <!-- <div class="col-4">
  <div class="cart1 pull-right"><i class="fa fa-shopping-cart fa-0.7x" style="color:#333;"></i><span id="itemCount_mobile"></span></div>
  </div>
    </div> -->

</div>

<div class="flotingbar">
      <Email class="small">Mobile/<a href="https://wa.me/+971556305217?text=HI%2C%20I%20am%20visiting%20from%20instrumentsfinder.com%2C%20can%20you%20help%20with%20my%20product%20query%0A">Whatsapp</a> : <a href="tel:+971556305217">+971556305217</a>
      <br>Email : <a href="mailto:instrumentsfinder@gmail.com">instrumentsfinder@gmail.com</a>
</div>

<nav class="navbar sticky-top navbar-expand-lg navbar-light bgcolor">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation" style="padding:10px;">
    <span class="navbar-toggler-icon"></span>
  </button>


<div class="row" style="width:90%">
  <div class="col-11">
   <input class="typeahead form-control" type="search" placeholder="Search for products or brands" style="height:40px;">

 </div>
 <div class="col-30">
  <span class="input-group-addon fa fa-search" id="basic-addon2"></span>
</div>
</div>





   <div class="collapse navbar-collapse" id="navbarTogglerDemo03" style="height:50px;">

    <ul class="navbar-nav ml-auto ">
      <li class="nav-item navitem_brand">
        <a href="{{$link_prefix}}/categories">Categories <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item navitem_brand">
        <a href="{{$link_prefix}}/brands">Brands</a>
      </li>
      <li class="nav-item navitem_brand">
        <a href="{{$link_prefix}}/applications">Applications</a>
      </li>
      <li class="nav-item navitem_brand cart cartColor" style="width:60px;display:block;text-align: center;vertical-align: middle;margin: auto;">
        <i class="fa fa-shopping-cart fa-0.7x cartColor"></i>
    <span id="itemCount"></span>
</li>


    </ul>

  </div>
</nav>
