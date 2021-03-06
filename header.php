<!DOCTYPE html>

<?php session_start(); ?>

<html>

<head>
	<meta name="description" content="This is a library management system for tracking checkouts of books and other materials.">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<!-- CSS only -->
	<Link rel="stylesheet" href="css/reset.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<Link rel="stylesheet" href="css/style.css">
	<title>Phoenux Online Library</title>

</head>

<body>

	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="library.php">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-half" viewBox="0 0 16 16">
  					<path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8
					   1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 
					   1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5
					    0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
					</svg>
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
					data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<!-- <li class="nav-item">
							<a class="nav-link active" aria-current="page" href="index.php">Home</a>
						</li> -->
						<li class="nav-item">
							<a class="nav-link" href="library.php">Library</a>
						</li>
						


					</ul>
					
						
						<?php
						echo $status = (isset($_SESSION['userName'])) ? 
						
						'<a href="profile.php"><button class="btn btn-info" type="submit">Profile Page</button></a> 
						<a href="scripts/logoutScript.php"><button class="btn btn-danger" type="submit" name="logout-submit">Logout</button></a>'
						:
						'<form class="d-flex" action="scripts/loginScript.php" method="POST">
						<input class="form-control me-2" type="text" name="mailuid" placeholder="Username/Email">
						<input class="form-control me-2" type="password" name="pwd" placeholder="Password">
 						<button class="btn btn-primary" type="submit" name="login-submit">Login</button>
						<a href="signup.php">Signup</a>
						</form>'
						;
						?>



				</div>
			</div>
		</nav>

	</header>
</body>

<html>