<?php
session_start();
include "../classes/user.php";

$user = new User;
$user_list = $user->getUsers();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css4.6/bootstrap.css">
    <title>DashBorard</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="dashboard.php" class="navbar-brand">
            <h1 class="h3"> The Company</h1>
        </a>
        <div class="ml-auto">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="#" class="nav-link">Username: <?= $_SESSION['username'] ?></a></li>
                <li class="nav-item"><a href="../actions/logout.php" class="nav-link text-danger">Log out</a></li>
            </ul>
        </div>
    </nav>
    <main class="container" style="padding-top:80px">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="../views/dashboard.php" method="POST">
                        <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control mb-2" required autofocus>
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control mb-2" required>
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control mb-2 font-weight-bold" maxlength="15" required>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control mb-5" minlength="8" required>
                            <button type="submit" name="btn_register" value="dashboard" class="w-100 btn btn-success btn_block">Register</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <h2 class="text-muted">User List</h2>
                <table class="table table-hover">
                    <thead class="tead-light">
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th></th> <!--for the action -->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    //$user->fech_assoc() - transform the result set/$user_list to an associative array
                    //user is an associative array
                    while($user = $user_list->fetch_assoc()){
                    ?>
                        <tr>
                            <td><?= $user['id']?></td>
                            <td><?= $user['first_name']?></td>
                            <td><?= $user['last_name']?></td>
                            <td><?= $user['username']?></td>
                            <td>
                                <a href="editUser.php?user_id=<?= $user['id'] ?>" class="btn btn-outline-warning btn-sm">Edit</a>
                                <a href="../actions/removeUser.php?user_id=<?= $user['id'] ?>" class="btn btn-outline-danger btn-sm">Remove</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
    <script src="../script/bootstrap.bundle.js"></script>
</body>
</html>