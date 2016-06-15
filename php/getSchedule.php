<?php
include ('renderSchedule.php');
function render_xml_data($url){
		$xml = simplexml_load_file($url) or die("Error: Cannot load Schedule from FHPI");
		echo '<h2 class="schedule">'.$xml->Course.' '.$xml->Year.'</h2>'."\n";
		
		echo '<h2>Juni 2016</h2>';
		echo draw_calendar(6,2016,$xml);
		
		foreach ($xml->Event as $record) {
			echo '<div class="schedule_item">'."\n";
			echo '<p><span class="category">Fach: </span>'.$record->Title.'</p>'."\n";
			echo '<p><span class="category">Lehrender: </span>'.$record->Lecturer.'</p>'."\n";
			echo '<p><span class="category">Ort: </span>'.$record->Location.'</p>'."\n";
			echo '<p><span class="category">Typ: </span>'.$record->Type.'</p>'."\n";
			echo '<p><span class="category">Start: </span>'.Date( 'Y-m-d | h:i', (int)$record->Start).'</p>'."\n";
			echo '<p><span class="category">Ende: </span>'.Date( 'Y-m-d | h:i', (int)$record->End).'</p>'."\n";
			echo '</div>'."\n";
		}
	}
?>