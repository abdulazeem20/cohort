<?php
require_once __DIR__ . "/../Model/Intern.php";


class EnrolController
{
    public function __construct()
    {
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
            header('location: ../../login.php');
        } else {
            header("location:". $_SERVER['HTTP_ORIGIN']. '/enrol.html');
        }
    }
}
