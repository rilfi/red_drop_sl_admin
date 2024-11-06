<div class="card card-widget widget-user">
	<!-- Add the bg color to the header using any of the bg-* classes -->
	<div class="widget-user-header bg-primary">
		<h3 class="widget-user-username"><?php echo $request['full_name']; ?></h3>
		<h5 class="widget-user-desc">Region : - <?php echo $request['city_name'].", ".$request['state_name'].", ".$request['country_name'] ?></h5>
	</div>
	<div class="widget-user-image">
		<img class="img-circle elevation-2" src="<?php if($request['request_for_gender'] == "female") { echo "assets/img/avatar3.png"; } else {echo "assets/img/avatar5.png";} ?>" alt="User Avatar">
	</div>
	<div class="card-footer">
		<div class="row">
			<div class="col-sm-4 border-right">
				<div class="description-block">
					<h5 class="description-header"><?php echo $request['no_of_bags']; ?></h5>
					<span class="description-text">No of Units</span>
				</div>
				<!-- /.description-block -->
			</div>
			<!-- /.col -->
			<div class="col-sm-4 border-right">
				<div class="description-block">
					<h5 class="description-header"><?php echo $request['views']; ?></h5>
					<span class="description-text">Views</span>
				</div>
				<!-- /.description-block -->
			</div>
			<!-- /.col -->
			<div class="col-sm-4">
				<div class="description-block">
					<h5 class="description-header"><?php echo strtoupper($request['blood_group']) ?></h5>
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
					Status <span class="float-right badge <?php if($request['status'] == 0) echo "bg-danger"; else echo "bg-primary";  ?>"><?php echo $request['status']==1?"Active":"Disabled"; ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Fulfilled <span class="float-right badge <?php if($request['fulfilled'] == 0) echo "bg-danger"; else echo "bg-primary";  ?>"><?php echo $request['fulfilled']==1?"Fulfilled":"NOT fulfilled yet"; ?></span>
				</span>
			</li>

			<li class="nav-item">
				<span class="nav-link">
					Date of birth <span class="float-right"><?php echo date("d-m-Y", strtotime($request['date_of_birth'])); ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Contact# <span class="float-right"><?php echo $request['mobile'] ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Message <span class="float-right"><?php echo $request['message'] ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Address / Hospital <span class="float-right"><?php echo $request['hospital_name'] ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Location <span class="float-right"><?php echo $request['location']."<br>".$request['latitude'].", ".$request['longitude']; ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					City, State, Country <span class="float-right"><?php echo $request['city_name'].", ".$request['state_name'].", ".$request['country_name'] ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Added by <span class="float-right"><?php echo $request['addedBy'] ?></span>
				</span>
			</li>
			<li class="nav-item">
				<span class="nav-link">
					Member Since <span class="float-right"><?php echo date("d-m-Y h:i:s a", strtotime($request['created'])) ?></span>
				</span>
			</li>
		</ul>
	</div>
</div>