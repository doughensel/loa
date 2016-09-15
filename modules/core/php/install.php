<?php

	include_once('config.php'); // $GLOBALS[] and also includes functions.php

	$json     = array();
	$mod_name = $_GET['name'] ?: '';
	$folders  = scandir( $GLOBALS['MOD_ROOT'] );


	// check if the data file exists
	if( !file_exists($GLOBALS['DATA']) ){
		$path = '';
		$info = array();
		foreach( $folders as $folder ){
			$path = $GLOBALS['MOD_ROOT'] . $folder;
			if( is_dir($path) 
				&& $folder !== '.' && $folder !== '..' 
				&& $folder !== 'core' 
				&& file_exists($path . '/info.json') )
			{
				$info = json_decode( file_get_contents($path . '/info.json'), true );
				array_push( $json, $info );
			}
		}
	}else{
		$json = json_decode( file_get_contents($GLOBALS['DATA'] ), true );
	}// if( !file_exists($GLOBALS['DATA']) )


	// force latest data for module IDed in URL
	if( $mod_name !== '' ){
		$path  = $GLOBALS['MOD_ROOT'] . $mod_name . '/info.json';
		$info  = getJSONasArray( $path );
		$index = findIndex( $json, 'name', $mod_name );
		if( $index >= 0 ){
			$json[$index] = $info;
		}else{
			array_push( $json, $info );
		}
	}// if( $mod_name !== '' )


	// check dependencies
	if( count($json) > 0 ){
		foreach( $json as $elem ){
			if($elem['dependencies']){
				foreach( $elem['dependencies'] as $key => $value ){
					if( $key === 'modules' ){
						for( $i=0, $x=count($value); $i<$x; $i++) {
							if( !findIndex( $json, 'name', $value[$i] ) ){
								echo 'ERROR: ' . $elem['name'] . ' is missing the dependency -> ' . $value[$i] . '<br />';
							}// if( !findIndex( $json, 'name', $value[$i] ) )
						}// for( $i=0, $x=count($value); $i<$x; $i++) 
					}else{
						for( $i=0, $x=count($value); $i<$x; $i++ ){
							$path = $GLOBALS['MOD_ROOT'] . 'core/' . $key . '/' . $value[$i];
							if( !file_exists($path) ){
								echo 'ERROR: ' . $elem['name'] . ' is missing the dependency -> ' . $path . '<br />';
							}
						}
					}// if( $key === 'modules' )
				}// foreach( $elem['dependencies'] as $key => $value )
			}// if($elem['dependencies'])
		}// foreach( $json as $elem )
	}// if( count($json) > 0 )



	file_put_contents($GLOBALS['DATA'], json_encode($json) );
	

?>