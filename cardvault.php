<?php
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
} 

// check if merchant is accessing and send to merchant admin page
if($_SESSION["merchant"] == true) {
    header("location: merchantcardvault.php");
}

// fetch the current user's stored cards
try {
    $pdo = new PDO("mysql:host=localhost;dbname=cardvault;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $cardnumber = "";
    $cardholder_name = "";
    $cvv = "";
    $expiration_date = "";
    $user_id = "";


    $sql = "SELECT id, AES_DECRYPT(`carddetails`.`cardnumber`, :user_key) AS `cardnumber`, AES_DECRYPT(`carddetails`.`cardholder_name`, :user_key) AS `cardholder_name`, AES_DECRYPT(`carddetails`.`cvv`, :user_key) AS `cvv`, AES_DECRYPT(`carddetails`.`expiration_date`, :user_key) AS `expiration_date` FROM `carddetails` WHERE AES_DECRYPT(`carddetails`.`user_id`, :user_key) = :user_id";


    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":user_id", $_SESSION['id']);
    $stmt->bindValue(":user_key", $_SESSION['user_key']);

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
include __DIR__ . "/templates/cardvault.html.php";
$output = ob_get_clean();

include __DIR__ . "/templates/layout.html.php";
