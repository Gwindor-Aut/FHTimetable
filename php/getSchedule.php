<?php
//renderSchedule got the functions: draw_calendar, draw_week, draw_day
include ('renderSchedule.php');
function render_xml_data($url){
    //Load the provided XML of the API
    $xml = getXMLData($url) or die("Error: Cannot load Schedule from FHPI");
    //Get the data of the XML-knots
    echo '<h2 class="schedule" id="topic">'.$xml->Course.' '.$xml->Year.'</h2>'."\n";

    //Extract data from the URL
    if (isset($_GET['day'])) {
        $tag = $_GET['day'];
    } else{
        $tag = date("j");
    }

    if (isset($_GET['month'])) {
        $monat = $_GET['month'];
    } else{
        $monat = date("n");
    }

    if (isset($_GET['year'])) {
        $jahr = $_GET['year'];
    } else{
        $jahr = date("Y");
    }

    if (isset($_GET['view'])) {
        $ansicht = $_GET['view'];
    }

    if (isset($_GET['y'])) {
        $yget = $_GET['y'];
    }

    if (isset($_GET['c'])) {
        $cget = $_GET['c'];
    }

    //HTML-Structure (drop-downs, button)
    echo '<form method="get" action="schedule.php">';

    echo '<div class="inputdd">Day: <br> <select name="day" class="selectpicker" data-style="btn-info" id="day" width="200px" onchange="" size="1">';
        for ($d=1; $d<=31; $d++) {
            echo '<option value="'.$d.'"'.(($d==$tag)?'selected="selected"':"").'>'.$d.'</option>';
        }
    echo '</select></div>';

    echo '<div class="inputdd">Month: <br> <select name="month" class="selectpicker" data-style="btn-info" id="month" width="200px" onchange="" size="1">';
        for ($m=1; $m<=12; $m++) {
            if($m == $monat){
                //.date to calculate the UNIX-time of mktime (long integer) to a readable format
                echo '<option value="'.$m.'"selected="selected">'.date('M',mktime(0,0,0,$m,1,$jahr)).'</option>';
            }else{
                echo '<option value="'.$m.'">'.date('M',mktime(0,0,0,$m,1,$jahr)).'</option>';
            }
        }
    echo '</select></div>';

    echo '<div class="inputdd">Year: <br> <select name="year" class="selectpicker" data-style="btn-info" id="year" width="200px" onchange="" size="1">';
        for ($y=0; $y<=8; $y++) {
            if($jahr+4-$y == $jahr){
                echo '<option value="'.($jahr+4-$y).'"selected="selected">'.($jahr+4-$y).'</option>';
            }else{
                echo '<option value="'.($jahr+4-$y).'">'.($jahr+4-$y).'</option>';
            }
        }
    echo '</select></div>';

    echo '<div class="inputdd">View: <br> <select name="view" class="selectpicker" data-style="btn-info" id="view" width="200px" onchange="" size="1">';
        echo '<option value="Month"'.(($ansischt=='Month')?'selected="selected"':"").'> Month </option>';
        echo '<option value="Week"'.(($ansicht=='Week')?'selected="selected"':"").'> Week </option>';
        echo '<option value="Day"'.(($ansicht=='Day')?'selected="selected"':"").'> Day </option>';
    echo '</select></div><div class="breaker"></div>';

    echo '<div class="inputdd">Course of studies: <br> <select class="selectpicker" data-style="btn-info" id="c" name="c" onchange="" size="1">';
        echo '<optgroup label="Angewandte Informatik">';
            echo '<option data-tokens="ITM Internettechnik"'.(($cget=='ITM')?'selected="selected"':"").'>ITM</option>';
            echo '<option data-tokens="IMA Informationsmanagement"'.(($cget=='IMA')?'selected="selected"':"").'>IMA</option>';
            echo '<option data-tokens="GEB Gesundheitsinformatik eHealth"'.(($cget=='GEB')?'selected="selected"':"").'>GEB</option>';
            echo '<option data-tokens="SWD Software Design"'.(($cget=='SWD')?'selected="selected"':"").'>SWD</option>';
            echo '<option data-tokens="IT Mobile Security"'.(($cget=='IMS')?'selected="selected"':"").'>IMS</option>';
            echo '<option data-tokens="eHealth"'.(($cget=='EHT')?'selected="selected"':"").'>EHT</option>';
            echo '<option data-tokens="Informationsmanagement"'.(($cget=='AIM')?'selected="selected"':"").'>AIM</option>';
            echo '<option data-tokens="IT-Recht Management"'.(($cget=='IRM')?'selected="selected"':"").'>IRM</option>';
        echo '</optgroup>';
        echo '<optgroup label="Engineering">';
            echo '<option data-tokens="ECE Elektronik Computer Engineering"'.(($cget=='ECE')?'selected="selected"':"").'>ECE</option>';
            echo '<option data-tokens="FZT Fahrzeugtechnik Automotive Engineering"'.(($cget=='FZT')?'selected="selected"':"").'>FZT</option>';
            echo '<option data-tokens="PTO Produktionstechnik Organisation"'.(($cget=='PTO')?'selected="selected"':"").'>PTO</option>';
            echo '<option data-tokens="LAV Luftfahrt Aviation"'.(($cget=='LAV')?'selected="selected"':"").'>LAV</option>';
            echo '<option data-tokens="LEB Nachhaltiges Lebensmittelmanagement"'.(($cget=='LEB')?'selected="selected"':"").'>LEB</option>';
            echo '<option data-tokens="Advanced Electronic Engneering"'.(($cget=='AEE')?'selected="selected"':"").'>AEE</option>';
            echo '<option data-tokens="Engineering and Product Management"'.(($cget=='ENP')?'selected="selected"':"").'>ENP</option>';
            echo '<option data-tokens="Luftfahrt Aviation"'.(($cget=='MAV')?'selected="selected"':"").'>MAV</option>';
            echo '<option data-tokens="Fahrzeugtechnik Automotive Engineering"'.(($cget=='MAE')?'selected="selected"':"").'>MAE</option>';
        echo '</optgroup>';
        echo '<optgroup label="Gesundheitsstudien">';
            echo '<option data-tokens="BIO Biomedizinische Analytik"'.(($cget=='BIO')?'selected="selected"':"").'>BIO</option>';
            echo '<option data-tokens="DIO Diätologie"'.(($cget=='DIO')?'selected="selected"':"").'>DIO</option>';
            echo '<option data-tokens="ERG Ergotherapie"'.(($cget=='ERG')?'selected="selected"':"").'>ERG</option>';
            echo '<option data-tokens="HEB Hebammen"'.(($cget=='HEB')?'selected="selected"':"").'>HEB</option>';
            echo '<option data-tokens="LOG Logopädie"'.(($cget=='LOG')?'selected="selected"':"").'>LOG</option>';
            echo '<option data-tokens="PTH Physiotherapie"'.(($cget=='PTH')?'selected="selected"':"").'>PTH</option>';
            echo '<option data-tokens="RAD Radiologietechnologie"'.(($cget=='RAD')?'selected="selected"':"").'>RAD</option>';
            echo '<option data-tokens="Massenspektrometrie Molekulare Analytik"'.(($cget=='MMA')?'selected="selected"':"").'>MMA</option>';
        echo '</optgroup>';
        echo '<optgroup label="Bauen, Energie und Gesellschaft">';
            echo '<option data-tokens="BBW Bauplanung Bauwirtschaft"'.(($cget=='BBW')?'selected="selected"':"").'>BBW</option>';
            echo '<option data-tokens="EVU Energie-, Verkehrs- Umweltmanagement"'.(($cget=='EVU')?'selected="selected"':"").'>EVU</option>';
            echo '<option data-tokens="SAM Soziale Arbeit"'.(($cget=='SAM')?'selected="selected"':"").'>SAM</option>';
            echo '<option data-tokens="Architektur"'.(($cget=='ARC')?'selected="selected"':"").'>ARC</option>';
            echo '<option data-tokens="Bauplanung Ingenieurbau"'.(($cget=='BMI')?'selected="selected"':"").'>BMI</option>';
            echo '<option data-tokens="Energy and Transport Management"'.(($cget=='MET')?'selected="selected"':"").'>MET</option>';
            echo '<option data-tokens="Soziale Arbeit"'.(($cget=='SOA')?'selected="selected"':"").'>SOA</option>';
        echo '</optgroup>';
        echo '<optgroup label="Medien und Design">';
            echo '<option data-tokens="IDB Industrial Design"'.(($cget=='IDB')?'selected="selected"':"").'>IDB</option>';
            echo '<option data-tokens="IND Informationsdesign"'.(($cget=='IND')?'selected="selected"':"").'>IND</option>';
            echo '<option data-tokens="JPR Journalismus Public Relations (PR)"'.(($cget=='JPR')?'selected="selected"':"").'>JPR</option>';
            echo '<option data-tokens="Ausstellungsdesign"'.(($cget=='AUD')?'selected="selected"':"").'>AUD</option>';
            echo '<option data-tokens="Communication Design; Interaction Design; Media Design; Sound Design"'.(($cget=='CMS')?'selected="selected"':"").'>CMS</option>';
            echo '<option data-tokens="Industrial Design"'.(($cget=='IDM')?'selected="selected"':"").'>IDM</option>';
            echo '<option data-tokens="Content-Strategie Content Strategy"'.(($cget=='COS')?'selected="selected"':"").'>COS</option>';
        echo '</optgroup>';
        echo '<optgroup label="Management">';
            echo '<option data-tokens="BVW Bank- Versicherungswirtschaft"'.(($cget=='BVW')?'selected="selected"':"").'>BVW</option>';
            echo '<option data-tokens="GMT Gesundheitsmanagement Tourismus"'.(($cget=='GMT')?'selected="selected"':"").'>GMT</option>';
            echo '<option data-tokens="IWI Industriewirtschaft Industrial Management"'.(($cget=='IWI')?'selected="selected"':"").'>IWI</option>';
            echo '<option data-tokens="MIG Management internationaler Geschäftsprozesse"'.(($cget=='MIG')?'selected="selected"':"").'>MIG</option>';
            echo '<option data-tokens="Bank- und Versicherungsmanagement"'.(($cget=='BVM')?'selected="selected"':"").'>BVM</option>';
            echo '<option data-tokens="Business in Emerging Markets"'.(($cget=='MEM')?'selected="selected"':"").'>MEM</option>';
            echo '<option data-tokens="Gesundheitsmanagement im Tourismus"'.(($cget=='GTM')?'selected="selected"':"").'>GTM</option>';
            echo '<option data-tokens="International Industrial Management"'.(($cget=='IIM')?'selected="selected"':"").'>IIM</option>';
        echo '</optgroup>';
    echo '</select></div>';

    echo '<div class="inputdd">Start year: <br> <select name="y" class="selectpicker" data-style="btn-info" id="y" onchange="" size="1">';
        for ($y=0; $y<=4; $y++) {
                echo '<option value="'.($jahr-$y).'"'.(($jahr-$y == $yget)?'selected="selected"':"").'>'.($jahr-$y).'</option>';
        }

    echo '</select></div><div class="breaker"></div><br>';

    echo '<div class="inputdd"><input class="btn btn-success" type="submit"></input></div>';
echo '</form><div class="breaker"></div>';


    if ($ansicht=='Month'){
        echo '<br><div class="inputdd">Monatsplan:</div><br><div class="breaker"></div>';
        echo draw_calendar((int)$monat,(int)$jahr,$xml);
    } else if ($ansicht=='Week'){
        echo '<br><div class="inputdd">Wochenplan:</div><br><div class="breaker"></div>';
        echo draw_week((int)$tag, (int)$monat,(int)$jahr,$xml);
    } else if ($ansicht=='Day'){
        echo '<br><div class="inputdd">Tagesplan:</div><br><div class="breaker"></div>';
        echo draw_day((int)$tag, (int)$monat,(int)$jahr,$xml);
    }
    }
	function getXMLData($url) {
	if (!($xml = simplexml_load_file($url))) {
		$ch = curl_init();  
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		$output = curl_exec($ch);
		curl_close($ch);
		$xml = simplexml_load_string($output);
	}
	return $xml;
}
?>
