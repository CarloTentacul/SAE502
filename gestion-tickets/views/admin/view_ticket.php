<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir le Ticket</title>
</head>
<body>
    <h1>Voir le Ticket</h1>
    <p><strong>Titre:</strong> <?php echo htmlspecialchars($ticket['title']); ?></p>
    <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($ticket['description'])); ?></p>
    <p><strong>Projet:</strong> <?php echo htmlspecialchars($ticket['project_name']); ?></p>
    <p><strong>Statut:</strong> <?php echo htmlspecialchars($ticket['status']); ?></p>

    <h2>Commentaires</h2>
    <ul>
        <?php foreach ($comments as $comment): ?>
        <li>
            <strong><?php echo htmlspecialchars($comment['name']); ?>:</strong>
            <?php echo nl2br(htmlspecialchars($comment['texte'])); ?>
            <br>
            <small><?php echo htmlspecialchars($comment['date']); ?></small>
        </li>
        <?php endforeach; ?>
    </ul>