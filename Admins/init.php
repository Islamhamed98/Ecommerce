<?php 

include 'Connect.php';


$tpl  = "Includes/templates/";      // The Routes For Header And Footer Pages  
$css  = "layout/css/";              //  The Routes For Css Files
$js   = "layout/js/";               //  The Routes For Js Files 
$func = "Includes/functions/";      //  The Routes For Functions page
$lang = "Includes/languages/";     //The Routes For Languages Files      

 
// Include The Important Pages

include $func . 'function.php';
include $lang . 'english.php';
include $tpl  . 'header.php';

if(!isset($navno))  include $tpl . 'navbar.php'; 
 