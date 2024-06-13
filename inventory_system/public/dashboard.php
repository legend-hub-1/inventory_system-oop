<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
</head>
</head>
<body>
<div class="container mt-5">
    <h2> <i class="fas fa-user"></i> Dashboard</h2>
    <div class="alert alert-success">Welcome, <?php echo htmlspecialchars($role); ?>!</div>
    <div class="list-group">
        <a href="change_password.php" class="list-group-item list-group-item-action btn btn-primary mb-2">
            <i class="fas fa-key mr-2"></i>Change Password
        </a>
        <?php if ($role === 'Logistic officer'): ?>
            <a href="register_equipment.php" class="list-group-item list-group-item-action btn btn-primary mb-2">
                <i class="fas fa-plus-circle mr-2"></i>Register New Equipment
            </a>
        <?php elseif ($role === 'Coordinator'): ?>
            <a href="request_equipment.php" class="list-group-item list-group-item-action btn btn-primary mb-2">
                <i class="fas fa-cart-plus mr-2"></i>Request New Equipment
            </a>
            <a href="view_equipment.php" class="list-group-item list-group-item-action btn btn-primary mb-2">
                <b>View Equipment</b> (<i class="fas fa-tools">)</i>
            </a>
            <a href="view_approved_requests.php" class="list-group-item list-group-item-action btn btn-primary mb-2">
                <b>View Approved</b> (<i class="fa fa-check-circle mr-2">)</i>
            </a>
        <?php elseif ($role === 'HoD'): ?>
            <a href="approve_requests.php" class="list-group-item list-group-item-action btn btn-primary mb-2">
                <i class="fas fa-check-circle mr-2"></i>Approve Requests
            </a>
        <?php endif; ?>
    </div>
    <a href="logout.php" class="btn btn-danger mt-3"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>
</body>
</html>
