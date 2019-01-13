<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?= $title." - 24/7 AMS"; ?></title>
	<!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap/bootstrap-theme.min.css">
	<link rel="stylesheet" href="assets/css/app/style.css"> -->
	<?= $header; ?>
</head>
<body style="overflow-y: hidden">
	<div class="login-form">
		<div class="col-xs-12 col-sm-offset-4 col-sm-4 col-lg-offset-4 col-lg-4">

			<div class="panel panel-primary" style="border: none;">
			<div class="panel-body" style="padding: 7% 20% 10% 20%;">
                <div class="text-center">
                    <h1 style="font-weight: 600;">LOGIN</h1>
                </div>
                <br>
				<form id="frmLogin">
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-glyphicon glyphicon-envelope"></i></span>
						<input id="username" name="email" class="form-control" type="text" placeholder="E-mail address">
					</div>
                    <br>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-lock"></i></span>
						<input id="password" name="password" class="form-control" type="password" placeholder="Password">
					</div>
				</form><br>
				<p id="notification" class="text-center"></p><br>
				<button id="signIn" class="btn btn-primary btn-block" style="border: none; background: #2196f3;font-weight: 700">SIGN IN</button>
				</div>
			</div>
		</div>
	</div>
	<?= $footer; ?>
	<!-- <script src="assets/js/jquery/jquery.min.js"></script>
	<script src="assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="assets/js/app/login.js"></script>  -->
</body>
</html>