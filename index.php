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
			$cars = array (
						array(1,"Volvo xc60","Auto","4 seater",30,"img/volvo.jpg"),
						array(2,"Mazda 3","Auto","4 seater",10,"img/mazda3.jpg"),
						array(3,"Ford Ranger","Auto","4 seater",90,"img/ranger.jpg"),
						array(4,"Nissan Juke","Auto","4 seater",25,"img/juke.jpg"),
						array(5,"2008 VW Golf","Manual","4 seater",30,"img/golf08.jpg"),
						array(6,"Audi A4","Auto","4 seater",40,"img/audia4.jpg")
			);

			include "header.php";
		
		?>
		<div class="container text-center">
			<div class="row">
			<?php
			
			//for car in cars array, render specific cards
			foreach($cars as $car){

			?>
				<div class="col">
					<div class="card" style="width: 18rem;">
					<img src=<?php echo $car[5]?> style="width: 100%; height:30vh;" alt="...">
						<div class="card-body">
							<h4><?php echo $car[1]?></h4>
							<p class="card-text">Transmission: <?php echo $car[2]?></p>
							<p class="card-text"><?php echo $car[3]?></p>
							<p class="card-text">£ <?php echo $car[4]?> / day</p>
							<button type="button" class="btn btn-outline-primary">Rent out <?php echo $car[1]; ?></button>
						</div>
					</div>
				</div>

			<?php

			//end of car cards
			}
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