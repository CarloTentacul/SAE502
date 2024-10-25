<?php
require_once '../models/Project.php';
require_once '../models/Client.php'; // Assurez-vous d'inclure le modèle Client

class ProjectController
{
    private $projectModel;
    private $clientModel; // Ajout du modèle Client

    public function __construct()
    {
        global $pdo;
        $this->projectModel = new Project($pdo);
        $this->clientModel = new Client($pdo); // Initialisation du modèle Client
    }

    public function index()
    {
        $projects = $this->projectModel->getAllProjects();
        require '../views/admin/projects.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'client_id' => $_POST['client_id']
            ];

            $this->projectModel->createProject($data);
            header('Location: /admin/projects');
            exit();
        } else {
            $clients = $this->clientModel->getAllClients(); // Récupération des clients
            require '../views/admin/create_project.php';
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'client_id' => $_POST['client_id']
            ];

            $this->projectModel->updateProject($id, $data);
            header('Location: /admin/projects');
            exit();
        } else {
            $project = $this->projectModel->getProjectById($id);
            $clients = $this->clientModel->getAllClients(); // Récupération des clients pour la vue de modification
            require '../views/admin/edit_project.php';
        }
    }

    public function delete($id)
    {
        $this->projectModel->deleteProject($id);
        header('Location: /admin/projects');
        exit();
    }
}
