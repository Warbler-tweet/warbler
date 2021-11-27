 <!-- This is HTML5 -->
<!DOCTYPE html>
<!-- html files must have html tag -->
	<html lang="en">
		<!-- the head tag contains information related to the document -->
		<head>
			<meta charset="utf-8">
			<title>The Warbler</title>
			<!-- Basic Metadata for Open Graph Markup --> 
			<meta property="og:title" content="The Warbler" />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="https://www.TheWarbler.ca" />
      <meta property="og:image" content="https://www.thewarbler.ca/images/warbler.PNG" />
			<meta property="og:description" content="locate geographically cannabis businesses" />
			<!-- Basic Meta data for twitter cards-->
			<meta name="twitter:card" content="summary_large_image">
			<meta name="twitter:title" content="The Warbler business locator">
			<meta name="twitter:description" content="The Warbler finds local Cannabis business lcoationss">
      <meta name="twitter:image" content="http://www.thewarbler.ca/image/warbler.PNG">
			<!-- Basic Meta Data for iOS home screen-->
      <link rel="apple-touch-icon" href="https://www.thewarbler.ca/images/warbler.PNG"/>	
			<link rel="apple-touch-startup-image" href="https://www.thewarbler.ca/images/warbler.PNG" />
			<meta name="apple-mobile-web-app-capable" content="yes" />
			<meta name="apple-mobile-web-app-status-bar-style" content="black" />
			<!-- links for css, js, and animate.css stylesheet -->
			<link href="assets/css/styles.css" rel="stylesheet" type="text/css"/>
			<script src="assets/js/script.js" type="text/javascript"></script>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
			
		</head>
				<!-- the first class wraps the entire document for use in CSS  -->
		 <div class="wrapper">
				<!-- the body tag contains the document features -->
				<body>
				<!-- the header tag is related to the header information of the document -->
					<header>
					  <?php include 'inc/header.inc' ?>
					</header>
					<!-- the nav tag is related to navigating the page(s) -->
					<!-- There are five related pages for the client side, four of which are in nav -->
					<nav>
						<div>
							<a href=""> Home</a>
							<!-- <a href="results/results.php"> Results</a> -->
							<a href="submit/submission.php"> Submission</a>
							<a href="register/registration.php"> Registration</a>
						</div>
					</nav>
					<!-- article tags are a way to section the page -->
					<article>
					<!-- section tags are inner sectioning of articles -->
						<section>
							<!-- The first section of the article will have a class to specify position in CSS -->
								<div class="uptop">
								<!-- the info text is animated -->
									<p class="animate__animated animate__flash">The Warbler brings cannabis enthusiasts and licensed cannabis businesses together.</p>
									<!-- There are three forms below, each for a different kind of search -->
									<!-- This form takes as input a text search string and submits to a results page specific for text searches -->
									<form action="results/results_text.php" method="POST" >
										<input type="text" name="text" class="search" value="" placeholder="Search for stores near you!">
										<input type="hidden" name="save_token" value="abcdefg" >
										<input type="submit" name="location" class="location" value="Submit">
										<input type="reset" value="Reset">
										<br> <br>
									</form>
									<!-- This form takes as input an integer and submits to a results page specific for rating queries -->
									<form action="results/results_rating.php" method="POST" >
										<select name="rating" class="rating">
											<option type="number" value='0'>Rating</option>
											<!-- <option type="number" value='1'>0 - 1</option> -->
											<option type="number" value='2'>1 - 2</option>
											<option type="number" value='3'>2 - 3</option>
											<option type="number" value='4'>3 - 4</option>
											<option type="number" value='5'>4 - 5</option>
										</select>
										<input type="hidden" name="save_token" value="abcdefg" >
										<input type="submit" name="location" class="location" value="Submit">
										<input type="reset" value="Reset">
									</form>
									<!-- This form takes as input two floating values representing latitude and longitude 
									and submits to a results page specific for latitude and longitude queries -->
									<form action="results/results_location.php" method="POST" >
										<br>
										<!-- use the Geolocation API to find user location -->
										<button type="button" onclick="getLocation();" >Search by my  location!</button>
										<!-- enter the user location into a form -->
										<input type="floatval" name="latitude" id="latitude" value='0'>
										<input type="floatval" name="longitude" id="longitude" value='0'>
										<input type="hidden" name="save_token" value="abcdefg" >
										<input type="submit" name="location" class="location" value="Submit">
										<input type="reset" value="Reset">
									</form>
								</div>
									</section>
							</article>
							<!-- the footer tag is related to the footer information of the document -->
							<footer>
								<p>Created by <a href="">Samuel Alderson</a>
								</p>
							</footer>
						</body>
					</div>
				</html>