<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="css/myorders.css">
    <link rel="icon" href="images/cafeteria.png" type="image/png">
    <link rel="stylesheet" href="css/orders.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
</head>

<body>

    <?php
    include 'design/header.php';

    ?>
    <?php
    // Fetch the orders along with user names and product details
    $sql =
        " SELECT 
    o.date, 
    u.name, 
    o.room, 
    o.ext, 
    op.product_id, 
    op.quantity, 
    p.image, 
    p.name as product_name,
    p.price
FROM 
    orders o 
JOIN 
    users u ON o.user_id = u.id 
JOIN 
    orders_products op ON o.id = op.order_id
JOIN 
    products p ON op.product_id = p.id
WHERE 
    o.status = 1;
    ";
    $orders = $db->selectOrder($sql);


    // Organize orders by user
    $userOrders = [];
    foreach ($orders as $order) {
        $userOrders[$order['name']][] = $order;
    }
    ?>

    <div class="container">
        <main>
            <h1>Orders</h1>

            <?php foreach ($userOrders as $userName => $orders): ?>
                <div class="con">
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>Name</th>
                                <th>Room</th>
                                <th>Ext</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="order-list">
                            <tr>
                                <td><?= $orders[0]['date'] ?></td>
                                <td><?= $userName ?></td>
                                <td><?= $orders[0]['room'] ?></td>
                                <td><?= $orders[0]['ext'] ?></td>
                                <td>Deliver</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="items-container">
                        <?php
                        $total = 0;
                        foreach ($orders as $order):
                            $total += $order['price'] * $order['quantity'];
                        ?>
                            <div class="item">
                                <div class="item-image">
                                    <img src="<?= $order['image'] ?>" alt="<?= $order['product_name'] ?>">
                                    <div class="item-price"><?= $order['price'] ?> EGP</div>
                                </div>
                                <div class="item-info">
                                    <span><?= $order['product_name'] ?> x</span>
                                    <span><?= $order['quantity'] ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="total">
                            <span>Total</span>
                            <span>EGP <?= $total ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </main>
        <nav class="d-flex justify-content-center">


            <div class="pagination mt-4">
                <button class="prev-page">&lt;</button>
                <span class="page-number">1</span>

                <button class="next-page">&gt;</button>
            </div>
        </nav>
    </div>

    <?php
    require "design/footer.php";
    ?>

    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script>
        let currentPage = 1;
        const itemsPerPage = 1; // Number of items per page
        const rows = document.querySelectorAll('.con'); // Select all table rows
        const totalPages = Math.ceil(rows.length / itemsPerPage);

        function showPage(page) {
            rows.forEach((row, index) => {
                row.style.display = (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage) ? 'table-row' : 'none';
            });
            document.querySelector('.page-number').textContent = page;
        }

        document.querySelector('.prev-page').addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                showPage(currentPage);
            }
        });

        document.querySelector('.next-page').addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                showPage(currentPage);
            }
        });

        // Show the first page on load
        showPage(currentPage);
    </script>
</body>

</html>