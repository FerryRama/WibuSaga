<!--**********************************
            Content body start
        ***********************************-->

<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-6 col-xxl-12">
				<div class="row">
					<div class="col-sm-6">
						<div class="card avtivity-card">
							<div class="card-body">
								<div class="media align-items-center">
									<span class="activity-icon bgl-success mr-md-4 mr-3">
										<svg id="icon-customers" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
											<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
											<circle cx="12" cy="7" r="4"></circle>
										</svg>
									</span>
									<div class="media-body">
										<p class="fs-14 mb-2">Total Users</p>
										<span class="title text-black font-w600"><?= $total_users; ?> Users</span>
									</div>
								</div>
								<div class="progress" style="height:5px;">
									<div class="progress-bar bg-success" style="width: <?= $total_users; ?>%; height:5px;" role="progressbar">
										<span class="sr-only"><?= $total_users; ?></span>
									</div>
								</div>
							</div>
							<div class="effect bg-success"></div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="widget-stat card avtivity-card">
							<div class="card-body p-4">
								<div class="media">
									<span class="activity-icon bgl-secondary  mr-md-4 mr-4">

										<i class="la la-users"></i>
									</span>
									</span>
									<div class="media-body">
										<p class="fs-14 mb-2">Total Online</p>
										<span class="title text-black font-w600"><?= $total_online['connNumber']; ?></span>
									</div>
								</div>
								<div class="progress" style="height:5px;">
									<div class="progress-bar bg-secondary" style="width: <?= $total_online['connNumber']; ?>%; height:5px;" role="progressbar">
										<span class="sr-only"><?= $total_online['connNumber']; ?></span>
									</div>
								</div>
							</div>
							<div class="effect bg-secondary"></div>
						</div>
					</div>

				</div>
			</div>


			<div class="col-xl-6 col-xxl-12">
				<div class="row">
					<div class="col-sm-6">
						<div class="card avtivity-card">
							<div class="card-body">
								<div class="media align-items-center">
									<span class="activity-icon bgl-success mr-md-4 mr-3">
										<svg id="icon-revenue" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
											<line x1="12" y1="1" x2="12" y2="23"></line>
											<path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
										</svg>
									</span>
									<div class="media-body">
										<p class="fs-14 mb-2">Total Bonus Cash</p>
										<?php foreach ($totalbonuscash as $bonuscash) : ?>
											<span class="title text-black font-w600"><?= number_format($bonuscash, '0', '.', '.') ?></span>
										<?php endforeach; ?>
									</div>
								</div>
								<div class="progress" style="height:5px;">
									<div class="progress-bar bg-success" style="width: <?= $bonuscash; ?>%; height:5px;" role="progressbar">
										<span class="sr-only"></span>
									</div>
								</div>
							</div>
							<div class="effect bg-success"></div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card avtivity-card">
							<div class="card-body">
								<div class="media align-items-center">
									<span class="activity-icon bgl-secondary  mr-md-4 mr-4">
										<svg id="icon-revenue" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
											<line x1="12" y1="1" x2="12" y2="23"></line>
											<path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
										</svg>
									</span>
									<div class="media-body">
										<p class="fs-14 mb-2">Total Real Cash</p>
										<?php foreach ($totalrealcash as $realcash) : ?>
											<span class="title text-black font-w600"><?= number_format($realcash, '0', '.', '.') ?></span>
										<?php endforeach; ?>
									</div>
								</div>
								<div class="progress" style="height:5px;">
									<div class="progress-bar bg-secondary" style="width:  <?= $realcash; ?>%; height:5px;" role="progressbar">
										<span class="sr-only"><?= $realcash; ?></span>
									</div>
								</div>
							</div>
							<div class="effect bg-secondary"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="profile card card-body px-3 pt-3 pb-0">
				<div class="profile-head">
					<div class="photo-content">
						<div class="cover-photo"></div>
					</div>
					<div class="profile-info">
						<div class="profile-photo">
							<img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-fluid rounded-circle" alt="">
						</div>
						<div class="profile-details">
							<div class="profile-name px-3 pt-2">
								<h4 class="text-primary mb-0"><?= $user['userID']; ?></h4>
								<p><?php
									$user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
									if ($user['role_id'] == 1) {
										echo 'Adminstrator/Developer';
									} elseif ($user['role_id'] == 2) {
										echo 'Game Master';
									} else {
										echo 'User';
									} ?></p>
							</div>
							<div class="profile-email px-2 pt-2">
								<h4 class="text-muted mb-0"><?= $user['email']; ?></h4>
								<p>Email</p>
							</div>
							<div class="dropdown ml-auto">
								<a href="#" class="btn btn-primary light sharp" data-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<rect x="0" y="0" width="24" height="24"></rect>
											<circle fill="#000000" cx="5" cy="12" r="2"></circle>
											<circle fill="#000000" cx="12" cy="12" r="2"></circle>
											<circle fill="#000000" cx="19" cy="12" r="2"></circle>
										</g>
									</svg></a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li class="dropdown-item"><i class="fa fa-user-circle text-primary mr-2"></i> View profile</li>
									<li class="dropdown-item"><i class="fa fa-users text-primary mr-2"></i> Add to close friends</li>
									<li class="dropdown-item"><i class="fa fa-plus text-primary mr-2"></i> Add to group</li>
									<li class="dropdown-item"><i class="fa fa-ban text-primary mr-2"></i> Block</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--********************************** Content body end ***********************************-->