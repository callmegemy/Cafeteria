<?php
class Database
{
    private $conn;

    public function connect($host, $username, $password, $dbname)
    {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        try {
            $this->conn = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function insert($table, $columns, $values)
    {

        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function select($table)
    {
        $sql = "SELECT * FROM $table";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRow($table, $field, $value)
    {
        $sql = "SELECT * FROM $table WHERE $field = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$value]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($table, $data, $id)
    {
        $sql = "UPDATE $table SET $data WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }

    public function delete($table, $id)
    {
        $sql = "DELETE FROM $table WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }

    public function checkIfUserExists($table, $email)
    {
        $sql = "SELECT * FROM $table WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);

        // Check if any row was returned
        // Fetch the user ID
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        return $userData !== false ? $userData : null;
    }

    public function changePasswordByID($randomNumber, $newPassword)
    {
        $user_id = $_COOKIE['user_id'];
        $codeRow = $this->getRow("forget_password", "user_id",  $user_id);
        if ($codeRow !== false) {
            if ($randomNumber == $codeRow['random_number']) {
                $this->update('users', "password = $newPassword", $user_id);
                $this->delete('forget_password', $codeRow['id']);
                header("location:../home.php");
            } else {
                echo "you have entered wrong or expired code please try again";
            }
        } else {
            echo "there's no code";
        }
    }
}
