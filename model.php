<?php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM user");
        return $stmt->fetchAll();
    }

    public function createUser($email, $password, $nom, $prenom) {
        $stmt = $this->pdo->prepare("INSERT INTO user (email, password, nom, prenom) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$email, password_hash($password, PASSWORD_DEFAULT), $nom, $prenom]);
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateUser($id, $email, $password, $nom, $prenom) {
        $query = "UPDATE user SET email = ?, nom = ?, prenom = ?";
        $params = [$email, $nom, $prenom];
        if (!empty($password)) {
            $query .= ", password = ?";
            $params[] = password_hash($password, PASSWORD_DEFAULT);
        }
        $query .= " WHERE id = ?";
        $params[] = $id;
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($params);
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM user WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
