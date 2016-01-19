<?php
	$data = @getData("number-listing",$id);
?>

@extends('admin_template')

@section('content')

        <div class="row">
					<div class="col-md-12">
				

        
									<div class="row">	
										<div class="col-md-8">
											<div class="box box-solid box-default">
												<div class="box-header with-border">
													<h3 class="box-title">{{trans('numbers.Details')}}</h3>
												</div><!-- /.box-header -->
												<div class="box-body">
													<dl class="dl-horizontal">
														<dt>{{trans('Phone Number')}}</dt>
														<dd><?=$data['number']?></dd>
														<dt>{{trans('numbers.Country')}}</dt>
														<dd><?=$data['country']?></dd>
														<dt>{{trans('numbers.Capabilities')}}</dt>
														<dd><?=$data['capability']?></dd>
														<dt>{{trans('numbers.Price')}}</dt>
														<dd><?=$data['price']?> per month</dd>
														<dt>{{trans('numbers.Date Purchased')}}</dt>
														<dd><?=$data['date_purchase']?></dd>
														<dt>{{trans('numbers.Date Expired')}}</dt>
														<dd><?=$data['date_expire']?></dd>
														<dt>{{trans('numbers.Configure With')}}</dt>
														<dd>{{trans('numbers.SIP Trunking')}}</dd>
														<dd>sip:kp@sip.com</dd>
													</dl>
												</div><!-- /.box-body -->
											</div><!-- /.box -->
										</div>
									</div>
									
									<div class="row">	
										<div class="col-md-8">
												<div class="box box-solid">
													<div class="box-header with-border">
														<h3 class="box-title">{{trans('numbers.Voice')}}</h3>
													</div><!-- /.box-header -->
												
												<div class="box-body">	
													<div class="row">
																					<h4 class="col-sm-8"><i class="fa fa-gear"></i>{{trans('numbers.Configure With')}} </h4>
																				</div>
																				
																				<div class="row">
																					<div class="col-sm-2">
																						<div class="radio">
																							<label>
																								<input type="radio" name="check[]" value="server"> {{trans('numbers.Server App')}}
																							</label>
																						</div>
																					</div>
																					
																					<div class="col-sm-3">
																						<div class="radio">
																							<label>
																								<input type="radio" name="check[]" value="pstn"> {{trans('numbers.Forward to phone number')}}
																							</label>
																						</div>
																					</div>
																					
																					<div class="col-sm-3">
																						<div class="radio">
																							<label>
																								<input type="radio" name="check[]" value="account">{{trans('numbers.Bind to User')}} 
																							</label>
																						</div>
																					</div>
																					
																					<div class="col-sm-2">
																						<div class="radio">
																							<label>
																								<input type="radio" name="check[]" value="sip"> {{trans('numbers.SIP Trunk')}}
																							</label>
																						</div>
																					</div>
																					
																				</div>
																				
																				
																				<div class="row sip" style="display:none;">
															<div class="col-md-6">
														
																		<div class="box-body">		
																			<div class="form-group">
																				<label>{{trans('numbers.Select a SIP Trunk Profile')}}</label>
																				
																
																					<select id="select-sip" class="form-control">
																						<option value="">- Select -</option>
																						<?php $cnt=0; foreach(openCSV("siptrunk-listing") as $key=>$item){ ++$cnt;?>
																							<option value="<?=$item["name"]?>"><?=$item["name"]?></option>
																						<?php } ?>
																					</select>
																	
																				
																			</div>
																		</div>
										
															</div>
														</div>
														
														
														<div class="row pstn" style="display:none;">
															<div class="col-md-6">
														
																		<div class="box-body">		
																			<div class="form-group">
																				<label>{{trans('numbers.Enter a phone number to forward')}}</label>
																					<input type="text" class="form-control" placeholder="Enter ...">
																			</div>
																		</div>
										
															</div>
														</div>
														
														<div class="row account" style="display:none;">
															<div class="col-md-6">
														
																		<div class="box-body">		
																			<div class="form-group">
																				<label>{{trans('numbers.Select a user to bind')}}</label>
																					<select class="form-control">
																						<option> - Select - </option>
																						<option>Globalroam HQ</option>
																						<option>Comfort Delgro Main Number</option>
																						<option>Customer Service</option>
																					</select>
																			</div>
																		</div>
										
															</div>
														</div>
														
														
														
														<div class="row server" style="display:none;">
															<div class="col-md-6">
																	<div class="box-body">		
																		<div class="form-group">
																				<label>{{trans('numbers.Select a server app')}}</label>
																				<select id='select-server' class="form-control">
																					<option value="">- Select -</option>
																					<option value="1">GR IVR</option>
																					<option value="1">GR Call Recording</option>
																					<option value="1">Number masking to L6</option>
																				</select>
																		</div>
																	</div>
															</div>
														</div>
																				
												</div>
											</div>
										</div>
									</div>
										
										
										
										<div class="row">	
										<div class="col-md-8">
										
										
										
												<div class="box box-solid">
													<div class="box-header with-border">
														<h3 class="box-title">{{trans('numbers.Messaging')}}</h3>
													</div><!-- /.box-header -->
												
												<div class="box-body">	
														<div class="row">
															<h4 class="col-sm-8"><i class="fa fa-gear"></i>{{trans('numbers.Configure With')}} </h4>
														</div>
														
														<div class="row">
															<div class="col-sm-2">
																<div class="radio">
																	<label>
																		<input type="radio" name="checks[]" value="url">{{trans('numbers.URL')}} 
																	</label>
																</div>
															</div>
															
															<div class="col-sm-3">
																<div class="radio">
																	<label>
																		<input type="radio" name="checks[]" value="server_sms"> {{trans('numbers.Server App')}}
																	</label>
																	
																</div>
															</div>

														</div>
																				
											
																		
													<div class="row url" style="display:none;">
															<div class="col-md-6">
														
																		<div class="box-body">		
																			<div class="form-group">
																				<label>{{trans('numbers.Enter a url')}}</label>
																				<input type="text" class="form-control" placeholder="Enter ...">
																	
																				
																			</div>
																		</div>
										
															</div>
														</div>
														
														
														<div class="row server_sms" style="display:none;">
															<div class="col-md-6">
														
																		<div class="box-body">		
																			<div class="form-group">
																				<label>{{trans('numbers.Select a server app')}}</label>
																				<select id='select-server' class="form-control">
																					<option value="">- Select -</option>
																					<option value="1">GR IVR</option>
																					<option value="1">GR Call Recording</option>
																					<option value="1">Number masking to L6</option>
																				</select>
																			</div>
																		</div>
																		
																		
										
															</div>
														</div>
														
										
												
												
											</div>
											
												<div class="box-footer">
													
						
														<div class="pull-left">
																<a href="number-listing.php" class="btn bg-maroon btn-flat margin">{{trans('numbers.Save')}}</a>
														</div>	
														
														<div class="pull-right">
																<a href="number-listing.php" class="btn btn-danger margin">{{trans('numbers.Release Number')}}</a>
														</div>
								
													
												</div>
		
												</div>
												
												
											
											
										</div>
									</div>
									
								</form>
	

					</div>
				</div>

 @endsection


 @section('afterfooter')

	<script>
				$(function(){
					
					//start select sip profile
					$('#select-sip').change(function(){
						var val = $(this).val();
						if(val!=""){
							$(".sipprofile").fadeIn();
						}else
							$(".sipprofile").fadeOut();
					});
					//end select sip profile
					
					
					//start select server app
					$('#select-server').change(function(){
						var val = $(this).val();
						if(val!=""){
							$(".selectserver").fadeIn();
						}else
							$(".selectserver").fadeOut();
					});
					//end select server app
					
					
					
					//start select configure type
					$('input[type=radio] , .radio label , .radio label ins').click(function(){

						var val = $(this).attr("value");

						if($(this).parent().hasClass('radio') || $(this).parent().parent().hasClass('radio'))
							val = $(this).find("input[type=radio]").attr("value");
					
					
						if($(this).hasClass('iCheck-helper'))
							val = $(this).parent().find("input[type=radio]").attr("value");
			
						
						if(val == "sip" || val == "server" || val == "pstn" || val == "account"){
							$('.sip').hide();
							$('.server').hide();
							$('.pstn').hide();
							$('.account').hide();
						}
						
						if(val == "url" || val == "server_sms"){
							$('.url').hide();
							$('.server_sms').hide();
						}

						$('.'+val).fadeIn();
							
					});
					
					
					
					
				})

			</script>


  @endsection