<?php
session_start();
require_once '../config/config.php';
require_once '../src/Request.php';
require_once '../src/Equipment.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Coordinator') {
    header('Location: login.php');
    exit();
}

$request = new Request($pdo);
$equipment = new Equipment($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $equipmentId = $_POST['equipment_id'];
    $userId = $_SESSION['user_id'];

    if ($request->create($userId, $equipmentId)) {
        $message = "Request created successfully";
    } else {
        $error = "Failed to create request";
    }
}

$allEquipment = $equipment->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request Equipment</title>
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
                        <h2 class="card-title text-center">Request Equipment</h2>
                        <?php if (isset($message)): ?>
                            <div class="alert alert-success"><?php echo $message; ?></div>
                        <?php endif; ?>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form action="request_equipment.php" method="POST">
                            <div class="form-group">
                                <label for="equipment_id">Equipment</label>
                                <select name="equipment_id" class="form-control" required>
                                    <?php foreach ($allEquipment as $item): ?>
                                        <option value="<?php echo htmlspecialchars($item['id']); ?>"><?php echo htmlspecialchars($item['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-warning btn-block"><i class="fas fa-toolbox"></i> Request</button>
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
