<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cafeteria Users</title>
  <link rel="stylesheet" href="css/CafeteriaUsers.css">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<?php 
require "design/header.php";
?>
  <div class="container">
    <h2>All Users</h2>
    <div class="add-user">
      <a class="btn edit" href="AddUser.php">Add user</a>
    </div>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Room</th>
          <th>Image</th>
          <th>Ext</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $table='users';
        $stmt = $db->select($table);
        foreach($stmt as $user){
        ?>
        <tr>
          <td><?php echo $user['name']; ?></td>
          <td><?php echo $user['room_id']; ?></td>
          <td><img class="user-image" src="<?php echo $user['image']; ?>" alt="Image"></td>
          <td><?php echo $user['ext']; ?></td>
          <td>
            <div class="actions">
              <a class="edit btn" href="edit_user.php?id=<?php echo $user['id'] ?>">Edit</a>
              <a href="#deleteModal<?php echo $user['id']; ?>" class="btn btn-danger" data-bs-toggle="modal">Delete</a>
            </div>
          </td>
        </tr>

        <div class="modal fade" id="deleteModal<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel<?php echo $user['id']; ?>" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel<?php echo $user['id']; ?>">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                Are you sure you want to delete the user <?php echo $user['name']; ?>?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="functions/delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger">Delete</a>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </tbody>
    </table>

    <nav class="d-flex justify-content-center">
      <ul class="pagination">
        <li class="page-item"><a class="page-link pg-link" href="#">&lt;</a></li>
        <li class="page-item"><a class="page-link pg-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link pg-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link pg-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link pg-link" href="#"> > </a></li>
      </ul>
    </nav>
  </div>

  <?php  
  require "design/footer.php";
  ?>
  
  <script src="bootstrap/js/bootstrap.bundle.js"></script>

</body>
</html>
