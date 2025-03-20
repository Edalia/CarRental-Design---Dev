<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "car_rental";
$_SESSION['id'] = null;

// Create connection
$conn = new mysqli($server, 
    $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " 
        . $conn->connect_error);
}

function user_exists($email, $conn){
    $stmt = $conn->prepare("SELECT user_email FROM `user` WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    //Fetch email and password from DB
    $user_query_result = $stmt->get_result()->fetch_assoc();

    if($user_query_result){
        return true;
    }else{
        return false;
    }

}

//Register account
function register_user($f_name,$l_name,$email,$password,$confirm_password,$con){
    $password_max_len = 8;
    $password_format = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";

    //Check if there is an empty field
    if(!$f_name || !$l_name || !$email || !$password || !$confirm_password){
    echo  "<script>
                document.getElementById('message-div').innerHTML = 'You left a field empty!';
                document.getElementById('message-div').className = 'alert alert-danger';
            </script>";
    }
    //Passwords do not match, print error message
    elseif($password != $confirm_password){
    echo    "<script>
                document.getElementById('message-div').innerHTML = 'Your passwords do not match!';
                document.getElementById('message-div').className = 'alert alert-danger';
            </script>";
    }
    //Password is not the required length,, print error message
    elseif($password_max_len > strlen($password)){
    echo    "<script>
                document.getElementById('message-div').innerHTML = 'Your password is less than 8 characters';
                document.getElementById('message-div').className = 'alert alert-danger';
            </script>";
    }
    //Password is not complex, print error message
    elseif(!preg_match($password_format,$password)){
    echo     "<script>
                document.getElementById('message-div').innerHTML = 'Your password must have at least: one uppercase letter,one lowercase letter, one special character and one number ';
                document.getElementById('message-div').className = 'alert alert-danger';
            </script>";
    }
    //check if user email already exists in DB
    elseif(user_exists($email,$con)){
    echo     "<script>
                document.getElementById('message-div').innerHTML = 'A user already exists with the email address: ".$email." ';
                document.getElementById('message-div').className = 'alert alert-danger';
            </script>";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo     "<script>
                document.getElementById('message-div').innerHTML = '".$email." is an invalid email format.  E.g valid format: example@mail.com';
                document.getElementById('message-div').className = 'alert alert-danger';
            </script>";
    }else{
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // prepare and bind - Against SQL Injection
        $stmt = $con->prepare("INSERT INTO `user`(`user_id`, `user_fname`, `user_sname`, `user_email`, `user_password`) VALUES (NULL, ?, ?, ?, ?)");
        $stmt->bind_param("ssss", $f_name, $l_name, $email, $password_hash);
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
            $con->close();
            
        }else{
            echo
                "<script>
                    document.getElementById('message-div').innerHTML = 'There was an error creating your account';
                    document.getElementById('message-div').className = 'alert alert-danger';
                </script>";
            $stmt->close();
            $con->close();
        }
    }
}

//Sign in User
function sign_in_user($email, $password, $conn){

    //Check if there is an empty field
    if(!$email || !$password){
        echo    "<script>
                    document.getElementById('message-div').innerHTML = 'You left a field empty!';
                    document.getElementById('message-div').className = 'alert alert-danger';
                </script>";

    }else{
        //Prepare statements before sign in
        $stmt = $conn->prepare("SELECT user_email,user_password FROM `user` WHERE user_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        //Fetch email and password from DB
        $user_query_result = $stmt->get_result()->fetch_assoc();

        //Check if this user record is in DB
        if($user_query_result){

            //verify password by comparing password field hash with DB hash
            if(password_verify($password, $user_query_result['user_password'])){
                
                $found_user = $conn->query("SELECT user_id, user_fname FROM `user` WHERE user_email = '".$user_query_result['user_email']."'");
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
    }       
}

function sign_in_admin($username, $password, $conn){

    //Check if fields are empty
    if(!$username || !$password){
        echo    "<script>
                document.getElementById('message-div').innerHTML = 'You left a field empty!';
                document.getElementById('message-div').className = 'alert alert-danger';
            </script>";
    }else{

        //Prepare statements before sign in
        $stmt = $conn->prepare("SELECT username, admin_password FROM `admin` WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        //Fetch email and password from DB
        $admin_query_result = $stmt->get_result()->fetch_assoc();

        //Check if this admin record is in DB
        if($admin_query_result){

            //verify password by comparing password field hash with DB hash
            if(password_verify($password, $admin_query_result['admin_password'])){
                
                $found_admin = $conn->query("SELECT id, first_name,is_admin FROM `admin` WHERE username = '".$admin_query_result['username']."'");
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