<?php

if(!isset($_GET['css']))exit('/* a "css" parameter is needed*/');
$filename=$_GET['css'];

if(strpos($filename,'..')!==false)exit('/* an absolute address for your css is needed*/');
$filename=$_SERVER['DOCUMENT_ROOT'].'/'.$filename;
if(!file_exists($filename))exit('/* bummer, the css file does not exist */');


$matches=array();
$file=file_get_contents($filename);
preg_match_all('/^(!.*)$/m',$file,$matches);


$names=array();
$values=array();
foreach(array_reverse($matches[0]) as $match){
  $match=preg_replace('/\s+/',' ',rtrim(ltrim($match)));
  $names[]=preg_replace('/\s.*/','',$match);
  $values[]=preg_replace('/^[^\s]*\s/','',$match);
}


header('Cache-Control: max-age=2592000');
header('Expires-Active: On');
header('Expires: Fri, 1 Jan 2500 01:01:01 GMT');
header('Pragma:');
header('Content-type: text/css; charset=utf-8');


echo str_replace($names,$values,$file);