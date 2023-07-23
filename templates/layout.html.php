<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="./fonts/sweden/SwedenSans.css" />
    <style>
        <?php include './css/normalize.css'?>
        <?php include './css/style.css' ?>
    </style>
    <script src="https://unpkg.com/htmx.org@1.9.3"></script>
    <script src="https://unpkg.com/hyperscript.org@0.9.9"></script>
    <title><?=$title?> - CardVault</title>
</head>
<body>
    <nav>
        <div class="nav-left-side nav-spacing">
            <a href="index.php" class="brand-link">CardVault</a>
        </div>
        <div class="nav-right-side nav-spacing">
            <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) : ?>
                <a style="text-decoration: underline; text-transform: capitalize; margin-right: 20px" href="#">User: <?=$_SESSION["username"]?></a>
                <a href="help.php">Help</a>
                <a href="logout.php" class="signup-link">Log Out</a>
            <?php else: ?>
                <a href="help.php">Help</a>
                <a href="login.php" class="login-link">Log In</a>
                <a href="signup.php" class="signup-link">Sign Up</a>
            <?php endif; ?>
        </div>

    </nav>
    <main>
        <?=$output?>
    </main>
</body>
</html>