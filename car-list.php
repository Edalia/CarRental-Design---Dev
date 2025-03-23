<div class="container text-center" style="margin-top:65px;">
	<div id="message-div"></div>
	<?php
    
	if(isset($_SESSION['id']) && $duration_days){

	?>
		<p>Cars available to rent for <?php echo $duration_days; ?>day(s)
		</p>

	<?php
		}
	?>
	<div class="row">
		<?php

        $sql = "SELECT * FROM `car` WHERE `is_available` = 1";
        $result = $conn->query($sql);
        $cars_array = $result->fetch_all();

        //for every car in cars array, output the car elements/cards
        foreach($cars_array as $car){

		?>
		<div class="col">
            
			<div class="card" id="carcard" style="width: 250px; height:max-content; margin-top: 5px; cursor:pointer;" data-toggle="modal" data-target=<?php echo "#confirmCar".$car[0]; ?>>
				<img src=<?php echo $car[5]?> style="width: 100%; height:100%;" alt=<?php echo $car[5]?> >
				<span class="position-absolute top-0 p-1 rounded bg-secondary">
					<p style="color: white;"> £ <?php echo $car[4]?>/day</p>
				</span>
					<div class="card-body">
						<h5 class="text-left"><?php echo $car[1]?></h5>
						<!--Car Transmission, Seat number-->
						<p class="text-left"><?php echo $car[2]?> | <?php echo $car[3]?> seater</p>
					</div>
			</div>

			<div class="modal fade" id=<?php echo "confirmCar".$car[0]; ?> tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
							<img src=<?php echo $car[5]?> style="width: 150px; height:150px;" alt=<?php echo $car[5]?> >
							<p>Pickup on: <?php echo $pickup_date?></p>
							<p>Return by: <?php echo $return_date?></p>
							<p>Booked by : <?php echo $user['user_fname']." ".$user['user_sname'];?></p>
							<b><p class="card-text">Total cost: £ <?php $cost = $car[4] * $duration_days; echo $cost; ?></p></b>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						
						<form method="POST" action="">
							<input type="hidden" name="pickup" value=<?php echo $pickup_date; ?> />
							<input type="hidden" name="return" value=<?php echo $return_date; ?> />
							<input type="hidden" name="car" value=<?php echo $car[0]; ?> />
							<input type="hidden" name="cost" value=<?php echo $cost; ?> />
							<button type="submit" class="btn btn-primary" class="btn btn-primary" name="confirm_booking">Confirm booking</button>
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>
		
        <?php
        
        }//end of loop
		
		if(isset($_POST['confirm_booking'])){
				$user = $_SESSION['id'];
				$pickup = $_POST['pickup'];
				$return = $_POST['return'];
				$car = intval($_POST['car']);
				$cost = intval($_POST['cost']);


			confirm_booking($user, $car, $pickup, $return, $cost, $conn);
			
			unset($_POST['confirm_booking']);
		}
		
        ?>
	</div>
</div>