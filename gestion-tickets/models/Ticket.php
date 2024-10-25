<?php

class Ticket
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Méthodes pour gérer les transactions
    public function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    public function commit()
    {
        $this->pdo->commit();
    }

    public function rollBack()
    {
        $this->pdo->rollBack();
    }

    // Créer un ticket pour un utilisateur (Rapporteur)
    public function createTicketForUser($data)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO tickets (title, description, status, project_id, created_by) VALUES (:title, :description, :status, :project_id, :created_by)");
            $stmt->execute([
                'title' => $data['title'],
                'description' => $data['description'],
                'status' => $data['status'],
                'project_id' => $data['project_id'],
                'created_by' => $data['created_by']
            ]);

            return $this->pdo->lastInsertId(); // Retourne l'ID du ticket créé
        } catch (PDOException $e) {
            // Gérer l'erreur si nécessaire
            return false;
        }
    }

    // Créer un ticket avec 'assigned_to' (utilisé par l'administrateur)
    public function createTicketForAdmin($data)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO tickets (title, description, status, project_id, created_by, assigned_to) VALUES (:title, :description, :status, :project_id, :created_by, :assigned_to)");
            $stmt->execute($data);

            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            // Gérer l'erreur si nécessaire
            return false;
        }
    }

    // Récupérer tous les tickets (utilisé par les développeurs)
    public function getAllTickets()
    {
        $stmt = $this->pdo->query("
            SELECT t.*, u.username AS created_by_username, p.name AS project_name
            FROM tickets t
            LEFT JOIN users u ON t.created_by = u.id
            LEFT JOIN projects p ON t.project_id = p.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les tickets créés par un utilisateur spécifique
    public function getTicketsByUser($userId)
    {
        $stmt = $this->pdo->prepare("
            SELECT t.*, p.name AS project_name
            FROM tickets t
            LEFT JOIN projects p ON t.project_id = p.id
            WHERE t.created_by = :user_id
        ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un ticket spécifique par son ID
    public function getTicketById($ticketId)
    {
        $stmt = $this->pdo->prepare("
            SELECT t.*, u.username AS created_by_username, p.name AS project_name
            FROM tickets t
            LEFT JOIN users u ON t.created_by = u.id
            LEFT JOIN projects p ON t.project_id = p.id
            WHERE t.id = :id
        ");
        $stmt->execute(['id' => $ticketId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mettre à jour un ticket (répondre ou modifier le statut)
    public function updateTicket($ticketId, $data)
    {
        $stmt = $this->pdo->prepare("
            UPDATE tickets 
            SET title = :title, description = :description, status = :status, project_id = :project_id 
            WHERE id = :id
        ");
        return $stmt->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status'],
            'project_id' => $data['project_id'],
            'id' => $ticketId
        ]);
    }

    // Fermer un ticket
    public function closeTicket($ticketId)
    {
        $stmt = $this->pdo->prepare("UPDATE tickets SET status = 'Fermé' WHERE id = :id");
        return $stmt->execute(['id' => $ticketId]);
    }

    // Supprimer un ticket
    public function deleteTicket($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM tickets WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // Récupérer tous les utilisateurs (pour assigner les tickets)
    public function getAllUsers()
    {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
