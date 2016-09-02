<?php

$reference = '../js/json/thanks.json';
$json = array();

if( file_exists( $reference ) ){
	$json = json_decode(file_get_contents($reference), true) ?: array();
}else{
	file_put_contents( $reference, '' );
}

$output = array();
$temp = array();
$html = "";
$max = ( count($json) < 5 ? count($json) : 5 );
for( $x = 0; $x<$max; $x++ ){
	$random = rand(0, ( count($json) - 1) );
	$temp = array_splice( $json, $random, 1 );
	$html .= "<p>" . $temp[0]["value"] . " <span class=\"date\">" . $temp[0]["date"] . "</span></p>";
}
$template_gratitude = file_get_contents('../templates/gratitude.html');
$module_gratitude = str_replace( '{$output}', $html, $template_gratitude );

file_put_contents('../modules/gratitude.html', $module_gratitude);


header( 'Location: stitcher.php' );


?>