<?php
session_start();
require_once '../config/config.php';
require_once '../src/User.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['new_password'];
    $userId = $_SESSION['user_id'];

    if ($user->changePassword($userId, $newPassword)) {
        $message = "Password changed successfully";
    } else {
        $error = "Failed to change password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
</head>
</head>
<body>
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4 mb-5 bg-white rounded">
                    <div class="card-body">
                        <h2 class="card-title text-center">Change Password</h2>
                        <?php if (isset($message)): ?>
                            <div class="alert alert-success"><?php echo $message; ?></div>
                        <?php endif; ?>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form action="change_password.php" method="POST">
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-warning btn-block"><i class="fas fa-key"></i> Change Password</button>
                        </form>
                        <br>
                        <a href="dashboard.php" class="btn btn-primary btn-block"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
