# Live Demo
[Greenify](http://greenify.devepi.com "Greenify")
# Project Overview
Pulau Semakau is an island located south of Singapore with part of the island being used as Singapore’s waste landfill. In 2017, Singapore generated 7.7 million tonnes of waste. It is projected that at this rate, Semakau landfill will only last for another 16 years. It is crucial for Singapore Residence to play their part in reducing the amount of trash they throw everyday. Hence, to kick-start on improving Singapore’s waste management system, our team came out with an idea to tackle the problem.
Greenify is a web app which helps users identify the category of the waste, recommends appropriate recycling tips and navigates users to the nearby recycle bins.  

# Project Objectives
Greenify aims to be a one stop web portal for Singapore Residence to get information on how to reduce their waste and how to dispose of their waste properly. It promotes and simplifies the process of 3Rs (Reduce, Recycle & Reuse) to encourage more people to recycle. Greenify allows smart waste categorisation, suggests how he/she can reuse the waste, provides nearby recycle bin locations and navigates users to the nearest one. Lastly, our goal is to expand the number of Singapore Residence who recycle so that the life of Pulau Semakau can be extended and more time is allowed to find improved ways of waste disposal.

# Project Functionality
- Identify type of object based on Image Recognition
- Search Suggestion when user is searching for recyclable object by text
- Identify Recycle Waste Category based on the object
- Suggests nearby Recycle Bin based on user’s location and Object Recycle Waste Category.
- Suggests the shortest route to the Recycle Bin based on users preferred mode of transportation.
- Provides relevant information in regards to the Object the user is going to recycle.
- Check for weather. Suggests to bring an umbrella if it is raining.

# Technologies Used
- PHP
- Bootstrap
- Javascript
- Clarifai API
- Earth911 API
- OneMap API
- OpenWeatherMap API
- Google API 
- News API

# Setup
Copy the **website folder** into your Web Server (Wamp/ MAMP/ others).

Import the database into your database and configure **index.php**, **services/add.php** with your database credentials.

    <?php
        $link = mysqli_connect("localhost", "username", "password", "database name", "3306");
    ?>

Add OneMap API Key and App id in **maps.php**.

 	<script>
        var key = ""; // Add OneMap API Key
        var appID = ""; // Add OneMap App ID
    </script>

Add Clarifai API Key in **scan_result.php**.

 	<script>
        $client = new ClarifaiClient(''); // Add your clarifai API key here
    </script>

Add Earth911 API Key in **scan_result.php** and **search_result.php**.

	<?php
		$mat_url = "http://api.earth911.com/earth911.getMaterials?api_key=";
		
		$family_url = "http://api.earth911.com/earth911.getFamilies?api_key=";
	?>

Also add in  **scripts/script.js**.

	$.getJSON('https://api.earth911.com/earth911.getMaterials?api_key=&format=jsonp&jsonp=?', function (data) {

Add Google API Key in **scan_result.php** and **search_result.php**.

	<?php
		$DEVELOPER_KEY = ''; 
	?>

Add Google Search API Key in **search_result.php**.

	<?php
		$googlekey = '';
		$url = "https://www.googleapis.com/customsearch/v1?key=".$url."&cx=015230085117659938076:gk2va1wfn5w&q=" . urlencode($_GET['object']) . "&searchType=image&num=1";
	?>

Add NewsAPI API Key in **articles.php**.

    <script>
        var newsApiKey = ''; // Add your api key
        var url = 'https://newsapi.org/v2/everything?' + 'q=Recycling&' + 'apiKey=' + newsApiKey + '&page=' + page;
    </script>
	