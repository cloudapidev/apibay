<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>APIBay | Registration Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/bootstrap/css/bootstrap.min.css") }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/dist/css/AdminLTE.min.css") }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset("/bower_components/admin-lte/plugins/iCheck/square/blue.css") }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo">
        <a href="./index.php?logged=true"><b>API</b>Bay</a>
      </div>

			
      <div class="register-box-body">
			
			<?php if(isset($_GET['failregister'])){ ?>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-info"></i> Validation Error</h4>
					<ul>
						<li>Full Name cannot be empty</li>
						<li>You are already a member ( email existed in our system ), please click "I already have a membership" to proceed login</li>
						<li>Password at least 6 characters</li>
						<li>Retype Password must be identical with Password</li>
						<li>Please check "I agree to the terms"</li>
					</ul>
				</div>
			<?php } ?>
			
        <p class="login-box-msg">Register a new membership</p>
        <form id='registerForm' action="{{url('postregister')}}" method="post">
					<input type="hidden" name="failregister" value="1">
					<input type="hidden" name="_token"         value="{{csrf_token()}}"/>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Full name" name='full_name' value=''>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name='email' value='' >
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" id="password" name='password' >
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Retype password" id="repassword" name='repassword'>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox" name='accept'> I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
						
			<!--  				<?php if(isset($_GET['failregister'])){ ?>
								<a href="login.php?successregister" type="submit" class="btn btn-primary btn-block btn-flat">Register</a>
							<?php }else{ ?>
								<a href="register.php?failregister" type="submit" class="btn btn-primary btn-block btn-flat">Register</a>
							<?php } ?>
							
							-->
            </div>
            <div class="col-xs-4">
       			<input type="submit" class="btn btn-primary btn-block btn-flat" value='Register'>
       		</div>
          </div>
       		
        </form>

        <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="login.php?successregister" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
          <a href="login.php?successregister" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
        </div>

        <a href="{{url("login")}}" class="text-center">I already have a membership</a>
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset("/bower_components/admin-lte/plugins/jQuery/jQuery-2.1.4.min.js")}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset("/bower_components/admin-lte/bootstrap/js/bootstrap.min.js")}}"></script>
    <!-- iCheck -->
    <script src="{{ asset("/bower_components/admin-lte/plugins/iCheck/icheck.min.js")}}"></script>
    <script src="{{ asset("/bower_components/admin-lte/plugins/validate/jquery.validate.min.js")}}"></script>
    <script src="{{ asset("/bower_components/admin-lte/myjs/login.js")}}"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });        
      });
    </script>
  </body>
</html>
