
@extends('layout.theme.mainlayout')

@section('content')


<div id="page-content" class="page-wrapper">

@if(isset($categories))
            <!-- SHOP SECTION START -->
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-md-push-3 col-xs-12">
                            <div class="shop-content">
                                <!-- shop-option start -->
                                <div class="shop-option box-shadow mb-30 clearfix">
                                    <!-- Nav tabs -->
                                    <ul class="shop-tab f-left" role="tablist">
                                        <li class="active">
                                            <a href="shop-list.html#grid-view" data-toggle="tab"><i class="zmdi zmdi-view-module"></i></a>
                                        </li>
                                        <li >
                                            <a href="shop-list.html#list-view" data-toggle="tab"><i class="zmdi zmdi-view-list-alt"></i></a>
                                        </li>
                                    </ul>
                                    <!-- short-by -->
                                    <!--<div class="short-by f-left text-center">
                                        <span>Sort by :</span>
                                        <select>
                                            <option value="volvo">Newest items</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select> 
                                    </div> -->
                                    <!-- showing -->
                                    <div class="showing f-right text-right">
                                        <span>Showing : {{count($categories)}} categories</span>
                                    </div>                                   
                                </div>
                                <!-- shop-option end -->
                                <!-- Tab Content start -->
                                <div class="tab-content">
                                    <!-- grid-view -->
                                    <div role="tabpanel" class="tab-pane active" id="grid-view">
                                        <div class="row">
                                        	@foreach($categories as $category) 
                                            <!-- product-item start -->
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="product-item">
                                                    <div class="product-img">
                                                        <a href="http://demo.devitems.com/subas-preview/subas/single-product.html">
                                                            <img src="img/product/7.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-info">
                                                        <h6 class="product-title">
                                                            <a href="category/{{$category['slug']}}">{{$category['name']}}</a>
                                                        </h6>
                                                        
                                                        <h6 class="pro-price">{{$category['total']}} products</h6>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- product-item end -->
                                            @endforeach
                                           
                                        </div>
                                    </div>
                                    <!-- list-view -->
                                    <div role="tabpanel" class="tab-pane " id="list-view">
                                        <div class="row">
@foreach($categories as $category)                                        	
                                            <!-- product-item start -->
                                            <div class="col-md-8">
                                                <div class="shop-list product-item" style="margin-bottom:8px;">
                                                    
                                                    <div class="product-info" style="padding:12px;" >
                                                        <div class="clearfix">
                                                            <h6 class="product-title f-left">
                                                                <a href="category/{{$category['slug']}}">{{$category['name']}}</a>
                                                            </h6>

                                                            
                                                        </div>
                                                         <h6 class="pro-price">{{$category['total']}} products</h6>
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- product-item end -->
@endforeach                                           
                                        </div>                                        
                                    </div>
                                </div>
                                <!-- Tab Content end -->
                                <!-- shop-pagination start -->
                                <!--<ul class="shop-pagination box-shadow text-center ptblr-10-30">
                                    <li><a href="shop-list.html#"><i class="zmdi zmdi-chevron-left"></i></a></li>
                                    <li><a href="shop-list.html#">01</a></li>
                                    <li><a href="shop-list.html#">02</a></li>
                                    <li><a href="shop-list.html#">03</a></li>
                                    <li><a href="shop-list.html#">...</a></li>
                                    <li><a href="shop-list.html#">05</a></li>
                                    <li class="active"><a href="shop-list.html#"><i class="zmdi zmdi-chevron-right"></i></a></li>
                                </ul>-->
                                <!-- shop-pagination end -->
                            </div>
                        </div>

                        <!--left side bar-->
                        <div class="col-md-3 col-md-pull-9 col-xs-12">
                            <!-- widget-search -->
                            <!--<aside class="widget-search mb-30">
                                <form action="#">
                                    <input type="text" placeholder="Search here...">
                                    <button type="submit"><i class="zmdi zmdi-search"></i></button>
                                </form>
                            </aside>-->
                            
                            <!-- operating-system -->
                            @if(isset($applications))
                            <aside class="widget operating-system box-shadow mb-30">
                                <h6 class="widget-title border-left mb-20">Applications</h6>
                                <form action="action_page.php">
                                	@foreach($applications as $application)
                                    <label>{{$application['name']}}  [{{$application['total']}}]</label><br>
                                    @endforeach
                                    
                                </form>
                            </aside>
                             @endif                             
                            </aside>
                        </div>
                        <!--left side bar-->
                        
                    </div>
                </div>
            </div>
            <!-- SHOP SECTION END -->             

        </div>
@endif
@endsection