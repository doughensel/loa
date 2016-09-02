<?php 

$reference = '../js/json/thanks.json';
$json = array();

if( file_exists( $reference ) ){
	$json = json_decode(file_get_contents($reference), true) ?: array();
}else{
	file_put_contents( $reference, '' );
}

date_default_timezone_set('America/New_York');

$thanks1 = htmlspecialchars($_POST[thanks1]);
if( !empty($thanks1) ){
	array_push( $json, array( "value" => $thanks1, "date" => date('M d, Y') ) );
}
$thanks2 = htmlspecialchars($_POST[thanks2]);
if( !empty($thanks2) ){
	array_push( $json, array( "value" => $thanks2, "date" => date('M d, Y') ) );
}
$thanks3 = htmlspecialchars($_POST[thanks3]);
if( !empty($thanks3) ){
	array_push( $json, array( "value" => $thanks3, "date" => date('M d, Y') ) );
}
$thanks4 = htmlspecialchars($_POST[thanks4]);
if( !empty($thanks4) ){
	array_push( $json, array( "value" => $thanks4, "date" => date('M d, Y') ) );
}
$thanks5 = htmlspecialchars($_POST[thanks5]);
if( !empty($thanks5) ){
	array_push( $json, array( "value" => $thanks5, "date" => date('M d, Y') ) );
}

file_put_contents($reference, json_encode($json));
file_put_contents('../modules/thanks.html', file_get_contents('../templates/thanks.html'));

header( 'Location: gratitude.php' );

?>