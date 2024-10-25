<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Administrateur</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Bienvenue sur votre tableau de bord Administrateur</h1>
        <a href="/admin/logout" class="btn btn-outline-danger">Se déconnecter</a>
    </div>

    <p class="lead">Ici, vous pouvez gérer vos tickets et suivre leur progression.</p>

    <nav class="mt-4">
        <ul class="list-group">
            <li class="list-group-item">
                <a href="/admin/users" class="text-decoration-none">Gérer les utilisateurs</a>
            </li>
            <li class="list-group-item">
                <a href="/admin/clients" class="text-decoration-none">Gérer les clients</a>
            </li>
            <li class="list-group-item">
                <a href="/admin/projects" class="text-decoration-none">Gérer les projets</a>
            </li>
            <li class="list-group-item">
                <a href="/admin/tickets" class="text-decoration-none">Gérer les tickets</a>
            </li>
            <li class="list-group-item">
                <a href="/admin/stats" class="text-decoration-none">Voir les statistiques</a>
            </li>
        </ul>
    </nav>
</div>

<!-- Lien vers le JS de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
