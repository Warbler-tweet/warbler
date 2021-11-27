

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
							<a href=""> Results</a>
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
								<!-- the table represents the output of a search from index.html -->
								<!-- there are five columns to view -->
								<!-- and there are five hard coded entries to display without using a server -->
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
									<?php 
		  if ($_SERVER["REQUEST_METHOD"] == "POST") {
		    if( (isset($_POST['save_token'])) && (isset($_POST['rating']))) {
					if ((!empty($_POST['save_token'])) && (!empty($_POST['rating']))) {
						if($_POST['save_token'] == 'abcdefg') {
							
							
							$ratingupper = $_POST['rating'];
							$ratinglower = $ratingupper - 1;

							$servername = "localhost";
					    $username = "root";
					    $password = "";
					    $dbname = "thewarbler";
					
					    $conne = new mysqli($servername, $username, $password, $dbname);
							
							if ($conne->connect_error) {
						    die("Connection failed while inserting data: ".$conne->connect_error);
						
					    } else {
								$sql = "SELECT * FROM businesses WHERE rating BETWEEN '$ratinglower' AND '$ratingupper'";
								$output = $conne->query($sql);
								if ($output->num_rows > 0) {
									$i = 1;
									$set = array();
									while( $result = $output->fetch_assoc()) {
										$set[] = array($result['name'], $result['Latitude'], $result['Longitude']);
									?>
									
										<tr>
										  <td> <input type="radio" name="Select" value="<?php echo $result['name']; ?>"> </td>
											<td><?php echo $i; ?></td>
											<td><?php echo $result['name'] ?></td>
											<td><?php echo $result['Latitude'] ?></td>
											<td><?php echo $result['Longitude'] ?></td>
											<td><?php echo $result['rating'] ?></td>
										</tr>
										<?php
										  $i = $i + 1;
									    }
					          
										?>
										<script>
											var set = <?php echo json_encode($set); ?>;
													
										</script>
										
									</tbody>
								</table>
								<input type="hidden" name="save_token" value="abcdefg" >
								<input type="submit" name="submit" class="submit" value="Enter">
								</form>
							</div>
						</section>
						
						<section>
						<!-- this class is used for the section furthest to the bottom of the page -->
							<div class="downbottom">
							<button onclick="loadMap(set);">Load Map</button>
								<!-- the maps are hardcoded results without the use of a server -->
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
									$conne->close();
							
									  
				        } else {
						      echo "invalid_access";
				        }
							} else {
								echo "empty_data";
							}
						}	else {
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