<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Utilisateur</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <!-- Titre principal -->
    <h1 class="mb-4 text-center text-primary">Bienvenue sur votre tableau de bord</h1>
    <p class="text-center">Gérez vos tickets et suivez leur progression.</p>

    <!-- Navigation avec boutons empilés -->
    <div class="d-flex flex-column align-items-center">
        <a class="btn btn-primary mb-3" href="/user/tickets">Mes Tickets</a>
        <a class="btn btn-success" href="/user/tickets/create">Créer un Ticket</a>
    </div>

    <!-- Bouton de déconnexion -->
    <div class="text-center mt-4">
        <a href="/user/logout" class="btn btn-danger">Se déconnecter</a>
    </div>
</div>

<!-- Lien vers le JS de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
