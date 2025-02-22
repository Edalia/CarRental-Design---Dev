
<?php
	include "base/header.php";
?>

<div class="container" style="width:100%; margin-top: 65px;">
	<div class="card" style="margin-top: 2.5%; display:flex; align-items: center;">
		<div class="card-body" style="width:100%;">
	
			<h2> Book your car</h2>
		
			<div id="message-div"></div>

			<?php

				$locations = $conn->query("SELECT * FROM `location`")->fetch_all();
			
			?>
			<form action="car-list.php" method="GET">
				<div class="form-group">
					<label for="pickup_location">Pickup Location</label>
					<select class="custom-select my-1 mr-sm-2" id="pickup_location" name="pickup_location">
						<option selected>Choose...</option>
					<?php
						foreach($locations as $location){
					?>
							<option value=<?php echo $location[0]; ?>><?php echo $location[2]." - ".$location[1]; ?></option>
					<?php
						}
					?>
					</select>
					<label for="pickup_date">Pickup date:</label>
					<input type="date" id="pickup" name="pickup" class="form-control" onchange="date_duration(event)">
				</div>
				
				<div class="form-group">
					<label for="return_location">Return Location</label>
					<select class="custom-select my-1 mr-sm-2" id="return_location" name="return_location">
						<option selected>Choose...</option>
					<?php
						foreach($locations as $location){
					?>
							<option value=<?php echo $location[0]; ?>><?php echo $location[2]." - ".$location[1]; ?></option>
					<?php
						}
					?>
					</select>
					<label for="return">Return date:</label>
					<input type="date" id="return" name="return" class="form-control">
				</div>
				<input type="submit" class="btn btn-primary" name="book_car" value="Search for car"/>
			</form>
			<br>

		</div>
	</div>
</div>
		
<?php
	include "base/footer.php";

?>