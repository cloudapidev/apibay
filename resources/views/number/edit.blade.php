@extends('admin_template')

@section('content')
<span style="display: none" id="sbuyUrl">{{url('/')}}</span>
<div class="row">
	<div class="col-md-12">
		<form id="editForm" action="{{url('/numbers/release')}}" method="post">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="number" value="{{$details['data']->number}}">
		<input type="hidden" name="developer_id" value="{{$details['data']->developer_id}}">
		<input type="hidden" name="capabilities" value="{{$details['data']->capabilities}}">
		<input type="hidden" name="id" value="{{$details['data']->id}}">
		<div class="row">
			<div class="col-md-8">
				<div class="box box-solid box-default">
					<div class="box-header with-border">
						<h3 class="box-title">{{trans('numbers.Details')}}</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						<dl class="dl-horizontal">
							<dt>{{trans('Phone Number')}}</dt>
							<dd id="number">{{$details['data']->number}}</dd>
							<dt>{{trans('numbers.Country')}}</dt>
							<dd>{{$details['data']->country}}</dd>
							<dt >{{trans('numbers.Capabilities')}}</dt>
							<dd id="capabilities">{{$details['data']->capabilities}}</dd>
							<dt>{{trans('numbers.Price')}}</dt>
							<dd>{{$details['data']->price}} per month</dd>
							<dt>{{trans('numbers.Date Purchased')}}</dt>
							<dd>{{$details['data']->purchased_date}}</dd>
							<dt>{{trans('numbers.Date Expired')}}</dt>
							<dd>{{$details['data']->expired_date}}</dd>
							<dt>{{trans('numbers.Configure With')}}</dt>
							
							<?php if(!empty($details['data']->voice_bind_type)):?>
							<dd id="voice_type" data-value="{{$details['data']->voice_bind_type}}">Voic: {{isset($details['data']->voice_bind_type)?($details['data']->voice_bind_type):null }}</dd>
							<?php endif;?>
							<?php if(!empty($details['data']->message_bind_type)):?>
							<dd id="smg_type" data-value="{{$details['data']->message_bind_type}}">Message:{{isset($details['data']->message_bind_type)?($details['data']->message_bind_type) : null}}</dd>
							<?php endif;?>
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
										<input type="radio"  name="voice[type]" value="SERVER_APP"> {{trans('numbers.Server App')}}
									</label>
								</div>
							</div>
						<!-- 	<div class="col-sm-3">
								<div class="radio">
									<label>
										<input type="radio" name="voice[type]" value="F2NUMBER"> {{trans('numbers.Forward to phone number')}}
									</label>
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="radio">
									<label>
										<input type="radio" name="voice[type]" value="BINDTOUSER">{{trans('numbers.Bind to User')}} 
									</label>
								</div>
							</div>
							-->
							<div class="col-sm-2">
								<div class="radio">
									<label>
										<input type="radio"   name="voice[type]" value="SIPTRUNK"> {{trans('numbers.SIP Trunk')}}
									</label>
								</div>
							</div>
						</div>

						<div class="row SIPTRUNK" style="display:none">
							<div class="col-md-6">
								<div class="box-body">		
									<div class="form-group">
										<label>{{trans('numbers.Select a SIP Trunk Profile')}}</label>
											<select id="select-sip" class="form-control" name="voice[setting][SIPTRUNK]">
												<option value="0">- Select -</option>
												<?php if(!empty($siptrunks['data'])) foreach ($siptrunks['data'] as $trunk):?>
													<?php if(isset($details['data']->voice_config_with) && $trunk['id'] == $details['data']->voice_config_with->id):?>
													<option selected value="{{$trunk['id']}}">{{$trunk['name']}}</option>
													<?php else:?>
													<option value="{{$trunk['id']}}">{{$trunk['name']}}</option>
													<?php endif;?>
												<?php endforeach;?>
											</select>
									</div>
								</div>
							</div>
						</div>
						<div class="row F2NUMBER" style="display:none;">
							<div class="col-md-6">
						
										<div class="box-body">		
											<div class="form-group">
												<label>{{trans('numbers.Enter a phone number to forward')}}</label>
													<input  type="text" class="form-control" placeholder="Enter ...">
											</div>
										</div>
		
							</div>
						</div>
						<div class="row BINDTOUSER" style="display:none;">
							<div class="col-md-6">
						
										<div class="box-body">		
											<div class="form-group">
												<label>{{trans('numbers.Select a user to bind')}}</label>
													<select class="form-control"  >
														<option> - Select - </option>
														<option>Globalroam HQ</option>
														<option>Comfort Delgro Main Number</option>
														<option>Customer Service</option>
													</select>
											</div>
										</div>
		
							</div>
						</div>
						<div class="row SERVER_APP" style="display:none;">
							<div class="col-md-6">
									<div class="box-body">		
										<div class="form-group">
												<label>{{trans('numbers.Select a server app')}}</label>
												<select id='select-server' class="form-control" name="voice[setting][SERVER_APP]" >
													<?php if(!empty($serverapps['data'])){
													foreach($serverapps['data'] as $app){	?>
													<?php if(isset($details['data']->message_config_with) ){?>
													<option selected value="{{$app['id']}}">{{$app['name']}}</option>
													<?php }else{?>
													<option value="{{$app['id']}}">{{$app['name']}}</option>
													<?php }
													}
													}?>

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
					<?php 
					/* $SERVER_APP=false;
					$SIPTRUNK=false;
					if(!empty($details->bind_msg_type))
					{
						$tmp=$details->bind_msg_type;
						$$tmp=true;
					} */	
					?>
						<h3 class="box-title">{{trans('numbers.Messaging')}}</h3>
					</div><!-- /.box-header -->
					<div class="box-body">	
							<div class="row">
								<h4 class="col-sm-8"><i class="fa fa-gear"></i>{{trans('numbers.Configure With')}} </h4>
							</div>
							<div class="row">
							<!-- 	<div class="col-sm-2">
									<div class="radio">
										<label>
											<input type="radio" name="message[type]" value="url">{{trans('numbers.URL')}} 
										</label>
									</div>
								</div> -->
								<div class="col-sm-3">
									<div class="radio">
										<label>
											<input type="radio"  name="message[type]" value="server_sms"> {{trans('numbers.Server App')}}
										</label>
										
									</div>
								</div>
							</div>
							<div class="row url" style="display:none;">
								<div class="col-md-6">
									<div class="box-body">		
										<div class="form-group">
											<label>{{trans('numbers.Enter a url')}}</label>
											<input name="message[setting][url]" type="text" class="form-control" placeholder="Enter ...">
										</div>
									</div>
								</div>
							</div>
							<div class="row server_sms" style="display:none;">
								<div class="col-md-6">
									<div class="box-body">		
										<div class="form-group">
											<label>{{trans('numbers.Select a server app')}}</label>
											<select id='select-server' class="form-control" name="message[setting][server_sms]" >
												<option value="">- Select -</option>

											<?php if(!empty($serverapps['data'])){
													foreach($serverapps['data'] as $app){	?>
												<?php if(isset($details['data']->message_config_with) ){?>
												<option selected value="{{$app['id']}}">{{$app['name']}}</option>
												<?php }else{?>
												<option value="{{$app['id']}}">{{$app['name']}}</option>
												<?php }
												}
												}?>
											</select>
										</div>
									</div>
								</div>
							</div>
					</div>
					<div class="box-footer">
							<div class="pull-left">
									<a href="#" class="savebtn btn bg-maroon btn-flat margin" >{{trans('numbers.Save')}}</a>
							</div>	
							<div class="pull-right">
									<a href="#" class="releasebtn btn btn-danger margin">{{trans('numbers.Release Number')}}</a>
							</div>
					</div>
				</div>
			</div>
		</div>
	</form>
	</div>

</div>
<div class="alert alert-success alert-dismissable" style="display: none" >
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4><i class="icon fa fa-info"></i> Notice</h4>
				<p></p>
</div>
<div class="alert alert-danger alert-dismissable" style="display: none" >
				<button type="button" class="close" data-dismiss="alert"
					aria-hidden="true">×</button>
				<h4>
					<i class="icon fa fa-ban"></i> Notice !
				</h4>
				<p></p>
</div>

 @endsection


 @section('afterfooter')
<script type="text/javascript" src="{{ asset("/bower_components/admin-lte/myjs/numbers/editNumber.js") }}"></script> 
 @endsection