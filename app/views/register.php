<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="author" content="4zur3">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Register &mdash; NetFlop</title>
	<link rel="shortcut icon" href="<?php echo _DEFAULT_PATH; ?>/assets/images/favicon.svg" type="image/svg+xml" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo _DEFAULT_PATH; ?>/assets/css/login-page.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="my-login-page" <?php if(!empty($valid_msg)){echo 'onload="valid_msg_pop()"';} ?>>
	<section class="h-100">
		<div class="brand">
			<a href="<?php echo _DEFAULT_PATH; ?>"><img class="logo-login" src="<?php echo _DEFAULT_PATH; ?>/assets/images/Netflop-logo3.png" alt="logo"></a>
		</div>
			<div class="container h-100">
				<div class="logo-and-form">
					<div class="card-wrapper">
						<div class="card fat">
							<div class="card-body">
								<h2 class="card-title">Register</h2>
								<form method="POST" class="my-login-validation" action="<?php echo _DEFAULT_PATH; ?>/register/handling">
									<div class="form-group">
										<label for="username">Username</label>
										<input id="username" type="text" class="form-control" name="username" value="<?php if(!empty($valid_old['username'])){ echo $valid_old['username']; } ?>" required autofocus>
										<div class="invalid-feedback">
											User Name is invalid
										</div>
									</div>
	
									<div class="form-group">
										<label for="email">E-Mail Address</label>
										<input id="email" type="email" class="form-control" name="email" value="<?php if(!empty($valid_old['email'])){ echo $valid_old['email']; } ?>" required>
										<div class="invalid-feedback">
											Email is invalid
										</div>
									</div>
	
									<div class="form-group">
										<label for="password">Password</label>
										<input id="password" type="password" class="form-control" name="password" required data-eye onkeyup='onChange()'>
										<div class="invalid-feedback">
											Password is required
										</div>
									</div>
	
									<div class="form-group">
										<label for="cfm_password">Comfirm Password
										
										</label>
										<input id="cfm_password" type="password" class="form-control" name="cfm_password" required data-eye onkeyup='onChange()'>
										<div class="invalid-feedback">
											No Match
										</div>
									</div>
	
									<div class="form-group">
										<div class="custom-checkbox custom-control">
											<input type="checkbox" name="remember" id="remember" class="custom-control-input" required>
											<label for="remember" class="custom-control-label">I agree to the <a href="<?php echo _DEFAULT_PATH ?>/about" class="link_creat">Terms and Conditions</a></label>
										</div>
									</div>
	
									<div class="form-group m-0">
										<button type="submit" class="btn btn-primary btn-block">
											Register
										</button>
									</div>
									<div class="mt-4 text-center">
										Already have an account? <a href="<?php echo _DEFAULT_PATH; ?>/login" class="link_creat">Login</a>
									</div>
								</form>
							</div>
						</div>
						<div class="footer">
							Copyright &copy; 2023 NetFlop &mdash; Group 58 ACTVN
						</div>
					</div>
				</div>
			</div>
	</section>

	<script src="<?php echo _DEFAULT_PATH ?>/assets/js/script.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
		crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
		crossorigin="anonymous"></script>
	<script src="<?php echo _DEFAULT_PATH; ?>/assets/js/my-login.js"></script>
	<script>
		function valid_msg_pop(){
			Swal.fire({
			title: "Register failed!",
			text: "<?php if(!empty($valid_err['username'])){
				echo $valid_err['username'];
			}elseif(!empty($valid_err['email'])){
				echo $valid_err['email'];
			}elseif(!empty($valid_err['password'])){
				echo $valid_err['password'];
			}elseif(!empty($valid_err['cfm_password'])){
				echo $valid_err['cfm_password'];
			}else{
				echo $valid_msg;
			} ?>",
			icon: "error"
		});}
    </script>
</body>

</html>