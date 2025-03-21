<?php
include 'base/header.php';

if(isset($_SESSION['is_admin'])){

   
    
    $booking_query = "SELECT * FROM booking";
    
   
    $bookings_result = $conn->query($booking_query);

    
    $booking_array = $bookings_result->fetch_all();


    

?>
<div class="container" style="width:100%; margin-top: 5%;">
    <h2>View Bookings</h2>
    <table class="table table-dark">
        <thead>
            <tr>
            <th scope="col">Booking ID</th>
            <th scope="col">Client name</th>
            <th scope="col">Car Booked</th>
            <th scope="col">Pickup Date</th>
            <th scope="col">Return Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if($booking_array){

                    foreach($booking_array as $booking){
                        $car_query = "SELECT car_model FROM `car` WHERE `car_id` = ".$booking[2]."";
                        $user_query = "SELECT user_fname,user_sname FROM user WHERE `user_id`= ".$booking[1]."";

                        $cars_array = $conn->query($car_query)->fetch_all();
                        $users_array = $conn->query($user_query)->fetch_all();

            ?>
            <tr>
                <td><?php echo $booking[0]; ?></td>
                <td><?php echo $users_array[0][0]." ".$users_array[0][1]; ?></td>
                <td><?php echo $cars_array[0][0]; ?></td>
                <td><?php echo $booking[3]; ?></td>
                <td><?php echo $booking[4]; ?></td>
            </tr>
            <?php
                    }
                }else{
            ?>
            <tr>
                <td>No Bookings Available</td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>
<?php
}else{
    header('Location: login.php');
    exit();
}
?>