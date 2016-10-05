<?php 
	
	include_once('config.php'); // $GLOBALS[] and also includes functions.php

	$TEMPLATE  = $GLOBALS['MOD_ROOT'] . 'core/template.tmpl';

	if( !file_exists( $GLOBALS['DATA'] ) ){
		include_once('install.php');
	}

	if( fileTest( $TEMPLATE ) ){

		$FILE = file_get_contents( $TEMPLATE );

		$OUTPUT = '';

		$layout = getJSONasArray( $GLOBALS['DATA'] );

		foreach( $layout as $section ){
			if( $section['active'] === true ){
				$OUTPUT .= $section['name'];
			}else{
				$OUTPUT .= $section['desc'];
			}
		}

		$FILE = str_replace( '{$OUTPUT}', $OUTPUT, $FILE );

		$FILE= updatePaths( $FILE ); // functions.php

		file_put_contents( $GLOBALS['DOC_ROOT'] . 'index.html', $FILE);

	}

	saveLog( $GLOBALS['LOG'] );
	

?>