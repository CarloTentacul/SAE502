<?php
session_start();
require_once '../config/config.php';
require_once '../models/Message.php';

// Récupérer les données du formulaire
$ticket_id = isset($_POST['ticket_id']) ? intval($_POST['ticket_id']) : 0;
$message_text = isset($_POST['message']) ? trim($_POST['message']) : '';

// Vérifier que les champs requis sont remplis
if ($ticket_id > 0 && !empty($message_text)) {
    // Créer une instance de la classe Message
    $messageModel = new Message($pdo);
    
    // Obtenez l'ID de l'utilisateur connecté (admin)
    $user_id = $_SESSION['user_id']; // Assurez-vous que l'ID de l'utilisateur admin est stocké dans la session
    
    // Enregistrer le message
    $messageModel->addMessage($ticket_id, $user_id, $message_text);
    
    // Renvoyer une réponse JSON indiquant le succès
    echo json_encode(['status' => 'success', 'message' => 'Message envoyé avec succès']);
} else {
    // Renvoyer une réponse JSON indiquant une erreur
    echo json_encode(['status' => 'error', 'message' => 'ID du ticket ou message invalide']);
}
