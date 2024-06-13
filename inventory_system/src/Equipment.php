<?php
class Equipment {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register($name, $description, $quantity) {
        $stmt = $this->pdo->prepare("INSERT INTO equipment (name, description, quantity) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $description, $quantity]);
    }

    public function getAll($page = 1, $itemsPerPage = 10) {
        $offset = ($page - 1) * $itemsPerPage;
        $stmt = $this->pdo->prepare("SELECT * FROM equipment LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM equipment WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
?>
