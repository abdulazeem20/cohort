<?php

class Database
{
    protected $connection;
    protected $table;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        try {
            $connect = new PDO("mysql:dbname=cohort;host=localhost", "root", "sijuade");
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connection Successful";
            $this->connection = $connect;
        } catch (PDOException $e) {
            // echo "Error During connection {$e->getMessage()}";
        }
    }

    public function checkIfExists(array $data)
    {
        try {
            $filterdedData = $this->filterElement($data);
            $column = implode(",", array_keys($data));
            $preparedColumn = implode(",", array_keys($filterdedData));
            $query = "SELECT count(*) exist FROM $this->table WHERE $column = $preparedColumn";
            $stmt = $this->connection->prepare($query);
            $stmt->execute($filterdedData);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo "Error During connection {$e->getMessage()}";
        }
    }

    private function filterElement(array $data)
    {
        $result = [];
        foreach ($data as $key => $value) {
            $result[":$key"] = $value;
        }
        return $result;
    }
}