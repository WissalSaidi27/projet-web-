<?php
require_once './models/User.php';

class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function listUsers() {
        $users = $this->userModel->getAllUsers();
        require './views/user/list.php';
    }

    public function createUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $nom = trim($_POST['nom']);
            $prenom = trim($_POST['prenom']);
            if ($this->userModel->createUser($email, $password, $nom, $prenom)) {
                header('Location: index.php');
                exit;
            } else {
                echo "Erreur lors de la création.";
            }
        }
        require './views/user/create.php';
    }

    public function editUser($id) {
        $user = $this->userModel->getUserById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $nom = trim($_POST['nom']);
            $prenom = trim($_POST['prenom']);
            if ($this->userModel->updateUser($id, $email, $password, $nom, $prenom)) {
                header('Location: index.php');
                exit;
            } else {
                echo "Erreur lors de la mise à jour.";
            }
        }
        require './views/user/edit.php';
    }

    public function deleteUser($id) {
        if ($this->userModel->deleteUser($id)) {
            header('Location: index.php');
            exit;
        } else {
            echo "Erreur lors de la suppression.";
        }
    }
}
