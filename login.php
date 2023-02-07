<!DOCTYPE html>
<?php
require_once __DIR__ . '/./src/request.php';
if (isset($_SESSION["testUser"])) {
    header("location: test.php");
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Login</title>
    <link rel="stylesheet" href="./assets/styles/css/login.css">
    <link rel="stylesheet" href="./assets/styles/css/all.min.css">
</head>

<body>
    <form action="" id="login">
        <img src="./assets/images/logo.png" alt="Logo Image">
        <h3>KLemweb Quick Test</h3>
        <div>
            <input type="email" name="email" placeholder="Enter your email here...">
            <button type="submit" name="" class="start">Start<i class="fas fa-sign-in-alt"></i> </button>
        </div>
    </form>
    <div class="after_login">
        <button>15:00</button>
        <button class="final" type="button">Start Test</button>
    </div>
    <script src="./assets/scripts/jquery.js"></script>
    <script src="./assets/scripts/all.min.js"></script>
    <script src="./assets/scripts/login.js"></script>
</body>

</html>