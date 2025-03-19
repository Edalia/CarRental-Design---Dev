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
        $stmt->close();
        $c->close();
    } 
}


$_SESSION['id'] = null;

//Sign in User
function sign_in_user($e, $p, $conn){

    //ensure fields are not empty

    if($e&&$p){
        
        //Prepare statements before sign in
        $stmt = $conn->prepare("SELECT user_email,user_password FROM `user` WHERE user_email = ?");
        $stmt->bind_param("s", $e);
        $stmt->execute();

        //Fetch email and password from DB
        $query_user = $stmt->get_result()->fetch_assoc();

        //Check if this user record is in DB
        if($query_user){

            //verify password by comparing password field hash with DB hash
            if(password_verify($p, $query_user['user_password'])){
                
                $found_user = $conn->query("SELECT user_id, user_fname FROM `user` WHERE user_email = '".$query_user['user_email']."'");
                $user_account = $found_user->fetch_assoc();

                //start user session
                session_start();
                $_SESSION['id'] = $user_account['user_id'];

                
                header('Location: index.php');

		    }else{
                echo
                "<script>
                    document.getElementById('message-div').innerHTML = 'Incorrect email or password';
                    document.getElementById('message-div').className = 'alert alert-danger';
                </script>";

                $stmt->close();
                $conn->close();
            }
        }else{
            echo 
            "<script>
                document.getElementById('message-div').innerHTML = 'Error signing in';
                document.getElementById('message-div').className = 'alert alert-danger';
            </script>";
            $stmt->close();
            $conn->close();
        }
    }else{
    echo
                "<script>
                    document.getElementById('message-div').innerHTML = 'Empty fields!';
                    document.getElementById('message-div').className = 'alert alert-danger';
                </script>";
    }       
}

function sign_in_admin($u, $p, $conn){

    //ensure fields are not empty

    if($u&&$p){
        
        //Prepare statements before sign in
        $stmt = $conn->prepare("SELECT username, admin_password FROM `admin` WHERE username = ?");
        $stmt->bind_param("s", $u);
        $stmt->execute();

        //Fetch email and password from DB
        $query_admin = $stmt->get_result()->fetch_assoc();

        //Check if this admin record is in DB
        if($query_admin){

            //verify password by comparing password field hash with DB hash
            if(password_verify($p, $query_admin['admin_password'])){
                
                $found_admin = $conn->query("SELECT id, first_name,is_admin FROM `admin` WHERE username = '".$query_admin['username']."'");
                $admin_account = $found_admin->fetch_assoc();

                //start user session
                session_start();
                $_SESSION['admin_id'] = $admin_account['id'];
                $_SESSION['is_admin'] = $admin_account['is_admin'];

                
                header('Location: index.php');

		    }else{
                echo
                "<script>
                    document.getElementById('message-div').innerHTML = 'Incorrect email or password';
                    document.getElementById('message-div').className = 'alert alert-danger';
                </script>";

                $stmt->close();
                $conn->close();
            }
        }else{
            echo 
            "<script>
                document.getElementById('message-div').innerHTML = 'Error signing in';
                document.getElementById('message-div').className = 'alert alert-danger';
            </script>";
            $stmt->close();
            $conn->close();
        }
    }else{
    echo
                "<script>
                    document.getElementById('message-div').innerHTML = 'Empty fields!';
                    document.getElementById('message-div').className = 'alert alert-danger';
                </script>";
    }       
}

function logout(){
    session_destroy();
    header('Location: index.php');
    exit();

}
function logout_admin(){
    session_destroy();
    header('Location: index.php');
    exit();

}

?>