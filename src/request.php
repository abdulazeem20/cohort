<?php
require_once __DIR__ . "/./Controllers/enrolController.php";

if (isset($_POST['exist'])) {
    array_pop($_POST);
    (new EnrolController())->exists($_POST);
} elseif (isset($_POST['enrolValidate'])) {
    array_pop($_POST);
    $empty = (new EnrolController())->empty($_POST);
    $notValid = (new EnrolController())->isEmail($_POST['email']);
    $numberInvalid = (new EnrolController())->isNumber($_POST['phone']);
    if (count($empty) > 0) {
        $response["status"] = "error";
        $response["message"] = $empty;
        echo json_encode($response);
    } elseif ($notValid) {
        $response["status"] = "error";
        $response["message"] = $notValid;
        echo json_encode($response);
    } elseif ($numberInvalid) {
        $response["status"] = "error";
        $response["message"] = $numberInvalid;
        echo json_encode($response);
    } else {
        $response["status"] = "success";
        echo json_encode($response);
    }
} elseif (isset($_POST['insert'])) {
    array_pop($_POST);
    (new EnrolController())->insert($_POST);
}
