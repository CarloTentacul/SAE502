<?php
require_once '../models/Client.php';

class ClientController
{
    private $clientModel;

    public function __construct()
    {
        global $pdo;
        $this->clientModel = new Client($pdo);
    }

    // Afficher la liste de tous les clients
    public function index()
    {
        $clients = $this->clientModel->getAllClients();
        require '../views/admin/clients.php';
    }

    // Créer un nouveau client
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'entreprise' => $_POST['entreprise'],
                'email' => $_POST['email']
            ];

            $this->clientModel->createClient($data);

            header('Location: /admin/clients');
            exit();
        } else {
            require '../views/admin/create_client.php';
        }
    }

    // Modifier un client existant
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'entreprise' => $_POST['entreprise'],
                'address' => $_POST['address']
            ];

            $this->clientModel->updateClient($id, $data);

            header('Location: /admin/clients');
            exit();
        } else {
            $client = $this->clientModel->getClientById($id);
            require '../views/admin/edit_client.php';
        }
    }

    // Supprimer un client existant
    public function delete($id)
    {
        $this->clientModel->deleteClient($id);
        header('Location: /admin/clients');
        exit();
    }
}
