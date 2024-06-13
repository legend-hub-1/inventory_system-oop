<?php
session_start();
require_once '../config/config.php';
require_once '../src/Request.php';

// Check if the user is logged in and is a Coordinator
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Coordinator') {
    header('Location: login.php');
    exit();
}

$request = new Request($pdo);
$approvedRequests = $request->getApprovedRequests();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Approved Requests</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2><i class="fa fa-check-circle mr-2"></i> View Approved Requests</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Coordinator</th>
                    <th>Equipment</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($approvedRequests as $request): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($request['id']); ?></td>
                        <td><?php echo htmlspecialchars($request['username']); ?></td>
                        <td><?php echo htmlspecialchars($request['equipment_name']); ?></td>
                        <td><?php echo htmlspecialchars($request['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="dashboard.php" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</body>
</html>
