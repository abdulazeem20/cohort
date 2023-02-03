<?php
// session_start();
// session_destroy();
require_once __DIR__ . "/./Controllers/enrolController.php";
require_once __DIR__ . "/./Model/Intern.php";

if (isset($_POST['exist'])) {
    array_pop($_POST);
    (new EnrolController())->exists($_POST);
} else if (isset($_POST['enrolValidate'])) {
    array_pop($_POST);
    $empty = (new EnrolController())->empty($_POST);
    $notValid = (new EnrolController())->isEmail($_POST['email']);
    $numberInvalid = (new EnrolController())->isNumber($_POST['phone']);
    if (count($empty) > 0) {
        $response["status"] = "error";
        $response["message"] = $empty;
        echo json_encode($response);
    } else if ($notValid) {
        $response["status"] = "error";
        $response["message"] = $notValid;
        echo json_encode($response);
    } else if ($numberInvalid) {
        $response["status"] = "error";
        $response["message"] = $numberInvalid;
        echo json_encode($response);
    } else {
        $response["status"] = "success";
        echo json_encode($response);
    }
} else if (isset($_POST['insert'])) {
    array_pop($_POST);
    (new EnrolController())->insert($_POST);
} else if (isset($_POST["login"])) {
    array_pop($_POST);
    ((new EnrolController)->checkUser($_POST));
} else if (isset($_POST["saveScore"])) {
    $update = (new Intern())->updateScore([
        "email" => $_SESSION["testUser"],
        "score" => $_POST["score"]
    ]);
    if ($update) {
        session_destroy();
        echo json_encode(["status" => true]);
    } else {
    }
}