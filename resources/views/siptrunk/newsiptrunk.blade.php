@extends('admin_template')
@section('content')

<div class="row editTrunk" >
<p id="url" style="display: none">{{url('/')}}</p>
<div class="col-md-12">
<!--  <form class="form-horizontal" onsubmit="return false;">-->
	<!-- start custom tab -->
	<div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
			<li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-info-circle"></i> General</a></li>
            <li ><a href="#tab_2" data-toggle="tab"><i class="fa fa-external-link-square"></i> Termination</a></li>
            <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-level-down"></i> Origination</a></li>
            <li><a href="#tab_4" data-toggle="tab"><i class="fa fa-phone-square"></i> Assigned Numbers</a></li>
		</ul>
		<div class="box-body" >
			<!-- start tab content -->
			<div class="tab-content">
				<!-- Start general -->
			 	<div class="tab-pane active general" id="tab_1">
			 		<form id="saveTrunkInfoForm" class="form-horizontal"  action="#" method="post" >
			 			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			 			<input type='hidden' name="TrunkId" value="{{$trunkInfo->id}}">
			 			<input type='hidden' name="general" value="general">
						<div class="form-group">
							<label class="control-label col-sm-2" for="name">Name</label>
							<div class="col-sm-4">
								<input class="form-control" id="name" name="name" size="30" type="text" value="{{$trunkInfo->name}}">
							</div>
						</div>	
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="termination_uri">Termination URI</label>
							<div class="col-sm-4">
							<input class="form-control" id="user_full_name" name="termination_uri" size="30" type="text" value="{{$trunkInfo->termination_uri}}">
						</div>
						<div class="col-sm-4">
							<span>.pstn.apibay.com</span>
						</div>
					</div>
				</form>
			</div> 
			<!-- End general -->
			<!-- Start termination -->
			<div class="tab-pane termination" id="tab_2">
				<form action="#" method="post" id="saveTerminationForm" >
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type='hidden' name="sipTrunkId" value="{{$trunkInfo->id}}">
				<input type='hidden' name="termination" value="termination">
				<div class="form-group">
					<label class="control-label col-sm-3" for="user_full_name">Authentication ( Credentials )</label>
					<div class="col-sm-8">
						<select id="selectAuth" name="sipTrunkAuthId">
							<option value="0">---Select---</option>
							<?php if(!empty($allAuthList)): foreach ($allAuthList as $auth):?>
							<option value="{{$auth->id}}">{{$auth->user_name}}</option>
							<?php endforeach;endif;?>
						</select>&nbsp;
						<a href="#"  id="user_submit" name="commit" type="submit" value="Add user" data-toggle="modal" data-target="#myModalauth">Add credential authentication</a><br />
						<table id="authTable" class="table table-bordered table-striped table-condensed cf">
							<thead>
								<tr>
									<th>#</th>
									<th>Username</th>
									<th>Password</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							<?php $index=1; if(!empty($selectedAuthList)):foreach ($selectedAuthList as $auth):?>
								<tr>
									<td>{{$index}}</td>
									<td>{{$auth->user_name}}</td>
									<td>********</td>
									<td><a href="#" data-authid="{{$auth->id}}"  id="user_submit" name="commit" type="submit" value="Add user" data-toggle="modal" data-target="#myModalauth">Edit</a></td>
								</tr>
							<?php endforeach;endif;?>
							</tbody>
							<tfoot>
								<tr>
 									<th>#</th>
									<th>Username</th>
									<th>Password</th>
									<th></th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-3" for="user_full_name">IP Access Control</label>
					<div class="col-sm-8">
					<select id="selectIpcontrol" name="sipTrunkIpId">
							<option value="0">---Select---</option>
							<?php if(!empty($allIpAccess)): foreach ($allIpAccess as $ipAccess):?>
							<option value="{{$ipAccess->id}}">{{$ipAccess->description}}</option>
							<?php endforeach;endif;?>
						</select>&nbsp;
						<a href="#"  id="user_submit" name="commit" type="submit" value="Add user" data-toggle="modal" data-target="#myModalip">Add IP Access</a><br />
						<table id="IpAccessList" class="table table-bordered table-striped table-condensed cf">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>IP Address</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							<?php $index=1; if(!empty($selectedIpAccess)):foreach ($selectedIpAccess as $ipAccess):?>
								<tr>
									<td>{{$index}}</td>
									<td>{{$ipAccess->description}}</td>
									<td>{{$ipAccess->ip}}</td>
									<td><a href="#" data-ipaccess="{{$ipAccess->id}}"  id="user_submit" name="commit" type="submit" value="Add user" data-toggle="modal" data-target="#myModalip">Edit</a></td>
								</tr>
							<?php $index++; endforeach;endif; ?>
							</tbody>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Name</th>
							   	<th>IP Address</th>
									<th></th>
								</tr>
							</tfoot>
						</table>
										
					</div>
				</div>	
				</form>
			</div>
			<!-- End termination -->
			<!-- Start origination -->
			<div class="tab-pane" id="tab_3">
				<div class="form-group">
					<label class="control-label col-sm-2" for="user_full_name">Origination IP</label>
					<div class="col-xs-3">
							<input type="text" class="form-control" placeholder="IP Address / Domain" value="">
						</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="user_full_name">Origination Port</label>
					<div class="col-xs-2">
						<input type="text" class="form-control" placeholder="Port" value="">
					</div>
				</div>			
				<div class="form-group">
					<label class="control-label col-sm-2" for="user_full_name">Origination Prefix</label>
					<div class="col-xs-3">
						<input type="text" class="form-control" placeholder="Prefix" value="">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="user_full_name"> No. of channel</label>
					<label class="control-label col-sm-2" style="text-align:left;" for="user_full_name"></label>
				</div>
			</div>
			<!-- End origination -->
			<!-- Start number -->
			<div class="tab-pane" id="tab_4">
				<div class="table-responsive">
					<div class="box box-solid container-fluid">
						<div class="pull-right">
							<a href="#" class="pull-right btn bg-red btn-flat margin ">Delete assigned number</a>
							<a href="#" data-toggle="modal" data-target="#myModalassign" class="pull-left btn bg-green btn-flat margin ">Assign new number from existing</a>
						</div>
						<table id="example1" class="datatable table table-bordered table-striped table-condensed cf">
							<thead>
								<tr>
									<th>#</th>
									<th>Number</th>
									<th>Country</th>
									<th>Area</th>
									<th>Capabilities</th>
									<th>
											<input type="checkbox" class="checkall" >
									</th>
								</tr>
							</thead>
							<tbody>
								<?php $cnt=0; foreach(openCSV("number-listing") as $key=>$item){ ++$cnt;?>
								<tr>
									<td><?=$cnt ?></td>
									<td><?=$item['number']?></td>
									<td><?=$item['country']?></td>
									<td><?=$item['area']?></td>
									<td><?=$item['capability']?></td>
									<td>
										<input type="checkbox">
									</td>
								</tr>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Number</th>
									<th>Country</th>
									<th>Area</th>
									<th>Capabilities</th>
									<th></th>
							 </tr>
							</tfoot>
						</table>
						<div class="overlay" style="display:none;" >
								<i class="fa fa-refresh fa-spin"></i>
						</div>
					</div>
				</div>
			</div>
			<!-- End number -->
		</div>
		<!-- end tab content -->
	</div>
	<!-- end box body -->
	<div class="box-footer">
		<!-- Start submit -->
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">

					<div class="col-sm-8">
						<a href="#" class="btn btn-success" id="saveTrunkInfo" name="commit" type="submit" >Save</a>
					</div>
				</div>
			</div>
		</div>
		<!-- End submit -->
	</div>
</div>
<!-- end custom tab -->
<!-- 	</form>						 -->
	
	
	<!-- start buy channel -->
<div class="modal fade" id="myModalassign" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add existing number</h4>
			</div>
			<div class="modal-body">
			
						<div class="box box-solid box-default">
						 <div class="box-header with-border">
								<h3 class="box-title">Search & Filter</h3>
							</div><!-- /.box-header -->
								<form class="form-horizontal">
									<div class="box-body">
											
											
										<div class="form-group">
											<label for="inputPassword3" class="col-sm-1 control-label">Country</label>
											
											<div class="col-sm-3">
												<select class="form-control">
													<option>(+1) United States</option>
													<option>(+65) Singapore</option>
												</select>
											</div>
											
											<label for="inputPassword3" class="col-sm-1 control-label">Area</label>
											<div class="col-sm-1">
												<input type="text" class="form-control">
											</div>
												
							
											<label for="inputPassword3" class="col-sm-1 control-label">Number</label>
											<div class="col-sm-2">
												<input type="text" class="form-control">
											</div>
							
											<label for="inputPassword3" class="col-sm-1 control-label">Capabilities</label>
											<div class="col-sm-2">
													<select class="form-control">
														<option>Voice</option>
														<option>SMS</option>
														<option>Voice + SMS</option>
													</select>
											</div>
											
										</div>
										
										<div class="box-footer">
											
											<div class="pull-right">
													<a href="#" class="btn bg-maroon btn-flat kpsubmit">Search</a>
											</div>	

										</div>
										
									
									</div>
							</form>

					
						</div>
							
			
					<div class="row kpsearch" style="display:none;">
									<div class="col-md-12">
										<div class="box box-solid container-fluid">
									 
										<div class="box-header with-border">
											<h3 class="box-title">Search Results</h3>
										</div><!-- /.box-header -->
											<div class="box-body buytable table-responsive" >
												<table class="table kptable table-striped" style="display:none;">
													<thead>
														<tr>
															<th>No</th>
															<th>Country</th>
															<th>Area</th>
															<th>Number</th>
															<th>Capabilities</th>
															<th><input type="checkbox" class="mcheckall" ></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>1</td>
															<td>Malaysia</td>
															<td>Johor</td>
															<td>+6012345664</td>
															<td>Voice</td>
															<td>
																<input type="checkbox">
															</td>
														</tr>
														<tr>
															<td>2</td>
															<td>Singapore</td>
															<td>-</td>
															<td>+65612345664</td>
															<td>SMS</td>
															<td>
																<input type="checkbox">
															</td>
														</tr>
														<tr>
															<td>3</td>
															<td>Singapore</td>
															<td>-</td>
															<td>+65612345667</td>
															<td>Voice+SMS</td>
															<td>
																<input type="checkbox">
															</td>
														</tr>
														<tr>
															<td>4</td>
															<td>China</td>
															<td>Cheng Du</td>
															<td>+86612345664</td>
															<td>Voice</td>
															<td>
																<input type="checkbox">
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="overlay" >
													<i class="fa fa-refresh fa-spin"></i>
											</div>
										
											<div class="row">
												<div class="col-md-12">
													<nav class="pull-right">
														<ul class="pagination">
															<li class="default"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
															<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
															<li class="default"><a href="#">2 <span class="sr-only">(current)</span></a></li>
															<li class="default"><a href="#">3 <span class="sr-only">(current)</span></a></li>
															<li class="default"><a href="#">4 <span class="sr-only">(current)</span></a></li>
															<li class="default"><a href="#">5 <span class="sr-only">(current)</span></a></li>
															<li class="disabled"><a href="#">6 <span class="sr-only">(current)</span></a></li>
														</ul>
													</nav>
												</div>
											</div>
											
					
										</div>
									</div>
								</div>
		
			</div>

	
			<div class="modal-footer">
				<button type="button" class="btn closes btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn buy btn-primary" data-dismiss="modal">Add</button>
			</div>
		</div>
	</div>
</div>
<!-- End buy channel -->

	<div class="box box-default box-solid" style="display:none;">
               
                <div class="box-header with-border">
                  <h3 class="box-title">SIP Trunk Details</h3>
                </div><!-- /.box-header -->
			
			
			<!-- stat box body -->
			<div class="box-body" >
				<div class="row">
					
					<form class="form-horizontal">
				
						<div class="left-col col-md-12">
								<div class="form-group">
									<label class="control-label col-sm-2" for="user_full_name">Name</label>
									<div class="col-sm-8">
										<input class="form-control" id="user_full_name" name="user[full_name]" size="30" type="text" value="<?=isset($data['name'])?$data['name']:null?>">
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="control-label col-sm-2" for="user_full_name">Termination URI</label>
									<div class="col-sm-8">
										<input class="form-control" id="user_full_name" name="user[full_name]" size="30" type="text" value="<?=isset($data['termination'])?$data['termination']:null?>">
									</div>
									
									 
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="user_full_name">Authentication</label>
									<div class="col-sm-8">
										<a href="#"  id="user_submit" name="commit" type="submit" value="Add user" data-toggle="modal" data-target="#myModalauth">Add authentication</a><br />
									
										<table class="table">
											<thead>
												<tr>
													<th>#</th>
													<th>Username</th>
													<th>Password</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1</td>
													<td>keeperng</td>
													<td>********</td>
													<td><a href="#"  id="user_submit" name="commit" type="submit" value="Add user" data-toggle="modal" data-target="#myModalauth">Edit</a></td>
												</tr>
												<tr>
													<td>2</td>
													<td>admin</td>
													<td>******</td>
													<td>	<a href="#"  id="user_submit" name="commit" type="submit" value="Add user" data-toggle="modal" data-target="#myModalauth">Edit</a></td>
												</tr>
											</tbody>
											<tfoot>
												<tr>
													<th>#</th>
													<th>Username</th>
													<th>Password</th>
													<th></th>
												</tr>
											</tfoot>
										</table>
										
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="control-label col-sm-2" for="user_full_name">Origination URI</label>
									<div class="col-xs-3">
											<input type="text" class="form-control" placeholder="IP Address / Domain" value="<?=isset($data['origination_ip'])?$data['origination_ip']:null?>">
										</div>
										<div class="col-xs-2">
											<input type="text" class="form-control" placeholder="Port" value="<?=isset($data['origination_port'])?$data['origination_port']:null?>">
										</div>
										<div class="col-xs-3">
											<input type="text" class="form-control" placeholder="Prefix" value="<?=isset($data['origination_prefix'])?$data['origination_prefix']:null?>">
										</div>
								</div>
								<div class="form-group">
									<label class="control-label col-sm-2" for="user_full_name">Current No. of channel</label>
									<p class="col-sm-1 text-left" for="user_full_name"><?=(isset($data['channel'])&& $data['channel']!=""?$data['channel']:"1")?> </p>
									<div class="col-sm-8">
										<a href="#"  id="user_submit" name="commit" type="submit" value="Add user" data-toggle="modal" data-target="#myModal">Buy more channel</a>
									</div>
								</div>
								<div class="form-group showupdated" style="display:none;">
									<label class="control-label col-sm-2" for="user_full_name">Updated Total No. of channel</label>
									<p class="col-sm-1 updatednum text-left" for="user_full_name"> </p>
								</div>
								<hr />
								<div class="form-group">
									<label class="control-label col-sm-2" for="user_full_name">Number associated</label>
									<div class="col-sm-8">
										<select class="form-control select2" multiple="multiple" data-placeholder="Select from unassign number" style="width: 100%;">
										
											<?php $cnt=0; foreach(openCSV("number-listing") as $key=>$item){ ++$cnt;?>
												<option><?=$item["number"]?> (<?=$item["country"]?>)</option>
											<?php } ?>
			
										</select>
									</div>
										
								</div>

						</div>
								

					</form>
					<!-- Start submit -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<div class="col-sm-4">&nbsp;</div>
								<div class="col-sm-8">
									<a href="#" class="btn btn-default" name="commit" onclick="gHistoryBack()" type="submit" value="">Cancel </a>
									<a href="#" class="btn btn-success" id="user_submit" name="commit" type="submit" value="Add user">Save</a>
								</div>
							</div>
						</div>
					</div>
					<!-- End submit -->
					</div>
					<!-- End row -->
			</div>
			<!-- End box body -->
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
<!-- End modal -->


 
<!-- Modal authentication -->
<div class="modal fade" id="myModalauth" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Manage Credential Authentication</h4>
			</div>
			<div class="modal-body">
			
				<form id="addAuthForm" class="form-horizontal">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="trunkId" value="{{ $trunkId }}">
						<div class="box-body">
							<div class="form-group">
								<label class="col-xs-3">Enter username</label>
								<div class="col-xs-4">
									<input type="text" name="user_name" class="form-control" placeholder="Enter ...">
								</div>
							</div>
							<div class="form-group margin">
								<label class="col-xs-3">Enter password</label>
								<div class="col-xs-4">
									<input type="password" name="password" class="form-control" placeholder="Enter ...">
								</div>
							</div>
						</div>
			</form>
		</div>
			<div class="modal-footer">
					<div class="pull-left">
							<a href="#" id="saveAuthBtn" class="btn bg-maroon btn-flat margin" data-dismiss="modal">Save</a>
					</div>	
					
					<div class="pull-right">
							<a href="#" class="btn btn-danger margin" data-dismiss="modal">Delete</a>
					</div>
			</div>
		</div>
	</div>
</div>
<!-- End authentication -->



<!-- Modal ip access -->
<div class="modal fade" id="myModalip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Manage IP Access</h4>
			</div>
			<div class="modal-body">
			
				<form id="addIPAccessForm" class="form-horizontal">
					<input type="hidden" name="_token" value="{{csrf_token()}}" />
					<input type="hidden" name="trunkId" value="{{$trunkId}}" />
						<div class="box-body">
							<div class="form-group">
								<label class="col-xs-3">Enter name</label>
								<div class="col-xs-4">
									<input type="text" name="description" class="form-control" placeholder="Enter ..." value="GR PBX">
								</div>
							</div>
							<div class="form-group margin">
								<label class="col-xs-3">Enter IP Address</label>
								<div class="col-xs-4">
									<input type="text" name="ip" class="form-control" placeholder="Enter ..." value="145.24.21.111">
								</div>
							</div>
						</div>
			</form>
			</div>
			<div class="modal-footer">
					<div class="pull-left">
							<a href="#" id="addIpAccess" class="btn bg-maroon btn-flat margin" data-dismiss="modal">Save</a>
					</div>	
					<div class="pull-right">
							<a href="#" class="btn btn-danger margin" data-dismiss="modal">Delete</a>
					</div>
			</div>
		</div>
	</div>
</div>
<!-- End ip access -->
<div id="success" class="alert alert-success alert-dismissable" style="display: none" >
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-info"></i> Notice</h4>
				<p></p>
</div>
<div id="error" class="alert  alert-danger alert-dismissable" style="display: none" >
				<button type="button" class="close" data-dismiss="alert"
					aria-hidden="true">×</button>
				<h4>
					<i class="icon fa fa-ban"></i> Notice !
				</h4>
				<p></p>
</div>

@endsection
@section('afterfooter')
<script type="text/javascript" src="{{ asset("/bower_components/admin-lte/myjs/sipTrunks/editTrunks.js") }}"></script> 
@endsection