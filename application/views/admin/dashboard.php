<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Dashboard <small><?php
						if (isset($title)) {
							echo $title;
						} ?></small></h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item active"><a href="<?php
						echo base_url(); ?>">Home</a></li>
				</ol>
			</div>
		</div>
	</div>
</div>
<section class="content">
	<div class="container-fluid">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-4 col-6">
				<!-- small box -->
				<div class="small-box bg-info">
					<div class="inner">
						<h3><?php
							echo $total_donors; ?></h3>

						<p>Blood Donors</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
					<a href="<?php
					echo base_url('admin/blooddonors') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-4 col-6">
				<!-- small box -->
				<div class="small-box bg-success">
					<div class="inner">
						<h3><?php
							echo $total_requests; ?></h3>

						<p>Blood Requests</p>
					</div>
					<div class="icon">
						<i class="ion ion-stats-bars"></i>
					</div>
					<a href="<?php
					echo base_url('admin/bloodrequests') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-4 col-6">
				<!-- small box -->
				<div class="small-box bg-warning">
					<div class="inner">
						<h3><?php
							echo $total_blood_banks; ?></h3>

						<p>Blood Banks</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="<?php
					echo base_url('admin/bloodbanks') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-4 col-6">
				<!-- small box -->
				<div class="small-box bg-danger">
					<div class="inner">
						<h3><?php
							echo $total_users; ?></h3>

						<p>App Users</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph"></i>
					</div>
					<a href="<?php
					echo base_url('admin/appusers') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-4 col-6">
				<!-- small box -->
				<div class="small-box bg-warning">
					<div class="inner">
						<h3><?php
							echo $total_blogs; ?></h3>

						<p>Blogs</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="<?php
					echo base_url('admin/blogs') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>

			<div class="col-lg-4 col-6">
				<!-- small box -->
				<div class="small-box bg-info">
					<div class="inner">
						<h3><?php
							echo $total_calls; ?></h3>

						<p>Contacts/Calls</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header border-0">
						<div class="d-flex justify-content-between">
							<h3 class="card-title">Last 6 months users joining</h3>
							<!--                <a href="javascript:void(0);">View Report</a>-->
						</div>
					</div>
					<div class="card-body">
						<!--              <div class="d-flex">-->
						<!--                <p class="d-flex flex-column">-->
						<!--                  <span class="text-bold text-lg">$18,230.00</span>-->
						<!--                  <span>Sales Over Time</span>-->
						<!--                </p>-->
						<!--                <p class="ml-auto d-flex flex-column text-right">-->
						<!--                    <span class="text-success">-->
						<!--                      <i class="fas fa-arrow-up"></i> 33.1%-->
						<!--                    </span>-->
						<!--                  <span class="text-muted">Since last month</span>-->
						<!--                </p>-->
						<!--              </div>-->
						<!-- /.d-flex -->

						<div class="position-relative mb-4">
							<canvas id="monthly-users-chart" height="270"></canvas>
						</div>

						<!--              <div class="d-flex flex-row justify-content-end">-->
						<!--                  <span class="mr-2">-->
						<!--                    <i class="fas fa-square text-primary"></i> This year-->
						<!--                  </span>-->
						<!---->
						<!--                <span>-->
						<!--                    <i class="fas fa-square text-gray"></i> Last year-->
						<!--                  </span>-->
						<!--              </div>-->
					</div>
				</div>
				<!--          --><?php
				//ewodie($recent_donors_chart); ?>
				<!-- /.card -->
			</div>

			<div class="col-md-6">
				<div class="card">
					<div class="card-header border-0">
						<div class="d-flex justify-content-between">
							<h3 class="card-title">Last 6 months donor joining</h3>
							<!--                <a href="javascript:void(0);">View Report</a>-->
						</div>
					</div>
					<div class="card-body">
						<!--              <div class="d-flex">-->
						<!--                <p class="d-flex flex-column">-->
						<!--                  <span class="text-bold text-lg">$18,230.00</span>-->
						<!--                  <span>Sales Over Time</span>-->
						<!--                </p>-->
						<!--                <p class="ml-auto d-flex flex-column text-right">-->
						<!--                    <span class="text-success">-->
						<!--                      <i class="fas fa-arrow-up"></i> 33.1%-->
						<!--                    </span>-->
						<!--                  <span class="text-muted">Since last month</span>-->
						<!--                </p>-->
						<!--              </div>-->
						<!-- /.d-flex -->

						<div class="position-relative mb-4">
							<canvas id="monthly-donors-chart" height="270"></canvas>
						</div>

						<!--              <div class="d-flex flex-row justify-content-end">-->
						<!--                  <span class="mr-2">-->
						<!--                    <i class="fas fa-square text-primary"></i> This year-->
						<!--                  </span>-->
						<!---->
						<!--                <span>-->
						<!--                    <i class="fas fa-square text-gray"></i> Last year-->
						<!--                  </span>-->
						<!--              </div>-->
					</div>
				</div>
				<!--          --><?php
				//ewodie($recent_donors_chart); ?>
				<!-- /.card -->
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header border-transparent">
						<h3 class="card-title">Recent Requests</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove">
								<i class="fas fa-times"></i>
							</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body p-0">
						<div class="table-responsive">
							<table class="table m-0 table-sm table-hover">
								<thead>
								<tr>
									<th>Request ID</th>
									<th>Requester Name</th>
									<th>City</th>
									<th>Blood Group</th>
									<th>Bags</th>
									<th>Fulfilled</th>
									<th>Requested at</th>
								</tr>
								</thead>
								<tbody>

								<?php
								if (isset($recent_blood_reqeusts)) {
									if(count($recent_blood_reqeusts)==0){
										 ?>
										<tr>
											<td class="text-center text-danger" colspan="7">No data found!</td>
										</tr>
										<?php
									}
									foreach ($recent_blood_reqeusts as $request) {
										?>
										<tr>
											<td><?php
												echo $request['id']; ?></td>
											<td><?php
												echo $request['full_name']; ?></td>
											<td><?php
												echo $request['city_name']; ?></td>
											<td><?php
												echo strtoupper($request['blood_group']); ?></td>
											<td><?php
												echo($request['no_of_bags']); ?></td>
											<td><span class="badge badge-<?php
												if ($request['fulfilled'] == 1) {
													echo 'success';
												} else {
													echo 'danger';
												} ?>"><?php
													if ($request['fulfilled'] == 1) {
														echo 'Yes';
													} else {
														echo 'No';
													}; ?></span></td>

											<td><?php
												echo date("d/m/Y h:i:s a", strtotime($request['created'])); ?></td>
										</tr>
										<?php
									}
								}
								?>
								</tbody>
							</table>
						</div>
						<!-- /.table-responsive -->
					</div>
					<!-- /.card-body -->
					<div class="card-footer clearfix">
						<a href="<?php
						echo base_url('admin/bloodrequests') ?>" class="btn btn-xs btn-secondary float-right">View All Requests</a>
					</div>
					<!-- /.card-footer -->
				</div>
			</div>


			<div class="col-md-12">
				<div class="card">
					<div class="card-header border-transparent">
						<h3 class="card-title">Recent Users</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove">
								<i class="fas fa-times"></i>
							</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body p-0">
						<div class="table-responsive">
							<table class="table m-0 table-sm table-hover">
								<thead>
								<tr>
									<th>User ID</th>
									<th>Name</th>
									<th>City</th>
									<th>Blood Group</th>
									<th>Status</th>
									<th>Registered at</th>
								</tr>
								</thead>
								<tbody>

								<?php
								if (isset($recent_users)) {

									if(count($recent_users)==0){
										?>
										<tr>
											<td class="text-center text-danger" colspan="6">No data found!</td>
										</tr>
										<?php
									}

									foreach ($recent_users as $user) {
										?>
										<tr>
											<td><?php
												echo $user['id']; ?></td>
											<td><?php
												echo $user['name']; ?></td>
											<td><?php
												echo $user['city_name']; ?></td>
											<td><?php
												echo strtoupper($user['blood_group']); ?></td>
											<td><span class="badge badge-<?php
												if ($user['status'] == 1) {
													echo 'success';
												} else {
													echo 'danger';
												} ?>"><?php
													if ($user['status'] == 1) {
														echo 'Active';
													} else {
														echo 'Disabled';
													}; ?></span></td>
											<td><?php
												echo date("d/m/Y h:i:s a", strtotime($user['created'])); ?></td>
										</tr>
										<?php
									}
								}
								?>
								</tbody>
							</table>
						</div>
						<!-- /.table-responsive -->
					</div>
					<!-- /.card-body -->
					<div class="card-footer clearfix">
						<a href="<?php
						echo base_url('admin/appusers') ?>" class="btn btn-xs btn-secondary float-right">View All Users</a>
					</div>
					<!-- /.card-footer -->
				</div>
			</div>

			<div class="col-md-12">
				<div class="card">
					<div class="card-header border-transparent">
						<h3 class="card-title">Recent Donors</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
							<button type="button" class="btn btn-tool" data-card-widget="remove">
								<i class="fas fa-times"></i>
							</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body p-0">
						<div class="table-responsive">
							<table class="table m-0 table-sm table-hover">
								<thead>
								<tr>
									<th>Donor ID</th>
									<th>Name</th>
									<th>City</th>
									<th>Blood Group</th>
									<th>Type</th>
									<th>Registered at</th>
								</tr>
								</thead>
								<tbody>

								<?php
								if (isset($recent_donors)) {
									if(count($recent_donors)==0){
										?>
										<tr>
											<td class="text-center text-danger" colspan="6">No data found!</td>
										</tr>
										<?php
									}

									foreach ($recent_donors as $donor) {
										?>
										<tr>
											<td><?php
												echo $donor['id']; ?></td>
											<td><?php
												echo $donor['full_name']; ?></td>
											<td><?php
												echo $donor['city_name']; ?></td>
											<td><?php
												echo strtoupper($donor['blood_group']); ?></td>
											<td><span class="badge badge-<?php
												if (strtolower($donor['type']) == 'free') {
													echo 'success';
												} else {
													echo 'danger';
												} ?>"><?php
													echo $donor['type']; ?></span></td>
											<td><?php
												echo date("d/m/Y h:i:s a", strtotime($donor['created'])); ?></td>
										</tr>
										<?php
									}
								}
								?>
								</tbody>
							</table>
						</div>
						<!-- /.table-responsive -->
					</div>
					<!-- /.card-body -->
					<div class="card-footer clearfix">
						<a href="<?php
						echo base_url('admin/blooddonors') ?>" class="btn btn-xs btn-secondary float-right">View All Donors</a>
					</div>
					<!-- /.card-footer -->
				</div>
			</div>


		</div>
	</div><!-- /.container-fluid -->
</section>

<script>


	var ticksStyle = {
		fontColor: '#495057',
		fontStyle: 'bold'
	}

	var mode = 'index'
	var intersect = true

	$(function () {
		var $donorsChart = $('#monthly-donors-chart')
		// eslint-disable-next-line no-unused-vars
		var donorsChart = new Chart($donorsChart, {
			type: 'bar',
			data: {
				labels: [<?php foreach ($recent_donors_chart as $don) {
					echo "'" . $don['name'] . "'" . ",";
				} ?>],
				datasets: [
					{
						backgroundColor: '#007bff',
						borderColor: '#007bff',
						data: [<?php foreach ($recent_donors_chart as $don) {
							foreach ($don['results'] as $data) {
								echo "'" . $data['TOTAL_DONORS'] . "'" . ",";
							}
						} ?>]
					},
					//{
					//    backgroundColor: '#ced4da',
					//    borderColor: '#ced4da',
					//    data: [<?php //foreach ($recent_donors_chart as $don){
					//      echo $don['month'].",";
					//    } ?>//]
					//}
				]
			},
			options: {
				maintainAspectRatio: false,
				tooltips: {
					mode: mode,
					intersect: intersect
				},
				hover: {
					mode: mode,
					intersect: intersect
				},
				legend: {
					display: false
				},
				scales: {
					yAxes: [{
						// display: false,
						gridLines: {
							display: true,
							lineWidth: '4px',
							color: 'rgba(0, 0, 0, .2)',
							zeroLineColor: 'transparent'
						},
						ticks: $.extend({
							beginAtZero: true,

							// Include a dollar sign in the ticks
							callback: function (value) {
								if (value >= 1000) {
									value /= 1000
									value += 'k'
								}

								return '' + value
							}
						}, ticksStyle)
					}],
					xAxes: [{
						display: true,
						gridLines: {
							display: false
						},
						ticks: ticksStyle
					}]
				}
			}
		})


		var $usersChart = $('#monthly-users-chart')
		// eslint-disable-next-line no-unused-vars
		var usersChart = new Chart($usersChart, {
			type: 'bar',
			data: {
				labels: [<?php foreach ($recent_users_chart as $don) {
					echo "'" . $don['name'] . "'" . ",";
				} ?>],
				datasets: [
					{
						backgroundColor: '#007bff',
						borderColor: '#007bff',
						data: [<?php foreach ($recent_users_chart as $don) {
							foreach ($don['results'] as $data) {
								echo "'" . $data['TOTAL_USERS'] . "'" . ",";
							}
						} ?>]
					},
					//{
					//    backgroundColor: '#ced4da',
					//    borderColor: '#ced4da',
					//    data: [<?php //foreach ($recent_users_chart as $don){
					//      echo $don['month'].",";
					//    } ?>//]
					//}
				]
			},
			options: {
				maintainAspectRatio: false,
				tooltips: {
					mode: mode,
					intersect: intersect
				},
				hover: {
					mode: mode,
					intersect: intersect
				},
				legend: {
					display: false
				},
				scales: {
					yAxes: [{
						// display: false,
						gridLines: {
							display: true,
							lineWidth: '4px',
							color: 'rgba(0, 0, 0, .2)',
							zeroLineColor: 'transparent'
						},
						ticks: $.extend({
							beginAtZero: true,

							// Include a dollar sign in the ticks
							callback: function (value) {
								if (value >= 1000) {
									value /= 1000
									value += 'k'
								}

								return '' + value
							}
						}, ticksStyle)
					}],
					xAxes: [{
						display: true,
						gridLines: {
							display: false
						},
						ticks: ticksStyle
					}]
				}
			}
		})

	})
</script>