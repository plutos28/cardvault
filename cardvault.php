<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//     header("location: login.php");
//     exit;
// } else {
//     header("location: cardvault.php");
// }


$title = "Cardvault";
ob_start();
include __DIR__ . "/templates/cardvault.html.php";
$output = ob_get_clean();

include __DIR__ . "/templates/layout.html.php";
