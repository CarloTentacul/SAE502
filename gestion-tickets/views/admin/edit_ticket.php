<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un ticket</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4 text-primary">Modifier un ticket</h1>

    <!-- Formulaire de modification du ticket -->
    <form method="POST" action="/admin/tickets/edit/<?php echo $ticket['id']; ?>" class="mb-4">
        <div class="mb-3">
            <label for="title" class="form-label">Titre:</label>
            <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($ticket['title']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" name="description" rows="3" required><?php echo htmlspecialchars($ticket['description']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Statut:</label>
            <select class="form-select" name="status" required>
                <option value="Ouvert" <?php if ($ticket['status'] == 'Ouvert') echo 'selected'; ?>>Ouvert</option>
                <option value="En cours" <?php if ($ticket['status'] == 'En cours') echo 'selected'; ?>>En cours</option>
                <option value="Fermé" <?php if ($ticket['status'] == 'Fermé') echo 'selected'; ?>>Fermé</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="project_id" class="form-label">Projet:</label>
            <select class="form-select" name="project_id" required>
                <?php foreach ($projects as $project): ?>
                    <option value="<?php echo $project['id']; ?>" <?php if ($project['id'] == $ticket['project_id']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($project['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour le ticket</button>
    </form>

    <!-- Lien de retour vers la liste des tickets -->
    <div class="d-flex justify-content-between">
        <a href="/admin/tickets" class="btn btn-outline-secondary">Retour à la liste des tickets</a>
    </div>
</div>

<!-- Lien vers le JS de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
