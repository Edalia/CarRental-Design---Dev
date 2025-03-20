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

		<title>Sign in to your account</title>
	</head>
	<body>
		<div class="container" style="width:100%;">
			<div class="card" style="margin-top: 5%; display:flex; align-items: center;">
				<div class="card-body" style="width:100%;">
            
				<h2> Sign in to your account</h2>
            
            	<div id="message-div"></div>

				<form style="margin-top: 40px;" <?php echo "action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='POST'"?>>
					<div class="form-group">
						<label for="email">Email address</label>
						<input
							type="text"
							class="form-control"
							name="email"
							aria-describedby="emailHelp"
							placeholder="Enter email"
							required
						/>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input
							type="password"
							class="form-control"
							name="password"
							placeholder="Password"
							required
						/>
					</div>
					<input type="submit" class="btn btn-primary" name="login" value="Sign in"/>
				</form>
				<br>
				<p>Dont have an account? <a href="../CarRental/register.php">Register here</a></p>
				
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
			header('Location: index.php');
     		exit();
		}

        $email = "";
        $password = "";

        if (isset($_POST['login'])) {

            include "dep\session.php";

            $email = $_POST['email'];
            $password = $_POST['password'];

			//sign in user -> session.php
			sign_in_user($email, $password,$conn);
			
			unset($_POST['login']);
        }
        ?>
	</body>
</html>