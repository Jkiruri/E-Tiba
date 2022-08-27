<?php

session_start();

if (isset($_SESSION["user_id"])){

    $mysqli = require __DIR__ ."/database.php";

    $sql = "SELECT *FROM user
            where id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result ->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>

    <?php if (isset($user)): ?>

        <p>Hello <?= htmlspecialchars($user["name"]) ?></p>

        <p><a href = "logout.php">Log Out</a></p>
    <?php else: ?>
        <p><a href = "login.php">log In </a> or <a href = "sign-up.html">sign up </a> </p> 
    
        <?php endif; ?>
</body>
</html>