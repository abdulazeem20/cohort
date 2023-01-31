<?php
$email = "jane@doe.com";
$coming = $_POST['email'];
if ($coming === $email) {
    $res = "Email already exists";
    echo $res;
}
