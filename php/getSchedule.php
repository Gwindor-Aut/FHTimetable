<?php
//renderSchedule got the functions: draw_calendar, draw_week, draw_day
include ('renderSchedule.php');
function render_xml_data($url){
    //Load the provided XML of the API
    $xml = simplexml_load_file($url) or die("Error: Cannot load Schedule from FHPI");
    //Get the data of the XML-knots
    echo '<h2 class="schedule">'.$xml->Course.' '.$xml->Year.'</h2>'."\n";

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
        echo '<option value="Month"'.(($ansischt=='Month')?'selected="selected"':"").'> Monthview </option>';
        echo '<option value="Week"'.(($ansicht=='Week')?'selected="selected"':"").'> Weekview </option>';
        echo '<option value="Day"'.(($ansicht=='Day')?'selected="selected"':"").'> Dayview </option>';
    echo '</select></div><div class="breaker"></div>';

    echo '<div class="inputdd">Course of studies: <br> <select class="selectpicker" data-style="btn-info" id="c" name="c" onchange="" size="1">';
        echo '<optgroup label="Angewandte Informatik" data-max-options="2">';
            echo '<option data-tokens="ITM Internettechnik">ITM</option>';
            echo '<option data-tokens="IMA Informationsmanagement">IMA</option>';
            echo '<option data-tokens="GEB Gesundheitsinformatik eHealth">GEB</option>';
            echo '<option data-tokens="SWD Software Design">SWD</option>';
            echo '<option data-tokens="IT Mobile Security">IMS</option>';
            echo '<option data-tokens="eHealth">EHT</option>';
            echo '<option data-tokens="Informationsmanagement">AIM</option>';
            echo '<option data-tokens="IT-Recht Management">IRM</option>';
        echo '</optgroup>';
        echo '<optgroup label="Engineering">';
            echo '<option data-tokens="ECE Elektronik Computer Engineering">ECE</option>';
            echo '<option data-tokens="FZT Fahrzeugtechnik Automotive Engineering">FZT</option>';
            echo '<option data-tokens="PTO Produktionstechnik Organisation">PTO</option>';
            echo '<option data-tokens="LAV Luftfahrt Aviation">LAV</option>';
            echo '<option data-tokens="LEB Nachhaltiges Lebensmittelmanagement">LEB</option>';
            echo '<option data-tokens="Advanced Electronic Engneering">AEE</option>';
            echo '<option data-tokens="Engineering and Product Management">ENP</option>';
            echo '<option data-tokens="Luftfahrt Aviation">MAV</option>';
            echo '<option data-tokens="Fahrzeugtechnik Automotive Engineering">MAE</option>';
        echo '</optgroup>';
        echo '<optgroup label="Gesundheitsstudien">';
            echo '<option data-tokens="BIO Biomedizinische Analytik">BIO</option>';
            echo '<option data-tokens="DIO Diätologie">DIO</option>';
            echo '<option data-tokens="ERG Ergotherapie">ERG</option>';
            echo '<option data-tokens="HEB Hebammen">HEB</option>';
            echo '<option data-tokens="LOG Logopädie">LOG</option>';
            echo '<option data-tokens="PTH Physiotherapie">PTH</option>';
            echo '<option data-tokens="RAD Radiologietechnologie">RAD</option>';
            echo '<option data-tokens="Massenspektrometrie Molekulare Analytik">MMA</option>';
        echo '</optgroup>';
        echo '<optgroup label="Bauen, Energie und Gesellschaft">';
            echo '<option data-tokens="BBW Bauplanung Bauwirtschaft">BBW</option>';
            echo '<option data-tokens="EVU Energie-, Verkehrs- Umweltmanagement">EVU</option>';
            echo '<option data-tokens="SAM Soziale Arbeit">SAM</option>';
            echo '<option data-tokens="Architektur">ARC</option>';
            echo '<option data-tokens="Bauplanung Ingenieurbau">BMI</option>';
            echo '<option data-tokens="Energy and Transport Management">MET</option>';
            echo '<option data-tokens="Soziale Arbeit">SOA</option>';
        echo '</optgroup>';
        echo '<optgroup label="Medien und Design">';
            echo '<option data-tokens="IDB Industrial Design">IDB</option>';
            echo '<option data-tokens="IND Informationsdesign">IND</option>';
            echo '<option data-tokens="JPR Journalismus Public Relations (PR)">JPR</option>';
            echo '<option data-tokens="Ausstellungsdesign">AUD</option>';
            echo '<option data-tokens="Communication Design; Interaction Design; Media Design; Sound Design">CMS</option>';
            echo '<option data-tokens="Industrial Design">IDM</option>';
            echo '<option data-tokens="Content-Strategie Content Strategy">COS</option>';
        echo '</optgroup>';
        echo '<optgroup label="Management">';
            echo '<option data-tokens="BVW Bank- Versicherungswirtschaft">BVW</option>';
            echo '<option data-tokens="GMT Gesundheitsmanagement Tourismus">GMT</option>';
            echo '<option data-tokens="IWI Industriewirtschaft Industrial Management">IWI</option>';
            echo '<option data-tokens="MIG Management internationaler Geschäftsprozesse">MIG</option>';
            echo '<option data-tokens="Bank- und Versicherungsmanagement">BVM</option>';
            echo '<option data-tokens="Business in Emerging Markets">MEM</option>';
            echo '<option data-tokens="Gesundheitsmanagement im Tourismus">GTM</option>';
            echo '<option data-tokens="International Industrial Management">IIM</option>';
        echo '</optgroup>';
    echo '</select></div>';

    echo '<div class="inputdd">start year: <br> <select name="y" class="selectpicker" data-style="btn-info" id="y" onchange="" size="1">';
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
?>
