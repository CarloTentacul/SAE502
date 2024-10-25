<?php

class Message
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Ajouter un message à un ticket
    public function addMessage($ticketId, $userId, $message)
    {
        $stmt = $this->pdo->prepare("INSERT INTO messages (ticket_id, user_id, message) VALUES (:ticket_id, :user_id, :message)");
        return $stmt->execute([
            'ticket_id' => $ticketId,
            'user_id' => $userId,
            'message' => $message
        ]);
    }

    // Récupérer tous les messages liés à un ticket
    public function getMessagesByTicketId($ticketId)
    {
        $stmt = $this->pdo->prepare("SELECT messages.*, users.username FROM messages JOIN users ON messages.user_id = users.id WHERE ticket_id = :ticket_id ORDER BY created_at ASC");
        $stmt->execute(['ticket_id' => $ticketId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}