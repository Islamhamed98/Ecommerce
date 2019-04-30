<?php

     session_start();

	 if( isset($_SESSION['Username'] )){
        $pageTitle = 'dashboard';
        include 'init.php';

     }
     else
     {
        header('Location: index.php');
        exit();
     }
