<?php 

$reference = '../js/json/timeline.json';
$json = array();

if( file_exists( $reference ) ){
	$json = json_decode(file_get_contents($reference), true) ?: array();
}else{
	file_put_contents( $reference, '' );
}

date_default_timezone_set('America/New_York');

$id = $_POST[eventID];

$active = $_POST[active];
	$active = ($active === "true" || $active === true)? true : false;
$name   = $_POST[eventName];
$desc   = $_POST[eventDescription];
$day    = $_POST[timeDayCount];
	$day = $day ?: 0;
$week   = $_POST[timeWeekCount];
	$week = $week ?: 0;
$month  = $_POST[timeMonthCount];
	$month = $month ?: 0;
$year   = $_POST[timeYearCount];
	$year = $year ?: 0;
$focus  = $_POST[focusActive];
	$focus = ($focus === "on" || $focus === true)? true : false;

$dateSt = " +{$day} day +{$week} week +{$month} month +{$year} year";
$date = date('Y-m-d');
$date = date('Y-m-d', strtotime( $dateSt, strtotime($date)));

if( $id !== '' && $day === 0 && $week === 0 && $month === 0 && $month === 0 ){
	$date = $_POST[eventDate];
}

$result = array( "name" => $name, "desc" => $desc, "active" => $active, "focus" => $focus, "date" => $date );
if( $id === '' ){
	array_push( $json, $result );
}else{
	$json[$id] = $result;
}


// Sort by date...
// http://php.net/manual/en/function.asort.php
usort($json, "custom_sort");
function custom_sort($a,$b) {
	return $a['date']>$b['date'];
}

$html = '<ul>';
$html2 = '<ul>';
foreach( $json as $key => $value ){
	$date2 = date_create_from_format('Y-m-d', $value[date]);
	$result = '<li><a href="timeline.html?id=' . $key . '">' . $value[name] . ' [' . $date2->format('M d, Y'). ']</a></li>';
	if( $value[active] && $value[date] >= date('Y-m-d') ){
		$html .= $result;
	}else{
		$html2 .= $result;
	}
}
$html .= '</ul>';
$html2 .= '</ul>';

$html .= $html2;

$output = str_replace( '{$output}', $html, file_get_contents('../templates/timeline.html') );

file_put_contents($reference, json_encode($json));
file_put_contents('../modules/timeline.html', $output);

header( 'Location: focus.php' );
// header( 'Location: ../timeline.html' );

?>