<?php
include "dep/session.php";

$sql = "SELECT * FROM `car` WHERE `car_gear` = 'Auto'";
$result = $conn->query($sql);
$cars_array = $result->fetch_all();

//for every car in cars array, output the car sections/cards
// while($car = $result->fetch_assoc()) 


foreach($cars_array as $car){
    echo $car[1]."Number".count($cars_array).'<br>';
}

?>