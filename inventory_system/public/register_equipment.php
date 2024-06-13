<?php
session_start();
require_once '../config/config.php';
require_once '../src/Equipment.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Logistic officer') {
    header('Location: login.php');
    exit();
}

$equipment = new Equipment($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];

    if ($equipment->register($name, $description, $quantity)) {
        $message = "Equipment registered successfully";
    } else {
        $error = "Failed to register equipment";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Equipment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
</head>
</head>
<body>
<div class="container mt-5">
    <h2>Register Equipment</h2>
    <?php if (isset($message)): ?>
        <div class="alert alert-success"><?php echo $message; ?></div>
    <?php endif; ?>
    <form action="register_equipment.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control form-control-sm" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control form-control-sm" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" class="form-control form-control-sm" required>
        </div>
        <button type="submit" class="btn btn-warning"><i class="fas fa-plus"></i> Add Equipment</button>
    </form>
    <br>
    <a href="dashboard.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
</div>
</body>
</html>
