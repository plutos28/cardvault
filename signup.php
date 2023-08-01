<?php
session_start();

// check if user is logged in, if yes redirect to cardvault
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: cardvault.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=cardvault;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $username = "";
        $password = "";
        $password_confirmation = "";

        $username = trim($_POST["username"]);
        $password = trim($_POST["password1"]);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $user_key = hash("sha256", $password);

        $sql = "INSERT into `customer` (username, password, user_key) VALUES (:username, :password, :user_key)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":username", $username);
        $stmt->bindValue(":password", $password);
        $stmt->bindValue(":user_key", $user_key);
        $stmt->execute();

        header("location: login.php");
    } catch(PDOException $e) {
        $output = "Unable to connect to the database server: " . 
            $e->getMessage() . " in " . 
            $e->getFile() . ":" . $e->getLine();
        $output .=  "<br>" . $e;
    }
} else {
    $title = "Sign Up";
    ob_start();
    include __DIR__ . "/templates/signup.html.php";
    $output = ob_get_clean();

    include __DIR__ . "/templates/layout.html.php";
}


