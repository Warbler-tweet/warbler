<!-- This is HTML5 -->
<!DOCTYPE html>
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
							<a href="../submit/submission.php"> Submission</a>
							<a href=""> Registration</a>
						</div>
					</nav>
					<!-- article tags are a way to section the page -->
					<article>
					<!-- section tags are inner sectioning of articles -->
						<section>
						<!-- The first section of the article will have a class to specify position in CSS -->
							<div class="uptop">
							<!-- the info text is animated -->
								<p class="animate__animated animate__flash">Register with The Warbler</p>
									<!-- This form takes as input textual elements for user information -->
									<!-- to register with the website, but server is not implemented -->
								<form action="../php/register.php" method="post" onsubmit="return validate(this);" >
									<label class="form_labels"> Username: </label>
									<br> <br>
									<input type="text" name="username" class="Username" placeholder="Enter a username">
									<br> <br> <br>
									<label class="form_labels"> Email: </label>
									<br> <br>
									<input type="text" name="email" class="email" placeholder="Enter an email">
									<br> <br> <br>
									<label class="form_labels"> Password: </label>
									<br> <br>
									<input type="password" name="password" class="password" placeholder="Enter a password">
									<br> <br> <br>
			            <label class="form_labels"> I am over 19 </label>
			            <input type="checkbox" name="checkbox" class="checkbox" value="19+">
				          <br> <br>
					        <input type="submit" name="submit" class="submit" value="Enter">
									<input type="hidden" name="save_token" value="abcdefg" >
					      </form>
				      </div>
		       	</section>
	      	</article>
		    <footer>
			  <p>Created by <a href="">Samuel Alderson</a></p>
		    </footer>
	     </body>
     </div>
  </html>