<?php
require "functions/connect.php";
require "functions/db_class.php";
session_start();
if(isset($_SESSION['login'])){
    $db = new Database();
    $db->connect($db_host, $db_user, $db_pass, $db_name);
    $table = 'users';
    $field = 'id';
    $id = $_SESSION['id'];
    $data = $db->getRow($table, $field, $id);

}else{
    session_destroy();
    header("Location: login.php");
}

?>
<header>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand mx-3" href="#">Cafeteria</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">My Orders</a></li>
                <li <?php if($data['perm_id'] == 1){echo "hidden";} ?> class="nav-item"><a class="nav-link" href="#">Products</a></li>
                <li <?php if($data['perm_id'] == 1){echo "hidden";} ?> class="nav-item"><a class="nav-link" href="#">Users</a></li>
                <li <?php if($data['perm_id'] == 1){echo "hidden";} ?> class="nav-item"><a class="nav-link" href="#">Manual Orders</a></li>
                <li <?php if($data['perm_id'] == 1){echo "hidden";} ?> class="nav-item"><a class="nav-link" href="#">Checks</a></li>
            </ul>
            <div class="navbar-nav ml-auto">
                <div class="d-flex align-items-center">
                    <img src="<?php echo $data['image'] ?>" alt="User Photo" class="rounded-circle" width="40" height="40">
                    <span class="ml-2"><?php echo $data['name']; ?></span>
                    <a class="btn  mx-3" href="functions/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
</header>
