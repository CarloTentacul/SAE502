<?php
require_once '../models/Ticket.php';
require_once '../models/Project.php';
require_once '../models/Message.php';

class TicketController
{
    private $ticketModel;
    private $projectModel;
    private $messageModel;
    private $userModel;

    public function __construct()
    {
        global $pdo;
        $this->ticketModel = new Ticket($pdo);
        $this->projectModel = new Project($pdo);
        $this->messageModel = new Message($pdo);
        $this->userModel = new User($pdo); // Si vous avez un modèle User
    }

    public function index()
    {
        if ($_SESSION['user_role'] === 'Développeur') {
            $tickets = $this->ticketModel->getAllTickets();
            require '../views/admin/tickets.php';
        } else {
            $tickets = $this->ticketModel->getTicketsByUser($_SESSION['user_id']);
            require '../views/user/tickets.php';
        }
    }

    public function view($id)
    {
        // Vérifier si le ticket existe
        $ticket = $this->ticketModel->getTicketById($id);
        if (!$ticket) {
            header('HTTP/1.0 404 Not Found');
            echo "Ticket non trouvé.";
            exit();
        }

        // Récupérer les messages associés au ticket
        $messages = $this->messageModel->getMessagesByTicketId($id);

        // Afficher la vue appropriée
        if ($_SESSION['user_role'] === 'Développeur') {
            require '../views/admin/chat.php';
        } else {
            require '../views/user/chat.php';
        }
    }

    public function sendMessage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ticketId = isset($_POST['ticket_id']) ? intval($_POST['ticket_id']) : 0;
            $messageContent = trim($_POST['message']);
            $userId = $_SESSION['user_id'];

            if ($ticketId > 0 && !empty($messageContent)) {
                $this->messageModel->addMessage($ticketId, $userId, $messageContent);
                // Vous pouvez renvoyer une réponse JSON ou rediriger
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Données invalides.']);
            }
        }
    }

    public function fetchMessages()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $ticketId = isset($_GET['ticket_id']) ? intval($_GET['ticket_id']) : 0;
            if ($ticketId > 0) {
                $messages = $this->messageModel->getMessagesByTicketId($ticketId);
                header('Content-Type: application/json');
                echo json_encode($messages);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ID de ticket invalide.']);
            }
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $projectId = isset($_POST['project_id']) ? intval($_POST['project_id']) : null;
            $createdBy = $_SESSION['user_id'];

            if (empty($title) || empty($description)) {
                echo "Le titre et la description sont obligatoires.";
                exit();
            }

            $data = [
                'title' => $title,
                'description' => $description,
                'status' => 'Ouvert',
                'project_id' => $projectId,
                'created_by' => $createdBy
            ];

            // Commencer une transaction
            $this->ticketModel->beginTransaction();

            // Créer le ticket
            $ticketId = $this->ticketModel->createTicketForUser($data);

            if ($ticketId) {
                // Ajouter un premier message avec la description du ticket
                $messageAdded = $this->messageModel->addMessage($ticketId, $createdBy, $description);

                if ($messageAdded) {
                    // Valider la transaction
                    $this->ticketModel->commit();
                    header('Location: /user/tickets/view/' . $ticketId);
                    exit();
                } else {
                    // Annuler la transaction
                    $this->ticketModel->rollBack();
                    echo "Erreur lors de l'ajout du message.";
                    exit();
                }
            } else {
                $this->ticketModel->rollBack();
                echo "Erreur lors de la création du ticket.";
                exit();
            }
        } else {
            $projects = $this->projectModel->getAllProjects();
            require '../views/user/create_ticket.php';
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $status = isset($_POST['status']) ? $_POST['status'] : 'Ouvert';
            $projectId = isset($_POST['project_id']) ? intval($_POST['project_id']) : null;

            if (empty($title) || empty($description)) {
                echo "Le titre et la description sont obligatoires.";
                exit();
            }

            $data = [
                'title' => $title,
                'description' => $description,
                'status' => $status,
                'project_id' => $projectId
            ];

            $this->ticketModel->updateTicket($id, $data);
            $redirectUrl = $_SESSION['user_role'] === 'Développeur' ? '/admin/tickets' : '/user/tickets';
            header('Location: ' . $redirectUrl);
            exit();
        } else {
            $ticket = $this->ticketModel->getTicketById($id);
            if (!$ticket) {
                header('HTTP/1.0 404 Not Found');
                echo "Ticket non trouvé.";
                exit();
            }

            $messages = $this->messageModel->getMessagesByTicketId($id);
            $projects = $this->projectModel->getAllProjects();

            if ($_SESSION['user_role'] === 'Développeur') {
                require '../views/admin/edit_ticket.php';
            } else {
                require '../views/user/edit_ticket.php';
            }
        }
    }

    public function delete($id)
    {
        // Vérifier si le ticket existe
        $ticket = $this->ticketModel->getTicketById($id);
        if (!$ticket) {
            header('HTTP/1.0 404 Not Found');
            echo "Ticket non trouvé.";
            exit();
        }

        // Supprimer le ticket
        $this->ticketModel->deleteTicket($id);

        // Redirection après la suppression
        $redirectUrl = $_SESSION['user_role'] === 'Développeur' ? '/admin/tickets' : '/user/tickets';
        header('Location: ' . $redirectUrl);
        exit();
    }
}
