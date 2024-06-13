<?php
class Request {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($userId, $equipmentId) {
        $stmt = $this->pdo->prepare("INSERT INTO requests (user_id, equipment_id) VALUES (?, ?)");
        return $stmt->execute([$userId, $equipmentId]);
    }

    public function approve($id) {
        $stmt = $this->pdo->prepare("UPDATE requests SET status = 'Approved' WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getAll($status = 'Pending') {
        $stmt = $this->pdo->prepare("SELECT r.*, u.username, e.name AS equipment_name FROM requests r
                                     JOIN users u ON r.user_id = u.id
                                     JOIN equipment e ON r.equipment_id = e.id
                                     WHERE r.status = ?");
        $stmt->execute([$status]);
        return $stmt->fetchAll();
    }
    public function getApprovedRequests() {
        $stmt = $this->pdo->prepare("
            SELECT r.id, u.username, e.name as equipment_name, r.status
            FROM requests r
            JOIN users u ON r.user_id = u.id
            JOIN equipment e ON r.equipment_id = e.id
            WHERE r.status = 'approved'
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
