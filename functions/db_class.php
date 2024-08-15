<?php
class Database
{
    private $conn;

    public function connect($host, $username, $password, $dbname)
    {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        try {
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function insert($table, $columns, $values) {
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function insertOrder($user_id, $date, $room, $ext, $comment, $total, $status) {
        $columns = "user_id, date, room, ext, comment, total, status";
        $values = "'$user_id', '$date', '$room', '$ext', '$comment', '$total', $status";
        $this->insert('orders', $columns, $values);
        return $this->lastInsertId();
    }

    public function insertOrderProduct($order_id, $product_id, $quantity, $price, $user_id) {
        $columns = "order_id, user_id, product_id, quantity, price";
        $values = "'$order_id', '$user_id', '$product_id', '$quantity', '$price'";
        $this->insert('orders_products', $columns, $values);
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
    public function getAll($table, $field, $value)
    {
        $sql = "SELECT * FROM $table WHERE $field = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$value]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  
    public function getRows($query, $params = [])
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function lastInsertId() {
        return $this->conn->lastInsertId();
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

    public function getLatestUserProducts($user_id) {
        $sql = "SELECT p.*, op.order_id, o.date 
                FROM products p 
                JOIN orders_products op ON p.id = op.product_id 
                JOIN orders o ON op.order_id = o.id 
                WHERE o.user_id = ? 
                ORDER BY o.date DESC, op.order_id DESC 
                LIMIT 3";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
