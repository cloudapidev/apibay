@extends('admin_template')

@section('content')
  <div class="row">
					<div class='col-md-12'>

			
				
						
						<div class="row">
							<div class="col-md-8">
								<div class="panel panel-default">
									<div class="panel-heading">Edit Server Apps</div>
									<div class="panel-body">
									
										<div class="row">
										<div class="col-md-12">

											<div class="form-group">
												<label class="col-sm-3 control-label" for="application_title">Server App Name</label>
												<div class="col-md-9">
												<input class="form-control valid" focus="focus" id="application_title" name="application[title]" onfocus="this.value = this.value;" required="required" size="30" type="text" value="<?=$data['name']?>" aria-required="true" aria-invalid="false">
												</div>
												<div class='clearfix'></div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="application_url">App Status</label>
												<div class="col-md-6">
													<select class="form-control">
														<option>Development</option>
														<option>Production</option>
													</select>
												</div>
												<div class='clearfix'></div>
											</div>
										
											<div class="form-group">
												<label class="col-sm-3 control-label" for="application_type">Type</label>
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
												</div>
												<div class='clearfix'></div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="application_description">Description</label>
												<div class="col-md-8">
													<textarea class="form-control" cols="40" id="application_description" name="application[description]" rows="4"><?=$data['description']?></textarea>
												</div>
												<div class='clearfix'></div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="facebook_key">Voice Script URL</label>
												<div class="col-md-6">
													<input class="form-control" id="facebook_key" name="facebook[key]" size="30" type="text" value="<?=$data['voice_script']?>">
												</div>
												<div class='clearfix'></div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="facebook_secret">SMS Script URL</label>
												<div class="col-md-6">
													<input class="form-control" id="facebook_secret" name="facebook[secret]" size="30" type="text" value="<?=$data['sms_script']?>">
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
														
															<?php if(!isset($_GET['edit'])){ ?>
											
																<a href="serverapp-new.php?edit&id=1" class="btn btn-success" name="button" type="submit">Save</a>
														
															<?php }else{ ?>
																<a href="serverapp-listing.php"  class="btn btn-default">Cancel</a>
																<a href="serverapp-new.php?edit&id=1" class="btn btn-success" name="button" type="submit">Update</a>
																<a href="serverapp-listing.php" class="btn btn-danger pull-right" >Remove app
															<?php } ?>

															</a>
														</div>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
						
						
						
						
						
							<?php if(isset($_GET['edit'])){ ?>
									<div class="row">
										<div class="col-md-8">
											<div class="panel panel-default">
												<div class="panel-heading">Number associated</div>
												<div class="panel-body">
													
													<table id="example1" class="datatabsle table table-bordered table-striped table-condensed cf">
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
																				
																				<?php $cnt=0; foreach(openCSV("number-listing") as $key=>$item){ ++$cnt;?>
																				<tr>
																					<td><?=$cnt ?></td>
																					<td><?=$item['number']?></td>
																					<td><?=$item['country']?></td>
																					<td><?=$item['area']?></td>
																					<td><?=$item['capability']?></td>
																					<td><?=$item['date_purchase']?></td>
																					<td><?=$item['date_expire']?></td>
																					<td><?=$item['price']?></td>
																					<td>
																						<a href="number-edit.php?edit&id=<?=$item['id']?>" class="btn btn-default">Manage</a>
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
																					<th>Date Purchased</th>
																					<th>Date Expired</th>
																					<th>Price / month</th>
																					
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
					
				
@endsection
@section('afterfooter')
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