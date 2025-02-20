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

		<title>Car Rental</title>
	</head>
	<body>
		<?php
			include "header.php";

		?>
		<div class="container text-center" style="margin-top:65px;">
			<div class="row">
				<?php

				//if no search has been made, output all cars available in DB
				if(isset($_GET['search'])== null){

					$sql = "SELECT * FROM `car`";
					$result = $conn->query($sql);

					//for every car in cars array, output the car sections/cards
					while($car = $result->fetch_assoc()) {

				?>
				<div class="col">
					<div class="card" style="width: 20rem; margin-top: 5px;">
					<img src=<?php echo $car['car_img_path']?> style="width: 100%; height:30vh;" alt=<?php echo $car['car_img_path']?> >
						<div class="card-body">
							
							<!--Car Name-->
							<h4><?php echo $car['car_model']?></h4>
							
							<!--Car Transmission-->
							<p class="card-text">Transmission: <?php echo $car['car_gear']?></p>
							<!--Car Seats-->
							<p class="card-text"><?php echo $car['car_seat']?> seater</p>
							<!--Car Rent Price-->
							<p class="card-text">£ <?php echo $car['car_price']?> / day</p>
							<button type="button" class="btn btn-outline-primary">Rent out <?php echo $car['car_model']; ?></button>
						</div>
					</div>	
				</div>
			<?php

					}//end of loop

				}else{
					//when search is made, get value from field

					$searchQuery = $_GET['search_field']."%";
					
					try{
					
						/*	Search for records of cars according to car model OR according to transmission(auto/manual) .
							Prepare statements to avoid injection.
						*/
						$search_stmt = $conn->prepare("SELECT * FROM `car` WHERE `car_model` LIKE ? OR `car_gear` LIKE ?");
						$search_stmt->bind_param("ss", $searchQuery,$searchQuery);
						$search_stmt->execute();
						
						//Return results of cars as array
						$search_result = $search_stmt->get_result();	
					
			?>
				<div>
					<a>Your search results for "<?php echo $_GET['search_field']; ?>". </a>
					<a href ="../CarRental/index.php"; ?>Reset search</a>
				</div>
			<?php
					
						//for every car found in the query, render their cards
						while($search_car = $search_result->fetch_assoc()){
			?>
			<div class="col">
					<?php echo $search_car['car_model'];?>
			</div>
			<?php
						}//endloop
					}catch(Exception $e){
			?>
				There was an error in your search. Try again.

			<?php

					}//endtrycatch
				}//endelse

			?>

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
	</body>
</html>