<?php
require_once '../models/User.php';

class AuthController
{
    private $userModel;

    public function __construct()
    {
        global $pdo;
        $this->userModel = new User($pdo);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Trouve l'utilisateur par nom d'utilisateur
            $user = $this->userModel->findUserByUsername($username);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                // Redirection en fonction du rôle de l'utilisateur
                if ($user['role'] === 'Développeur') {
                    header('Location: /admin/dashboard');
                }
                if ($user['role'] === 'Rapporteur') {
                    header('Location: /user/dashboard');
                }
            } else {
                echo "Nom d'utilisateur ou mot de passe incorrect.";
            }
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $role = $_POST['role']; // Assurez-vous que le formulaire d'inscription permet de choisir un rôle

            if ($this->userModel->createUser(['name' => $name, 'email' => $email, 'password' => $password, 'role' => $role])) {
                header('Location: /login');
                exit();
            } else {
                echo "Erreur lors de l'inscription.";
            }
        }
    }

    // Ajoutez la méthode logout ici
    public function logout()
    {
        // Détruire toutes les données de session
        session_unset();
        session_destroy();
        
        // Rediriger vers la page de connexion après la déconnexion
        header('Location: /login');
        exit();
    }
}
