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

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            // for now, just trim the values and use them outright, no validation and error checking for now
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);

            $sql = "SELECT id, username, password FROM user WHERE username = :username";

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":username", $username);
            $stmt->execute();

            // check if user exists
            if($stmt->rowCount() == 1) {
                if($row = $stmt->fetch()) {
                    $id = $row["id"];
                    $username = $row["username"];
                    $hashed_password = $row["password"];

                    if(password_verify($password, $hashed_password)) {
                        session_start(); 

                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $id;
                        $_SESSION["username"] = $username;

                        header("location: index.php");
                    }
                }
            }
        }
    } catch(PDOException $e) {
        $output = "Unable to connect to the database server: " . 
            $e->getMessage() . " in " . 
            $e->getFile() . ":" . $e->getLine();
        $output .=  "<br>" . $e;
    }
} else {
    $title = "Log In";

    ob_start();
    include __DIR__ . "/templates/login.html.php";
    $output = ob_get_clean();


    include __DIR__ . "/templates/layout.html.php";
}



