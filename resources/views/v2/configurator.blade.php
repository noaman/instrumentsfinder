@extends('layout.v2.mainlayout')

@section('content')
<div class="container">


		<div style="padding:10px;">
		@if(isset($productData))

		<div class="d-none" style="display:none;">
  <span class="baseproductname">{{$productData->name}}</span>
  <span class="baseproductid">{{$productData->prod_id}}</span>
  <span class="baseproductcode">{{$productData->codevalue}}</span>
  <span class="baseproductimg">/assets/{{$productData->thumb_img_new_path}}</span>
</div>

			<div class="row">
				<div class="col-md-12 col-sm-6">
					<h1 style="font-size:1.5em">{{$productData->name}}</h1>
					<p>{!!$productData->short_desc!!}</p>
					<img src="/assets/{{$productData->thumb_img_new_path}}"/>
				</div>
			</div>

			<div class="row">
				<div class="col-md-7 col-sm-6 options_block">
					<div style="text-transform: uppercase;color:#4ECDEE;margin-bottom:20px;margin-top:10px;">Choose your options below</div>
					@if(isset($options) && is_array($options) && count($options)>0)

                  		@foreach($options as $option)
                  		@if($option['options_desc']!="block")
                  		<div class="option" optionid="{{$option['option_id']}}">
                  			<div class="variant option_name">{{$option['options_desc']}}</div>
                  			@if(isset($option["variants"]))
                    			<?php $ctr=0; ?>
                    			<div class="radio_options">
                    			@foreach($option["variants"] as $variant)

			                          <?php
			                            if($ctr==0)
			                            $checked = "checked";
			                            else
			                            $checked = "";
			                            ?>


			                        <input class="radiochoice" type="radio" name="{{$option['option_id']}}" {{$checked}} label="{{$variant['variant_desc']}}" code="{{$variant['code']}}" variant_id="{{$variant['variant_id']}}" id="{{$variant['variant_id']}}">

			                         <label for="{{$variant['variant_id']}}">
			                       <span class="variant_desc">{{$variant['variant_desc']}}</span></label>

			                        <?php $ctr++; ?>
			                        <br/>
			                     @endforeach
			                     </div>
                    		@endif
                    	</div>
                    	@endif
                  		@endforeach
                  	@endif
				</div>
				<hr/>

				<div class="col-md-5 col-sm-6">


					<div style="border:dotted #fdd700 1px;padding:5px;">
						<div style="margin-top:10px;display:block;text-align:center;text-transform: uppercase;width:90%;dotted;font-size:13px;color:#4ECDEE;letter-spacing: 0.5px;">Reach out to us for support<hr/></div>
                        <div style="margin-top:10px;display:block;text-align:center;width:90%;dotted;font-size:13px;color:#cb202d;letter-spacing: 0.5px;"><p> <b>If you need help with Product Options Selection, Please send us the input RFQ so we can help identify the right product fit</p></b></div>
                        <button type="button" class="btn_cartload btn btn-brand">REACH OUT FOR SUPPORT</button>
					</div>
					<hr>
					 <div style="text-align:center;font-weight:800;font-style:bold;">OR </div><hr>
						<div style="border:dotted #fdd700 1px;padding:5px;">

						<div style="margin-top:10px;display:block;text-align:center;text-transform: uppercase;width:90%;dotted;font-size:13px;color:#4ECDEE;letter-spacing: 0.5px;">Configure your Product Options<hr/></div>
						<div class="configcartdiv"></div>

						<div style="background-color: #f3f3f3;padding:8px;">
						<div>Check Configuration availability and best Reseller Price Now</div>
						<p style="color:#666;" class="small"></p>
						</div>
						<hr/>
						<button type="button" class="btn_cartload btn btn-brand">CHECK PRICE NOW</button>

						</div>







				</div>

			</div>
		@endif
		</div>
</div>

@endsection


<script type="text/javascript">





</script>
