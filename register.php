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

		<title>Register an account</title>
	</head>
	<body>
		<div class="container" style="width:100%;">
			<div class="card" style="margin-top: 2.5%; display:flex; align-items: center;">
				<div class="card-body" style="width:100%;">
            
					<h2> Create your account</h2>
				
					<div id="message-div"></div>

					<form <?php echo "action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='POST'"?>>
						<div class="form-group">
							<label for="fname">First Name</label>
							<input
								type="text"
								class="form-control"
								name="fname"
								placeholder="Enter first name"
								required
							/>
						</div>
						<div class="form-group">
							<label for="sname">Surname</label>
							<input
								type="text"
								class="form-control"
								name="sname"
								placeholder="Enter surname"
								required
							/>
						</div>
						<div class="form-group">
							<label for="email">Email address</label>
							<input
								type="email"
								class="form-control"
								name="email"
								aria-describedby="emailHelp"
								placeholder="Enter email"
								required
							/>
							<small id="emailHelp" class="form-text text-muted"
								>e.g user@mail.com</small
							>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input
								type="password"
								class="form-control"
								name="password"
								aria-describedby="passwordHelp"
								placeholder="Password"
								required
							/>
							<small id="passwordHelp" class="form-text text-muted"
								>Must be at least 8 characters with: an uppercase letter, lowercase letter, number, special character</small
							>
						</div>
						<div class="form-group">
							<label for="confirm_password">Confirm Password</label>
							<input
								type="password"
								class="form-control"
								name="confirm_password"
								placeholder="Confirm Password"
								required
							/>
						</div>
						<input type="submit" class="btn btn-primary" name="register" value="Register"/>
					</form>
					<br>
					<p>Already have an account? <a href="../CarRental/login.php">Sign in here</a></p>
				</div>
			</div>
		</div>
		
        <script
			src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
			integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
			crossorigin="anonymous"
		></script>
		<script
			src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
			integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
			crossorigin="anonymous"
		></script>
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
			integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
			crossorigin="anonymous"
		></script>
        <?php
		session_start();

		if(isset($_SESSION['id'])){
			header('Location: home.php');
     		exit();
		}

        $firstname = "";
        $surname = "";
        $email = "";
        $password = "";
        $confirm_password = "";

        if (isset($_POST['register'])) {

            include "dep\session.php";

            $firstname = $_POST['fname'];
            $surname = $_POST['sname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            
			//Register user => session.php)
			register_user($firstname,$surname,$email,$password,$confirm_password,$conn);
            
			// unset($_POST['register']);
        }
        ?>
	</body>
</html>