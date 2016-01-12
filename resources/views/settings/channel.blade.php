@extends('admin_template')
@section('content')
	  <div class="row">
						<div class="pull-right">

							<a href="#" data-toggle="modal" data-target="#myModalbuy" class="btn bg-maroon btn-flat margin ">Buy Additional Channel</a>
						</div>
						
						
            <div class="col-xs-12">
							
			
														 <div class="box">
														 
																<div class="box-header with-border">
																	<h3 class="box-title">Listing </h3>
																</div>
																
																
														
																<div class="box-body table-responsive">
																	<table id="example1" class="datatable table table-bordered table-striped table-condensed cf">
																		<thead>
																			<tr>
																				<th>#</th>
																				<th>Name</th>
																				<th>Termination URI</th>
																				<th>Origination URI </th>
																				<th>No. of Channel</th>
																				<th></th>
																			</tr>
																		</thead>
																		<tbody>
																			
																			<?php $cnt=0; foreach(openCSV("siptrunk-listing") as $key=>$item){ ++$cnt; ?>
																			<tr>
																				<td><?=$cnt ?></td>
																				<td><?=$item['name']?></td>
																				<td><?=$item['termination']?>.pstn.apibay.com</td>
																				<td><?=$item['origination']?> : <?=$item['origination_port']?> ( Prefix : <?=$item['origination_prefix']?> )</td>
																				<td><?=$item['channel']?></td>
																				<td><a href='' id="user_submit" name="commit" type="submit" value="Add user" data-toggle="modal" data-target="#myModal" class="btn btn-block btn-default">Edit</a></td>
																			</tr>
																			<?php } ?>
																		</tbody>
																		<tfoot>
																			<tr>
																				<th>#</th>
																				<th>Name</th>
																				<th>Termination URI</th>
																				<th>Origination URI</th>
																				<th>No. of Channel</th>
																				<th></th>
																		 </tr>
																		</tfoot>
																	</table>
																</div><!-- /.box-body -->
															</div><!-- /.box -->

				
							
             
            </div><!-- /.col -->
          </div><!-- /.row -->
					
					<div class="row">
						<div class="col-xs-12">
							<nav class="pull-right">
								<ul class="pagination">
									<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
									<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
									<li class="default"><a href="#">2 <span class="sr-only">(current)</span></a></li>
									<li class="default"><a href="#">3 <span class="sr-only">(current)</span></a></li>
									<li class="default"><a href="#">4 <span class="sr-only">(current)</span></a></li>
									<li class="default"><a href="#">5 <span class="sr-only">(current)</span></a></li>
									<li class="default"><a href="#">6 <span class="sr-only">(current)</span></a></li>
								</ul>
							</nav>
						</div>
					</div>
					
					
					
						<!-- Modal manage channel -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Manage Number of channel</h4>
								</div>
								<div class="modal-body">
								
									<form class="form-horizontal">
				

											<div class="box-body">
											
												<div class="alert alert-info alert-dismissable">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
													<h4><i class="icon fa fa-info"></i>Information</h4>
													Currently you have 18/50 channels unoccupied. You may select up to max 23 channels for this SIP Trunk.
												</div>
												
												<div class="form-group margin">
													<label class="control-label col-xs-5">Select new channel number value</label>
													
													<div class="col-xs-4">
														<input type="text" class="form-control" >
													</div>
													
												</div>

											</div>
					
							
								</form>
	
								</div>

								<div class="modal-footer">
										<div class="pull-left">
												<a href="#" class="btn bg-maroon btn-flat margin" data-dismiss="modal">Save</a>
										</div>	
										
										<div class="pull-right">
												<a href="#" class="btn btn-default margin" data-dismiss="modal">Cancel</a>
										</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End manage channel -->
					
					
					
					
					<!-- start buy channel -->
					<div class="modal fade" id="myModalbuy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Buy additional channel</h4>
								</div>
								<div class="modal-body">
								
									<form class="form-horizontal">
										<div class="box-body">

											<div class="form-group">
												<label class="control-label col-xs-6">Number of additional channel</label>
												<select class="addnumber form-control col-xs-6" style="width:auto;">
													<?php for($i=0;$i<50;$i++){ ?>
														<option value="<?=$i?>"><?=$i?></option>
													<?php } ?>
												</select>
											</div>
											
											<hr>
											
											<div class="col-xs-12">
												<p class="lead">Amount Due 2/22/2014</p>
												<div class="table-responsive">
													<table class="table">
														<tbody><tr>
															<th style="width:50%">Subtotal:</th>
															<td>$250.30</td>
														</tr>
														<tr>
															<th>Tax (9.3%)</th>
															<td>$10.34</td>
														</tr>
														<tr>
															<th>Shipping:</th>
															<td>$5.80</td>
														</tr>
														<tr>
															<th>Total:</th>
															<td>$265.24</td>
														</tr>
														<tr> 
															<th>Total credit after deducted:</th>
															<td>$25.60</td>
														</tr>
													</tbody></table>
												</div>
											</div>
										
										</div>
									</form>
									
									
									<div class="alert alert-danger alert-dismissable" style="display:none;">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<h4><i class="icon fa fa-ban"></i> Alert!</h4>
										Your credit balance is insufficient, please topup your amount first in order to proceed.
									</div>
									
								
								</div>
							
						
									
						
								<div class="modal-footer">
									<button type="button" class="btn closes btn-default" data-dismiss="modal">Close</button>
									<button type="button" class="btn buy btn-primary" data-dismiss="modal">Buy</button>
									<a href="number-confirm.php" type="button" class="btn topup btn-danger"  style="display:none;">Topup</a>
								</div>
							</div>
						</div>
					</div>
					<!-- End buy channel -->
					
	
					
@endsection
@section('afterfooter')
 <script>
	
		$(".addnumber").change(function(){
			var val=$(this).val();
			if(val > 10){
				$(".closes , .buy ").not(".top").hide();
				$(".topup , .alert").not(".top").show();
			}else{
				$(".closes , .buy").not(".top").show();
				$(".topup , .alert").not(".top").hide();
			}
		});		
	
	$('.checkall').on('ifChecked', function(event){
			$('input[type=checkbox]').iCheck('check');
	});
	$('.checkall').on('ifUnchecked', function(event){
			$('input[type=checkbox]').iCheck('uncheck');
	});
 </script>
@endsection