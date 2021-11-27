<!-- This is HTML5 -->
<!DOCTYPE html>
<!-- html files must have html tag -->
<html>
		<!-- the head tag contains information related to the document -->
	<head>
		<meta charset="utf-8">
		<title>The Warbler</title>
			<!-- links for css, js, leaflet map, and animate.css stylesheet -->
		<link href="../assets/css/styles.css" rel="stylesheet" type="text/css"/>
		<script src="../assets/js/script.js" type="text/javascript"></script>
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
       integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	</head>
      <!-- the first class wraps the entire document for use in CSS  -->
	<div class="wrapper">			
			<!-- the body tag contains the document features -->
		<body>
				<!-- the header tag is related to the header information of the document -->
			<header>
			 <!-- php adds the html content from the '.inc' files -->
				<?php include '../inc/header.inc' ?>
			</header>
					<!-- the nav tag is related to navigating the page(s) -->
					<!-- There are five related pages for the client side, four of which are in nav -->
			<nav>
				<div>
					<a href="../index.php"> Home</a>
						<!-- <a href="results.php"> Results</a> -->
					<a href="../submit/submission.php"> Submission</a>
					<a href="../register/registration.php"> Registration</a>
				</div>
			</nav>
					<!-- sample.php recieves the form submission from the results php files. -->
					<?php
					  // if html post is received then process the form
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
							// check the form parameters are set
							if( (isset($_POST['save_token'])) && (isset($_POST['Select']))) {
								// check the form parameters are non empty
								if ((!empty($_POST['save_token'])) && (!empty($_POST['Select']))) {
									// check the security token is unaltered
									if($_POST['save_token'] == 'abcdefg') {
							      // the name of the business selected by the form is stored
										$name = $_POST['Select'];
										// create an sql connection from php
										$servername = "localhost";
										$username = "root";
										$password = "";
										$dbname = "thewarbler";
					
										$conne = new mysqli($servername, $username, $password, $dbname);
							      // check the connection is established
										if ($conne->connect_error) {
											die("Connection failed while inserting data: ".$conne->connect_error);
						
										} else {
											// make prepared statements to prevent scripting attack
											$stmt = $conne->prepare("SELECT * FROM businesses WHERE name=?");
											$stmt->bind_param("s", $name);
											$stmt->execute();
											// $output stores the SQL results
											$output = $stmt->get_result();
											// if result is non empty; it should be exactly one business name in the row
											if ($output->num_rows > 0) {
												// get the SQL data from the one row
												$result = $output->fetch_assoc();
												// store the information required for the javascript map api
												$row[] = array($result['name'], $result['Latitude'], $result['Longitude']);
												// the $result and $row variables will be used embedded in the html page

												?>
					
					
					
					
					
					
					
					<!-- article tags are a way to section the page -->
			  <article>
					<!-- section tags are inner sectioning of articles -->
					<section>
							<!-- The first section of the article will have a class to specify position in CSS -->
						<div class="uptop">
							<h4> Overview </h4>
								<!-- the info text is animated -->
								<p class="animate__animated animate__flash"><?php echo $result['Description']; ?></p>
								<!-- the table contains the results for one sample -->
								<!-- there are five columns to view -->
								<!-- and there is one hard coded entrie to display without using a server -->
								<table>
									<thead>
										<tr>
											<th>Result</th>
											<th>Name</th>
											<th>Latitude</th>
											<th>Longitude</th>
											<th>Average Rating</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<!-- the parameters in the $result variable are displayed in a table here -->
											<td><?php echo $result['name']; ?></td>
											<td><?php echo $result['Latitude']; ?> </td>
											<td><?php echo $result['Longitude'] ?></td>
											<td><?php echo $result['rating']; ?> </td>
										</tr>
										
										<script>
										  // the php $row array is cast into a javascript array which will be passed into the 
											// the javascript function loadMap(row) below
											var row = <?php echo json_encode($row); ?>;
													
										</script>
									</tbody>
								</table>
							</div>
						</section>
						<!-- The second section contains the further results -->
						<section>
						<!-- This section contains a map generated by the javascript function loadMap(row) using the parameter row -->
							<button onclick="loadMap(row);">Load Map</button>
								<!-- the map markers are generated dynamically with the server -->
								  <div id="mapid"></div>
								  	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
                    crossorigin=""></script>
						</section>
						
						<?php		
						  // the code above is displayed to the browser provided that the if condition ($output->num_rows > 0) is satisfied
											}
											?>
						
								<!-- This section is commented out temporarily 
								The third section contains an image of the company logo
							<section>
							  <!-- if the browser window is greater than 800px then image selected 
							  <!-- is either high or low res depending on screen type otherwise low res is selected
							 <picture>
							  <source media="(min-width: 800px)" srcset="../images/TCann.PNG, ../images/TCann_2x.PNG 2x">
							  <img src="../images/TCann.PNG" alt="T Cannabis Company Logo" class="comp_logo">
							 </picture>
							</section>
							<!-- The fourth section contains a video 
							<section>
							  <video width="480" height="320" controls>
								<source src="../video/Cannabis.mp4" type="video/mp4">
							</section>
							commented out temporarily
							-->
							
							<!-- This section contains a table of the reviews for the business from users -->
							<section>
								<div class="downbottom">
									<h4> Ratings </h4>
									<!-- The table has three columns, a username, review, and the score -->
									<table>
										<thead>
											<tr>
												<th>Username</th>
												<th>Review</th>
												<th>Score</th>
											</tr>
										</thead>
										<tbody>
										<?php
										  // using the same SQL connection as before
										  // make prepared statements to prevent scripting attack
											$stmt = $conne->prepare("SELECT * FROM reviews WHERE name=?");
											$stmt->bind_param("s", $name);
											$stmt->execute();
											// $output stores the SQL results
											$output = $stmt->get_result();
										  
											
											// if there are reviews for the business specified by $name
											if ($output->num_rows > 0) {
												// get each row and supply the parameters into the html table
												while( $result = $output->fetch_assoc()) {
													
													?>
											<tr>
												<td><?php echo $result['username']; ?></td>
												<td><?php echo $result['description']; ?></td>
												<td><?php echo $result['rating']; ?></td>
											</tr>
											<?php
										  
									    }
					          
										?>
										</tbody>
									</table>
								</div>
							</section>
						</article>
						
						
						<?php		
						 
											}
									}
									// finally close the connection
									$conne->close();  
				        } else {
									// if the save token is changed then return invalid access
						      echo "invalid_access";
				        }
							} else {
								// if the form data is empty return empty data
								echo "empty_data";
							}
						}	else {
							// if the form data is not set return invalid_data
								echo "invalid_data";
						}
					}
				?>
						
						
						<!-- the footer tag is related to the footer information of the document -->
						<footer>
							<p>Created by <a href="">Samuel Alderson</a> </p>
						</footer>
					</body>
				</div>
			</html>