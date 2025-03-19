
<?php
	include "base/header.php";

	/**
	 * Only render page when user has confirmed pickup and return dates
	 * 
	*/
	//if the dates have a value( not null ) & are not blank (empty string), render available cars
	if(isset($_GET['pickup']) && isset($_GET['return']) && $_GET['pickup'] && $_GET['return']){

		$pickup_date = $_GET['pickup']; 
		$return_date = $_GET['return'];
		$duration_days;

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

?>

	<div class="container text-center" style="margin-top:65px;">
		
		<?php include "search.php";?>
		<p>Cars available to rent for <?php echo $duration_days; ?>day(s)
		</p>
		
		<div class="row">
			<?php
			//if no search has been made, output all cars available in DB
			if(isset($_GET['search'])== null){

				$sql = "SELECT * FROM `car` WHERE `is_available` = 1";
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
						<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#confirmCar">Rent out <?php echo $car[1]; ?></button>
					</div>
				</div>

				<div class="modal fade" id="confirmCar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Confirm your reservation</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="card-body">
								<h4><?php echo $car[1]?></h4>
								<p class="card-text">Total cost: <?php echo $car[4] * $duration_days?></p>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Save changes</button>
						</div>
						</div>
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
					$search_stmt = $conn->prepare("SELECT * FROM `car` WHERE `is_available` = 1 AND `car_model` LIKE ? OR `car_gear` LIKE ?");
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
						<button type="button" class="btn btn-outline-primary" >Rent out <?php echo $search_car[1]; ?></button>
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
	<div class="card" style="margin-top: 10%; text-align: center;">
		<div class="card-body">
			Start from <a href="index.php">here</a> to select your pickup/return dates to view available cars.
		</div>
	</div>
<?php
	}

	include "base/footer.php";

?>