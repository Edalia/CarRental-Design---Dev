
<?php
	include "base/header.php";

	$dateToday;

	$dateToday = date('Y-m-d');
?>

<div class="container" style="width:100%; margin-top: 65px;">
	<div class="card" style="margin-top: 2.5%; display:flex; align-items: center;">
		<div class="card-body" style="width:100%;">
	
			<h2> Book your car</h2>
		
			<div id="message-div"></div>

			<form action="booking.php" method="GET">
				<div class="form-group">
					<label for="pickup_date">Pickup date:</label>
					<input type="date" id="pickup" name="pickup" class="form-control" onchange="date_duration(event)" min=<?php echo $dateToday; ?> required>
				</div>
				
				<div class="form-group">
					<label for="return">Return date:</label>
					<input type="date" id="return" name="return" class="form-control" required>
				</div>
				<input type="submit" class="btn btn-primary" name="book_car" value="Search for car" />
			</form>
			<br>

		</div>
	</div>
</div>
		
<?php
	include "base/footer.php";
	include "dep/booking.php";
?>