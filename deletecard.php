<?php
session_start();


// check if user is logged in, if not redirect to cardvault
if(!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true) {
    header("location: login.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
	try {
        $pdo = new PDO("mysql:host=localhost;dbname=cardvault;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $card_id = trim($_POST["card_id"]);

        # encrypt all the data as it goes into the database, note that encrypting needs a key, so we'll have to generate real keys later on
        $sql = "DELETE FROM `cardvault`.`carddetails` WHERE `carddetails`.`id` = :card_id";

        // DELETE FROM carddetails WHERE `carddetails`.`id` = 6"

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":card_id", $card_id);
        $stmt->execute();

        header("location: cardvault.php");

    } catch(PDOException $e) {
        $output = "Unable to connect to the database server: " . 
            $e->getMessage() . " in " . 
            $e->getFile() . ":" . $e->getLine();
        $output .=  "<br>" . $e;
    }
} else {
	include __DIR__ . "/templates/addcard.html.php";
}

