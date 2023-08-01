<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
} elseif(isset($_SESSION["loggedin"]) && $_SESSION["merchant"] == true) {
    header("location: merchantcardvault.php");
} else {
    header("location: cardvault.php");
}
 
$title = "Home";
ob_start();
include __DIR__ . "/templates/home.html.php";
$output = ob_get_clean();


include __DIR__ . "/templates/layout.html.php";
