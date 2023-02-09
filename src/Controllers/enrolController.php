<?php
require_once __DIR__ . "/../Model/Intern.php";
require_once __DIR__ . "/./../library/Email.php";


class EnrolController
{
    public function __construct()
    {
    }

    public function checkUser($data)
    {
        $exists = ((new Intern())->fetchUser($data));
        if ($exists && $exists[0]["testStatus"] != 1) {
            $_SESSION["testUser"] = $data["email"];
            echo json_encode([
                "status" => "success",
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "msg" => "Email does not exist or you've already attempted the test ",
            ]);
        }
    }

    public function exists($data)
    {
        $exists = ((new Intern())->checkIfExists($data));
        if ($exists["exist"] > 0) {
            echo json_encode([
                "status" => "error",
                "msg" => "Detail Already Exists",
            ]);
        } else {
            echo json_encode([
                "status" => "success",
            ]);
        }
    }

    public function empty(array $data)
    {
        $response = [];
        $empty = [];
        foreach ($data as $key => $value) {
            if (empty($value)) {
                // $err = "$key cant be empty";
                $empty["$key"] = "$key cant be empty";
            }
        }
        return $empty;
    }
    public function isEmail($data)
    {
        $response = [];
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            $response["status"] = "error";
            $response["invalid"] = "Email is not valid";
        }
        return $response;
    }
    public function isNumber($data)
    {
        $response = [];
        if (!is_numeric($data)) {
            $response["status"] = "error";
            $response["num_invalid"] = "Phone Number is not valid";
        }
        return $response;
    }
    public function insert($data)
    {
        $insert = ((new Intern())->insert($data));
        if ($insert) {
            (new Email($data))->sendCongratulatoryMessage();
            echo json_encode(["status" => "success"]);
        } else {
            header("location:" . $_SERVER['HTTP_ORIGIN'] . '/enrol.html');
        }
    }
}