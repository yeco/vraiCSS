<?php
/* ----------------------------- vraiCSS ----------------------------------
* simple yet useful script that allows to use vars 
* (and soon other methods) on CSS allowing some code reuse.
*
* Copyright (c) 2010 Yëco, pobreyeco@gmail.com
*
* Planned to be Licensed under MIT-style license (google it).
*
*/

if(!isset($_GET['css']))exit('/* a "css" parameter is needed*/');
$filename=$_GET['css'];

$min = isset($_GET['min']);


$location = $_SERVER['PATH_INFO'];
$filename = realpath($location).'/'.$filename;

if(!file_exists($filename))exit('/* bummer, the css file does not exist */');



$matches=array();
$file=file_get_contents($filename);
preg_match_all('/^(!.*)$/m',$file,$matches);


$names=array();
$values=array();
foreach(array_reverse($matches[0]) as $match){
  $match=preg_replace('/\s+/',' ',trim($match));  
  $names[]=preg_replace('/\s.*/','',$match);
  $values[]=preg_replace('/^[^\s]*\s/','',$match);
}

/* 
* Simple minifier 
* @params $css String
*/

function doMin( $css ) {
	$css = preg_replace( '#\s+#', ' ', $css );
	$css = preg_replace( '#/\*.*?\*/#s', '', $css );
	$css = str_replace( '; ', ';', $css );
	$css = str_replace( ': ', ':', $css );
	$css = str_replace( ' {', '{', $css );
	$css = str_replace( '{ ', '{', $css );
	$css = str_replace( ', ', ',', $css );
	$css = str_replace( '} ', '}', $css );
	$css = str_replace( ';}', '}', $css );

	return trim( $css );
};


$output = str_replace($names,$values,$file);

$output = ($min)?doMin($output):$output;



header('Cache-Control: max-age=2592000');
header('Expires-Active: On');
header('Expires: Fri, 1 Jan 2500 01:01:01 GMT');
header('Pragma:');
header('Content-type: text/css; charset=utf-8');


echo $output;