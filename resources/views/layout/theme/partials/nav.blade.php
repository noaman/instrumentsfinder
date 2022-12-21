<!-- START HEADER AREA -->
        <header class="header-area header-wrapper">
            <!-- header-top-bar -->
            <div class="header-top-bar plr-185">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 hidden-xs">
                            <div class="call-us">
                                <p class="mb-0 roboto">(+971) 01234-567890</p>
                            </div>
                        </div>
                        <!--<div class="col-sm-6 col-xs-12">
                            <div class="top-link clearfix">
                                <ul class="link f-right">
                                    <li>
                                        <a href="http://demo.devitems.com/subas-preview/subas/my-account.html">
                                            <i class="zmdi zmdi-account"></i>
                                            My Account
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://demo.devitems.com/subas-preview/subas/wishlist.html">
                                            <i class="zmdi zmdi-favorite"></i>
                                            Wish List (0)
                                        </a>
                                    </li>
                                    <li>
                                        <a href="http://demo.devitems.com/subas-preview/subas/login.html">
                                            <i class="zmdi zmdi-lock"></i>
                                            Login
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
            <!-- header-middle-area -->
            <div id="sticky-header" class="header-middle-area plr-185">
                <div class="container-fluid">
                    <div class="full-width-mega-dropdown">
                        <div class="row" style="margin-bottom: 0px;">
                            <!-- logo -->
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <div class="logo">
                                    <a href="/">
                                        <img style="width:180px;" src="/img/logo.png" alt="main logo">
                                    </a>
                                </div>
                            </div>
                            <!-- primary-menu -->
                            <div class="col-md-8 hidden-sm hidden-xs">
                                <nav id="primary-menu">
                                    <ul class="main-menu text-center">
                                        <li><a href="/">Home</a></li>
                                        <li><a href="/categories">Categories</a></li>
                                        <li><a href="/brands">Brands</a></li>
                                        <li><a href="/applications">Applications</a></li>
                                        <!--<li>
                                            <a href="http://demo.devitems.com/subas-preview/subas/about.html">About us</a>
                                        </li>
                                        <li>
                                            <a href="http://demo.devitems.com/subas-preview/subas/contact.html">Contact</a>
                                        </li>-->
                                    </ul>
                                </nav>
                                
                            </div>
                            <!-- header-search & total-cart -->
                            <div class="col-md-2 col-sm-6 col-xs-12">
                                <div class="search-top-cart  f-right">
                                   
                                    <!-- total-cart -->
                                    <div class="total-cart f-left">
                                        <div class="total-cart-in">
                                            <div class="cart-toggler">
                                                <a href="#">
                                                    <span class="cart-quantity"></span><br>
                                                    <span class="cart-icon">
                                                        <i class="zmdi zmdi-shopping-cart-plus"></i>
                                                    </span>
                                                </a>                            
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--enf of row-->


                       <div class="row" style="padding:8px;background-color: #222;height:60px;margin-bottom:20px;">


                        <div class="col">
                                <div class="form-group" style="padding-left:50px; padding-right:50px;">
    
    <input class="typeahead" type="text" id="search_text" placeholder="search for a product, category or brand" style="background:#444444;color:#eee;">
    <span class="fa fa-search form-control-feedback"></span>
        </div>
                        </div>
                        </div>
                                    
                                   
                                

                    </div>
                </div>
                   

            </div>
 
        </header>
        <!-- END HEADER AREA -->

        <!-- START MOBILE MENU AREA -->
        <div class="mobile-menu-area hidden-lg hidden-md">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="mobile-menu">
                            <nav id="dropdown">
                                <ul>
                                    <li><a href="/">Home</a>
                                        
                                    </li>
                                    
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MOBILE MENU AREA -->
<?php

    $page="";
    $pageheader="";
    $linksarray=array("Home"=>"/");
    if(count($url_array)==1)
        $page="home";
    else
    if(count($url_array)==2)    
    {
        $pageheader=$url_array[1];
        $linksarray=array("Home"=>"/");
    }
    else
    if(count($url_array)==3)    
    {
        $pageheader=str_replace("-"," ",$url_array[2]);
        $pageheader=str_replace("%20"," ",$pageheader);

        if($url_array[1]=="category")
            $linksarray=array("Home"=>"/","Categories"=>"/categories");
        if($url_array[1]=="brand")
            $linksarray=array("Home"=>"/","Brands"=>"/brands");
        if($url_array[1]=="application")
            $linksarray=array("Home"=>"/","Applications"=>"/applications");

    }
    else
    if(count($url_array)==4)    
    {
        $page="productdetail";
    }

?>
        <!-- BREADCRUMBS SETCTION START -->
        @if($page!="home" && $page!="productdetail")
        <div class="breadcrumbs-section plr-200 mb-20">
            <div class="breadcrumbs overlay-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="breadcrumbs-inner">
                                <h1 class="breadcrumbs-title">{{$pageheader}}</h1>
                                <ul class="breadcrumb-list">
                                    @foreach($linksarray as $key=>$value)
                                    <li><a href="{{$value}}">{{$key}}</a></li>
                                    
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- BREADCRUMBS SETCTION END --> 

        

      

