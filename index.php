<?php
	
	/*  Lab assignments for CMPSCI-192 PHP Programming, taken at College of the Canyons
	 *	Spring of 2013.
	 *
	 */
	
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
	
	require_once('carDealer.class.php');
	$carcadia = new carDealer;
	
	if (!empty($_REQUEST['debug'])) //determines if debugging is turned on or off
	{
		$debug = true;
		print "DEBUGGING has been turned ON<br />";
	}
	else {
		$debug = false;
	} 

	$company_name = 'Carcadia';
	$company_address = '10092 Riverside Dr.';
	$company_citystatezip = 'Los Angeles, CA  91505';
	$slogan = '"Your Used Car Marketplace"';
	$car_array;

/*---------------- Lab 6 functions --------------------------*/

	function getHeader($company_name, $background_color)
	{

    $head = "<table style=\"background-color: $background_color; width: 100%; text-align: center;\"><tr><td>";
    $head .= "<h1>$company_name</h1>";
    $head .= "</td></tr></table>";
    return $head;
  
	} // end of getHeader

	function getFooter($background_color)
	{
		global $company_name;
    	global $company_address;
    	global $company_citystatezip;

    	$footer = "<table style=\"background-color: $background_color; width: 100%; text-align: center;\"><tr><td>";
    	$footer .= "$company_name, $company_address, $company_citystatezip";
    	$footer .= "</td></tr></table>";
    	return $footer;

	} // end of getFooter
	
/*---------------- Lab 5 functions --------------------------*/

	function display_company_name($co_name)
	{
		global $debug;
		
		if ($debug)
		{
			echo "DEBUGGING: called function - display_company_name($co_name)\n <br />";
		}
     	echo "$co_name";

	} //end of display_company_name()

	function display_company_address()
	{
		global $company_name;
		global $company_address;
		global $company_citystatezip;
		global $debug;
		
		if ($debug)
		{
			echo "DEBUGGING: called function - display_company_address()\n <br />";
		}
		
		echo "<span style=\"text-decoration: underline; font-weight: bold;\">$company_name, $company_address, $company_citystatezip</span>";

	} //end of display_company_address()
	
	// creates array for a Car Dealership
	function  create_array_cars (  )
	{
		global $debug;
		
		if ($debug)
		{
			echo "DEBUGGING: called function - create_array_cars()\n <br />";
		}
		
    	global $car_array;
    	
   		$car_array = array();
    	$car_array[] = "ID: 12345, Vehicle: 2002 Ford Ranger, $6500.00, Excellent condition, low 68000 miles" ;
    	$car_array[] = "ID: 45678, Vehicle: 1998 Chevy Corvette, $19995.00, Low miles 54000, Great car 4 cruising" ;
    	$car_array[] = "ID: 67890, Vehicle: 2000 Toyota Camry, $9990.00, Mom wants you 2 buy a conservative car" ;
    	$car_array[] = "ID: 89123, Vehicle: 1995 Honda Civic, $4500.00, 140000 miles, but a Honda, it will last" ;
    	
    	if ($debug)
		{
			echo 'DEBUGGING: $cars_array contains - ';
			print_r($car_array);
			echo '<br />';
		}
		
	}  //end of create_array_cars
	
	function displayProduct($array)
	{
		global $debug;
				
		if ($debug)
		{
			echo "DEBUGGING: called function - displayProduct(\$cars_array)\n <br />";
		}
		
    	echo '<table class="cars">';
    	
     	foreach ($array as $car)
     	{
          echo '<tr><td>' . $car . '</td></tr>';
     	}
     	
     	echo '</table>';
     	
	} // end of displayProduct

	function create_spacer($num) {
	
		global $debug;
		
		if ($debug)
		{
			echo "DEBUGGING: called function - create_spacer($num)\n<br />";
		}
		
		for ($i = 1; $i <= $num; $i++)
		{
			if ($debug)
			{
				echo "DEBUGGING: for () loop \$i = $i\n";
			}
			echo "<br /> \n";
		}

	}
	
	if ($debug)  
	{
		echo 'Variable $company_name contains ' . gettype($company_name) .  ' - ' . $company_name . '<br />';
		echo 'Variable $company_address contains ' . gettype($company_address) .  ' - ' . $company_address . '<br />';
		echo 'Variable $company_citystatezip contains ' . gettype($company_citystatezip) .  ' - ' . $company_citystatezip . '<br />';
		echo 'Variable $slogan contains ' . gettype($slogan) .  ' - ' . $slogan . '<br />';
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>
			<?php
				display_company_name($company_name);
				echo " - $slogan\n";
			?>
		</title>
		<link href='http://fonts.googleapis.com/css?family=Julius+Sans+One' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="carcadia_style.css" type="text/css">
	</head>
	<body>
		<?php
			echo $carcadia->getHeader(); 
				
			$carcadia->create_navbar_array();
			$carcadia->setWhichPage();
			
			echo $carcadia->getLeftNavBar('menuLeft');
			
		?>
			
		<div  class="body">
		<?php
		
			echo $carcadia->getMainSection();
			
			if ((!isset($_GET['whichpage'])) || ($_GET['whichpage'] == 'home'))
			{
				create_array_cars();
				displayProduct($car_array);
			}
			
		echo "</div>";
		echo "<div style=\"clear: both;\">";
		echo "<div style=\"text-align: center\" class=\"footerWrapper\">\n";

		echo $carcadia->getFooter();
		echo "\n<br />\n";
		echo "<div class=\"subFooter\">\n";
		echo "This is a non-commercial web site by Patrick Stephens, created as a lab assignment for COC Online. <br />\n";
		echo "<br />\n";
		echo "<a href='http://www.pmstephens.com/php'>Turn Debugging OFF</a> | <a href='http://www.pmstephens.com/php?debug=true'>Turn Debugging ON</a>";
		//echo "<a href='http://localhost:8888/pmstephens/php/'>Turn Debugging OFF</a> | <a href='http://localhost:8888/pmstephens/php/?debug=true'>Turn Debugging ON</a>";
		echo "</div>\n";
		echo "</div>\n";
	?>
	</body>
</html>