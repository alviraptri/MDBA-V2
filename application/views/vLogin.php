<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login MDBA</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="WaterOut">
	<meta name="author" content="ICT">
	<meta name="keyword" content="TVIP,ASA">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/icon/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/fonts/iconic/css/material-design-iconic-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/login/css/main.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/sweetalert2.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fontawesome/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<!--===============================================================================================-->
</head>

<body>
	<script src="<?php echo base_url(); ?>assets/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/jquery/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/jquery/sweetalert2.min.js"></script>
	<?php if ($this->session->flashdata('error')) { ?>
		<script>
			Swal.fire({
				type: 'error',
				title: 'NIK dan Password Salah',
			})
		</script>
	<?php }
	elseif ($this->session->flashdata('warning')) { ?>
		<script>
			Swal.fire({
				type: 'warning',
				title: 'Tipe Jabatan Salah',
			})
		</script>
	<?php }
	elseif ($this->session->flashdata('info')) { ?>
		<script>
			Swal.fire({
				type: 'info',
				title: 'Data Tidak Ada',
			})
		</script>
	<?php } elseif ($this->session->flashdata('success')) { ?>
		<script>
			Swal.fire({
				type: 'success',
				title: 'Anda Berhasil Logout',
			})
		</script>
	<?php } ?>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-15 p-b-10">
				<form class="login100-form validate-form" method="POST" action="<?php echo base_url('login/validasi'); ?>">
					<center>
						<img width="150px" class="img-rounded" src="<?php echo base_url() . 'assets/logo/logo_mdba.svg' ?>" />
					</center>


					<div class="login-wrap m-t-15 m-b-10" style="font-family:Helvetica, sans-serif;">
						<select class="form-control" name="type" id="type" required autofocus>
							<option value="" selected>KATEGORI USER :</option>
							<option value="240">DEPO : ADMIN ENTRY</option>
							<option value="241">DEPO : ADMIN INVOICE</option>
							<option value="243">DEPO : ADMIN GUDANG</option>
							<option value="275">DEPO : CRL</option>
							<option value="238">DEPO : KASIR</option>
							<option value="239">DEPO : PETTY CASHIER</option>
							<option value="222">DEPO : SPV ADMIN</option>
							<option value="ICT">PUSAT : ICT</option>
						</select>
						<br>
						<input type="text" class="form-control" placeholder="Username" name="username" required>
						<br>
						<input type="password" class="form-control" placeholder="Password" name="password" required>
						<br>
						<br>
						<center> <button class="btn btn-primary" type="submit">
								<font size="4"><b>&ensp; Login &ensp;<b></center>
						<center><label class="login-wrap" style="font-family:Helvetica,sans-serif;">
								<font size="1"> MDBA &copy; 2021 ICT Department, TVIP | ASA
							</label> </font>
						</center>
					</div>


				</form>
			</div>
		</div>
	</div>

	<div id="dropDownSelect1"></div>

	<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/login/vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/login/vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url(); ?>assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/login/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/login/vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/login/vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="<?php echo base_url(); ?>assets/login/js/main.js"></script>

</body>

</html>