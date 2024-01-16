<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="author" content="4zur3">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Login &mdash; NetFlop</title>
	<link rel="shortcut icon" href="<?php echo _DEFAULT_PATH; ?>/assets/images/favicon.svg" type="image/svg+xml" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo _DEFAULT_PATH; ?>/assets/css/login-page.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="my-login-page" <?php if(!empty($valid_msg)){echo 'onload="valid_msg_pop()"';} ?><?php if(!empty($success_msg)){echo 'onload="success_msg_pop()"';} ?>>

	<section class="h-100">
		<div class="brand">
			<a href="<?php echo _DEFAULT_PATH; ?>"><img class="logo-login" src="<?php echo _DEFAULT_PATH; ?>/assets/images/Netflop-logo3.png" alt="logo"></a>
		</div>

			<div class="container h-100">
				<div class="logo-and-form">
					<div class="card-wrapper">
						<div class="card fat">
							<div class="card-body">
								<h2 class="card-title">Login</h2>
								<form method="POST" action="<?php echo _DEFAULT_PATH ?>/login/handling">
									<div class="form-group">
										<label for="username">Username</label>
										<input id="username" type="text" class="form-control" name="username" value="<?php if(!empty($valid_old['username'])){ echo $valid_old['username']; } ?>" required autofocus>
										<div class="invalid-feedback">
											Username is invalid
										</div>
									</div>
	
									<div class="form-group">
										<label for="password">Password</label>
										<input id="password" type="password" class="form-control" name="password" required data-eye>
										<div class="invalid-feedback">
											Password is required
										</div>
									</div>
	
									<div class="form-group m-0">
										<button type="submit" class="btn btn-primary btn-block">
											Login
										</button>
									</div>
									<div class="mt-4 text-center">
										Don't have an account? <a href="<?php echo _DEFAULT_PATH; ?>/register" class="link_creat">Create One!</a>
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
        title: "Login failed!",
    	text: "<?php if(!empty($valid_err['username'])){
			echo $valid_err['username'];
		}elseif(!empty($valid_err['password'])){
			echo $valid_err['password'];
		}else{
			echo $valid_msg;
		} ?>",
        icon: "error"
      });}

	  	function success_msg_pop(){
			Swal.fire({
			title: "Register successfully!",
			text: "<?php if(!empty($success_msg)){ echo $success_msg;} ?>",
			icon: "success"
		});}
    </script>
</body>

</html>