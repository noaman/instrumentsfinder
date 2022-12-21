
@extends('layout.theme.mainlayout')

@section('content')

<div id="page-content" class="page-wrapper">

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
                                        <li class="">
                                            <a href="#grid-view" data-toggle="tab" aria-expanded="false"><i class="zmdi zmdi-view-module"></i></a>
                                        </li>
                                        <li class="active">
                                            <a href="#list-view" data-toggle="tab" aria-expanded="true"><i class="zmdi zmdi-view-list-alt"></i></a>
                                        </li>
                                    </ul>
                                    
                                    <!-- showing -->
                                    @if(isset($productlistings))
                                    <div class="showing f-right text-right">
                                        <span>Showing : {{count($productlistings)}} products</span>
                                    </div>                      
                                    @endif             
                                </div>
                                <!-- shop-option end -->
                                <!-- Tab Content start -->
                                <div class="tab-content">
                                    <!-- grid-view -->
                                    @if(isset($productlistings))
                                    <div role="tabpanel" class="tab-pane" id="grid-view">
                                        <div class="row">
                                           @foreach($productlistings as $productlisting)


                                              <?php
  $prodslug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $productlisting->name)));

  ?>
                                            <!-- product-item start -->
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="product-item" ">
                                                    
                                                    <div class="product-info" style="background:#ffffff;border:1px dotted;padding:15px;">
                                                        <a href="single-product.html">
                                                            <img src="{{$productlisting->thumbnail}} " alt="" style='margin:auto;height: auto;;width: auto; max-width: 64px;height: 64;'>
                                                        </a>
                                                        <h6 class="product-title">
                                                             <a href="/product/{{$productlisting->prod_id}}/{{$prodslug}}">{{$productlisting->name}} </a>
                                                        </h6>
                                                        
                                                        <h6 class="pro-price">{{$productlisting->brand}}</h6>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- product-item end -->
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                    <!-- list-view -->
                                    @if(isset($productlistings))
                                    <div role="tabpanel" class="tab-pane active" 
                                    id="list-view">
                                        <div class="row">
                                            
                                            <!-- product-item start -->
                                            

                                              @foreach($productlistings as $productlisting)

                                              <?php
  $prodslug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $productlisting->name)));

  ?>

                                            <div class="col-md-11" style="border: dotted 1px;background-color: #fefefe;margin-left:10px;margin-bottom:20px;padding:10px;">

                                                <div class="col-1">
                                                    <div class="product-img" style="margin:auto;">
                                                        <a href="/product/{{$productlisting->prod_id}}/{{$prodslug}}">
                                                            <img src="{{$productlisting->thumbnail}}" alt="" style='margin:auto;height: auto;;width: auto; max-width: 64px;height: 64;'>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="clearfix">
                                                            <h6 class="product-title f-left">
                                                               <a href="/product/{{$productlisting->prod_id}}/{{$prodslug}}">{{$productlisting->name}} </a>
                                                            </h6>
                                                            
                                                        </div>
                                                    <h6 class="brand-name" style="margin-left:5px;">{{$productlisting->brand}} <i>[as reseller]</i></h6>
                                                        
                                                        <p style="color:#333;">{{$productlisting->short_desc}}</p>
                                                </div>
                                            </div>
                                            @endforeach

                               
                                            <!-- product-item end -->
                                         </div>
                                        @endif                                         
                                    </div>
                                </div>
                                <!-- Tab Content end -->
                                <!-- shop-pagination start -->
                               
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
                            </aside>
                            
                            <!-- operating-system -->
                            @if(isset($applicationsblock) && count($applicationsblock)>0)
                            <aside class="widget operating-system box-shadow mb-30">
                                <h6 class="widget-title border-left mb-20">Applications</h6>
                                <form action="action_page.php">
                                  @foreach ($applicationsblock as $k=>$v)
                                    <label><input type="checkbox" name="operating-1" value="phone-1">{{$k}}  [{{$v}}]</label><br>
                                    @endforeach
                                    
                                </form>
                            </aside>
                             @endif                             
                            
                            <!-- operating-system -->
                            @if(isset($categoriesblock) && count($categoriesblock)>0)
                            <aside class="widget operating-system box-shadow mb-30">
                                <h6 class="widget-title border-left mb-20">Categories</h6>
                                <form action="action_page.php">
                                  @foreach ($categoriesblock as $k=>$v)
                                    <label><input type="checkbox" name="operating-1" value="phone-1">{{$v['name']}}  [{{$v['total']}}]</label><br>
                                    @endforeach
                                    
                                </form>
                            </aside>
                             @endif                             
                            

                        </div>
                        <!--left side bar-->
                        
                    </div>
                </div>
            </div>
            <!-- SHOP SECTION END -->
        </div>
@endsection
