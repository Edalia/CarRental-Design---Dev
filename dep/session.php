<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";

// Create connection
$conn = new mysqli($server, 
    $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " 
        . $conn->connect_error);
}

//Register account
function register_user($f,$s,$e,$p,$c){
    $hash = password_hash($p, PASSWORD_BCRYPT);

    // prepare and bind - Against SQL Injection
    $stmt = $c->prepare("INSERT INTO `user`(`user_id`, `user_fname`, `user_sname`, `user_email`, `password`) VALUES (NULL, ?, ?, ?, ?)");
    $stmt->bind_param("ssss", $f, $s, $e, $hash);
    $stmt->execute();

    if($stmt){
        echo
            "<script>
                document.getElementById('message-div').innerHTML = 'Your account was created successfully!';
                document.getElementById('message-div').className = 'alert alert-success';
            </script>";
            
        $stmt->close();
        $c->close();
    }
    else{
        echo
            "<script>
                document.getElementById('message-div').innerHTML = 'There was an error creating your account';
                document.getElementById('message-div').className = 'alert alert-danger';
            </script>";
    } 
}

?>