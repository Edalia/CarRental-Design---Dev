
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
					<input type="date" id="pickup" name="pickup"  onchange="date_duration(event)" min=<?php echo $dateToday; ?> >
				</div>
				
				<div class="form-group">
					<label for="return">Return date:</label>
					<input type="date" id="return" name="return"  >
				</div>
				<input type="submit" class="btn btn-primary" name="book_car" value="Search for car" />
			</form>
			<br>

		</div>
	</div>
</div>
		
<?php
	if(isset($_GET['book_car'])){
		$pickup_date = $_GET['pickup'];
		$return_date = $_GET['return'];

		if(!$pickup_date || !$return_date){
		echo	"<script>
					document.getElementById('message-div').innerHTML = 'You need to specify your pickup and return dates.';
					document.getElementById('message-div').className = 'alert alert-danger';
				</script>";

		}else if($return_date < $pickup_date){
			echo
                "<script>
                    document.getElementById('message-div').innerHTML = 'Your return date cannot be earlier than your pickup date';
                    document.getElementById('message-div').className = 'alert alert-danger';
                </script>";
		}else{
			return true;
		}
	
	}

	include "base/footer.php";
?>