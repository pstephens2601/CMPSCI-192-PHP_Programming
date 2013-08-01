<?php

require_once('company.class.php');

class CarDealer extends Company
{

    var $navbar_array;

     // create array for a Car/house/travel Nav Bar
	function create_navbar_array( )
	{
    	$mainurl = $this->company_url;   // get the main url address of this web page
        $this->navbar_array = array( "Home Page"=>"$mainurl?whichpage=home", "Sales"=>"$mainurl?whichpage=sales", "Support" => "$mainurl?whichpage=support", "Contacts" => "$mainurl?whichpage=contact" );
    }
    
    function getFAQ($sqldb)
	{
 		$query = "SELECT * FROM FAQTable";

     	if ( $result = mysql_query($query, $sqldb))
     	{
            $html =  '<table border="1" width="100%" style="text-align: center">';
            $html .= "<tr><td colspan='4'>FAQs</td></tr>";

             while ($assoc_array = mysql_fetch_assoc($result))
             {
                   $html .= '<tr><td>' . $assoc_array['question'] . '</td><td>' . $assoc_array['answer'] . '</td></tr>';

              }

              $html .= '</table>';
              return $html;
     	}
     	else
     	{
          	die(mysql_error());
     	}  
	}
	
    function getContacts($sqldb)
	{
 		$query = "SELECT * FROM ContactsTable";

     	if ( $result = mysql_query($query, $sqldb))
     	{
            $html =  '<table border="1" width="100%" style="text-align: center">';
            $html .= "<tr><td colspan='4'>Contacts</td></tr>";

             while ($assoc_array = mysql_fetch_assoc($result))
             {
                   $html .= '<tr><td>' . $assoc_array['contactName'] . '</td><td>' . $assoc_array['contactDepartment'] .  '</td><td>' . $assoc_array['contactPhone'] . '</td><td>' . $assoc_array['contactEmail'] . '</td></tr>';

             //print_r($assoc_array);

              }

              $html .= '</table>';
              return $html;
     	}
     	else
     	{
          	die(mysql_error());
     	}  
	}
	
    function getSQLProduct( $sqldb)
	{
     
     	$query = "SELECT * FROM CarProduct";

     	if ( $result = mysql_query($query, $sqldb))
     	{
            $html =  '<table border="1" width="100%" style="text-align: center">';
            $html .= "<tr><td colspan='4'>Best Deals From Our Database</td></tr>";

        	while ($assoc_array = mysql_fetch_assoc($result))
            {
                $html .= '<tr><td>' . $assoc_array['productID'] . '</td><td>' . $assoc_array['productName'] .  '</td><td>' . $assoc_array['productPrice'] . '</td><td>' . $assoc_array['productDescription'] . '</td></tr>';

        	}

            $html .= '</table>';
            return $html;
     	}
     	else
     	{
        	die(mysql_error());
     	}  
	}
	 
	function getDatabase()
	{
    	if ( $sqldb = mysql_connect( "phplabs.db.8938076.hostedresource.com", "phplabs", "PHPpass1!" ))
     	{
        	if ( mysql_select_db( "phplabs", $sqldb ))
         	{
              	return $sqldb;
         	}
         	else
         	{
              	die ("Select failed database name xcollege1-testdb. Error number: <b>".mysql_errno()." Message: ".mysql_error()."</b>");
         	}
     	}
     	else 
     	{
         	die ("Unable to connect to MySQL.college1.com username xcollege1. Error: <b>".mysql_error()."</b>");
    	}
    	
	} // end of getDatabase
	
    function getLeftNavBar($cssClass)
    {
        $links = $this->navbar_array;
        $data = "<div class=\"$cssClass\"\n>";
        $data .= "<ul class=\"$cssClass\">\n";
        $data .= "<li class=\"$cssClass\"><a href=\"" . $links['Home Page'] . "\" class=\"$cssClass\">Home Page</a></li>\n";
        $data .= "<li class=\"$cssClass\"><a href=\"" . $links['Sales'] . "\" class=\"$cssClass\">Sales</a></li>\n";
        $data .= "<li class=\"$cssClass\"><a href=\"" . $links['Support'] . "\" class=\"$cssClass\">Support</a></li>\n";
        $data .= "<li class=\"$cssClass\"><a href=\"" . $links['Contacts'] . "\" class=\"$cssClass\">Contact Us</a></li>\n";
        $data .= "</ul>\n";
        $data .= "</div>\n";
        
        return $data;

     } // end of method getLeftNavBar
     
      function setWhichPage()
     {
          if ((isset($_GET['whichpage'])) && ($_GET['whichpage'] != ''))
          {
               $this->whichpage = $_GET['whichpage'];
          } // end of if statement
     } // end of method setWhichPage

     function getMainSection()
     {
          $data = '';

          if ($this->whichpage == 'home')
          {
          		$data .= "<h2>";
                $data .= "Home";
                $data .= "</h2>";

          }
          elseif ($this->whichpage == 'sales')
          {
          		$data .= "<h2>";
                $data .= "Sales";
                $data .= "</h2>";
                $data .= "<br />";
                $data .= $this->displaySpecials();
                $sqldb = $this->getDatabase();
                $data .= $this->getSQLProduct($sqldb);
 				mysql_close($sqldb); 
          }
          elseif ($this->whichpage == 'support')
          {
          		$data .= "<h2>";
                $data .= "Support";
                $data .= "</h2>";
                $sqldb = $this->getDatabase();
                $data .= $this->getFAQ($sqldb);
 				mysql_close($sqldb);

          }
          elseif ($this->whichpage == 'contact')
          {
          		$data .= "<h2>";
                $data .= "Contact";
                $data .= "</h2>";
                $sqldb = $this->getDatabase();
                $data .= $this->getContacts($sqldb);
 				mysql_close($sqldb);

          } // end of if statement

          

          return $data;
     } // end of method getMainSection
     
     function displaySpecials()
     {
         $html = "<table style='width:100%; text-align: center;' border='1'>";
         $html .= "<tr><td colspan='4'>Best Deals From a File</td></tr>";
         if ($cars = fopen("car.txt", "r"))
         {
               while ( ! feof($cars))
               {
                     $oneline = fgets($cars);
                     $car_array = explode( ",", $oneline);
                     $html .= "<tr>";
                     foreach( $car_array as $field)
                     {
                          $html .= "<td>" . str_replace('"', '', $field) . "</td>";
                     }
                    $html .= "</tr>";
               }
              fclose($cars);  
         }
         $html .= "</table>";
         return $html;

     } // end of displaySpecials


} // end of class CarDealer

?>