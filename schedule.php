<?php
include ('php/getSchedule.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>FH-Schedule</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css" title="default" media="screen" />
</head>
	<body>
        <?php
            $url = "{$_SERVER['QUERY_STRING']}";
            if(function_exists('render_xml_data')){
                render_xml_data('https://ws.fh-joanneum.at/getschedule.php?'.$url.'&k=qWj44BTFEx');
            }else{
                echo null;
            }
		?>
	</body>
</html>