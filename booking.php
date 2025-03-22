
<?php
	include "base/header.php";

	if(isset($_SESSION['id'])){
	/**
	 * Only render page when user has confirmed pickup and return dates
	 * 
	*/
	//if the dates have a value( not null ) & are not blank (empty string), render available cars
		if(isset($_GET['pickup']) && isset($_GET['return']) && $_GET['pickup'] && $_GET['return']){

			$pickup_date = $_GET['pickup']; 
			$return_date = $_GET['return'];

			/**
				* Cars picked and returned on the same day count as 1 day.
				* New variable -> 'day' used tp calculate total price for renting the car
			*/
			if($pickup_date == $return_date){
				$duration_days = 1;
			}else{
			
			/**Change date values to timestamp since they are currently in string
			 * Get duration in seconds
			*/
				$duration = strtotime($return_date) - strtotime($pickup_date);

			//Round off to duration in days
				$duration_days = round($duration / (60 * 60 * 24));
			
			}

		include "search.php";
		include "car-list.php";


		}else{
?>
	<div class="card" style="margin-top: 10%; text-align: center;">
		<div class="card-body">
			Start from <a href="home.php">here</a> to select your pickup/return dates to view available cars.
		</div>
	</div>
<?php
		}
	}else{
?>
	<div class="card" style="margin-top: 10%; text-align: center;">
		<div class="card-body">
			<a href="login.php">Sign in to your account</a> to book a car or <a href="register.php">Register</a> an account here.
		</div>
	</div>
<?php
	}

	include "base/footer.php";

?>