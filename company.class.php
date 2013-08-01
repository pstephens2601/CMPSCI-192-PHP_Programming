<?php

	/*  Lab assignments for CMPSCI-192 PHP Programming, taken at College of the Canyons
	 *	Spring of 2013.
	 *
	 */
	
	class company
	{
    	var $company_name = "Carcadia";
    	var $company_address = "10092 Riverside Dr.";
    	var $company_citystatezip = "Los Angeles, CA  91505";
    	var $background_color = 'silver';
    	var $company_url = 'http://www.pmstephens.com/php';
    	var $company_tagline = "\"Your used car marketplace.\"";
    	var $whichpage = 'home';
	
		function getHeader()
		{
			$head = "<div class=\"header\">\n";
			$head .= "<h1>$this->company_name</h1>\n";
			$head .= "<div class=\"tagline\">$this->company_tagline</div>\n";
    		$head .= "</div>";
    		return $head;
		} // end of function getHeader
	
		function getFooter()
		{
			$footer = "<div class=\"footer\">";
        	$footer .= "$this->company_name, $this->company_address, $this->company_citystatezip";
        	$footer .= "</div>";
        	return $footer;
		} // end of function getFooter

	} // end of class company
?>