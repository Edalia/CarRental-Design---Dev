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
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="top:0; position:fixed; width:100%; height:max-content; z-index: 255;">
			<p class="navbar-brand" >Car Rentals Admin</p>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<?php
				
				session_start();
			
				if(isset($_SESSION['admin_id'])){

					include "..\dep\session.php";

					//fetch user first name
					$fname = $conn->query("SELECT `first_name` FROM `admin` WHERE `id` = '".$_SESSION['admin_id']."' AND `is_admin`='".$_SESSION['is_admin']."'")->fetch_assoc();

			?>
				<form <?php echo "action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='POST'"?>>
						<input type="submit" class="btn btn-outline-danger" name="logout" value="Logout"/>
				</form>

			<?php 
					if (isset($_POST['logout'])){
						logout();
					}
				}
			?>

			</div>
		</nav>
