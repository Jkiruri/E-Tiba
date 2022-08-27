<?php
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require __DIR__ ."/database.php";
    
    $sql = sprintf("SELECT *FROM user
            WHERE email = '%s'",

            $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    if ($user){

        if (password_verify($_POST["password"], $user["password_hash"])){
            
            session_start();

            session_regenerate_id();

            $_SESSION["user_id"] = $user["id"];

            header("Location: index.html");
            exit;
        }

    }

    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    <div class="login-wrapper">
        
        <?php if ($is_invalid): ?>
            <em>Invalid Login</em>
        <?php endif; ?>

        <form method = "post" class="form">
        <img src="Images/avatar.png" alt="">   
        <h1>Log in</h1>
        
        <div class="input-group">
         <label for="loginUser">E-mail</label>
         <input type = "email" name = "email" id = "loginUser"  
             value="<?= htmlspecialchars($_POST["email"] ?? "" ) ?>">     
        </div>
        <div class="input-group">
         <label for = "loginPassword">Password</label>
         <input type = "password" id = "loginPassword" name = "password">
        </div>
         <button class="submit-btn">Log in</button>
         <a href="#forgot-pw" class="forgot-pw">Forgot Password?</a>
        </form>
        
        <div id="forgot-pw">
         <form action="" class="form">
             <a href="#" class="close">&times;</a>
             <h2>Reset Password</h2>
            <div class="input-group">
                <input type="email" name="email" id="email" required>
                <label for="email">Email</label>
            </div>
            <input type="submit" value="Submit" class="submit-btn">
            </form>
        </div>
    </div>
</body>
</html>