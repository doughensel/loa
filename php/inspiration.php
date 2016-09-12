<?php

$active = $_POST[active]  ?: true;
$id     = $_POST[eventID] ?: -1;
$desc   = $_POST[desc]    ?: '';
$ref    = $_POST[ref]     ?: '';
$refAdd = $_POST[refAdd]  ?: '';
$date   = $_POST[date]    ?: '';

$reference = '../js/json/inspiration.json';
$json = array();

if( file_exists( $reference ) ){
	$json = json_decode(file_get_contents($reference), true) ?: array();
}else{
	file_put_contents( $reference, '' );
}

$result = array( "desc" => $desc, "ref" => $ref, "refAdd" => $refAdd, "date" => $date, "active" => $active );

if( $id >= 0 ){
	$json[$id] = $result;
}else{
	if( $desc !== '' ){
		array_push( $json, $result );
	}
}

file_put_contents($reference, json_encode($json));

$html = '<ul id="inspirations">';
$temp = array();
$random = 0;
$max  = ( count($json) < 5 ? count($json) : 5 );
for( $x = 0; $x<$max; $x++ ){
	$random = rand(0, ( count($json) - 1) );
	$temp   = array_splice( $json, $random, 1 );
	$html  .= '<li><a href="inspiration.html?id=' . $x . '"><span class="txtDesc">' . $temp[0]["desc"] . '</span> <span class="txtRef">' . $temp[0]["ref"] . ' ' . $temp[0]["refAdd"] . '</span> <span class="txtDate">' . $temp[0]["date"] . '</span></a></li>';
}
$html .= '</ul>';

$output = str_replace( '{$output}', $html, file_get_contents('../templates/inspiration.html') );

file_put_contents('../modules/inspiration.html', $output);

header( 'Location: stitcher.php' );

?>