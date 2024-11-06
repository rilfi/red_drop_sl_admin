<div class="card card-widget widget-user">
	<!-- Add the bg color to the header using any of the bg-* classes -->
	<div class="widget-user-header bg-danger">
		<h3 class="widget-user-username"><?php echo $bloodbank['name']; ?></h3>
		<h5 class="widget-user-desc">Region : - <?php echo $bloodbank['city_name'].", ".$bloodbank['state_name'].", ".$bloodbank['country_name'] ?></h5>
	</div>
<!--	<div class="widget-user-image">-->
<!--		<img class="img-circle elevation-2" src="--><?php //if($bloodbank['gender'] == "female") { echo "assets/img/avatar3.png"; } else {echo "assets/img/avatar5.png";} ?><!--" alt="User Avatar">-->
<!--	</div>-->
	<div class="card-footer">
		<div class="row">
			<div class="col-sm-4 border-right">
				<div class="description-block">
					<h5 class="description-header"><?php echo $bloodbank['addedByUser']; ?></h5>
					<span class="description-text">Added by</span>
				</div>
				<!-- /.description-block -->
			</div>
			<!-- /.col -->
			<div class="col-sm-4 border-right">
				<div class="description-block">
					<h5 class="description-header"><?php echo $bloodbank['views']; ?></h5>
					<span class="description-text">Views</span>
				</div>
				<!-- /.description-block -->
			</div>
			<!-- /.col -->
			<div class="col-sm-4">
				<div class="description-block">
					<h5 class="description-header"><?php echo $bloodbank['contact'] ?></h5>
					<span class="description-text">Contact#</span>
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
					Status <span class="float-right badge <?php if($bloodbank['status'] == 0) echo "bg-danger"; else echo "bg-primary";  ?>"><?php echo $bloodbank['status']==1?"Active":"Disabled"; ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Address <span class="float-right"><?php echo $bloodbank['address'] ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Location <span class="float-right"><?php echo $bloodbank['location']."<br>".$bloodbank['latitude'].", ".$bloodbank['longitude']; ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Member Since <span class="float-right"><?php echo date("d-m-Y h:i:s a", strtotime($bloodbank['created'])) ?></span>
				</span>
			</li>
		</ul>
	</div>
</div>