<?php

class Comment
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getCommentsByTicketId($ticketId)
    {
        $stmt = $this->pdo->prepare("SELECT commentaires.*, users.name FROM commentaires 
                                     LEFT JOIN users ON commentaires.user_id = users.id
                                     WHERE ticket_id = ?");
        $stmt->execute([$ticketId]);
        return $stmt->fetchAll();
    }

    public function addComment($ticketId, $userId, $texte)
    {
        $stmt = $this->pdo->prepare("INSERT INTO commentaires (user_id, texte, ticket_id) VALUES (?, ?, ?)");
        return $stmt->execute([$userId, $texte, $ticketId]);
    }
}
