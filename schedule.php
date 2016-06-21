<?php
include ('php/getSchedule.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>FH-Timetable</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="img/png" href="./img/favicon.ico">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="css/schedulestyle.css" title="default" media="screen" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js" defer></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js" defer></script>

</head>
	<body>
		<div id="wrapper" class="container">
        <?php
            $url = "{$_SERVER['QUERY_STRING']}";
            if(function_exists('render_xml_data')){
                render_xml_data('https://ws.fh-joanneum.at/getschedule.php?'.$url.'&k=qWj44BTFEx');
            }else{
                echo null;
            }
		?>
		</div>
	</body>
</html>
