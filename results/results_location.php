
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
					  <?php include '../inc/header.inc' ?>
			</header>
					<!-- the nav tag is related to navigating the page(s) -->
					<!-- There are five related pages for the client side, four of which are in nav -->
			<nav>
				<div>
					<a href="../index.php"> Home</a>
					<a href="../submit/submission.php"> Submission</a>
					<a href="../register/registration.php"> Registration</a>
				</div>
			</nav>
				<!-- article tags are a way to section the page -->
			<article>
					<!-- section tags are inner sectioning of articles -->
				<section>
						<!-- The first section of the article will have a class to specify position in CSS -->
					<div class="uptop">
							<!-- the info text is animated -->
						<p class="animate__animated animate__flash">Use the "Select" and "Enter" to find more information about each store.</p>
								<!-- the table represents the output of a search from index.php -->
								<!-- there are six columns to view -->
								<!-- the entries to the table will be the businesses returned dynamically from a search -->
								<!-- the table will have an embedded form to select from the businesses for a more detailed page -->
						<form action="sample.php" method="POST">
							<table>
								<thead>
									<tr>
										<th>Select</th>
										<th>Result</th>
										<th>Name</th>
										<th>Latitude</th>
										<th>Longitude</th>
										<th>Average Rating</th>
									</tr>
								</thead>
							<tbody>
							<!-- results_location.php recieves the form submission from the search page using the latitude-longitude form. -->
							<?php 
							// if html post is recieved then process the form
							if ($_SERVER["REQUEST_METHOD"] == "POST") {
								// check the form parameters are set
								if( (isset($_POST['save_token'])) && (isset($_POST['latitude'])) && (isset($_POST['longitude'])) ) {
									// check the form parameters are non empty
									if ((!empty($_POST['save_token'])) && (!empty($_POST['latitude'])) && (!empty($_POST['longitude']))) {
										// check the security token is unaltered
										if($_POST['save_token'] == 'abcdefg') {
							
							        // the latitude and longitude are stored
											// a range is specified around each parameter according to plus or minus 1 decimal degree
											// where 1 decimal degree represents approximately 111km, so the range is total 222km
											$latitude = $_POST['latitude'];
											$latlower = $latitude - 1;
											$latupper = $latitude + 1;
											$longitude = $_POST['longitude'];
											$longlower = $longitude - 1;
											$longupper = $longitude + 1;
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
												// the SQL query is safe becuase it is only supplied numbers
												$sql = "SELECT * FROM businesses WHERE (Latitude BETWEEN '$latlower' AND '$latupper') AND 
													(Longitude BETWEEN '$longlower' AND '$longupper')";
												$output = $conne->query($sql);
												// if the result is non empty; some businesses are returned from the query
												if ($output->num_rows > 0) {
													// an index for the array
													$i = 1;
													// create a php array of the parameters required for javascript mapping api
													$set = array();
													// loop through each row in the results of the query
													while( $result = $output->fetch_assoc()) {
														// store the parameters
														$set[] = array($result['name'], $result['Latitude'], $result['Longitude']);
												?>
									    <!-- each iteration of the php while loop will contain an html row -->
										<tr>
										  <!-- each row in the table has a radio button whose value is the name of the business in the row -->
										  <td> <input type="radio" name="Select" value="<?php echo $result['name']; ?>"> </td>
											<td><?php echo $i; ?></td>
											<td><?php echo $result['name'] ?></td>
											<td><?php echo $result['Latitude'] ?></td>
											<td><?php echo $result['Longitude'] ?></td>
											<td><?php echo $result['rating'] ?></td>
										</tr>
										<?php
										// increment the array index
										  $i = $i + 1;
									    }
					          
										?>
										<script>
										// the php $set array is cast into a javascript array which will be passed into the 
											// the javascript function loadMap(set) below
											var set = <?php echo json_encode($set); ?>;
													
										</script>
										
									</tbody>
								</table>
								<input type="hidden" name="save_token" value="abcdefg" >
								<!-- the submit button on the form-->
								<input type="submit" name="submit" class="submit" value="Enter">
								</form>
							</div>
						</section>
						
						<section>
						<!-- this class is used for the section furthest to the bottom of the page -->
							<div class="downbottom">
							<!-- This section contains a map generated by the javascript function loadMap(set) using the parameter set -->
							<button onclick="loadMap(set);">Load Map</button>
								<!-- the map markers are generated dynamically with the server -->
								  <div id="mapid"></div>
								  	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
                    crossorigin=""></script>
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
								// if the form data is empty then return empty data
								echo "empty_data";
							}
						}	else {
							// if the form data is not set then return invalid data
								echo "invalid_data";
						}
					}
				?>
										
										
										
										
										<!-- the footer tag is related to the footer information of the document -->
										<footer>
											<p>Created by <a href="">Samuel Alderson</a>
											</p>
										</footer>
									</body>
								</div>
							</html>