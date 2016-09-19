<?php 

	$GLOBAL['errors'] = $GLOBAL['errors'] ?: array();

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
		return $data;
	}// function updatePaths( $data )

	function fileTest( $fileName ){
		if( file_exists( $fileName ) ){
			return true;
		}else{
			$filesAvailable = false;
			echo 'ERROR: ' . $fileName . ' is missing.<br />';
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

?>