<div class="container">
	<div class="row">
		<div class="login-container">
			<div class="logo-footnote">
				<img src="<?=BASE_URL?>assets/images/footnote-logo-200x200.png" class="img-circle" width="100" height="100"/>
			</div>
			<div id="login-container" class="col-sm-12 col-md-10 col-md-offset-1">
				<h2 class="text-center">Login</h2>
				<form action="<?=BASE_URL?>account/login" method="post" autocomplete="off" data-toggle="validator" role="form">
					<div class="form-group has-feedback">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input class="form-control" type="text" id="username" name='username' placeholder="Username" required/>
						</div>
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group has-feedback">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input class="form-control" type="password" id="password" name='password' placeholder="Password" required/>
						</div>
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						<div class="help-block with-errors"></div>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="remember" value="true"> Remember me
						</label>
					</div>
					<?php if(http_getParam('error') == 1) : ?>
					<div class="alert alert-danger">
						<strong>Error!</strong> Invalid username or password.
					</div>
					<?php endif; ?>
					<div class="form-group">
						<button type="submit" class="btn btn-def btn-block" >Login</button>
					</div>
					<div class="form-group text-center">
						<a href="#">Forgot Password</a>&nbsp;|&nbsp;<a href="" data-options="register-container" data-callback="hide|login-container" >Register</a>
					</div>
				</form>
			</div>

			<div id="register-container" class="col-sm-12 col-md-10 col-md-offset-1 hide">
				<h2 class="text-center">Register</h2>
				<form name="registerForm" method="post" autocomplete="off" data-toggle="validator" ng-submit="registerUser()" role="form">
					<div class="form-group has-feedback">
						<input class="form-control" type="text" name='username' placeholder="Username" ng-model="formDataRegUserInfo.username" required/>
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group has-feedback">
						<input class="form-control" type="email" name='email' placeholder="Email" required data-error="Invalid email address." ng-model="formDataRegUserInfo.email"/>
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group has-feedback">
						<input id="register-password" class="form-control" type="password" name='password' placeholder="Password" ng-model="formDataRegUserInfo.password" required/>
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group has-feedback">
						<input id="confirm-password" class="form-control" type="password" name='password_v' placeholder="Confirm Password" ng-model="formDataRegUserInfo.password_v" data-match="#register-password" required data-match-error="Oops, password did not match."/>
						<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
						<div class="help-block with-errors"></div>
					</div>
					<div data-loading>
						<i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i> Processing. Please wait...
					</div>
					<div class="alert alert-info" ng-show="userRegFeedback">
						{{userRegFeedback.message }}
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-def btn-block" >Register</button>
					</div>
					<div class="form-group text-center">
						<a href="" data-options="login-container" data-callback="hide|register-container">Login</a>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>