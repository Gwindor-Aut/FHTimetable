<?php
/* draws a calendar */
function draw_calendar($month,$year,$xml){
		
	/* draw table */
	$calendar = '<table cellpadding="5px" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$datum = Date('Y-m-d', mktime(0,0,0,$month,$list_day,$year));
			foreach ($xml->Event as $record) {
				if (Date( 'Y-m-d', (int)$record->Start) == $datum){
					$calendar.= str_repeat('<div class="schedule_item">'."\n".'<p>'.$record->Title.' - '.$record->Type.'</p>'."\n". '<p>'.Date( 'H:i', (int)$record->Start).'-'.Date( 'H:i', (int)$record->End).'</p>'."\n". '</div>'."\n",1);
				}
			}
			$calendar.= str_repeat('<p> </p>',2);
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}
function draw_week($givenday,$month,$year,$xml){
    
	/* draw table */
	$calendar = '<table cellpadding="5px" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$day = date('w',mktime(0,0,0,$month,$givenday,$year));
    $week_start_day = date('d', strtotime('sunday last week', mktime(0,0,0,$month,$givenday,$year)));
    $week_end_day = date('d', strtotime('saturday this week', mktime(0,0,0,$month,$givenday,$year)));
    $week_start_dim = date('t', strtotime('sunday last week', mktime(0,0,0,$month,$givenday,$year)));
    
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();
    $daycopy = $week_start_day;

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';


	/* keep going with days.... */
	for($list_day = 1; $list_day <= 7; $list_day++):
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$daycopy.'</div>';
    
			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$datum = Date('Y-m-d', mktime(0,0,0,$month,$daycopy,$year));
			foreach ($xml->Event as $record) {
				if (Date( 'Y-m-d', (int)$record->Start) == $datum){
					$calendar.= str_repeat('<div class="schedule_week_item">'."\n".'<p>'.$record->Title.' - '.$record->Type.'</p>'."\n".'<p>'.Date( 'H:i', (int)$record->Start).'-'.Date( 'H:i', (int)$record->End).'</p>'."\n"."\n".'<p>'.$record->Location.'</p>'."\n".'<p>'.$record->Lecturer.'</p>'."\n".'</div>',1);
				}
			}
        $daycopy++;
        if ($daycopy > $week_start_dim){
            $daycopy = 1;
        }
			
		$calendar.= '</td>';

		$days_in_this_week++; $day_counter++;
	endfor;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}
?>