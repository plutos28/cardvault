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

        // for now, just trim the values and use them outright, no validation and error checking for now
        $username = trim($_POST["username"]);
        $password = trim($_POST["password1"]);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT into `user` (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":username", $username);
        $stmt->bindValue(":password", $password);
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


