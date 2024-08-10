<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/styles.css" />
    <link rel="stylesheet" href="./css/header.css">
    <title>Document</title>
  </head>


  <body>
  <?php 
    include 'design/header.php';
 ?>

    <main class="container p-4">
      <h1>Add Product</h1>
      <div class="row">
        <div class="col-12 col-lg-6">
          <form class="w-100 p-2" action="">
            <div class="mb-3">
              <label for="product" class="form-label">Product Name</label>
              <input
                id="product_name"
                required
                type="text"
                class="form-control myInput"
                id="product"
                placeholder="Enter your product name"
              />
            </div>

            <div class="mb-3">
              <label for="price" class="form-label">Product Price</label>
              <input
                id="product_price"
                required
                type="number"
                min="1"
                class="form-control myInput"
                id="price"
                placeholder="Enter your product price"
              />
            </div>

            <div class="mb-3">
              <label for="category" class="form-label">Product Category</label>
              <select
                id="product_category"
                class="form-select myInput"
                id="category"
              >
                <option selected>Choose your product category</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="pic" class="form-label">Product Picture</label>
              <input
                id="product_pic"
                required
                type="file"
                class="form-control myInput"
                id="pic"
                placeholder="Enter your product price"
              />
            </div>

            <div class="my-2 d-lg-none">
              <img
                style="object-fit: fill; aspect-ratio: 16 / 9"
                id="product_img2"
                class="img-fluid"
                alt=""
              />
            </div>

            <div class="mb-3">
              <button class="btn myBtn">Save</button>
              <button type="reset" id="reset_button" class="btn btn-secondary">
                Reset
              </button>
            </div>
          </form>
        </div>

        <div class="col-12 col-lg-6 d-none d-lg-flex justify-content-center">
          <img
            src="logoimg.png"
            style="object-fit: fill"
            id="product_img"
            class="img-fluid"
            alt=""
          />
        </div>
      </div>
    </main>

    <footer></footer>

    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery.js"></script>
  </body>
</html>