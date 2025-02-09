		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Navbar</a>
			<button
				class="navbar-toggler"
				type="button"
				data-toggle="collapse"
				data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent"
				aria-expanded="false"
				aria-label="Toggle navigation"
			>
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#"
							>Home <span class="sr-only">(current)</span></a
						>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Link</a>
					</li>
					<li class="nav-item dropdown">
						<a
							class="nav-link dropdown-toggle"
							href="#"
							id="navbarDropdown"
							role="button"
							data-toggle="dropdown"
							aria-haspopup="true"
							aria-expanded="false"
						>
							Dropdown
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</li>
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