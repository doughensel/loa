<?php 
	
	include_once('config.php'); // $GLOBALS[] and also includes functions.php

	$TEMPLATE  = $GLOBALS['MOD_ROOT'] . 'core/template.tmpl';
	$AMP_CSS   = $GLOBALS['MOD_ROOT'] . 'core/css/amp_css.tmpl';
	$CORE_CSS  = $GLOBALS['MOD_ROOT'] . 'core/css/core_css.tmpl';

	$filesAvailable = true;

	fileTest( $TEMPLATE );	// functions.php
	fileTest( $AMP_CSS  );	// functions.php
	fileTest( $CORE_CSS );	// functions.php

	if( !file_exists($DATA) ){
		include_once('install.php');
	}

	if( $filesAvailable ){

		$FILE = file_get_contents( $TEMPLATE );

		$OUTPUT = '';

		$FILE = str_replace( '{$OUTPUT}', $OUTPUT, $FILE );

		$FILE= updatePaths( $FILE ); // functions.php

		$FILE = str_replace( '{$AMP_CSS}' , file_get_contents($AMP_CSS) , $FILE  );
		$FILE = str_replace( '{$CORE_CSS}', file_get_contents($CORE_CSS), $FILE );

		file_put_contents( $GLOBALS['DOC_ROOT'] . 'index.html', $FILE);

	}
	

?>