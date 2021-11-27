<!-- This is HTML5 
<!DOCTYPE html> -->
<?php
  session_start();
?>

<!-- html files must have html tag -->
	<html>
		<!-- the head tag contains information related to the document -->
			<head>
				<meta charset="utf-8">
				<title>The Warbler</title>
				<!-- links for css, js, and animate.css stylesheet -->
				<link href="../assets/css/styles.css" rel="stylesheet" type="text/css"/>
			  <script src="../assets/js/script.js" type="text/javascript"></script>
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
			</head>
			<!-- the first class wraps the entire document for use in CSS  -->
		  <div class="wrapper">
				<!-- the body tag contains the document features -->
				<body>				
				<!-- the header tag is related to the header information of the document -->
					<header>
					  <?php include '../inc/header.inc' ?>
					</header>
					<!-- the nav tag is related to navigating the page(s) -->
					<!-- There are five related pages for the client side, four of which are in nav -->
					<nav>
						<div>
							<a href="../index.php"> Home</a>
							<!-- <a href="../results/results.php"> Results</a> -->
							<a href=""> Submission</a>
							<a href="../register/registration.php"> Registration</a>
						</div>
					</nav>
					<!-- article tags are a way to section the page -->
					<article>
					<!-- section tags are inner sectioning of articles -->
						<section>
						<!-- The first section of the article will have a class to specify position in CSS -->
						  <div class="uptop">
							  <?php
									$is_session_valid = 0;
									if (isset($_SESSION['valid'])) {
										if (!empty($_SESSION['valid'])) {
											if ($_SESSION['valid'] == true) {
												$is_session_valid = 1;
											}
										}
									}
									if ($is_session_valid == 0) {
								?>
							  <p class="animate__animated animate__flash"> If you are registered,
 								and you want to submit a store, or a review, login to The Warbler</p>
								
								<?php 
								  if(isset($_SESSION['status_message'])) {
										if (!empty($_SESSION['status_message'])) {
											$msg = "";
											if ($_SESSION['status_message'] == 'invalid') {
												$msg = "Invalid credentials.";
												$_SESSION['status_message'] = '';
											}
											echo '<p class="animate__animated animate__flash">' . $msg . ' </p>';
										}
									}
								?>
								<form action="../php/login.php" method="POST">
								  <?php
									  $username_remembered = 0;
										$username = '';
										if (isset($_COOKIE['rememberme'])) {
											if (!empty($_COOKIE['rememberme'])) {
												if (isset($_COOKIE['uname'])) {
											    if (!empty($_COOKIE['uname'])) {
														$username_remembered = 1;
														$username = $_COOKIE['uname'];
													}
												}
											}
										}
									?>
								  <label class="form_labels"> Username: </label>
									<br> <br>
									<input type="text" name="username" class="Username" placeholder="Enter a username"
									value="<?php if($username_remembered == 1) { echo $username; } ?>">
									<br> <br> <br>
									<label class="form_labels"> Password: </label>
									<br> <br>
									<input type="password" name="password" class="password" placeholder="Enter a password">
									<br> <br> <br>
			            <label class="form_labels"> Remember me: </label>
			            <input type="checkbox" name="checkbox" class="checkbox" 
									<?php if($username_remembered == 1){ echo 'checked="checked"'; } ?>>
									<br> <br> <br>
									<input type="submit" name="submit" class="submit" value="Enter">
									<input type="hidden" name="login_token" value="abcdefg" >
								</form>
									<?php } else { ?>
							      <p class="animate__animated animate__flash"> You are logged into The Warbler 
										<?php echo $_SESSION['userfullname']; ?> </p>
										<a href="../php/logout.php">Logout</a>
										<br> <br> <br>
							    <!-- php } ?--> 
							</div>
						</section>
						  
						<section>
							
							
							<!-- the info text is animated -->
								<p class="animate__animated animate__flash">Submit a Cannabis retail business to The Warbler</p>
							<!-- This form takes as input textual elements for business information -->
							<!-- as well as image and video elements -->
							<!-- to enter an object into the database of businesses, but server is not implemented -->
								<form action="../php/business.php" method="POST">
									<label class="form_labels"> Name: </label>
									<br> <br>
									<input type="text" name="name" class="Business_Name" placeholder="Business Name" required>
									<br> <br> <br>
									<label class="form_labels"> Description: </label>
									<br> <br>
									<input type="text" name="description" class="Description" placeholder="Description" required>
									<br> <br> <br>
									<!-- use the Geolocation API to find user location -->
									<button type="button" onclick="getLocation()">Use my location!</button>
									<label class="form_labels"> Latitude: </label>
									<br> 
									<!-- use the HTML5 and CSS3 form validation for patterns -->
									<input type="text" name="latitude" id="latitude" class="Latitude" placeholder="Latitude" pattern="^(\-?|\+?)?\d+(\.\d+)?$" required>
									<br> <br> <br>
									<label class="form_labels"> Longitude: </label>
									<br> <br>
									<input type="text" name="longitude" id="longitude" class="Longitude" placeholder="Longitude" pattern="^((\-?|\+?)?\d+(\.\d+)?)$" required>
									<br> <br> <br>
									<label class="form_labels"> Image: </label>
									<br> <br>
									<input type="file" name="object_image" class="object_image" value="fileupload" accept="image/*">
									<br> <br> <br>
									<label class="form_labels"> Video: </label>
									<br> <br>
									<input type="file" name="object_video" class="object_video" value="fileupload" accept="video/*">
									<br> <br> <br>
									<input type="submit" name="submit" class="submit" value="Enter">
									<input type="hidden" name="save_token" value="abcdefg" >
								</form>
							
						</section>
						<section>
						  <div class="downbottom">
							  <form action="../php/review.php" method="POST">
								  <br> <br> <br>
								  <label class="form_labels"> Name: </label>
									<br> <br>
									<input type="text" name="name" class="Business_Name" placeholder="Business Name" required>
									<br> <br> <br>
									<label class="form_labels"> Description: </label>
									<br> <br>
									<input type="text" name="description" class="Description" placeholder="Description" required>
									<br> <br> <br>
								  <label class="form_labels"> Rating(1-5 stars): </label>
									<br> <br>
									<input type="number" name="rating" class="Rating" placeholder="#" min="1" max="5" required>
									<br> <br> <br>
									<input type="submit" name="submit" class="submit" value="Enter">
									<input type="hidden" name="save_token" value="abcdefg" >
								</form>
							</div>
						</section>
					</article>
					<?php } ?>
				  <footer>
						<p>Created by <a href="">Samuel Alderson</a> </p>
					</footer>
				</body>
			</div>
		</html>