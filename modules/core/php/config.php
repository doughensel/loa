<?php

$PATH     = 'http://localhost/';
$ROOT     = 'loa/';
$MODULES  = 'modules/';
$LAYOUT   = 'data.json';

$DOC_ROOT = $_SERVER['DOCUMENT_ROOT'] . '/' . $ROOT;
$MOD_ROOT = $DOC_ROOT . $MODULES;
$DATA     = $DOC_ROOT . $LAYOUT;

$LOG      = array();

include( 'functions.php' );

?>