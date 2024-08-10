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
                    <!-- Orders will be populated by JavaScript -->
                    <tr>
                        <td>2015/02/02 10:30 AM</td>
                        <td>Processing</td>
                        <td>55 EGP</td>
                        <td><button class="cancel-btn">Cancel</button></td>
                    </tr>
                    <tr>
                        <td>2015/02/01 11:30 AM</td>
                        <td>Out for delivery</td>
                        <td>20 EGP</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2015/01/01 11:35 AM</td>
                        <td>Done</td>
                        <td>29 EGP</td>
                        <td></td>
                    </tr>
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

    <div class="pagination mt-4" >
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