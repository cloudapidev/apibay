@extends('admin_template')
@section('content')
  <div class="row">
					<div class='col-md-12'>
					
					<div class='col-md-2 col-nav modules-menu'>
	
							<div class='list-group' id='app-list'>
								<a href="/apps/30527/edit" class="list-group-item active" title="Edit app"><i class='qbico qb-cog'>
								Overview
								</i>
								</a><a href="/apps/30527/service/chat/dialogs" class="list-group-item <?=isset($_GET['edit'])?"":"disabled"?>" title="Click here to use Chat Module for this app"><i class='qbico qb-qbchat'>
								Chat 
								</i>
								</a>
								<a href="/apps/30527/service/content" class="list-group-item <?=isset($_GET['edit'])?"":"disabled"?>" title="Click here to use Content Module for this app"><i class='qbico qb-qbcontent'>
								Content
								</i>
								</a>
								<a href="/apps/30527/service/custom" class="list-group-item <?=isset($_GET['edit'])?"":"disabled"?>" title="Click here to use Custom Module for this app"><i class='qbico qb-qbcustom'>
								Custom
								</i>
								</a>
								<a href="/apps/30527/service/location" class="list-group-item <?=isset($_GET['edit'])?"":"disabled"?>" title="Click here to use Location Module for this app"><i class='qbico qb-qblocation'>
								Location
								</i>
								</a>
								<a href="/apps/30527/service/push-notifications" class="list-group-item <?=isset($_GET['edit'])?"":"disabled"?>" title="Click here to use Push notifications Module for this app"><i class='qbico qb-qbpush-notifications'>
								Push notifications
								</i>
							</a>
							<a href="/apps/30527/service/users" class="list-group-item <?=isset($_GET['edit'])?"":"disabled"?>" title="Click here to use Users Module for this app"><i class='qbico qb-qbusers'>
								Users
							</i>
							</a>
							</div>
							<div class='clearfix'></div>
					</div>
				
					<div class="col-md-8">
							
							<div class='panel panel-default'>
								<div class='panel-heading'>Credentials</div>
								<div class='panel-body'>
								
								
								<div class='form-group'>
									<label class='col-md-2 control-label' for='app_id'>Application ID</label>
									<div class='col-md-6'>
										<input class='copy-field form-control' id='app_id' name='app_id' readonly='readonly' type='text' value='30527'>
									</div>
									<div class='col-md-2'>
										<a class='clipboard' href='#' id='c_app_id' title='Click here to copy value'>
											<span>Copy to clipboard</span>
										</a>
									</div>
									<div class='clearfix'></div>
								</div>
								
								
								<div class='form-group'>
									<label class='col-md-2 control-label' for='app_auth_key'>Authorization key</label>
									<div class='col-md-6'>
										<input class='copy-field form-control' id='app_auth_key' name='app_auth_key' readonly='readonly' type='text' value='7J3jsYqQUxOdg7Z'>
									</div>
									<div class='col-md-2'>
										<a class='clipboard' href='#' id='c_app_auth_key' title='Click here to copy value'>
										<span>Copy to clipboard</span>
										</a>
									</div>
									<div class='clearfix'></div>
								</div>
								
								
								<div class='form-group'>
									<label class='col-md-2 control-label' for='app_auth_secret'>Authorization secret</label>
									<div class='col-md-6'>
										<input class='copy-field form-control' id='app_auth_secret' name='app_auth_secret' readonly='readonly' type='text' value='hMQGA2PF-Jb5hKH'>
									</div>
									<div class='col-md-2'>
										<a class='clipboard' href='#' id='c_app_auth_secret' title='Click here to copy value'>
										<span>Copy to clipboard</span>
										</a>
									</div>
									
								</div>
					
					
						
								
						
					
						</div>
					</div>
				</div>
				
				
				
				<div class="row">
					<div class="col-md-8">
						<div class="panel panel-default">
							<div class="panel-heading">Edit application</div>
							<div class="panel-body">
							
								<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="col-sm-2 control-label" for="application_Image">Image</label>
										<div class="col-sm-6 type-file">
											<input class="inputFile" id="avatar_file" name="avatar[file]" type="file" size="12">
											<input class="fileName form-control" id="" name="" readonly="readonly" type="text">
											<div class="box-loading">
												<span class="inline-loading"></span>
											</div>
										</div>
										<div class="col-md-2">
											<div class="choose">
											
											</div>
										</div>
										<div class="col-md-1">
										
										</div>
										<div class='clearfix'></div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="application_title">* Title</label>
										<div class="col-md-6">
										<input class="form-control valid" focus="focus" id="application_title" name="application[title]" onfocus="this.value = this.value;" required="required" size="30" type="text" value="KP APP" aria-required="true" aria-invalid="false">
										</div>
										<div class='clearfix'></div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="application_url">Website</label>
										<div class="col-md-6">
										<input class="form-control" id="application_url" name="application[url]" size="30" type="text">
										</div>
										<div class='clearfix'></div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="application_store_link">App store link</label>
											<div class="col-md-6">
											<input class="form-control" id="application_app_store_link" name="application[app_store_link]" size="30" type="text" value="">
										</div>
										<div class='clearfix'></div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="application_type">* Type</label>
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
										<label class="col-sm-2 control-label" for="application_description">Description</label>
										<div class="col-md-8">
											<textarea class="form-control" cols="40" id="application_description" name="application[description]" rows="4"></textarea>
										</div>
										<div class='clearfix'></div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="facebook_key">Facebook App Id</label>
										<div class="col-md-6">
											<input class="form-control" id="facebook_key" name="facebook[key]" size="30" type="text" value="">
										</div>
										<div class='clearfix'></div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="facebook_secret">Facebook Secret</label>
										<div class="col-md-6">
											<input class="form-control" id="facebook_secret" name="facebook[secret]" size="30" type="text" value="">
										</div>
										<div class='clearfix'></div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="twitter_key">Twitter Key</label>
										<div class="col-md-6">
											<input class="form-control" id="twitter_key" name="twitter[key]" size="30" type="text" value="">
										</div>
										<div class='clearfix'></div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label" for="twitter_secret">Twitter Secret</label>
											<div class="col-md-6">
												<input class="form-control" id="twitter_secret" name="twitter[secret]" size="30" type="text" value="">
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
									
														<a href="clientapp-new.php?edit" class="btn btn-success" name="button" type="submit">Save</a>
												
													<?php }else{ ?>
														<a href="clientapp-listing.php"  class="btn btn-default">Cancel</a>
														<a href="clientapp-new.php?edit" class="btn btn-success" name="button" type="submit">Update</a>
														<a href="clientapp-listing.php" class="btn btn-danger pull-right" onclick="deleteApp(&quot;/apps/30527/destroy&quot;, this, 'Are you sure you want to delete the application &quot;KP APP&quot; and all its data? There is no undo.')">Remove app
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