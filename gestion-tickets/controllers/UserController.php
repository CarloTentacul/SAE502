<?php
require_once '../models/User.php';
require_once '../models/Client.php';

class UserController
{
    private $userModel;

    public function __construct()
    {
        global $pdo;
        $this->userModel = new User($pdo);
        $this->clientModel = new Client($pdo); 
    }

    // Affiche la liste de tous les utilisateurs
    public function index()
    {
        $users = $this->userModel->getAllUsers();
        require '../views/admin/users.php';
    }

    // Crée un nouvel utilisateur
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupération des données du formulaire
            $username = $_POST['username'];
            $name = $_POST['name'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $telephone = $_POST['telephone'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hachage du mot de passe
            $entreprise = $_POST['entreprise'];
            $role = $_POST['role'];

            // Création de l'utilisateur
            $this->userModel->createUser([
                'username' => $username,
                'name' => $name,
                'prenom' => $prenom,
                'email' => $email,
                'telephone' => $telephone,
                'password' => $password,
                'entreprise' => $entreprise,
                'role' => $role
            ]);

            // Redirection vers la liste des utilisateurs après création
            header('Location: /admin/users');
            exit();
        } else {
            $clients = $this->clientModel->getAllClients(); // Récupération des clients
            require '../views/admin/create_user.php';
        }
    }

    // Modifie un utilisateur existant
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupération des données du formulaire
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'role' => $_POST['role']
            ];

            // Mise à jour de l'utilisateur
            $this->userModel->updateUser($id, $data);

            // Redirection vers la liste des utilisateurs après modification
            header('Location: /admin/users');
            exit();
        } else {
            // Récupération des informations de l'utilisateur à modifier
            $user = $this->userModel->getUserById($id);
            // Affiche le formulaire de modification avec les données actuelles de l'utilisateur
            require '../views/admin/edit_user.php';
        }
    }

    // Supprime un utilisateur existant
    public function delete($id)
    {
        // Suppression de l'utilisateur
        $this->userModel->deleteUser($id);

        // Redirection vers la liste des utilisateurs après suppression
        header('Location: /admin/users');
        exit();
    }
}
