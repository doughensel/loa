<?php 

$reference = '../js/json/timeline.json';
$json = array();

if( file_exists( $reference ) ){
	$json = json_decode(file_get_contents($reference), true) ?: array();
}else{
	file_put_contents( $reference, '' );
}

date_default_timezone_set('America/New_York');

$html = '';
foreach( $json as $key => $value ){
	if( $value[focus] && $value[active] && $value[date] > date('Y-m-d') ){
		$html .= '<h2>' . $value[name] . '</h2>';
		$date = date_create_from_format('Y-m-d', $value[date]);
		$html .= '<h3>' . $value[desc] . '</h3>';
		$html .= '<p>'  . $date->format('M d, Y') . '</p>';
		break;
	}
}

$output = str_replace( '{$output}', $html, file_get_contents('../templates/focus.html') );

file_put_contents($reference, json_encode($json));
file_put_contents('../modules/focus.html', $output);

header( 'Location: stitcher.php' );
// header( 'Location: ../timeline.html' );

?>