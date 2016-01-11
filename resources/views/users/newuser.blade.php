@extends('admin_template')

@section('content')
<div class="row">
<div class="col-md-12">

<div class="box box-default box-solid">
 
<div class="box-header with-border">
<h3 class="box-title">User Details</h3>
</div><!-- /.box-header -->


<!-- stat box body -->
<div class="box-body" >
<div class="row">

<form class="form-horizontal">
	
<div class="left-col col-md-6">
		<div class="form-group">
		<label class="control-label col-sm-3" for="user_full_name">Full Name</label>
		<div class="col-sm-9">
															<input class="form-control" id="user_full_name" name="user[full_name]" size="30" type="text" value="<?=$data['fullname']?>">
																	</div>
													</div>
																	<div class="form-group">
																	<label class="control-label col-sm-3" for="user_email">Email **</label>
																	<div class="col-sm-9">
																	<input class="form-control" id="user_email" name="user[email]" size="30" type="text" value="<?=$data['email']?>">
																			</div>
																					</div>
																					<div class="form-group">
																					<label class="control-label col-sm-3" for="user_login">Login **</label>
														<div class="col-sm-9">
														<input class="form-control" id="user_login" name="user[login]" size="30" type="text" value="<?=$data['login']?>">
																</div>
																</div>
																<div class="form-group">
																<label class="control-label col-sm-3" for="user_password">Password</label>
																<div class="col-sm-9">
																<input class="form-control" id="user_password" name="user[password]" required="required" size="30" type="password" aria-required="true" value="<?=$data['password']?>">
																</div>
																</div>
																<div class="form-group">
																<label class="control-label col-sm-3" for="user_password_confirmation">Confirm</label>
																		<div class="col-sm-9">
																		<input class="form-control" id="user_password_confirmation" name="user[password_confirmation]" size="30" type="password" value="<?=$data['password']?>">
																		</div>
																		</div>
																		<div class="form-group">
																				<label class="control-label col-sm-3" for="user_phone">Phone</label>
																				<div class="col-sm-9">
																				<input class="form-control" id="user_phone" name="user[phone]" size="30" type="text" value="<?=$data['phone']?>">
																				</div>
																				</div>
																				<div class="form-group">
														<label class="control-label col-sm-3" for="user_website">Website</label>
																<div class="col-sm-9">
																		<input class="form-control" id="user_website" name="user[website]" size="30" type="text" value="<?=$data['website']?>">
																		</div>
																		</div>
																		<div class="form-group">
																				<label class="control-label col-sm-3" for="user_blob_id">Blob ID</label>
																				<div class="col-sm-9">
																				<input class="form-control" id="user_blob_id" name="user[blob_id]" size="30" type="text">
																				</div>
																						</div>
																						<div class="form-group">
																								<label class="control-label col-sm-3" for="user_external_user_id">External ID</label>
																										<div class="col-sm-9">
																												<input class="form-control" id="user_external_user_id" name="user[external_user_id]" size="30" type="text">
																														</div>
													</div>
																														<div class="form-group">
																														<label class="control-label col-sm-3" for="user_facebook_id">Facebook ID</label>
																														<div class="col-sm-9">
																														<input class="form-control" id="user_facebook_id" name="user[facebook_id]" size="30" type="text" value="<?=$data['facebook']?>">
																														</div>
																														</div>
													<div class="form-group">
																														<label class="control-label col-sm-3" for="user_twitter_id">Twitter ID</label>
																														<div class="col-sm-9">
																														<input class="form-control" id="user_twitter_id" name="user[twitter_id]" size="30" type="text" value="<?=$data['twitter']?>">
																																</div>
																																</div>

																																	
							
																																</div>
																																<div class="col-md-6">
														<div id="tags-wrap">
																																<label for="Tags">Tags</label>
																																<div class="tags-container">
																																<div id="add_tags">
																																<input id="tags" name="user[tag_list]" value="" style="display: none;"><div id="tags_tagsinput" class="tagsinput" style="width: 100%; min-height: 34px; height: 100%;"><div id="tags_addTag"><input id="tags_tag" value="" data-default="" style="color: rgb(102, 102, 102); width: 67.7778px;"></div><div class="tags_clear"></div></div>
																																</div>
																																<div id="tags-hint"></div>
																																</div>
																																</div>
																																<div id="popular-tags-wrap">
																																<label for="Popular_tags">Popular tags</label>
																																<div class="popular-tags">
																																<p>No popular tags yet</p>
																																</div>
																																</div>
																																<div class="row" id="data">
																																<div class="col-sm-12">
																																<label for="Custom_data">Custom data</label>
																																		<textarea class="form-control" cols="40" id="user_custom_data" name="user[custom_data]" rows="10"></textarea><br />
																																				</div>
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
																																				** Only one field is required
																																				<div class="spacer"></div>
																																				<a href="user-listing.php?success" class="btn btn-default" name="commit" onclick="gHistoryBack()" type="submit" value="">Cancel </a>
																																				<a href="user-listing.php?success" class="btn btn-success" id="user_submit" name="commit" type="submit" value="Add user">Submit</a>
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
																																					
																																					
																																					
																																				<div class="row kpsearch" style="display:none;">
																																				<div class="col-md-12">
																																				<div class="box box-solid container-fluid">
																																					
																																				<div class="box-header with-border">
																																				<h3 class="box-title">Search Results</h3>
																																				</div><!-- /.box-header -->
																																				<div class="box-body buytable table-responsive" >
																																				<table class="table kptable table-striped datatable" style="display:none;">
																																				<thead>
																																				<tr>
																																				<th>No</th>
																																				<th>Country</th>
																																				<th>Area</th>
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
																																						<td>Johor</td>
																																						<td>+6012345664</td>
																																						<td>Voice</td>
																																						<td>$64.50</td>
																																								<td>
																																								<a class="btn btn-default">Buy</a>
																																										</td>
																																										</tr>
																																										<tr>
																																										<td>2</td>
																																										<td>Singapore</td>
																																										<td>-</td>
																																										<td>+65612345664</td>
																																										<td>SMS</td>
																																												<td>$50.00</td>
																																												<td>
																																												<a  class="btn btn-default">Buy</a>
																																												</td>
																																												</tr>
																																														<tr>
																																														<td>3</td>
												<td>Singapore</td>
												<td>-</td>
												<td>+65612345667</td>
												<td>Voice+SMS</td>
												<td>$10.70</td>
												<td>
													<a  class="btn btn-default">Buy</a>
												</td>
											</tr>
											<tr>
												<td>4</td>
												<td>China</td>
												<td>Cheng Du</td>
												<td>+86612345664</td>
												<td>Voice</td>
												<td>$25.99</td>
												<td>
													<a  class="btn btn-default">Buy</a>
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
											</uldefault
										</nav>
									</div>
								</div>


							</div>
						</div>
					</div>
			

			
					<div class="row kpbuysummary"  style="display:none;">
						<div class="col-md-12">

							<section class="invoice" style=''>
							<!-- title row -->
							<div class="row">
								<div class="col-xs-12">
									<h2 class="page-header">
										<i class="fa fa-globe"></i> Purchase total
										<small class="pull-right">Date: <?=date("d/m/Y")?></small>
									</h2>
								</div><!-- /.col -->
							</div>
							<!-- info row -->
					 

          
          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6 table-responsive">
							 <p class="lead">Item</p>
							<table class="table table-striped table-condensed cf">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Country</th>
                    <th>Area</th>
                    <th>Number</th>
                    <th>Capabilities</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody class="kpselectedtable">
                  
                </tbody>
              </table>
            </div><!-- /.col -->
            <div class="col-xs-6">
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
                    <th>Total:</th>
                    <td>$265.24</td>
                  </tr>
									
									 <tr>
                    <th>Your current available credit:</th>
                    <td>$300.00</td>
                  </tr>
									
									<tr>
                    <th>Your Available Credit After checkout:</th>
                    <td>$34.76</td>
                  </tr>
									
                </tbody></table>
              </div>
            </div><!-- /.col -->
          </div><!-- /.row -->
					
					<div class="alert alert-danger alert-dismissable" style="display:none;">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-ban"></i> Alert!</h4>
						Your credit balance is insufficient, please topup your amount first in order to proceed.
					</div>
					
					<div class="row no-print kpconfirm-purchase">
            <div class="col-xs-12">
              <a href="number-listing.php?success" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Confirm Purchase</a>
            </div>
          </div>

          <!-- this row will not appear when printing -->
          <div class="row no-print kp-topup" style="display:none;">
            <div class="col-xs-12">
              <a href="number-confirm.php" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Topup Balance</a>
            </div>
          </div>
        </section>

						
						
						
						</div>
					</div>
					
@endsection