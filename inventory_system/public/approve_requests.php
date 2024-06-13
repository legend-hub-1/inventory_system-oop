<?php
session_start();
require_once '../config/config.php';
require_once '../src/Request.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'HoD') {
    header('Location: login.php');
    exit();
}

$request = new Request($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approve'])) {
    $requestId = $_POST['request_id'];
    if ($request->approve($requestId)) {
        $message = "Request approved successfully";
    } else {
        $error = "Failed to approve request";
    }
}

$allRequests = $request->getAll('Pending');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Approve Requests</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
</head>
</head>
<body>
<div class="container mt-5">
        <h2>Approve Requests</h2>
        <?php if (isset($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <table class="table table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Request ID</th>
                    <th>Coordinator</th>
                    <th>Equipment</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allRequests as $request): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($request['id']); ?></td>
                        <td><?php echo htmlspecialchars($request['username']); ?></td>
                        <td><?php echo htmlspecialchars($request['equipment_name']); ?></td>
                        <td><?php echo htmlspecialchars($request['status']); ?></td>
                        <td>
                            <form action="approve_requests.php" method="POST">
                                <input type="hidden" name="request_id" value="<?php echo htmlspecialchars($request['id']); ?>">
                                <button type="submit" name="approve" class="btn btn-primary"><i class="fas fa-check-circle mr-2"></i> Approve</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="dashboard.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
    </div>
</body>
</html>
