<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
} 

// fetch the current user's stored cards
try {
    $pdo = new PDO("mysql:host=localhost;dbname=cardvault;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM `cardvault`.`carddetails`";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $cards = $stmt->fetchAll();

} catch(PDOException $e) {
    $output = "Unable to connect to the database server: " . 
        $e->getMessage() . " in " . 
        $e->getFile() . ":" . $e->getLine();
    $output .=  "<br>" . $e;
}

$title = "Cardvault";
ob_start();
include __DIR__ . "/templates/merchantcardvault.html.php";
$output = ob_get_clean();

include __DIR__ . "/templates/layout.html.php";
