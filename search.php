<div class="card" style="margin-top: 100px;">
		<div class="card-body" style>
				<form class="form-inline my-2 my-lg-2"  <?php echo "action='".htmlspecialchars($_SERVER["PHP_SELF"])."' method='GET'"?>>
				<input
					class="form-control mr-sm-2"
					name="search_field"
					placeholder="Search for a car"
					aria-label="Search"
					style="width: 500px; margin-left: 25%;"
				/>
				<input type="submit" class="btn btn-outline-success my-2 my-sm-0" name="search" value="Search"/>
			</form>
		</div>
</div>




