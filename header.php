<div class="card">
	<?php include "dep/session.php";?>

	<nav class="navbar navbar-expand-lg navbar-light bg-light" style="top:0; position:fixed; width:100%; height:max-content; z-index: 255;">
		<a class="navbar-brand" >Car Rental</a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<form class="form-inline my-2 my-lg-2" <?php echo "action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='POST'"?>>
						<input
							class="form-control mr-sm-2"
							name="search_field"
							placeholder="Search"
							aria-label="Search"
							style="width: 500px; ;"
						/>
						<input type="submit" class="btn btn-outline-success my-2 my-sm-0" name="search" value="Search"/>
					</form>
				</li>
			</ul>
		<?php
			$query = '';

			// function search_car($q){
			// $stmt = $conn->prepare("SELECT user_email,user_password FROM `user` WHERE user_email = ?");
			// 		$stmt->bind_param("s", $e);
			// 		$stmt->execute();
			// }

			// if (isset($_POST['search'])) {
			// 	search_car($_POST['search_field']);
			// }

		?>

		<?php
			
			session_start();
		
			if(isset($_SESSION['id'])){
				
				//fetch user first name
				$fname = $conn->query("SELECT user_fname FROM `user` WHERE user_id = '".$_SESSION['id']."'")->fetch_assoc();

		?>
			<a class="nav-link disabled">Welcome, <?php echo $fname['user_fname']; ?></a>

			<form <?php echo "action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='POST'"?>>
					<input type="submit" class="btn btn-outline-danger" name="logout" value="Logout"/>
			</form>

		<?php 
				if (isset($_POST['logout'])){
					logout();
				}
			}else{
		?>
		<a href="../CarRental/login.php">Sign in to your account </a>
		<a>&nbsp;or&nbsp;</a>
		<a href="../CarRental/register.php"> Register an account</a>
		<?php
		
			}
		?>

		</div>
	</nav>
</div>