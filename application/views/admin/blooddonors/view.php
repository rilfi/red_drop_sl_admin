<div class="card card-widget widget-user">
	<!-- Add the bg color to the header using any of the bg-* classes -->
	<div class="widget-user-header bg-primary">
		<h3 class="widget-user-username"><?php echo $donor['full_name']; ?></h3>
		<h5 class="widget-user-desc">Region : - <?php echo $donor['city_name'].", ".$donor['state_name'].", ".$donor['country_name'] ?></h5>
	</div>
	<div class="widget-user-image">
		<img class="img-circle elevation-2" src="<?php if($donor['gender'] == "female") { echo "assets/img/avatar3.png"; } else {echo "assets/img/avatar5.png";} ?>" alt="User Avatar">
	</div>
	<div class="card-footer">
		<div class="row">
			<div class="col-sm-4 border-right">
				<div class="description-block">
					<h5 class="description-header"><?php echo $donor['points']; ?></h5>
					<span class="description-text">Points</span>
				</div>
				<!-- /.description-block -->
			</div>
			<!-- /.col -->
			<div class="col-sm-4 border-right">
				<div class="description-block">
					<h5 class="description-header"><?php echo $donor['views']; ?></h5>
					<span class="description-text">Views</span>
				</div>
				<!-- /.description-block -->
			</div>
			<!-- /.col -->
			<div class="col-sm-4">
				<div class="description-block">
					<h5 class="description-header"><?php echo strtoupper($donor['blood_group']) ?></h5>
					<span class="description-text">Blood Group</span>
				</div>
				<!-- /.description-block -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
	<div class="card-footer p-0">
		<ul class="nav flex-column">
			<li class="nav-item">
				<span class="nav-link">
					Status <span class="float-right badge <?php if($donor['status'] == 0) echo "bg-danger"; else echo "bg-primary";  ?>"><?php echo $donor['status']==1?"Active":"Disabled"; ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Donor Type <span class="float-right badge <?php if($donor['type'] == "paid") echo "bg-danger"; else echo "bg-primary";  ?>"><?php echo $donor['type'] ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Last Donation <span class="float-right"><?php echo date("d-m-Y", strtotime($donor['lastDonationDate'])); ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Date of birth <span class="float-right"><?php echo date("d-m-Y", strtotime($donor['date_of_birth'])); ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Contact# <span class="float-right"><?php echo $donor['mobile'] ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Address <span class="float-right"><?php echo $donor['address'] ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Location <span class="float-right"><?php echo $donor['location']."<br>".$donor['latitude'].", ".$donor['longitude']; ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Habits <span class="float-right"><?php echo $donor['habits'] ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					City, State, Country <span class="float-right"><?php echo $donor['city_name'].", ".$donor['state_name'].", ".$donor['country_name'] ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Added by <span class="float-right"><?php echo $donor['addedBy'] ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Member Since <span class="float-right"><?php echo date("d-m-Y h:i:s a", strtotime($donor['created'])) ?></span>
				</span>
			</li>
		</ul>
	</div>
</div>