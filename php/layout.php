<?php

$reference = '../js/json/modules.json';

if( !file_exists( $reference ) ){
	file_put_contents( $reference, '' );
}

$formData = json_decode($_POST[formData]);
if( !empty($formData) ){
	$array = array("module" => $formData);
	file_put_contents($reference, json_encode($array));
}

header( 'Location: stitcher.php' );

?>