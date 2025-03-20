<?php
include 'base/header.php';
?>
<div class="container" style="width:100%;">
    <div class="card" style="margin-top: 10%; display:flex; align-items: center;">
        <div class="card-body" style="width:100%;">
    
        <h2> Admin Sign in</h2>
    
        <div id="message-div"></div>

        <form style="margin-top: 40px;" <?php echo "action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='POST'"?>>
            <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    class="form-control"
                    name="username"
                    placeholder="Enter username"
                    required
                />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    placeholder="Password"
                    required
                />
            </div>
            <input type="submit" class="btn btn-primary" name="admin_login" value="Sign in"/>
        </form>
    </div>
    </div>
</div>
<?php

    $username = "";
    $password = "";

    if(isset($_SESSION['is_admin'])){
        header('Location: index.php');
        exit();
    }


    if (isset($_POST['admin_login'])) {

        include "..\dep\session.php";

        $username = $_POST['username'];
        $password = $_POST['password'];

        //sign in user -> session.php
        sign_in_admin($username, $password,$conn);

        unset($_POST['admin_login']);
    }
?>