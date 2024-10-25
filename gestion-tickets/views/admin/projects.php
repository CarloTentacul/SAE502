<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projets</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Projets</h1>
        <a href="/admin/projects/create" class="btn btn-success">Créer un projet</a>
    </div>

    <div class="list-group">
        <?php foreach ($projects as $project): ?>
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <span><?php echo $project['name']; ?></span>
                <div>
                    <a href="/admin/projects/edit/<?php echo $project['id']; ?>" class="btn btn-warning btn-sm me-2">Modifier</a>
                    <a href="/admin/projects/delete/<?php echo $project['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce projet ?');">Supprimer</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <br>
    <a href="/admin/dashboard" class="btn btn-primary mb-3">Dashboard</a>
</div>

<!-- Lien vers le JS de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
