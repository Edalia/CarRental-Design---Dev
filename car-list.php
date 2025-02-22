
<?php
	include "base/header.php";

	/**
	 * Prevents php error where pickup_location variable is missing/undefined.
	 * 
	 * Page only renders when 'pickup_location' is set from bookings(index.php)
	 * 
	*/
	if(isset($_GET['pickup_location'])){

		$sql = "SELECT * FROM `location` WHERE `location_id` = ".$_GET['pickup_location']."";
		
		$location = $conn->query($sql)->fetch_all();

		
		if($location){

?>

	<div class="container text-center" style="margin-top:65px;">
		<h3 style="margin-bottom:10px;"><?php echo "Cars available to pick from ".$location[0][1];?></h3>
		
		<?php include "search.php";?>
		
		<div class="row">
			<?php
			//if no search has been made, output all cars available in DB
			if(isset($_GET['search'])== null){

				$sql = "SELECT * FROM `car`";
				$result = $conn->query($sql);
				$cars_array = $result->fetch_all();

				//for every car in cars array, output the car sections/cards
				foreach($cars_array as $car){

			?>
			<div class="col">
				<div class="card" style="width: 20rem; margin-top: 5px;">
				<img src=<?php echo $car[5]?> style="width: 100%; height:30vh;" alt=<?php echo $car[5]?> >
					<div class="card-body">
						
						<!--Car Name-->
						<h4><?php echo $car[1]?></h4>
						
						<!--Car Transmission-->
						<p class="card-text">Transmission: <?php echo $car[2]?></p>
						<!--Car Seats-->
						<p class="card-text"><?php echo $car[3]?> seater</p>
						<!--Car Rent Price-->
						<p class="card-text">£ <?php echo $car[4]?> / day</p>
						<button type="button" class="btn btn-outline-primary">Rent out <?php echo $car[1]; ?></button>
					</div>
				</div>	
			</div>
		<?php

				}//end of loop

			}else{
				//when search is made, get value from field

				$searchQuery = "%".$_GET['search_field']."%";
				
				try{
				
					/*	Search for records of cars according to car model OR according to transmission(auto/manual) .
						Prepare statements to avoid injection.
					*/
					$search_stmt = $conn->prepare("SELECT * FROM `car` WHERE `car_model` LIKE ? OR `car_gear` LIKE ?");
					$search_stmt->bind_param("ss", $searchQuery,$searchQuery);
					$search_stmt->execute();
					
					//Return results of cars as associative array
					$search_result = $search_stmt->get_result();
					$search_array = $search_result->fetch_all();

					//check if user's search has any results
					if(count($search_array)>0){
		?>
			<div>
				<a>Your search results for "<?php echo $_GET['search_field']; ?>". </a>
				<br>
				<a href ="../CarRental/index.php"; ?>Reset search</a>
			</div>
		
		<?php
				
					//for every car found in the query, render their cards
						foreach($search_array as $search_car){
		?>
		<div class="col">
				<div class="col">
				<div class="card" style="width: 20rem; margin-top: 5px;">
				<img src=<?php echo $search_car[5]?> style="width: 100%; height:30vh;" alt=<?php echo $search_car[5]?> >
					<div class="card-body">
						
						<!--Car Name-->
						<h4><?php echo $search_car[1]?></h4>
						
						<!--Car Transmission-->
						<p class="card-text">Transmission: <?php echo $search_car[2]?></p>
						<!--Car Seats-->
						<p class="card-text"><?php echo $search_car[3]?> seater</p>
						<!--Car Rent Price-->
						<p class="card-text">£ <?php echo $search_car[4]?> / day</p>
						<button type="button" class="btn btn-outline-primary">Rent out <?php echo $search_car[1]; ?></button>
					</div>
				</div>	
			</div>
		</div>
		<?php
						}//endloop
					}else{
		?>
					<a>Your search results for "<?php echo $_GET['search_field']; ?>". </a>
					<br>
					<a href ="../CarRental/index.php"; ?>Reset search</a>

					<div class="alert alert-light" role="alert" style="margin-top: 20%; width:75%; left:10%;">
					There was nothing found!
					</div>
					
		<?php
					}
				}catch(Exception $e){
		?>
			<div class="alert alert-danger" role="alert">
			We could not complete your search. There is an error.
			</div>.

		<?php

				}//endtrycatch
			}//endelse

		?>

		</div>
	</div>
		
<?php

	}else{
?>
	<div class="alert alert-danger" role="alert">
		There is an error.
	</div>.
<?php
		}
	}//endif
	else{
?>
	<div class="card" style="margin-top: 10%; text-align: center;">
		<div class="card-body">
			Start from <a href="index.php">here</a> to choose your pickup/return location & dates to view available cars.
		</div>
	</div>
<?php

	}
	include "base/footer.php";

?>