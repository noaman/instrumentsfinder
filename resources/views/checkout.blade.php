@extends('layout.v2.mainlayout')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-7 col-sm-6">
			<div class="header" style="display:block;padding:10px;margin: 10px;">
				<h5>Your selected products</h5>
			</div>
			<div class="cart_checkout_data">
			</div>	
		</div>

		<div class="col-md-5 col-sm-6">
			<div style="margin:10px;display:block;padding:30px;border:dotted 1px;">
			<h5>Submit your details</h5>
			<form action="/submitlead" method="post">
                      @csrf

                      <div id="cartdetails_form" style="display:none"></div>
                    <div class="form-group small">
                    <label for="email small"><b>Your Email(Required)</b></label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                    <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <div class="form-group small">
                    <label for="country">Country product ships to?</label>
                    
                    <select name="CountryProductShipsTo" class="form-control"><option value="">---</option><option value="Afghanistan">Afghanistan</option><option value="UAE">UAE</option><option value="Saudi">Saudi Arabia</option><option value="Kazakhastan">Kazakhastan</option></select>

                    </div>

                    <div class="form-group small">
                    <label for="inquiryDescription"><b>Enquiry description</b></label>
                    <textarea type="desc" class="form-control" id="inquiryDescription" name="inquiryDescription" placeholder="To get Quotations & Product details Kindly describe your requirement here" rows="4"></textarea>
                    
                    </div>

					<!--
                    <div class="form-check form-check-inline small">
                    <input type="checkbox" class="form-check-input" id="resllerbox" name="resellerpricing">
                    <label class="form-check-label" for="exampleCheck1">Need Reseller Pricing</label>
                    </div>

                    <div class="form-check form-check-inline small">

                    <input type="checkbox" class="form-check-input" id="bulkbox" name="bulkpricing">
                    <label class="form-check-label" for="exampleCheck1">Need Bulk Pricing</label>
                    </div>
					-->
                   

                    <input type="submit" class="btn btn-brand" value="Check Price Now"/>

                   
                    </form>
		</div>

	</div>	
</div>
</div>
@endsection