<?php
include_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once '../../configuration/header3.php';
    ?>
	<title>Dashboard</title>
</head>
<body>

<!-- Loader -->
<div class="loader"></div>

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="" class="brand">
			<span class="text">MAGRENT</span>
		</a>
		<ul class="side-menu top">
			<li  class="active">
				<a href="./">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="user">
					<i class='bx bxs-user-plus'></i>
					<span class="text">User Account</span>
				</a>
			</li>
			<li>
				<a href="pending-user">
					<i class='bx bxs-user-account'></i>
					<span class="text">Pending User</span>
				</a>
			</li>
			<li>
				<a href="package">
					<i class='bx bxs-package' ></i>
					<span class="text">Package</span>
				</a>
			</li>
			<li>
				<a href="payment?status=?">
					<i class='bx bxs-credit-card'></i>
					<span class="text">Payment</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu top">
			<li>
				<a href="settings">
					<i class='bx bxs-cog' ></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="audit-trail">
					<i class='bx bxl-blogger'></i>
					<span class="text">Audit Trail</span>
				</a>
			</li>
			<li>
				<a href="authentication/admin-signout" class="btn-signout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Signout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<form action="#">
				<div class="form-input">
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>
			<div class="username">
                <span>Hello, <label for=""><?php echo $user_fname ?></label></span>
            </div>
			<a href="profile" class="profile" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Profile">
				<img src="../../src/images/profile/<?php echo $user_profile ?>">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a class="active" href="./">Home</a>
						</li>
						<li>|</li>
						<li>
							<a href="">Dashboard</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="dashboard_data">
				<li>
					<i class='bx bx-user-circle'></i>
					<span class="text">
					<?php
								$pdoQuery = "SELECT * FROM 	users WHERE user_type = :user_type";
								$pdoResult1 = $pdoConnect->prepare($pdoQuery);
								$pdoResult1->execute(array(":user_type" => 2));

								$count = $pdoResult1->rowCount();

								echo
								"
									<h3>$count</h3>
								";
							?>
						<p>Agent Accounts</p>
					</span>
				</li>

				<li>
					<i class='bx bx-user-circle'></i>
					<span class="text">
					<?php
								$pdoQuery = "SELECT * FROM 	users WHERE user_type = :user_type AND status=:status";
								$pdoResult1 = $pdoConnect->prepare($pdoQuery);
								$pdoResult1->execute(array(":user_type" => 2, ":status" => "N"));

								$count = $pdoResult1->rowCount();

								echo
								"
									<h3>$count</h3>
								";
							?>
						<p>Pending Agent Accounts</p>
					</span>
				</li>

				<li>
					<i class='bx bx-user-circle'></i>
					<span class="text">
					<?php
								$pdoQuery = "SELECT * FROM 	users WHERE user_type = :user_type";
								$pdoResult1 = $pdoConnect->prepare($pdoQuery);
								$pdoResult1->execute(array(":user_type" => 3));

								$count = $pdoResult1->rowCount();

								echo
								"
									<h3>$count</h3>
								";
							?>
						<p>User Accounts</p>
					</span>
				</li>

				<li>
					<i class='bx bxs-building-house' ></i>
					<span class="text">
					<?php
								$pdoQuery = "SELECT * FROM 	property";
								$pdoResult1 = $pdoConnect->prepare($pdoQuery);
								$pdoResult1->execute();

								$count = $pdoResult1->rowCount();

								echo
								"
									<h3>$count</h3>
								";
							?>
						<p>Property</p>
					</span>
				</li>

				<li>
					<i class='bx bxs-credit-card' ></i>
					<span class="text">
					<?php
								$pdoQuery = "SELECT * FROM 	payment WHERE status = :status";
								$pdoResult1 = $pdoConnect->prepare($pdoQuery);
								$pdoResult1->execute(array(":status" => "pending"));

								$count = $pdoResult1->rowCount();

								echo
								"
									<h3>$count</h3>
								";
							?>
						<p>Pending Payment</p>
					</span>
				</li>


				<li>
					<i class='bx bxs-package' ></i>
					<span class="text">
					<?php
								$pdoQuery = "SELECT * FROM 	package";
								$pdoResult1 = $pdoConnect->prepare($pdoQuery);
								$pdoResult1->execute();

								$count = $pdoResult1->rowCount();

								echo
								"
									<h3>$count</h3>
								";
							?>
						<p>Package</p>
					</span>
				</li>
			</ul>
			
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

	<?php
    include_once '../../configuration/footer3.php';
    ?>
    <?php include_once '../../configuration/sweetalert.php'; ?>

</body>
</html>