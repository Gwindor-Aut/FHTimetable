<?php
include ('renderSchedule.php');
function render_xml_data($url){
    $xml = simplexml_load_file($url) or die("Error: Cannot load Schedule from FHPI");
    echo '<h2 class="schedule">'.$xml->Course.' '.$xml->Year.'</h2>'."\n";
	   
    $monat = date("n");
    $jahr = date("Y");
    
    echo '<button id="prevMonth" type="button" class="btn btn-success" name="prevMonth" onClick=redMonth()><--</button> '.date('M',mktime(0,0,0,$monat,1,$jahr)).' <button id="nextMonth" type="button" class="btn btn-success" name="nextMonth" onclick="addMonth()">--></button>';
    echo '<button id="prevYear" type="button" class="btn btn-success" name="prevYear"><--</button> '.$jahr.' <button id="nextYear" type="button" class="btn btn-success" name="nextYear">--></button>';
    
    echo draw_calendar((int)$monat,(int)$jahr,$xml);
    echo '<br> Wochenplan:';
    echo draw_week(28,(int)$monat,(int)$jahr,$xml);
		
    foreach ($xml->Event as $record) {
        echo '<div class="schedule_item">'."\n";
        echo '<p><span class="category">Fach: </span>'.$record->Title.'</p>'."\n";
        echo '<p><span class="category">Lehrender: </span>'.$record->Lecturer.'</p>'."\n";
        echo '<p><span class="category">Ort: </span>'.$record->Location.'</p>'."\n";
        echo '<p><span class="category">Typ: </span>'.$record->Type.'</p>'."\n";
        echo '<p><span class="category">Start: </span>'.Date( 'Y-m-d | H:i', (int)$record->Start).'</p>'."\n";
        echo '<p><span class="category">Ende: </span>'.Date( 'Y-m-d | H:i', (int)$record->End).'</p>'."\n";
        echo '</div>'."\n";
		}
	}
?>
