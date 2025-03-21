<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1, shrink-to-fit=no"
	/>

	<!-- Bootstrap CSS -->
	<link
		rel="stylesheet"
		href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
		crossorigin="anonymous"
	/>

	<title>Car Rentals</title>
</head>
<body>
<?php include "dep/session.php";?>

<nav class="navbar navbar-expand-lg navbar-light bg-light" style="top:0; position:fixed; width:100%; height:max-content; z-index: 255;">
	<a class="navbar-brand" >Car Rental</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	<?php
		
		session_start();
	
		if(isset($_SESSION['id'])){
			
			//fetch user first name
			$user = $conn->query("SELECT user_id,user_fname,user_sname FROM `user` WHERE user_id = '".$_SESSION['id']."'")->fetch_assoc();

	?>
		<a class="nav-link disabled">Welcome, <?php echo $user['user_fname']; ?></a>

		<form <?php echo "action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='POST'"?>>
				<input type="submit" class="btn btn-outline-danger" name="logout" value="Logout"/>
		</form>

	<?php 
			if (isset($_POST['logout'])){
				logout();
			}
		}else{
	?>
	<div class="background-color: red;">
		<a href="../CarRental/login.php">Sign in to your account </a>
		<a>&nbsp;or&nbsp;</a>
		<a href="../CarRental/register.php"> Register an account</a>
	</div>
	<?php
	
		}
	?>

	</div>
</nav>
