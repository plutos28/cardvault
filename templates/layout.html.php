<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php include './css/normalize.css'?>
        <?php include './css/style.css' ?>
    </style>
    <title><?=$title?> CardVault</title>
</head>
<body>
    <nav>
        <div class="nav-left-side nav-spacing">
            <a href="index.php" class="brand-link">CardVault</a>
        </div>
        <div class="nav-right-side nav-spacing">
            <a href="help.php">Help</a>
            <a href="login.php" class="login-link">Log In</a>
            <a href="signup.php" class="signup-link">Sign Up</a>
        </div>

    </nav>
    <main>
        <?=$output?>
    </main>
</body>
</html>