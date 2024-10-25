<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un client</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4 text-warning">Modifier un client</h1>

    <!-- Formulaire de modification du client -->
    <form method="POST" action="/admin/clients/edit/<?php echo $client['id']; ?>" class="bg-light p-4 rounded shadow-sm">
        <div class="mb-3">
            <label for="entreprise" class="form-label">Nom de l'entreprise</label>
            <input type="text" name="entreprise" id="entreprise" value="<?php echo $client['entreprise']; ?>" class="form-control" required>
            <br>
            <label for="address" class="form-label">Adresse de contact</label>
            <input type="text" name="address" id="address" value="<?php echo $client['address']; ?>" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-warning">Mettre à jour</button>
    </form>

    <a href="/admin/clients" class="btn btn-link mt-3">Retour à la liste des clients</a>
</div>

<!-- Lien vers le JS de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
