<!doctype html>
<html lang="en">
<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<link rel="shortcut icon" href="img/favicon.ico" />
		<title>Login - School Revenue</title>
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/icomoon.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
      

	</head>  

	<body class="login-bg">
			
		<div class="container">
			<div class="login-screen row align-items-center">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    {{-- @include('partials._messages') --}}
					<form action="{{ route('login.verify_credentials') }}">
						<div class="login-container">
							<div class="row no-gutters">
								<div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
									<div class="login-box">
										{{-- <a href="#" class="login-logo">
											<img src="img/unify.png" alt="Unify Admin Dashboard" />
										</a> --}}
										<div class="input-group">
											<span class="input-group-addon" id="email"><i class="icon-account_circle"></i></span>
											<input type="email" class="form-control" placeholder="email" aria-label="email" aria-describedby="email" required autofocus>
										</div>
										<br>
										<div class="input-group">
											<span class="input-group-addon" id="password"><i class="icon-verified_user"></i></span>
											<input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password">
										</div>
										<div class="actions clearfix">
											<a href="forgot-pwd.html">Lost password?</a>
											<button type="submit" class="btn btn-primary">Login</button>
										</div>
										<div class="or"></div>
										{{-- <div class="mt-4">
											<a href="signup.html" class="additional-link">Don't have an Account? <span>Create Now</span></a>
										</div> --}}
									</div>
								</div>
								<div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
									<div class="login-slider"></div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<footer class="main-footer no-bdr fixed-btm">
			<div class="container">
				Copyright School Revenue {{ date('Y') }}.
			</div>
		</footer>
	</body>
</html>