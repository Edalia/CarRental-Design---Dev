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