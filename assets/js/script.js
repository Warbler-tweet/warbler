/**************************************
javascript file for index.html, results.html, sample.html, registration.html, submission.html
**************************************/

// function makes a call to the geolocation API to find the users coordinates
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    document.getElementById("latitude").value = "Unsupported";
  }
}

// function enters the user coordinates to the form elements
function showPosition(position) {
  document.getElementById("latitude").value = position.coords.latitude;
	document.getElementById("longitude").value = position.coords.longitude;
}

// function uses the leaflet mapping API to add map layers and markers to the results web page
function loadMap(set) {
	var myMap = L.map("mapid").setView([43.63081, -80.04016], 8);
	L.tileLayer("https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2FyYmxlci10d2VldCIsImEiOiJja3ZjeTliNXMxYTk0MzF0MjNuNGc1Mm5wIn0.EENJ38KC66Ua9WpVHhGebA" , {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
		'Imagery @ <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
	}).addTo(myMap);
	
	for( var i = 0; i <set.length; i++) {
		var marker = new L.marker([set[i][1],set[i][2]]).bindPopup(set[i][0]).addTo(myMap);
	}
	//var marker1 = new L.marker([43.63081, -80.04016]).bindPopup('T Cannabis').addTo(myMap);
	//var marker2 = new L.marker([43.86867, -79.03906]).bindPopup("The 6ix Cannabis").addTo(myMap);
	//var marker3 = new L.marker([44.15518, -79.86621]).bindPopup("Green Grove").addTo(myMap);
	//var marker4 = new L.marker([43.19868, -80.01655]).bindPopup("SPIRITLEAF ANCASTER").addTo(myMap);
	//var marker5 = new L.marker([43.14175, -80.26031]).bindPopup("ALPHA CANNABIS").addTo(myMap);
}

// function uses the leafelt mapping API to add map layers and markers to the sample results page
function loadSampleMap(row) {
	var myMap = L.map("mapid").setView([43.63081, -80.04016], 10);
	L.tileLayer("https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoid2FyYmxlci10d2VldCIsImEiOiJja3ZjeTliNXMxYTk0MzF0MjNuNGc1Mm5wIn0.EENJ38KC66Ua9WpVHhGebA" , {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
		'Imagery @ <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
	}).addTo(myMap);
	
	var marker1 = new L.marker([row[1], row[2]]).bindPopup(row[0]).addTo(myMap);
}

// function validates the input to the registration form and web page
function validate(form) {
	// ensure username is entered
	if (form.username.value=="") {
		window.alert("No username entered.");
		return false;
	}
	// check username has not digits
	if (/[0-9]/.test(form.username.value)) {
		window.alert("Name must not contain digits.")
		return false;
	}
	// ensure email is entered
	if (form.email.value=="") {
		window.alert("No email entered.");
		return false;
	}
	// check email is proper format
	if (!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,})+$/.test(form.email.value)) {
		window.alert("Pleas enter a valid email address.");
		return false;
	}
	// ensure password is entered
	if (form.password.value=="") {
		window.alert("No password entered.");
    return false;
	}
	// check password format is correct
	if (!/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/.test(form.password.value)) {
		window.alert("Password must be minimum eight characters, at least one upper case English letter, one lower case English letter, one number and one special character");
    return false;		
	}
	// ensure checkbox is checked
	if (!form.checkbox.checked) {
		window.alert("Checkbox 19+ unchecked") 
    return false;
	}		
}
