
$("#find_btn").click(function () { //user clicks button
	if ("geolocation" in navigator){ //check geolocation available 
		//try to get user current location using getCurrentPosition() method
		navigator.geolocation.getCurrentPosition(function(position){ 
				$("#result").html("Found your location <br />Lat : "+position.coords.latitude+" </br>Lang :"+ position.coords.longitude);
			});
	}else{
		console.log("Browser doesn't support geolocation!");
	}
});

