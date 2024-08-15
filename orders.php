<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="css/orders.css">
    <link rel="icon" href="images/cafeteria.png" type="image/png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
</head>

<body>

    <?php
    include 'design/header.php';
    if($data['perm_id'] == 1){header("Location: home.php");};

    ?>
    <div class="container">
        <main>
            <h1>My Orders</h1>



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
                        <td>2015/02/02 10:30 AM</td>
                        <td>Abdulrahman Hamdy</td>
                        <td>2006</td>
                        <td>6506</td>
                        <td>deliver</td>
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
                <div class="total">
                        <span>Total</span>
                        <span>EGP 104</span>
                    </div>
                

            </div>
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
                        <td>2015/02/02 10:30 AM</td>
                        <td>Abdulrahman Hamdy</td>
                        <td>2006</td>
                        <td>6506</td>
                        <td>deliver</td>
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
                <div class="total">
                        <span>Total</span>
                        <span>EGP 104</span>
                    </div>
                

            </div>











    </div>



    </main>
    </div>
    <?php
    require "design/footer.php";
    ?>


<script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>

</html>