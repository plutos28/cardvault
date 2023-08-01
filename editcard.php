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

 		$cardnumber = "";
		$cardholder_name = "";
		$cvv = "";
		$expiration_date = "";
		$user_id = $_SESSION['id']; // doesn't matter if we use the one from the form or directly from session

        // for now, just trim the values and use them outright, no validation and error checking for now
        $cardnumber = trim($_POST["cardnumber"]);
        $cardholder_name = trim($_POST["cardholder_name"]);
        $cvv = trim($_POST["cvv"]);
        $expiration_date = trim($_POST["expiration_date"]);
        $card_id = trim($_POST["card_id"]);

        $sql = "UPDATE `cardvault`.`carddetails` SET `cardnumber`=AES_ENCRYPT(:cardnumber, :user_key), `cardholder_name`=AES_ENCRYPT(:cardholder_name, :user_key), `cvv`=AES_ENCRYPT(:cvv, :user_key), `expiration_date`=AES_ENCRYPT(:expiration_date, :user_key) WHERE id=:card_id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":cardnumber", $cardnumber);
        $stmt->bindValue(":cardholder_name", $cardholder_name);
        $stmt->bindValue(":cvv", $cvv);
        $stmt->bindValue(":expiration_date", $expiration_date);
        $stmt->bindValue(":card_id", $card_id);
        $stmt->bindValue(":user_key", $_SESSION['user_key']);

        $stmt->execute();

        header("location: cardvault.php");

    } catch(PDOException $e) {
        $output = "Unable to connect to the database server: " . 
            $e->getMessage() . " in " . 
            $e->getFile() . ":" . $e->getLine();
        $output .=  "<br>" . $e;
    }
} else {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=cardvault;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $card_id = $_GET["card_id"];
		$user_id = $_SESSION['id']; 

        $sql = "SELECT id, AES_DECRYPT(`carddetails`.`cardnumber`, :user_key) AS `cardnumber`, AES_DECRYPT(`carddetails`.`cardholder_name`, :user_key) AS `cardholder_name`, AES_DECRYPT(`carddetails`.`cvv`, :user_key) AS `cvv`, AES_DECRYPT(`carddetails`.`expiration_date`, :user_key) AS `expiration_date` FROM `carddetails` WHERE AES_DECRYPT(`carddetails`.`user_id`, :user_key) = :user_id AND `carddetails`.`id` = :card_id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":user_id", $_SESSION['id']);
        $stmt->bindValue(":card_id", $card_id);
        $stmt->bindValue(":user_key", $_SESSION['user_key']);
        $stmt->execute();
    
        $card = $stmt->fetch();

	    include __DIR__ . "/templates/editcard.html.php";
    } catch(PDOException $e) {
        $output = "Unable to connect to the database server: " . 
        $e->getMessage() . " in " . 
        $e->getFile() . ":" . $e->getLine();
        $output .=  "<br>" . $e;
    }

}

