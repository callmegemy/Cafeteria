<?php

    // session_start();
    // if($_SESSION['login']){
    //     header("location:home.php");
    // }else{
    //     session_destroy();
    // }
  if(isset($_GET['errors'])){
      $errors = json_decode($_GET['errors'],true);
  }
  if(isset($_GET['prev_data'])){
      $prev_data = json_decode($_GET['prev_data'],true);
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="images/cafeteria.png" type="image/png">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<style>

</style>

<body>
    <?php 
    require "design/header.php";
    ?>
    <div class="login-container">
        <div class="login-box">
            <form class="login-form" method="post" action="functions/user_add.php" enctype="multipart/form-data">
                <h1>Add User</h1>

                        <div class="input-box">
                    <label class="form-label" for="name"> Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your first name"  value="<?php $val=isset($prev_data['name'])?$prev_data['name']:"";echo $val;?>" > 
                            <span class="text-danger">
                    <?php $error=isset($errors['name'])? $errors['name']: ''; echo $error; ?>
                    </span>
                    </div>

                        <div class="input-box">
                    <label class="form-label" for="email"> Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your email"  value="<?php $val=isset($prev_data['email'])?$prev_data['email']:"";echo $val;?>" > 
                            <span class="text-danger">
                    <?php $error=isset($errors['email'])? $errors['email']: ''; echo $error; ?>
                    </span>
                    </div>

                <div class="input-box">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" placeholder="Username"  value="<?php $val=isset($prev_data['username'])?$prev_data['username']:"";echo $val;?>">
                    <span class="text-danger">
                    <?php $error=isset($errors['username'])? $errors['username']: ''; echo $error; ?>
                    </span>
                </div>

                <div class="input-box">
            <label class="form-label" for="room">Room No.</label>
            <input type="text" id="room" name="room" placeholder="Room"  value="<?php $val=isset($prev_data['room'])?$prev_data['room']:"";echo $val;?>">
            <span class="text-danger">
                    <?php $error=isset($errors['room'])? $errors['room']: ''; echo $error; ?>
                    </span>
        </div>

        <div class="input-box">
            <label class="form-label" for="ext">Ext</label>
            <input type="text" class="form-control" id="ext" name="ext" placeholder="Ext" value="<?php $val=isset($prev_data['ext'])?$prev_data['ext']:"";echo $val;?>" >
            <span class="text-danger">
            <?php $error=isset($errors['ext'])? $errors['ext']: ''; echo $error; ?>
        </span>
        </div>
      
  

        <div class="input-box">
            <label class="form-label" for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" >
             <span class="text-danger">
            <?php $error=isset($errors['password'])? $errors['password']: ''; echo $error; ?>
        </span>
        </div>
        <div class="input-box">
            <label class="form-label" for="confirm">Confirm Password</label>
            <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Re-type Password" >
             <span class="text-danger">
            <?php $error=isset($errors['confirm'])? $errors['confirm']: ''; echo $error; ?>
        </span>
        </div>


                <div class="input-box">
            <label class="form-label" for="img">Profile Picture</label>
            <input type="file" class="form-control" id="img" name="img"   >
            <span class="text-danger">
            <?php $error=isset($errors['img'])? $errors['img']: ''; echo $error; ?>
        </span>
        </div>
                <div class="button-box">
                    <button type="submit">Submit</button>
                    <button type="reset">Reset</button>
                </div>
                

                
            </form>
        </div>
    </div>
    <?php 
    require "design/footer.php";
    ?>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>

</body>

</html>