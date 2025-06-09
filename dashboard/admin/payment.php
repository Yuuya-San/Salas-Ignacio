<?php
include_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	include_once '../../configuration/header3.php';
	?>
	<title>Payment</title>
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
			<li>
				<a href="./">
					<i class='bx bxs-dashboard'></i>
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
					<i class='bx bxs-package'></i>
					<span class="text">Package</span>
				</a>
			</li>
			<li class="active">
				<a href="payment?status=?">
					<i class='bx bxs-credit-card'></i>
					<span class="text">Payment</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu top">
			<li>
				<a href="settings">
					<i class='bx bxs-cog'></i>
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
					<i class='bx bxs-log-out-circle'></i>
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
			<i class='bx bx-menu'></i>
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
					<h1>Payment</h1>
					<ul class="breadcrumb">
						<li>
							<a class="active" href="./">Home</a>
						</li>
						<li>|</li>
						<li>
							<a href="">Payment</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="table-data">
				<!-- pending -->
				<?php
				if ($_GET['status'] == "pending" || $_GET['status'] == "?") {
				?>
					<div class="order">
						<div class="head">
							<h3><i class='bx bxs-credit-card'></i> List of Pending Payment</h3>
						</div>
						<button type="button" onclick="location.href='payment?status=pending'" class="archives btn-warning"><i class='bx bx-time'></i> Pending</button>
						<button type="button" onclick="location.href='payment?status=accepted'" class="archives btn-info"><i class='bx bxs-check-circle'></i> Accepted</button>
						<button type="button" onclick="location.href='payment?status=decline'" class="archives btn-success"><i class='bx bxs-shield-x'></i> Decline</button>
						<button type="button" onclick="location.href='payment?status=expired'" class="archives btn-danger"><i class='bx bxs-calendar-x'></i> Expired</button>
						<button type="button" class="archives btn-dark"><a href="controller/export-controller" class="export" style="color: white;"><i class='bx bx-export'></i> Export</a></button>

						<!-- BODY -->
						<section class="data-table">
							<div class="searchBx">
								<input type="input" placeholder="Search . . . . . ." class="search" name="search_box" id="search_box"><button class="searchBtn"><i class="bx bx-search icon"></i></button>
							</div>

							<div class="table">
								<div id="dynamic_content">
								</div>

						</section>
					</div>
				<?php
				} else if ($_GET['status'] == "accepted") {
				?>
					<div class="order">
						<div class="head">
							<h3><i class='bx bxs-credit-card'></i> List of Accepted Payment</h3>
						</div>
						<button type="button" onclick="location.href='payment?status=pending'" class="archives btn-warning"><i class='bx bx-time'></i> Pending</button>
						<button type="button" onclick="location.href='payment?status=accepted'" class="archives btn-info"><i class='bx bxs-check-circle'></i> Accepted</button>
						<button type="button" onclick="location.href='payment?status=decline'" class="archives btn-success"><i class='bx bxs-shield-x'></i> Decline</button>
						<button type="button" onclick="location.href='payment?status=expired'" class="archives btn-danger"><i class='bx bxs-calendar-x'></i> Expired</button>
						<button type="button" class="archives btn-dark"><a href="controller/export-controller" class="export" style="color: white;"><i class='bx bx-export'></i> Export</a></button>


						<!-- BODY -->
						<section class="data-table">
							<div class="searchBx">
								<input type="input" placeholder="Search . . . . . ." class="search" name="search_box1" id="search_box1"><button class="searchBtn"><i class="bx bx-search icon"></i></button>
							</div>

							<div class="table">
								<div id="dynamic_content1">
								</div>

						</section>
					</div>
				<?php
				} else if ($_GET['status'] == "decline") {
				?>
					<div class="order">
						<div class="head">
							<h3><i class='bx bxs-credit-card'></i> List of Decline Payment</h3>
						</div>
						<button type="button" onclick="location.href='payment?status=pending'" class="archives btn-warning"><i class='bx bx-time'></i> Pending</button>
						<button type="button" onclick="location.href='payment?status=accepted'" class="archives btn-info"><i class='bx bxs-check-circle'></i> Accepted</button>
						<button type="button" onclick="location.href='payment?status=decline'" class="archives btn-success"><i class='bx bxs-shield-x'></i> Decline</button>
						<button type="button" onclick="location.href='payment?status=expired'" class="archives btn-danger"><i class='bx bxs-calendar-x'></i> Expired</button>
						<button type="button" class="archives btn-dark"><a href="controller/export-controller" class="export" style="color: white;"><i class='bx bx-export'></i> Export</a></button>


						<!-- BODY -->
						<section class="data-table">
							<div class="searchBx">
								<input type="input" placeholder="Search . . . . . ." class="search" name="search_box2" id="search_box2"><button class="searchBtn"><i class="bx bx-search icon"></i></button>
							</div>

							<div class="table">
								<div id="dynamic_content2">
								</div>

						</section>
					</div>
				<?php
				} else if ($_GET['status'] == "expired") {
				?>
					<div class="order">
						<div class="head">
							<h3><i class='bx bxs-credit-card'></i> List of Expired Payment</h3>
						</div>
						<button type="button" onclick="location.href='payment?status=pending'" class="archives btn-warning"><i class='bx bx-time'></i> Pending</button>
						<button type="button" onclick="location.href='payment?status=accepted'" class="archives btn-info"><i class='bx bxs-check-circle'></i> Accepted</button>
						<button type="button" onclick="location.href='payment?status=decline'" class="archives btn-success"><i class='bx bxs-shield-x'></i> Decline</button>
						<button type="button" onclick="location.href='payment?status=expired'" class="archives btn-danger"><i class='bx bxs-calendar-x'></i> Expired</button>
						<button type="button" class="archives btn-dark"><a href="controller/export-controller" class="export" style="color: white;"><i class='bx bx-export'></i> Export</a></button>


						<!-- BODY -->
						<section class="data-table">
							<div class="searchBx">
								<input type="input" placeholder="Search . . . . . ." class="search" name="search_box3" id="search_box3"><button class="searchBtn"><i class="bx bx-search icon"></i></button>
							</div>

							<div class="table">
								<div id="dynamic_content3">
								</div>

						</section>
					</div>
				<?php
				}
				?>

			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

	<?php
	include_once '../../configuration/footer3.php';
	?>
	<script>
		//Pending live search---------------------------------------------------------------------------------------//
		$(document).ready(function() {

			load_data(1);

			function load_data(page, query = '') {
				$.ajax({
					url: "tables/pending-payment-table.php",
					method: "POST",
					data: {
						page: page,
						query: query
					},
					success: function(data) {
						$('#dynamic_content').html(data);
					}
				});
			}

			$(document).on('click', '.page-link', function() {
				var page = $(this).data('page_number');
				var query = $('#search_box').val();
				load_data(page, query);
			});

			$('#search_box').keyup(function() {
				var query = $('#search_box').val();
				load_data(1, query);
			});

		});

		// //Accepted live search---------------------------------------------------------------------------------------//
		$(document).ready(function() {

			load_data(1);

			function load_data(page, query = '') {
				$.ajax({
					url: "tables/accepted-payment-table.php",
					method: "POST",
					data: {
						page: page,
						query: query
					},
					success: function(data) {
						$('#dynamic_content1').html(data);
					}
				});
			}

			$(document).on('click', '.page-link', function() {
				var page = $(this).data('page_number');
				var query = $('#search_box1').val();
				load_data(page, query);
			});

			$('#search_box1').keyup(function() {
				var query = $('#search_box1').val();
				load_data(1, query);
			});

		});

		// //Decline live search---------------------------------------------------------------------------------------//
		$(document).ready(function() {

			load_data(1);

			function load_data(page, query = '') {
				$.ajax({
					url: "tables/decline-payment-table.php",
					method: "POST",
					data: {
						page: page,
						query: query
					},
					success: function(data) {
						$('#dynamic_content2').html(data);
					}
				});
			}

			$(document).on('click', '.page-link', function() {
				var page = $(this).data('page_number');
				var query = $('#search_box2').val();
				load_data(page, query);
			});

			$('#search_box2').keyup(function() {
				var query = $('#search_box2').val();
				load_data(1, query);
			});

		});

		// //Expired live search---------------------------------------------------------------------------------------//
		$(document).ready(function() {

			load_data(1);

			function load_data(page, query = '') {
				$.ajax({
					url: "tables/expired-payment-table.php",
					method: "POST",
					data: {
						page: page,
						query: query
					},
					success: function(data) {
						$('#dynamic_content3').html(data);
					}
				});
			}

			$(document).on('click', '.page-link', function() {
				var page = $(this).data('page_number');
				var query = $('#search_box3').val();
				load_data(page, query);
			});

			$('#search_box3').keyup(function() {
				var query = $('#search_box3').val();
				load_data(1, query);
			});

		});
	</script>
	<?php include_once '../../configuration/sweetalert.php'; ?>

</body>

</html>