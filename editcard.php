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

        # encrypt all the data as it goes into the database, note that encrypting needs a key, so we'll have to generate real keys later on
        $sql = "INSERT INTO `cardvault`.`carddetails` (`cardnumber`, `cardholder_name`, `cvv`, `expiration_date`, `user_id`) VALUES(AES_ENCRYPT(:cardnumber, 'secret'), AES_ENCRYPT(:cardholder_name, 'secret'), AES_ENCRYPT(:cvv, 'secret'), AES_ENCRYPT(:expiration_date, 'secret'), AES_ENCRYPT(:user_id, 'secret'))";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":cardnumber", $cardnumber);
        $stmt->bindValue(":cardholder_name", $cardholder_name);
        $stmt->bindValue(":cvv", $cvv);
        $stmt->bindValue(":expiration_date", $expiration_date);
        $stmt->bindValue(":user_id", $user_id);
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

        $sql = "SELECT id, AES_DECRYPT(`carddetails`.`cardnumber`, 'secret') AS `cardnumber`, AES_DECRYPT(`carddetails`.`cardholder_name`, 'secret') AS `cardholder_name`, AES_DECRYPT(`carddetails`.`cvv`, 'secret') AS `cvv`, AES_DECRYPT(`carddetails`.`expiration_date`, 'secret') AS `expiration_date` FROM `carddetails` WHERE AES_DECRYPT(`carddetails`.`user_id`, 'secret') = :user_id AND `carddetails`.`id` = :card_id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":user_id", $_SESSION['id']);
        $stmt->bindValue(":card_id", $card_id);
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

