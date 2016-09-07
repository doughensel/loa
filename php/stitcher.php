<?php

$reference = '../js/json/modules.json';
$json = array();
$output = '';
$fName = '';
$fExists = false;

if( file_exists( $reference ) ){
	$json = json_decode(file_get_contents($reference), true) ?: array();
}else{
	file_put_contents( $reference, '' );
}

foreach( $json[module] as $key => $value ){
	if( $value[active] ){

		$fExists = false;
		$fName = '../modules/' . $value[name] . '.html';


		if( !file_exists( $fName ) ){
			$fName = '../templates/' . $value[name] . '.html';
			if( file_exists( $fName ) ){
				$fExists = true;
			}
		}else{
			$fExists = true;
		}

		if( $fExists ){
		 	$html .= file_get_contents($fName);
		}
		
	}
}


$template = file_get_contents('../templates/index.html');
$output = str_replace( '{$output}', $html, $template );
file_put_contents('../index.html', $output);

header( 'Location: ../index.html' );
?>