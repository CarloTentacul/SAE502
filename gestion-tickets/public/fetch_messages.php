<?php
session_start(); // Démarrer la session si nécessaire

require_once '../config/config.php'; // Inclure la configuration de la base de données
require_once '../models/Message.php';
require_once '../models/Ticket.php'; // Inclure le modèle de ticket pour récupérer les infos du ticket

$ticket_id = isset($_GET['ticket_id']) ? intval($_GET['ticket_id']) : 0;
if ($ticket_id <= 0) {
    echo "ID de ticket invalide.";
    exit();
}

// Créer une instance de la classe Ticket pour obtenir les informations du ticket
$ticketModel = new Ticket($pdo);
$ticket = $ticketModel->getTicketById($ticket_id);

if (!$ticket) {
    echo "Ticket non trouvé.";
    exit();
}

// Afficher les détails du ticket avant le chat
echo "<div class='ticket-details'>";
echo "<h2>" . htmlspecialchars($ticket['title']) . "</h2>";
echo "<p>" . htmlspecialchars($ticket['description']) . "</p>";
echo "</div>";

// Créer une instance de la classe Message pour obtenir les messages
$messageModel = new Message($pdo);
$messages = $messageModel->getMessagesByTicketId($ticket_id);

foreach ($messages as $message) {
    echo '<div class="chat-message">';
    echo '<strong>' . htmlspecialchars($message['username']) . ' :</strong>';
    echo '<p>' . htmlspecialchars($message['message']) . '</p>';
    echo '<small>' . htmlspecialchars($message['created_at']) . '</small>';
    echo '</div>';
}
