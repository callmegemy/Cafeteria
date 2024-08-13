<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$user_id = $_SESSION['id'];

// Fetch orders from the database
$stmt = $pdo->prepare("SELECT o.id, o.date, o.status, o.total 
                            FROM orders o 
                            WHERE o.user_id = :user_id 
                            ORDER BY o.date DESC");
$stmt->execute(['user_id' => $user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="css/myorders.css">
    <link rel="icon" href="images/cafeteria.png" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
</head>

<body>

    <?php
    include 'design/header.php';
    ?>
    <div class="container">
        <main>
            <h1>My Orders</h1>

            <div class="filter-section">
                <div class="date-picker">
                    <label for="date-from">Date from</label>
                    <input type="date" id="date-from">
                </div>
                <div class="date-picker">
                    <label for="date-to">Date to</label>
                    <input type="date" id="date-to">
                </div>
            </div>

            <table class="order-table">
                <thead>
                    <tr>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="order-list">
                    <?php if (!empty($orders)) : ?>
                        <?php foreach ($orders as $order) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['date']); ?></td>
                                <td><?php echo htmlspecialchars($order['status']); ?></td>
                                <td><?php echo htmlspecialchars($order['total']); ?> EGP</td>
                                <td>
                                    <?php if ($order['status'] == 'Processing') : ?>
                                        <button class="cancel-btn" data-order-id="<?php echo htmlspecialchars($order['id']); ?>">Cancel</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4">No orders found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="items-container">
                <div class="item">
                    <div class="item-image">
                        <img src="images/tea.png" alt="Tea">
                        <div class="item-price">5 LE</div>
                    </div>
                    <div class="item-info">
                        <span>Tea</span>
                        <span>1</span>
                    </div>
                </div>

                <div class="item">
                    <div class="item-image">
                        <img src="images/tea.png" alt="Coffee">
                        <div class="item-price">6 LE</div>
                    </div>
                    <div class="item-info">
                        <span>Coffee</span>
                        <span>1</span>
                    </div>
                </div>

                <div class="item">
                    <div class="item-image">
                        <img src="images/tea.png" alt="Nescafe">
                        <div class="item-price">8 LE</div>
                    </div>
                    <div class="item-info">
                        <span>Nescafe</span>
                        <span>1</span>
                    </div>
                </div>

                <div class="item">
                    <div class="item-image">
                        <img src="images/tea.png" alt="Cola">
                        <div class="item-price">10 LE</div>
                    </div>
                    <div class="item-info">
                        <span>Cola</span>
                        <span>1</span>
                    </div>
                </div>

            </div>









    </div>
    <div class="total">
        <span>Total</span>
        <span>EGP 104</span>
    </div>

    <div class="pagination mt-4">
        <button class="prev-page">&lt;</button>
        <span class="page-number">1</span>

        <button class="next-page">&gt;</button>
    </div>
    </main>
    </div>
    <?php
    require "design/footer.php";
    ?>

    <script src="js/myorders.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>