@extends('admin_template')

@section('content')
	<span id="rootUrl" style="display: none">{{url("/")}}</span>
  <div class="row">
					<div class='col-md-12'>

			
				
						
						<div class="row">
							<div class="col-md-8">
								<div class="panel panel-default">
									<div class="panel-heading">Edit Server Apps</div>
									<form id="saveAppsInfo"   action="#" method="post" >
									<div class="panel-body">
									
										<div class="row">
										<div class="col-md-12">

												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="hidden" name="id" value="<?=isset($data->id)?$data->id:null?>" id="appId">
											<div class="form-group">
												<label class="col-sm-3 control-label" >Server App Name</label>
												<div class="col-md-9">
												<input class="form-control valid" focus="focus" id="application_title" name="name" onfocus="this.value = this.value;" required="required" size="30" type="text" value="<?=isset($data->name)?$data->name:null?>" aria-required="true" aria-invalid="false">
												</div>
												<div class='clearfix'></div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" >App Status</label>
												<div class="col-md-6">
													<?php $status=isset($data->status)?$data->status:null ?>
													<select class="form-control" name="status">
														<option value="INACTIVE"<?php if($status=='INACTIVE'){echo "selected='selected '";}?>>Development</option>
														<option value="ACTIVE" <?php if($status=='ACTIVE'){echo "selected='selected '";}?>>Production</option>
													</select>
												</div>
												<div class='clearfix'></div>
											</div>
										
											<div class="form-group">
											{{--	<label class="col-sm-3 control-label" for="application_type">Type</label>
												<div class="col-md-6">
													<select class="form-control" id="application_type" name="application[type]" required="required" aria-required="true"><option value="Other" selected="selected">Other</option>
													<option value="Game">Game</option>
													<option value="Fun">Fun</option>
													<option value="Office">Office</option>
													<option value="Productivity">Productivity</option>
													<option value="Books">Books</option>
													<option value="Business">Business</option>
													<option value="Dining">Dining</option>
													<option value="Education">Education</option>
													<option value="Entertainment">Entertainment</option>
													<option value="Finance">Finance</option>
													<option value="Food">Food and Drink</option>
													<option value="Gaming">Gaming</option>
													<option value="Lifestyle">Lifestyle</option>
													<option value="Local">Local</option>
													<option value="Medical">Medical</option>
													<option value="Music">Music</option>
													<option value="News">News</option>
													<option value="Photo">Photo &amp; Video</option>
													<option value="Security">Security</option>
													<option value="SocialNetworking">Social Networking</option>
													<option value="SocialNetworkingDating">Social Networking (Dating)</option>
													<option value="Sports">Sports</option>
													<option value="Travel">Travel</option>
													<option value="Utilities">Utilities</option></select>
												</div>--}}
												<div class='clearfix'></div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label">Description</label>
												<div class="col-md-8">
													<textarea class="form-control" cols="40" id="application_description"  name="description" rows="4"><?=isset($data->description)?$data->description:null?></textarea>
												</div>
												<div class='clearfix'></div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="facebook_key">Voice Script URL</label>
												<div class="col-md-6">
													<input class="form-control" id="facebook_key" name="uris[0]" size="30" type="text" value="<?=isset($data->voice_script)?$data->voice_script:null?>">
												</div>
												<div class='clearfix'></div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="facebook_secret">SMS Script URL</label>
												<div class="col-md-6">
													<input class="form-control" id="facebook_secret" name="uris[1]" size="30" type="text" value="<?=isset($data->sms_script)?$data->sms_script:null?>">
												</div>
												<div class='clearfix'></div>
											</div>

										</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-sm-2"></div>
														<div class="col-sm-10">
														
															<?php if(!isset($edit)){ ?>
											
																<a href="#" class="btn btn-success create" name="button"  id="saveinfo">Save</a>
														
															<?php }else{ ?>
																<a href="serverapp-listing.php"  class="btn btn-default">Cancel</a>
																<a href="#" id="updateInfo" class="btn btn-success" name="update" >Update</a>
																<a href="#" class="btn btn-danger pull-right" id="removeApp">Remove app
															<?php } ?>

															</a>
														</div>
												</div>
											</div>
										</div>

									</div>
									</form>
								</div>
							</div>
						</div>
						
						
						
						
						
							<?php if(isset($edit)){ ?>
									<div class="row">
										<div class="col-md-8">
											<div class="panel panel-default">
												<div class="panel-heading">Number associated</div>
												<div class="panel-body">

														<table id="example2" class="display">
																			<thead>
																				<tr>
																					<th>#</th>
																					<th>Number</th>
																					<th>Country</th>
																					<th>Area</th>
																					<th>Capabilities</th>
																					<th>Date Purchased</th>
																					<th>Date Expired</th>
																					<th>Price / month</th>
																					<th>Action</th>
																				</tr>
																			</thead>
																			<tbody>
																				

																				
																			 
																			</tbody>
																			<tfoot>
																				<tr>
																					<th>#</th>
																					<th>Number</th>
																					<th>Country</th>
																					<th>Area</th>
																					<th>Capabilities</th>
																					<th>Date Purchased</th>
																					<th>Date Expired</th>
																					<th>Price / month</th>
																					<th>Action</th>
																			 </tr>
																			</tfoot>
																		</table>
												</div>
											</div>
										</div>
									</div>
							<?php } ?>
			</div>
	</div>


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

	<script type="text/javascript" src="{{ asset("/bower_components/admin-lte/myjs/server apps/editServerApps.js") }}"></script>
	<script>
	$(function(){
		$('.kpsubmit').click(function(){
			$('.kpsearch').show();
				setTimeout(function(){
					$('.overlay').hide();
					$('.kptable').fadeIn();
				}, 2000);
			});

		
		$('nav').find('li').click(function(){
			//$('.kptable').hide();
			$('.overlay').show();
			setTimeout(function(){
					$('.overlay').hide();
					$('.kptable').fadeIn();
				}, 2000);
		});
		
		
		var cnt = 0;
		$('.buytable').find('a').click(function(){
			++cnt;
			$(this).text("selected");
			$('.kpbuysummary').slideDown();
			$('.kpselectedtable').append($(this).parent().parent().clone()).find('a').text('remove');
			
			if(cnt>3){
				$('.alert-dismissable').show();
				$('.kp-topup').show();
				$('.kpconfirm-purchase').hide();
			}
		});
		
	})
</script>

 @endsection