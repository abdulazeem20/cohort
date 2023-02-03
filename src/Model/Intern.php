<?php
require_once __DIR__ . "/Database.php";

class Intern extends Database
{
    protected $table = "intern";

    public function fetchUser($data)
    {
        try {
            $query = "SELECT * FROM intern WHERE email = :email";
            $stmt = $this->connection->prepare($query);
            $stmt->execute([
                ":email" => $data["email"]
            ]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error: {$e->getMessage()}";
        }
    }

    public function updateScore($data)
    {
        try {
            $query = "UPDATE intern SET score = :score, testStatus = 1 WHERE email = :email";
            $stmt = $this->connection->prepare($query);
            $stmt->execute([
                ":email" => $data["email"],
                ":score" => $data["score"]
            ]);
            return true;
        } catch (PDOException $e) {
            echo "Error: {$e->getMessage()}";
        }
    }
    public function updateTrial($data)
    {
        try {
            $query = "UPDATE intern SET trial = trial+1 WHERE email = :email";
            $stmt = $this->connection->prepare($query);
            $stmt->execute([
                ":email" => $data["email"]
            ]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error: {$e->getMessage()}";
        }
    }
    public function insert($data)
    {
        // print_r($data);
        try {
            $query = "INSERT INTO intern(firstname,lastname, othername, gender, email, phone_number, date_of_birth, admission_mode, course) VALUES(:firstname, :lastname, :othername, :gender, :email, :phone_number, :date_of_birth, :admission_mode, :course)";
            $insert = $this->connection;
            $prepared = $insert->prepare($query);
            $stmt = $prepared->execute([
                ':firstname' => $data['firstname'],
                ':lastname' => $data['lastname'],
                ':othername' => $data['othername'],
                ':gender' => $data['gender'],
                ':email' => $data['email'],
                ':phone_number' => $data['phone'],
                ':date_of_birth' => $data['dob'],
                ':admission_mode' => $data['admission_mode'],
                ':course' => $data['course'],
            ]);
            if ($stmt) {
                return true;
            }
        } catch (PDOException $e) {
            echo "Error: {$e->getMessage()}";
        }
    }
}