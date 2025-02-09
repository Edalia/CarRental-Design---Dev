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
    $stmt = $c->prepare("INSERT INTO `user`(`user_id`, `user_fname`, `user_sname`, `user_email`, `user_password`) VALUES (NULL, ?, ?, ?, ?)");
    $stmt->bind_param("ssss", $f, $s, $e, $hash);
    $stmt->execute();


    if($stmt){
        unset($_POST);

        echo
            "<script>
                document.getElementById('message-div').innerHTML = 'Your account was created successfully!';
                document.getElementById('message-div').className = 'alert alert-success';
               
                //redirect to login
                window.setTimeout(function(){
                    window.location.href = 'login.php';
                }, 3000);

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

//Sign in User
function sign_in_user($e, $p, $conn){

    //ensure fields are not empty
    
    if($e&&$p){
        //Prepare statements before sign in
        $stmt = $conn->prepare("SELECT user_email,user_password FROM `user` WHERE user_email = ?");
        $stmt->bind_param("s", $e);
        $stmt->execute();

        $user = $stmt->get_result()->fetch_assoc();

        if($user){

            //verify password by comparing password field hash with DB hash
            if(password_verify($p, $user['user_password'])){
                echo
                "<script>
                    document.getElementById('message-div').innerHTML = 'Welcome ".$user['user_email']."';
                    document.getElementById('message-div').className = 'alert alert-success';
                </script>";


            }
            else{
                echo
                "<script>
                    document.getElementById('message-div').innerHTML = 'Incorrect email or password';
                    document.getElementById('message-div').className = 'alert alert-danger';
                </script>";

                $stmt->close();
            }
        }else{
            echo 
            "<script>
                document.getElementById('message-div').innerHTML = 'Error signing in';
                document.getElementById('message-div').className = 'alert alert-danger';
            </script>";
            $stmt->close();
        }
    }else{
    echo
                "<script>
                    document.getElementById('message-div').innerHTML = 'Empty fields!';
                    document.getElementById('message-div').className = 'alert alert-danger';
                </script>";
    }

    
        
}

?>