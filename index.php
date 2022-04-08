<?php

if(!isset($_SESSION)){
    session_start();
}


require 'users/users.php';


$users = getUsers();

include 'partials/header.php';
?>

<link rel="stylesheet" href="css/style.css">

<div class="container">
    <p>
        <a class="btn btn-success" href="create.php">Create new User</a>
    </p>

    <table class="table">
        <thead>
        <tr>
            
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['firstName'] ?></td>
                <td><?php echo $user['lastName'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td><?php echo $user['clearanceLevel'] ?></td>
                <td>
                    <div class="3-button">
                        <a href="view.php?id=<?php echo $user['id'] ?>" class="btn btn-sm btn-outline-info">View</a>
                        <a href="update.php?id=<?php echo $user['id'] ?>"
                        class="btn btn-sm btn-outline-secondary">Update</a>
                        <form method="POST" action="delete.php">
                            <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </div>

                </td>
            </tr>
        <?php endforeach;; ?>
        </tbody>
    </table>
</div>

<?php include 'partials/footer.php' ?>

