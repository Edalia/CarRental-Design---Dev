<div class="card">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<p class="navbar-nav mr-auto">Car Rental</p>

			<div class="navbar fixed-top navbar-light bg-light">
				<a class="navbar-brand">Car Rental</a>
				<ul class="navbar-nav mr-auto">
                    <?php
						include "dep/session.php";
                        
						session_start();
                    
                        if(isset($_SESSION['id'])){
                            
                            //fetch user first name
                            $fname = $conn->query("SELECT user_fname FROM `user` WHERE user_id = '".$_SESSION['id']."'")->fetch_assoc();

                            ?>
                            <li class="nav-item">
                                <a class="nav-link disabled">Welcome, <?php echo $fname['user_fname']; ?></a>
                            </li>
							
							<form <?php echo "action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='POST'"?>>
								<input type="submit" class="btn btn-outline-danger" name="logout" value="Logout"/>
							</form>
                    <?php 
							if (isset($_POST['logout'])){
								logout();
							}
                        }
                    ?>
				</ul>
				<form class="form-inline my-2 my-lg-0" id="car_search_form">
					<input
						class="form-control mr-sm-2"
						id="search_field"
						placeholder="Search"
						aria-label="Search"
					/>
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">
						Search
					</button>
				</form>
			</div>
		</nav>
</div>