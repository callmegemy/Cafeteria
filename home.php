<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <?php
    include 'design/header.php';
    ?>

    <div class="container">
        <div class="row">
            <div class="search-select-container">
                <input type="text" id="search-input" class="form-control" placeholder="Search products...">
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-md-8  " >
                <h3 class="text-center">Products</h3>
                <div>
                    <label for="user-select">Add to User</label>
                    <select id="user-select" class="form-control">
                        <option value="">Select user</option>
                        <?php
                        $users = $db->select('users');
                        foreach ($users as $user) {
                            echo '<option value="' . $user['user_id'] . '">' . $user['name'] .  '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="row">
                    <hr class="container">
                    <?php
                    $products = $db->select('products');
                    foreach ($products as $product) {
                        echo '<div class="product-item col-6 col-md-6 col-lg-4 text-center">
                            <img src="' . $product['image'] . '" alt="' . $product['name'] . '" class="img-fluid">
                            <p>' . $product['name'] . '</p>
                            <p>EGP ' . $product['price'] . '</p>
                            <button class="btn highlight add-product" data-product="' . $product['name'] . '" data-price="' . $product['price'] . '" data-id="' . $product['id'] . '">Add</button>
                            </div>';
                    }
                    ?>
                </div>
            </div>

            <div class="col-md-3 bill">
                <h3 class="text-center">Bill</h3>
                <form id="bill-form" action="functions/add_order.php" method="POST">
                    <div id="bill-items"></div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea id="notes" name="notes" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="room">Room</label>
                        <input type="text" id="room" name="room" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ext">Ext</label>
                        <input type="text" id="ext" name="ext" class="form-control">
                    </div>
                    <hr>
                    <h4>Total: EGP <span id="total-price">0</span></h4>
                    <input type="hidden" name="total" id="total-input">
                    <button type="submit" class="btn highlight btn-block">Confirm</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    require "design/footer.php";
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script>
    $(document).ready(function() {
        function updateTotalPrice() {
            let totalPrice = 0;
            $('.bill-item').each(function() {
                const quantity = parseInt($(this).find('.quantity-controls span').text());
                const price = $(this).data('price');
                totalPrice += quantity * price;
            });
            $('#total-price').text(totalPrice);
            $('#total-input').val(totalPrice);
        }

        function updateItem($item, newQuantity) {
            $item.find('.quantity-controls span').text(newQuantity);
            $item.find('.quantity-input').val(newQuantity);

            const itemTotal = newQuantity * $item.data('price');
            $item.find('.item-total').text(itemTotal);
            $item.find('.item-total-input').val(itemTotal);

            updateTotalPrice();
        }

        $('.add-product').click(function() {
    const product = $(this).data('product');
    const price = $(this).data('price');
    const productId = $(this).data('id'); // Assuming you also have a data-id attribute
    let $item = $(`.bill-item[data-product-id="${productId}"]`);

    if ($item.length) {
        const newQuantity = parseInt($item.find('.quantity-controls span').text()) + 1;
        updateItem($item, newQuantity);
    } else {
        const billItem = `
        <div class="bill-item" data-product-id="${productId}" data-price="${price}">
            <div class="d-flex justify-content-between">
                <p>${product}</p>
                <div class="quantity-controls">
                    <button type="button" class="decrease">-</button>
                    <span>1</span>
                    <input type="hidden" name="products[${productId}][quantity]" value="1" class="quantity-input">
                    <button type="button" class="increase">+</button>
                </div>
                <p>EGP <span class="item-total">${price}</span></p>
                <input type="hidden" name="products[${productId}][total]" value="${price}" class="item-total-input">
                <input type="hidden" name="products[${productId}][id]" value="${productId}">
                <input type="hidden" name="products[${productId}][price]" value="${price}" class="price-input">
            </div>
        </div>`;
        $('#bill-items').append(billItem);
    }
    updateTotalPrice();
});


        $('#bill-items').on('click', '.increase', function() {
            const $item = $(this).closest('.bill-item');
            const newQuantity = parseInt($item.find('.quantity-controls span').text()) + 1;
            updateItem($item, newQuantity);
        });

        $('#bill-items').on('click', '.decrease', function() {
            const $item = $(this).closest('.bill-item');
            const currentQuantity = parseInt($item.find('.quantity-controls span').text());
            if (currentQuantity > 1) {
                updateItem($item, currentQuantity - 1);
            }
        });
    });
</script>
</body>

</html>
