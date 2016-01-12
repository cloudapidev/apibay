@extends('admin_template')
@section('content')
	<div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="dist/img/user2-160x160.jpg" alt="User profile picture">
                  <h3 class="profile-username text-center">Alexandre Pierce</h3>
                  <p class="text-muted text-center">Web Developer</p>

                </div><!-- /.box-body -->
              </div><!-- /.box -->

            
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#settings" data-toggle="tab">Details</a></li>
                  <li class="actaive"><a href="#api" data-toggle="tab">API Credentials</a></li>
                </ul>
                <div class="tab-content">

                  <div class="active tab-pane" id="settings">
                    <form class="form-horizontal">
											
											<h3>Main details</h3>
										
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name" value="Alexandre Pierce">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="keeperng@gmail.com" readonly>
                        </div>
                      </div>
											
											<div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Verify Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="OTP Code"  >
													<a href="#">Resend email verification</a>
                        </div>
                      </div>
											
											
											<div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Mobile Number</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="eg. +6584983919"  >
													<span class="badge bg-green">Verified</span>
													<span class="badge bg-red">Unverified</span>
													<p class="help-block">You need to have a verified mobile number in order to purchase new number</p>
                        </div>
                      </div>
											
											<div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Verify Mobile Number</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="OTP Code"  >
													<a href="#">Send OTP verification</a>
                        </div>
                      </div>
											
											<hr />
											
											<h3>Company Details</h3>
											
											 <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Company Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="eg. aBc12#4!"  >
                        </div>
                      </div>
											
											<div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Company Address</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" rows="5"></textarea>
                        </div>
                      </div>
											
											<div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Contact Person Phone number</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="eg: +6584983919"  >
                        </div>
                      </div>
											
											<div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Contact Person Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="eg: admin@globalroam.com"  >
                        </div>
                      </div>
											
											
											<hr />
											
											<h3>Change Password</h3>
											
											 <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="eg. aBc12#4!"  >
													<p class="help-block">Leave blank if you are not intended to change current password</p>
                        </div>
                      </div>
											<div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">New Password</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder=""  >
													<p class="help-block">Leave blank if you are not intended to change current password</p>
                        </div>
                      </div>
											<div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Confirm New Password</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder=""  >
													<p class="help-block">Leave blank if you are not intended to change current password</p>
                        </div>
                      </div>
											
											<hr />

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-flat bg-maroon">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->
									
									
									<div class="tab-pane" id="api">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Account ID</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" readonly id="inputName" placeholder="AC399a344fbc3c94f4b32bb660782cf032">
                        </div>
                      </div>
											<div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">API Key</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" readonly id="inputName" placeholder="74bdab7c48944ed42c301d7ffd5b2bc1">
                        </div>
                      </div>
                     
                    </form>
                  </div><!-- /.tab-pane -->
									
									
									
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->
					
@endsection
@section('afterfooter')
@endsection