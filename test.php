<!DOCTYPE html>
<?php
require_once __DIR__ . '/./src/request.php';
if (!isset($_SESSION["testUser"])) {
    header("location: login.php");
}
$user = (new Intern())->fetchUser(["email" => $_SESSION["testUser"]])[0];
if ($user["trial"] < 3) {
    (new Intern)->updateTrial(["email" => $_SESSION["testUser"]]);
} else if ($user["trial"] >= 3) {
    $update = (new Intern())->updateScore([
        "email" => $_SESSION["testUser"],
        "score" => 0
    ]);
    if ($update) {
        session_destroy();
        header("location: login.php");
    } else {
    }
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/styles/css/test.css">
    <link rel="stylesheet" href="./assets/styles/css/all.min.css">
    <title>Test</title>
</head>

<body>

    <header>
        <div class="left">
            <img src="./assets/images/logo.png" alt="">
        </div>
        <div class="right">
            <div>
                <h4><?= "{$user['firstname']} {$user['lastname']}" ?></h4>
                <h6><?= $user["email"]  ?></h6>
            </div>
        </div>
    </header>
    <main>
        <form method="post">
            <div class="head">


                <button class="modalToggler" data-target="#confirmModal" type="button">Submit</button>
            </div>
        </form>
    </main>
    <div class="myModal" id="confirmModal">
        <div class="modalContent">
            <div class="myModal-header">
                <button class="modal-close">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="myModal-body">
                <div><i class="fas fa-exclamation-triangle"></i> </div>
                <p>Are you sure you want to submit ?</p>
                <div class="button__container">
                    <button class="modal-close">Cancel</button>
                    <button class="submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <footer>

    </footer>

    <script src=" ./assets/scripts/all.min.js"></script>
    <script src="./assets/scripts/jquery.js"></script>
    <script src="./assets/scripts/md5.js"></script>
    <script src="./assets/scripts/script.js"></script>
    <script src="./assets/scripts/test.js" type="module"></script>
</body>

</html>