<?php
/*
	Written by Gary Hollands Sept 2010 - solriche.co.uk
	This work is available under the terms of the GNU General Public License, http://www.gnu.org/licenses/gpl.html
*/
include ('php/getSchedule.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Using PHP SimpleXml to create HTML from XML data</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css" title="default" media="screen" />
</head>
	<body>
			<?php
				if(function_exists('render_xml_data')){
					render_xml_data('https://ws.fh-joanneum.at/getschedule.php?c=ITM&y=2014&k=qWj44BTFEx');
				}else{
					echo null;//allows the page to continue rendering
				}
			?>
	</body>
</html>