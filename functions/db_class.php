<?php
class Database {
    private $conn;

    public function connect($host, $username, $password, $dbname) {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        try {
            $this->conn = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function insert($table, $columns, $values) {

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function select($table) {
        $sql = "SELECT * FROM $table";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRow($table, $field, $value) {
        $sql = "SELECT * FROM $table WHERE $field = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$value]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($table, $data, $id) {
        $sql = "UPDATE $table SET $data WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }

    public function delete($table, $id) {
        $sql = "DELETE FROM $table WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>
