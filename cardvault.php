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

    $cardnumber = "";
    $cardholder_name = "";
    $cvv = "";
    $expiration_date = "";
    $user_id = "";


    $sql = "SELECT AES_DECRYPT(`carddetails`.`cardnumber`, 'secret') AS `cardnumber`, AES_DECRYPT(`carddetails`.`cardholder_name`, 'secret') AS `cardholder_name`, AES_DECRYPT(`carddetails`.`cvv`, 'secret') AS `cvv`, AES_DECRYPT(`carddetails`.`expiration_date`, 'secret') AS `expiration_date` FROM `carddetails` WHERE AES_DECRYPT(`carddetails`.`user_id`, 'secret') = :user_id";


    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":user_id", $_SESSION['id']);
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
