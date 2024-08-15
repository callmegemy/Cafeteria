<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/myorders.css">
    <link rel="icon" href="images/cafeteria.png" type="image/png">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/footer.css">
    <style>
    .myBtn {
  background-color: #4b3723 !important;
  color: white;
  transition: all 0.3s;
}

.myBtn:hover {
  color: white !important;
  background-color: #4b3723 !important;
}

.myInput:focus {
  border-color: #4f3131 !important;
  box-shadow: 0 0 0 0.25rem rgba(79, 49, 49, 0.15);
}
.success-btn {
  transition: background-color 0.1s;
  border: 1px solid grey;
}
.success-btn:hover {
  background-color: #4b3723;
  color: white;
}
.pg-link {
  color: #4b3723 !important;
}
.pg-link:focus {
  box-shadow: 0 0 0 0.25rem rgba(79, 49, 49, 0.15);
  background-color: white;
}
</style>
    
    <title>Checks</title>
</head>

<body>
<?php 
    include 'design/header.php';
    if($data['perm_id'] == 1){header("Location: home.php");};

 ?>

    <main class="container p-4">
        <h1 class="mb-3"><span style="background-color: #4f3131; padding: 0px 10px; border-radius: 16px; color:white">C</span>hecks</h1>

        <div style="max-width: 550px;" class="row">
            <div class="col-12 col-md-6">
                <label for="from_date" class="form-label">From</label>
                <input id="from_date" class="form-control myInput" type="date">
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label for="to_date" class="form-label">To</label>
                <input id="to_date" class="form-control myInput" type="date">
            </div>

            <div class="col-12">
                <label for="user" class="form-label">Product Category</label>
                <select id="user" class="form-select myInput" id="category">
                    <option selected>Select the user</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>

        <!-- Users and amount table -->
        <table class="table mt-3 table-bordered">
            <thead>
                <tr>
                    <th style="background-color: #4f3131; color: white" scope="col">Name</th>
                    <th style="background-color: #4f3131; color: white" scope="col">Total Amount</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row" class="d-flex align-items-center gap-2">
                        <button id="show_orders_button" class="btn btn-sm success-btn">+</button>
                        <span>Shrouk</span>
                    </th>
                    <td>100000</td>
                </tr>
            </tbody>
        </table>

        <!-- Orders table -->
        <div id="orders_table" style="padding: 0 32px; display: none; " class="p-6" id="second-table">
            <table class="table table-bordered mt-3 p-6">
                <thead>
                    <tr>
                        <th style="background-color: #4f3131; color: white" scope="col">Order Date</th>
                        <th style="background-color: #4f3131; color: white" scope="col">Amount</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" class="d-flex align-items-center gap-2">
                            <button id="show_order_details_button" class="btn btn-sm success-btn">+</button>
                            <span>2020/5/5</span>
                        </th>
                        <td>150</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="order_details" style="display: none;" class="row">
            <div class="col-6 col-md-4 col-lg-2 text-center mb-3">
                <img class="img-fluid product-img" src="./assets/product.jpg" alt="">
                <h5 class="mt-3">Coffe</h5>
                <h6>x5</h6>
            </div>

            <div class="col-6 col-md-4 col-lg-2 text-center">
                <img class="img-fluid product-img" src="./assets/product.jpg" alt="">
                <h5 class="mt-3">Coffe</h5>
                <h6>x5</h6>
            </div>
        </div>

        <nav class="d-flex justify-content-center">
     

     <div class="pagination mt-4" >
       <button class="prev-page">&lt;</button>
       <span class="page-number">1</span>

       <button class="next-page">&gt;</button>
   </div>
   </nav>
    </main>
    <?php 
 require "design/footer.php";
 ?>


    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.js"></script>

    <script>
  let currentPage = 1;
const itemsPerPage = 3; // Number of items per page
const rows = document.querySelectorAll('tbody tr'); // Select all table rows
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

    <script>
        let orders_table_shown = false
        let order_details_shown = false
        $("#show_orders_button").click(() => {
            if (orders_table_shown) {
                orders_table_shown = false
                $("#show_orders_button").text('+')
                $("#orders_table").css('display', 'none')

                if (order_details_shown) {
                    order_details_shown = false
                    $("#show_order_details_button").text('+')
                    $("#order_details").css('display', 'none')
                }
            } else {
                orders_table_shown = true
                $("#show_orders_button").text('-')
                $("#orders_table").css('display', 'block', 'padding', '0 32px')
            }
        })

        $("#show_order_details_button").click(() => {
            if (order_details_shown) {
                order_details_shown = false
                $("#show_order_details_button").text('+')
                $("#order_details").css('display', 'none')
            } else {
                order_details_shown = true
                $("#show_order_details_button").text('-')
                $("#order_details").css('display', 'flex')
                $("#order_details").css('padding', '0 48px')
            }
        })
    </script>
</body>

</html>