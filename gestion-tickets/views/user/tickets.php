<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Tickets</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table th, .table td {
            vertical-align: middle;
        }
        .actions a {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4 text-primary">Mes Tickets</h1>

    <div class="d-flex justify-content-between mb-4">
        <a href="/user/tickets/create" class="btn btn-success">Créer un nouveau ticket</a>
        <a href="/user/dashboard" class="btn btn-secondary">Tableau de bord</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Statut</th>
                    <th>Projet</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tickets as $ticket): ?>
                <tr>
                    <td><?php echo htmlspecialchars($ticket['title']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['description']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['status']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['project_name']); ?></td>
                    <td><?php echo htmlspecialchars($ticket['created_at']); ?></td>
                    <td class="actions">
                        <a href="/user/tickets/edit/<?php echo $ticket['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="/user/tickets/view/<?php echo $ticket['id']; ?>" class="btn btn-info btn-sm">Voir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Lien vers le JS de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
