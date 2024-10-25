<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4 text-primary">Tickets</h1>

    <!-- Liste des tickets -->
    <ul class="list-group">
        <?php foreach ($tickets as $ticket): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span><?php echo $ticket['title']; ?></span>
                <div>
                    <a href="/admin/tickets/edit/<?php echo $ticket['id']; ?>" class="btn btn-sm btn-warning">Modifier</a>
                    <a href="/admin/tickets/delete/<?php echo $ticket['id']; ?>" class="btn btn-sm btn-danger">Supprimer</a>
                    <a href="/admin/tickets/view/<?php echo $ticket['id']; ?>" class="btn btn-sm btn-info">Voir le chat</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <br>
    <a href="/admin/dashboard" class="btn btn-primary mb-3">Dashboard</a>
</div>

<!-- Lien vers le JS de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
