<?php 

	date_default_timezone_set('America/New_York');

	function getJSONasArray( $fileName ){
		if( file_exists( $fileName ) ){
			return json_decode(file_get_contents($fileName), true) ?: array();
		}else{
			file_put_contents( $fileName, '' );
			return array();
		}
	}// function getJSONasArray( $fileName )

	function updatePaths( $data ){

		$data = str_replace( '{$ROOT}', $GLOBALS['PATH'] . $GLOBALS['ROOT'], $data );
		$data = str_replace( '{$MODULES}', $GLOBALS['MODULES'], $data );
		
		$AMP_CSS   = $GLOBALS['MOD_ROOT'] . 'core/css/amp_css.tmpl';
		$CORE_CSS  = $GLOBALS['MOD_ROOT'] . 'core/css/core_css.tmpl';
		if( fileTest( $AMP_CSS  ) && fileTest( $CORE_CSS ) ){
			$data = str_replace( '{$AMP_CSS}' , file_get_contents($AMP_CSS) , $data );
			$data = str_replace( '{$CORE_CSS}', file_get_contents($CORE_CSS), $data );
		}

		return $data;
	}// function updatePaths( $data )

	function fileTest( $fileName ){
		if( file_exists( $fileName ) ){
			return true;
		}else{
			$msg = '[[ ERROR ]] FUNCTIONS.PHP: ' . $fileName . ' is missing';
			array_push( $GLOBALS['LOG'], $msg );
			return false;
		}
	}// function fileTest( $fileName )

	function findIndex( $arr, $key, $value ){
		$counter = 0;
		foreach( $arr as $elem ){
			foreach( $elem as $k => $v ){
				if( $k === $key && $v === $value ){
					return $counter;
					break;
				}
			}// foreach( $elem as $k => $v )
			$counter++;
		}// foreach( $arr as $elem )
		return -1;
	}// function findIndex( $arr, $key, $value )

	function saveLog( $data = false ){
		$data = $data ?: $GLOBALS['LOG'];
		$d = new DateTime();
		file_put_contents( $GLOBALS['MOD_ROOT'] . 'logs/log_' . $d->getTimestamp() . '.log', json_encode($data) );
	}

?>