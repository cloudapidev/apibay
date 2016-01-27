@extends('admin_template') @section('content')
<div class="alert alert-success alert-dismissable" style="display: none">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-info"></i> Notice</h4>
					
</div>
<div class="row">
	<div class="col-md-12">

		<div class="box box-default box-solid">

			<div class="box-header with-border">
				<h3 class="box-title">Search new Number</h3>
			</div>
			<!-- /.box-header -->
			<span style="display: none" id="sbuyUrl">{{url('/')}}</span>
			<form id='searchForm' class="form-horizontal"
				onsubmit="return false;" method="post"
				action="{{url('numbers/sbuy')}}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="box-body">
					<div class="form-group">
						<!-- <label for="inputPassword3" class="col-sm-1 control-label">Country</label>
									<div class="col-sm-2">
										<select class="form-control" name="country" id="country">
											<option value="">(+1) United States</option>
											<option varlue="">(+65) Singapore</option>
										</select>
									</div> 
									
									<label for="inputPassword3" class="col-sm-1 control-label">Area</label>
									<div class="col-sm-1">
										<input type="text" class="form-control" name="area" id="area">
									</div>
									-->

						<label for="inputPassword3" class="col-sm-1 control-label">Number</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="number" name="number">
						</div>

						<label for="inputPassword3" class="col-sm-1 control-label">Capabilities</label>
						<div class="col-sm-1">
							<div class="radio">
								<label> <input type="radio" name="capabilities"
									id="capabilities" value="VOICE" checked=""> Voice
								</label>
							</div>
						</div>
						<div class="col-sm-1">
							<div class="radio">
								<label> <input type="radio" name="capabilities"
									id="capabilities" value="SMS" checked=""> SMS
								</label>
							</div>
						</div>
						<div class="col-sm-1">
							<div class="radio">
								<label> <input type="radio" name="capabilities"
									id="capabilities" value="VOICE_SMS" checked=""> Voice + SMS
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="kpsubmit btn btn-primary pull-right">Search</button>
					<button type="submit" class="btn btn-default">Reset</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="row kpsearch" style="display: none;">
	<div class="col-md-12">
		<div class="box box-solid container-fluid">

			<div class="box-header with-border">
				<h3 class="box-title">Search Results</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body buytable table-responsive">
				<table class="table kptable table-striped datastable"
					style="display: none;">
					<thead>
						<tr>
							<th>No</th>
							<th>Country</th>
							<th>Number</th>
							<th>Capabilities</th>
							<th>Price</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
				  	<tr>
							<td>1</td>
							<td>Malaysia</td>
							<td>+6012345664</td>
							<td>Voice</td>
							<td>$64.50</td>
							<td>
								<a class="buy btn btn-default">Buy</a>
							</td>
						</tr>
										
					</tbody>
				</table>
			</div>
			<div class="overlay">
				<i class="fa fa-refresh fa-spin"></i>
			</div>

	<!-- 	<div class="row">
				<div class="col-md-12">
					<nav class="pull-right">
						<ul class="pagination">
							<li class="default"><a href="#" aria-label="Previous"><span
									aria-hidden="true">&laquo;</span></a></li>
							<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
							<li class="default"><a href="#">2 <span class="sr-only">(current)</span></a></li>
							<li class="default"><a href="#">3 <span class="sr-only">(current)</span></a></li>
							<li class="default"><a href="#">4 <span class="sr-only">(current)</span></a></li>
							<li class="default"><a href="#">5 <span class="sr-only">(current)</span></a></li>
							<li class="disabled"><a href="#">6 <span class="sr-only">(current)</span></a></li>
							</uldefault
					
					</nav>
				</div>
			</div>
 	-->	

		</div>
	</div>
</div>
<div class="row kpbuysummary" <?=$style?> >
	<div class="col-md-12">

		<section class="invoice" style=''>
			<form id="purchaseForm" action="#" method='post' >
			<input type="hidden" name="_token" value="{{ csrf_token() }}" >
			<!-- title row -->
			<div class="row">
				<div class="col-xs-12">
					<h2 class="page-header">
						<i class="fa fa-globe"></i> Purchase total <small
							class="pull-right">Date: <?=date("d/m/Y")?></small>
					</h2>
				</div>
				<!-- /.col -->
			</div>
			<!-- info row -->



			<div class="row">
				<!-- accepted payments column -->
				<div class="col-xs-8 table-responsive">
					<p class="lead">
						<span>Item</span>
						<span class='refreshbtn btn btn-primary pull-right'>Refresh</span>
					</p>
					<table class="purchaseTotal table table-striped table-condensed cf">
						<thead>
							<tr>
								<th>No</th>
								<th>Country</th>
								<th>Number</th>
								<th>Capabilities</th>
								<th>price</th>
								<th>TotalMonth</th>
								<th>Subtotal</th>
							</tr>
						</thead>
						<tbody class="kpselectedtable">
						<?php if(!empty($selectedNumbers)):?>
						<?php foreach ($selectedNumbers as $k => $numbers):?>
							<tr>
								<td>{{$k+1}}</td>
								<td><?=$numbers->country?></td>
								<td><?=$numbers->number?></td>
								<td><input readonly name='type[<?=$numbers->number?>]' value="<?=$numbers->capabilities?>" ></td>
								<td><?=$numbers->price?></td>
								<td><input type='number' name='month[<?=$numbers->number?>]' class='totalmonth' min='1' max='12' value=1></td>
								<td name='subtotal'><span class='subtotal' ><?="$".$numbers->price?></span></td>
								<td><a name='<?=$numbers->number?>'  class="removebtn btn btn-default">Remove</a></td>
							</tr>
						<?php endforeach;?>
						<?php endif?>
						</tbody>
					</table>
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
					<p class="lead">Amount Due 2/22/2014</p>
					<div class="table-responsive">
						<table class="table">
							<tbody>
								<tr>
									<th  style="width: 50%">Total:</th>
									<td id='total' ></td>
								</tr>
								<tr>
									<th>Your current available credit:</th>
									<td id='curCredit'>$10.00</td>
								</tr>

								<tr>
									<th>Your Available Credit After checkout:</th>
									<td id='afterCredit'></td>
								</tr>

							</tbody>
						</table>
					</div>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->

			<div class="alert alert-danger alert-dismissable"
				style="display: none;">
				<button type="button" class="close" data-dismiss="alert"
					aria-hidden="true">×</button>
				<h4>
					<i class="icon fa fa-ban"></i> Alert!
				</h4>
				Your credit balance is insufficient, please topup your amount first
				in order to proceed.
			</div>

			<div class="row no-print kpconfirm-purchase">
				<div class="col-xs-12">
					<span  class="comPurchase btn btn-success pull-right"><i class="fa fa-credit-card"></i>
					Comfirm Purchase	</span>
				</div>
			</div>

			<!-- this row will not appear when printing -->
			<div class="row no-print kp-topup" style="display: none;">
				<div class="col-xs-12">
					<a href="#" class="btn btn-success pull-right"><i
						class="fa fa-credit-card"></i> Topup Balance</a>
				</div>
			</div>
			</form>
		</section>




	</div>
</div>


@endsection @section('afterfooter')
<script type="text/javascript" src="{{ asset("/bower_components/admin-lte/myjs/numbers/buyNumber.js") }}"></script> 
@endsection
