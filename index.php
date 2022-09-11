<?php 
	session_start(); 

	if(isset($_GET['clear']))
	{
		session_destroy();
		session_start();	
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Road Trip</title>
<!-- Facebook's openGraph tags-->
<meta property="og:title" content="Road Trip Beta v1.0 by Zen Pidgin" />
<meta property="og:type" content="website" />
<meta property="og:url" content="http://zenpidgin.com/portfolio/roadTrip/index.php" />
<meta property="og:image" content="http://zenpidgin.com/portfolio/roadTrip/images/newOGimage.png" />
<meta property="og:description" content="Estimate the cost of a Road Trip with this free online tool!" />

<link rel="icon" type="image/png" href="images/icon2_1_16x16.ico">


<script type="text/javascript" src="js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="js/backstretch.min.js"></script>
<script type="text/javascript" src="js/jquery-uo-1.10.3.custom.min"></script>

<link rel="stylesheet" type="text/css" href="html5-reset.css" />
<link rel="stylesheet" type="text/css" href="styles.css" />

 <script>
$(function() {
$( document ).tooltip();
});
</script>

</head>

<body>
<script>
	 $("body").backstretch("images/backgroundLight.png");
	 
</script>

<div id="hidden">
        	 <?php 
             //include 'functions.php'; 
             ?>
        </div>
	<div id="wrapper">
    	<header>
        	<h1><a href="index.php">Road Trip</a></h1><small class="tagline">BETA version 1.0</small>
            
            <p id="subTagline"><small>Here's to one less thing you have to worry about.</small></p>
            
            <div id="expenseBox">
            <p id="expenseLabel">Total Expenses:</p>
            <p id="expensesTotal">$<?php addToTotal($totalFuel, $totalLodging, $totalFood); ?></p>
            <form id="mini-form" method="GET" action="index.php">
            <input type="submit" name="clear" id="clear" value="Clear My Numbers"/></form>
            </div>
            
        </header>
        
        <div id="info">
        	<h2>Road Trip Expense Planner</h2>
            <p>Do you have a road trip coming up and want to know how much it will cost to get to your destination? It's simple - take the information you already know about your vehicle and fill in the blanks. We'll fill you in on the rest.</p>
        </div>
        
        <div id="mainContent">
        
        	<form class="mainForm" method="post" action="index.php">
           <fieldset class="formSection" id="fuelCosts">
            	<fieldset class="leftColumn">
                	<label class="info">
                    <p>This section will figure out the approximate cost of gasoline for your trip.</p> <p><small>Round Up: The price of gasoline is calculated at <strong>$4.50/gallon</strong> - for a cushion against unexpected prices across the country. However, you can put your own estimated cost of gas if you choose 'Exact'.</small></p>
                    </label>
                    <label> <p>How many gallons of gas does your tank hold?</p></label>
                    	<input type="text" name="tankSize" id="tankSize" placeholder="Numbers Only Please" />
                        
                     <label><p>What is your average MPG - Highway?</p></label>
                     	<input type="text" id="mpgHwy" name="mpgHwy" placeholder="Numbers Only Please"/>
                     <label><p>How far will you be traveling (in miles)? <small><a href="http://www.maps.google.com" target="_blank" title="Calculate the miles on Google Maps.">Check Google Maps.</a></small></p></label>
                     	<input type="text" id="distance" name="distance" placeholder="Numbers Only Please"/>
                     <label><p>Would you like to round up the cost, so you have a cushion for any unexpected events, or would you like an exact estimate?</p></label>
                    <div class="radioContainer">
                     	<input type="radio" name="rounded" id="roundedYes" checked="checked" value="Round Up"/> <label class="rdio"> Round Up </label>
                        <input type="radio" name="rounded" id="roundedNo" value="Exact"/> <label class="rdio"> Exact </label><input type="text" name="other" id="other" placeholder="Numbers Only Please"/>
                        </div>
                        
                        
                </fieldset>
                <fieldset class="rightColumn">
                	<label><p>Your estimated total cost for gasoline for this trip is:</p></label>
                    	<p class="result"> $<?php totalFuelCost($totalFuel); ?></p>
                    <label><p>Estimated stops for gas:</p></label>
                    	<p class="result"> <?php showNumTanks($numTanks); ?> <small>one-way</small></p>
                    <label><p>Estimated cost per tank:</p></label>
                    	<p class="result"> $<?php showPricePerStop($pricePerStop); ?> </p>
                    <label><p>Your estimated miles per tank is:</p></label>
                    	<p class="result"> <?php showMilesPerTank($milesPerTank); ?> </p>
                	<label><p>Distance:</p></label>
						<p class="result"><?php echo $distance . ' miles.';?> <small>one-way</small></p>
                    <label><p>Estimated Time:</p></label>
                    	<p class="resultShort"><?php estimatedTime($estTime);?> <small>one-way</small></p>
                    
                </fieldset>
            </fieldset><!--end fuelCosts-->
            
           <fieldset class="formSection" id="lodgingCosts">
            	<fieldset class="leftColumn">
                	<label class="info">
                    <p>This section will figure out the approximate cost of lodging for your trip!</p> <p>Estimated number of stops is based on a recommendation of only driving up to 8 hours a day.</p>
                    </label>
                    <label> <p>How many rooms will you need per night?</p></label>
                    	<input type="text" name="numOfRooms" id="numOfRooms" placeholder="Numbers Only Please"/>
                        
                     <label><p>How many times will you be stopping in search of lodging?</p></label>
                     	<input type="text" id="plannedStops" name="plannedStops" placeholder="Numbers Only Please."/>
                    
                     <label><p>How much would you spend per night for lodging?</p></label>
                    <div class="radioContainer">
                     	<input type="radio" name="lodging" value="cheap" checked="checked" /> <label class="rdio"> Cheap ($60)</label>
                        <input type="radio" name="lodging" value="moderate" /> <label class="rdio"> Average (<a href="http://www.ahla.com/content.aspx?id=34706" alt="This figure is based on the American Hotel and Lodging Association's average cost per leisurely stay." title="This figure is based on the American Hotel and Lodging Association's average cost per leisurely stay. Click to follow the link to their website." target="_blank">$109)</a> </label>
                        <input type="radio" name="lodging" value="expensive" /> <label class="rdio"> Expensive ($150) </label>
                        </div>
                        
                        
                </fieldset>
                <fieldset class="rightColumn">
                	
                
                	
                    <label><p>Estimated total cost of lodging:</p></label>
                    	<p class="result"> $<?php showPriceLodging($totalLodging); ?> </p>
                        
                    <label><p>Recommended stops for lodging:</p></label>
                    	<p class="result"> <?php showNumStopsLodging($numStopsLodging); ?> <small>one-way</small></p>
                    
                    <label><p>Planned stops for lodging:</p></label>
                    	<p class="result"> <?php showPlannedStops($numPlannedStops); ?> <small>one-way</small></p>
                	<p><?php echo $recStops; ?></p>
                </fieldset>
            </fieldset>
           <!--end lodgingCosts-->
            
            
         
            <fieldset class="formSection" id="foodCosts">
            	<fieldset class="leftColumn">
                	<label class="info">
                    <p>This section will figure out the approximate cost of food for your trip! <small>***Still working on this section - going to add an option to put in your own estimate.*** Gas Station Food is pretty expensive: Estimated $10 per stop. Fast Food - $7 per stop. Restuarant (including gratuity): $30 per stop. All of these figures are per person.</p> 
                    </label>
                    
                        
                     <label><p>How many people?</p></label>
                     	<input type="text" id="numPeople" name="numPeople" placeholder="Numbers Only Please"/>
                     
                     <label><p>Food costs will probably be a mixture of the following, however for the purposes of this application, choose where you are most likely to purchase food on your trip.</p></label>
                    <div class="radioContainer">
                     	<input type="radio" name="food" value="cheap" checked="checked" /> <label class="rdio"> Gas Station Food</label>
                        <input type="radio" name="food" value="moderate" /> <label class="rdio"> Fast Food </label>
                        <input type="radio" name="food" value="expensive" /> <label class="rdio"> Restaurants </label>
                        </div>
                        
                        <label>Last Question: Is this a round-trip?</label>
                        <div class="radioContainer">
                        <input type="radio" name="roundTrip" value="Yes" /><label class="rdio">Yes</label>
                        <input type="radio" name="roundTrip" value="No" /><label class="rdio">No</label>
                        </div>
                        
                        <input type="submit" class="submit" name="submit" value="Calculate"/>
                </fieldset>
                <fieldset class="rightColumn">
                	<label><p>Your estimated total cost for food for this trip is:</p></label>
                    	<p class="result"> $<?php showFoodTotal($totalFood); ?></p>
                    <label><p>Estimated cost per stop:</p></label>
                    	<p class="result"> $<?php showFoodPerStop($foodPerStop); ?> </p>
                    <label><p>Estimated stops:</p></label>
                    	<p class="result"> <?php showNumStops($numStops); ?> <small>one-way</small></p>
                	
                		
                </fieldset>
                </fieldset>
            </form>
            
            
            
                    </div><!--end mainContent-->
        <footer>
        	<p>Roadtrip by <a href="http://www.jesihester.com" target="_blank" >Jessica Hester</a> &copy; 2016</p>
        </footer>
    </div><!--end wrapper-->
</body>
</html>
